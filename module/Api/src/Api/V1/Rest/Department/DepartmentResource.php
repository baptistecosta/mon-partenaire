<?php
namespace Api\V1\Rest\Department;

use ZF\Rest\AbstractResourceListener;

/**
 * Class DepartmentResource
 * @package Api\V1\Rest\Department
 */
class DepartmentResource extends AbstractResourceListener
{
    /**
     * @var DepartmentMapper
     */
    protected $mapper;

    /**
     * @param $mapper
     */
    function __construct($mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Fetch a resource
     *
     * @param  int $id
     * @return mixed
     */
    public function fetch($id)
    {
        return $this->mapper->fetchOne($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return mixed
     */
    public function fetchAll($params = [])
    {
        return $this->mapper->fetchAll();
    }
}