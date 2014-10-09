<?php
namespace Api\V1\Rest\PlaceMarker;

use Api\V1\Rest\AbstractMapper;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;

/**
 * Class PlaceMarkerMapper
 * @package Api\V1\Rest\Department
 */
class PlaceMarkerMapper extends AbstractMapper
{
    public function fetchAll(array $params = [])
    {
        $northEastBound = explode(',', $params['north-east-bound']);
        $southWestBound = explode(',', $params['south-west-bound']);

        $latSouth = floatval($southWestBound[0]);
        $latNorth = floatval($northEastBound[0]);
        $lngWest = floatval($southWestBound[1]);
        $lngEast = floatval($northEastBound[1]);

        $sql = new Sql($this->getAdapter());
        $select = $sql->select($this->getTableName());
        $select->columns([
            'id',
            'latitude',
            'longitude',
            'title' => 'name',
            'icon' => new Expression("'/img/marker.png'")
        ]);
        $select->where("CONTAINS(
            GeomFromText('POLYGON((
                {$lngWest} {$latSouth},
                {$lngWest} {$latNorth},
                {$lngEast} {$latNorth},
                {$lngEast} {$latSouth},
                {$lngWest} {$latSouth}
            ))'),
            POINT(longitude, latitude)
        )");

        $paginatorAdapter = new DbSelect($select, $this->adapter);
        $collection = new PlaceMarkerCollection($paginatorAdapter);
        return $collection;
    }
}