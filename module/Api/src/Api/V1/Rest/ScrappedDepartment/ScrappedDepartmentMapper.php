<?php
namespace Api\V1\Rest\ScrappedDepartment;

use Api\V1\Rest\AbstractMapper;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Result;
use Zend\Db\Sql\Sql;

/**
 * Class ScrappedDepartmentMapper
 * @package Api\V1\Rest\ScrappedDepartment
 */
class ScrappedDepartmentMapper extends AbstractMapper
{
    public function create($id)
    {
        $sql = new Sql($this->getAdapter());
        $insert = $sql->insert($this->getTableName());
        $insert->values(['id' => (string)$id]);
        $query = $sql->getSqlStringForSqlObject($insert);

        /** @var Result $results */
        $results = $this->adapter->query($query, Adapter::QUERY_MODE_EXECUTE);
        return $results->getGeneratedValue();
    }
}