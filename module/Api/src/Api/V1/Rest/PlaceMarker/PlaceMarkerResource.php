<?php
namespace Api\V1\Rest\PlaceMarker;

use ZF\Rest\AbstractResourceListener;

/**
 * Class PlaceMarkerResource
 * @package Api\V1\Rest\Department
 */
class PlaceMarkerResource extends AbstractResourceListener
{
    /**
     * @var PlaceMarkerMapper
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
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return mixed
     */
    public function fetchAll($params = [])
    {
        return $this->mapper->fetchAll((array)$params);
    }
}