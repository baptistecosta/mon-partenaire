<?php
namespace Api\V1\Rest\Place;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

/**
 * Class PlaceResource
 * @package Api\V1\Rest\Place
 */
class PlaceResource extends AbstractResourceListener
{
    /**
     * @var PlaceMapper
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

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $tennisPlaceId = $this->mapper->create((array)$data);
        return $this->mapper->fetchOne($tennisPlaceId);
    }
}