<?php
namespace Api\V1\Rest\Department;
use Api\V1\Rest\AbstractMapper;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\TableIdentifier;
use Zend\Paginator\Adapter\DbSelect;

/**
 * Class DepartmentMapper
 * @package Api\V1\Rest\Department
 */
class DepartmentMapper extends AbstractMapper
{
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

    public function fetchUnscrappedDepartmentIdFromLocation(array $location)
    {
        $sql = new Sql($this->getAdapter());
        $select = new Select();
        $select->from(['d' => $this->getTableName()]);
        $select->columns(['id']);
        $select->join(['s' => new TableIdentifier('scrapped_departments', 'my_tennis_pal')], 's.id = d.id', [], 'left');
        $select->where('s.id IS NULL');
        $select->where([
            'd.latitude' => $location['latitude'],
            'd.longitude' => $location['longitude']
        ]);

        $query = $sql->getSqlStringForSqlObject($select);
        $resultSet = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $data = $resultSet->toArray();
        if (empty($data[0])) {
            return false;
        }
        return $data[0]['id'];
    }
}