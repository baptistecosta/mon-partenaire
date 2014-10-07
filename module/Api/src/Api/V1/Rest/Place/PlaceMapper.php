<?php
namespace Api\V1\Rest\Place;

use Api\V1\Rest\PlaceType\PlaceTypeEntity;
use Api\V1\Rest\PlaceType\PlaceTypeMapper;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Result;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

/**
 * Class PlaceMapper
 * @package Api\V1\Rest\Place
 */
class PlaceMapper
{
    /**
     * @var string
     */
    protected $tableName = 'places';

    /**
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $adapter;

    /**
     * @var PlaceTypeMapper
     */
    protected $placeTypeMapper;

    public function fetchOne($id)
    {
        $sql = new Sql($this->adapter);

        $select = new Select();
        $select->from($this->tableName);
        $select->columns(['id', 'name', 'latitude', 'longitude']);
        $select->where(['id' => $id]);
        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $res = $resultSet->toArray();
        if (!$placeData = $res[0]) {
            return false;
        }

        $placeTypesCollection = $this->getPlaceTypeMapper()->fetchAllForPlace($res[0]['id']);
        $placeData['types'] = array_map(function(PlaceTypeEntity $placeTypeEntity) {
            return $placeTypeEntity->getArrayCopy();
        }, $placeTypesCollection);

        $entity = new PlaceEntity();
        $entity->exchangeArray($placeData);
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
            $placeTypesCollection = $this->getPlaceTypeMapper()->fetchAllForPlace($result['id']);
            $result['types'] = array_map(function(PlaceTypeEntity $placeTypeEntity) {
                return $placeTypeEntity->getArrayCopy();
            }, $placeTypesCollection);
        }

        $collection = array_map(function($rec) {
            $entity = new PlaceEntity();
            $entity->exchangeArray($rec);
            return $entity;
        }, $results);

        return $collection;
    }

    public function create(array $data)
    {
        $sql = new Sql($this->adapter);

        $this->adapter->getDriver()->getConnection()->beginTransaction();

        $insert = $sql->insert('places');
        $insert->values([
            'name' => $data['name'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
        $query = $sql->getSqlStringForSqlObject($insert);

        /** @var Result $results */
        $results = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $placeId = $results->getGeneratedValue();

        foreach ($data['types'] as $typeId) {
            $insert = $sql->insert('places_place_types');
            $insert->values([
                'place_id' => $placeId,
                'place_type_id' => $typeId
            ]);
            $q = $sql->getSqlStringForSqlObject($insert);
            $this->adapter->query($q, Adapter::QUERY_MODE_EXECUTE);
        }

        $this->adapter->getDriver()->getConnection()->commit();

        return $placeId;
    }

    /**
     * @param mixed $adapter
     * @return $this
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @param PlaceTypeMapper $placeTypeMapper
     * @return $this
     */
    public function setPlaceTypeMapper($placeTypeMapper)
    {
        $this->placeTypeMapper = $placeTypeMapper;
        return $this;
    }

    /**
     * @return PlaceTypeMapper
     */
    public function getPlaceTypeMapper()
    {
        return $this->placeTypeMapper;
    }
}