<?php
namespace Api\V1\Rest\DepartmentMarker;

use ZF\Rest\AbstractResourceListener;

/**
 * Class DepartmentMarkerResource
 * @package Api\V1\Rest\Department
 */
class DepartmentMarkerResource extends AbstractResourceListener
{
    /**
     * @var DepartmentMarkerMapper
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