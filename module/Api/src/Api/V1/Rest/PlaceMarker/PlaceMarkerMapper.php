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
        $latSouth = floatval($params['south-west-bound']['latitude']);
        $latNorth = floatval($params['north-east-bound']['latitude']);
        $lngWest = floatval($params['south-west-bound']['longitude']);
        $lngEast = floatval($params['north-east-bound']['longitude']);

        $sql = new Sql($this->getAdapter());
        $select = $sql->select($this->getTableName());
        $select->columns([
            'id',
            'latitude',
            'longitude',
            'title' => 'name',
            'icon' => new Expression("'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'")
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