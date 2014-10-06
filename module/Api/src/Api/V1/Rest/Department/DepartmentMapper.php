<?php
namespace Api\V1\Rest\Department;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;

/**
 * Class DepartmentMapper
 * @package Api\V1\Rest\Department
 */
class DepartmentMapper
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
        $resultSet = $this->adapter->query("SELECT * FROM {$this->tableName} WHERE id = ?", [$id]);
        $results = $resultSet->toArray();
        if (empty($results)) {
            return false;
        }

        $entity = new DepartmentEntity();
        $entity->exchangeArray($results[0]);
        return $entity;
    }

    public function fetchAll()
    {
        $select = new Select($this->tableName);
        $paginatorAdapter = new DbSelect($select, $this->adapter);
        $collection = new DepartmentCollection($paginatorAdapter);
        return $collection;
    }
}