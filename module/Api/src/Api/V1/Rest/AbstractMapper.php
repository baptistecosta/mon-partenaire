<?php
namespace Api\V1\Rest;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

/**
 * Class AbstractMapper
 * @package Api\V1\Rest
 */
class AbstractMapper
{
    /**
     * @var Adapter
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $tableName;

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
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param string $tableName
     * @return $this
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    public function find($params)
    {
        $sql = new Sql($this->getAdapter());

        $select = new Select();
        $select->from($params['from']);
        if (!empty($params['columns'])) {
            $select->columns($params['columns']);
        }
        foreach ($params['where'] as $where) {
            $select->where($where);
        }
        foreach ($params['joins'] as $join) {
            if (empty($join['columns'])) {
                $join['columns'] = Select::SQL_STAR;
            }
            if (empty($join['type'])) {
                $join['type'] = Select::JOIN_INNER;
            }
            $select->join($join['name'], $join['on'], $join['columns'], $join['type']);
        }

        $query = $sql->getSqlStringForSqlObject($select);

        $results = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        $data = $results->toArray();
        if (empty($data)) {
            return false;
        } else if (count($data) == 1) {
            return $data[0];
        } else {
            return $data;
        }
    }
}