<?php
namespace Api\V1\Rest\DepartmentMarker;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;

/**
 * Class DepartmentMarkerMapper
 * @package Api\V1\Rest\Department
 */
class DepartmentMarkerMapper
{
    /**
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $adapter;

    protected $tableName = 'departments';

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
        $resultSet = $this->adapter->query("
          SELECT
            d.id,
            d.name,
            c.latitude,
            c.longitude
          FROM departments d
          INNER JOIN cities c
             ON d.id = c.department_id
          WHERE d.id = ?
          LIMIT 1
          ;
        ", [$id]);

        $results = $resultSet->toArray();
        if (empty($results)) {
            return false;
        }

        $entity = new DepartmentMarkerEntity();
        $entity->exchangeArray($results[0]);
        return $entity;
    }

    public function fetchAll()
    {
        $sql = new Sql($this->adapter);
        $select = new Select();
        $select->from(['d' => $this->tableName]);
        $select->columns([
            'id',
            'name'
        ]);
        $select->join(['c' => 'cities'], 'c.id = d.prefecture_id', ['longitude', 'latitude']);
        $select->join(
            ['s' => new TableIdentifier('scrapped_departments', 'my_tennis_pal')],
            's.id = d.id',
            ['scrapped_department_id' => 'id'],
            'left'
        );

        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $results = $resultSet->toArray();

        if (empty($results)) {
            return false;
        }

        $collection = array_map(function($rec) {
            $rec['icon'] = empty($rec['scrapped_department_id']) ?
                'http://maps.google.com/mapfiles/ms/micons/question.png':
                'http://maps.google.com/mapfiles/ms/micons/sunny.png';

            $entity = new DepartmentMarkerEntity();
            $entity->exchangeArray($rec);
            return $entity;
        }, $results);

        return $collection;
    }
}