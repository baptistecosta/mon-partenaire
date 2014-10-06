<?php
namespace Api\V1\Rest\TennisPlace;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

/**
 * Class TennisPlaceMapper
 * @package Api\V1\Rest\TennisPlace
 */
class TennisPlaceMapper
{
    /**
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $adapter;

    /**
     * @param mixed $adapter
     * @return $this
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function fetchOne($id)
    {
        $sql = new Sql($this->adapter);

        $select = new Select();
        $select->from('places');
        $select->columns(['id', 'name', 'latitude', 'longitude']);
        $select->where(['id' => $id]);
        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $placesResults = $resultSet->toArray();
        if (empty($placesResults[0])) {
            return false;
        }

        $select = new Select();
        $select->from(['pt' => 'place_types']);
        $select->columns(['id', 'name']);
        $select->join(['ppt' => 'places_place_types'], 'ppt.place_type_id = pt.id', []);
        $select->where(['ppt.place_id' => $placesResults[0]['id']]);
        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $placeTypesResults = $resultSet->toArray();

        $placesResults[0]['types'] = $placeTypesResults;

        $entity = new TennisPlaceEntity();
        $entity->exchangeArray($placesResults[0]);
        return $entity;
    }

    public function fetchAll()
    {
        $sql = new Sql($this->adapter);
        $select = new Select();
        $select->from('places');
        $select->columns(['id', 'name', 'latitude', 'longitude']);

        $query = $sql->getSqlStringForSqlObject($select);

        $placesResults = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $results = $placesResults->toArray();

        foreach ($results as &$result) {
            $select = new Select();
            $select->from(['pt' => 'place_types']);
            $select->columns(['id', 'name']);
            $select->join(['ppt' => 'places_place_types'], 'ppt.place_type_id = pt.id', []);
            $select->where(['ppt.place_id' => $result['id']]);
            $query = $sql->getSqlStringForSqlObject($select);
            $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
            $placeTypesResults = $resultSet->toArray();
            $result['types'] = $placeTypesResults;
        }

        $collection = array_map(function($rec) {
            $entity = new TennisPlaceEntity();
            $entity->exchangeArray($rec);
            return $entity;
        }, $results);

        return $collection;
    }
} 