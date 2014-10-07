<?php
namespace Api\V1\Rest\PlaceType;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

/**
 * Class PlaceType
 * @package Api\V1\Rest\PlaceType
 */
class PlaceTypeMapper
{
    /**
     * @var string
     */
    protected $tableName = 'place_types';

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
        $select = $sql->select();
        $select->from($this->tableName);
        $select->columns(['id', 'name']);
        $select->where(['id' => $id]);

        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);

        $results = $resultSet->toArray();
        if (empty($results[0])) {
            return false;
        }
        $entity = new PlaceTypeEntity();
        $entity->exchangeArray($results[0]);
        return $entity;
    }

    public function fetchAll(array $params)
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from($this->tableName);
        $select->columns(['id', 'name']);

        $q = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($q, Adapter::QUERY_MODE_EXECUTE);

        $results = $resultSet->toArray();

        $collection = array_map(function($rec) {
            $entity = new PlaceTypeEntity();
            $entity->exchangeArray($rec);
            return $entity;
        }, $results);

        return $collection;
    }

    public function fetchAllForPlace($placeId)
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from(['pt' => 'place_types']);
        $select->columns(['id', 'name']);
        $select->join(['ppt' => 'places_place_types'], 'ppt.place_type_id = pt.id', []);
        $select->where(['ppt.place_id' => $placeId]);

        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);

        $results = $resultSet->toArray();

        return array_map(function($rec) {
            $entity = new PlaceTypeEntity();
            $entity->exchangeArray($rec);
            return $entity;
        }, $results);
    }
}