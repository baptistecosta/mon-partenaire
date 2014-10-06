<?php
namespace Api\V1\Rest\DepartmentMarker;

/**
 * Class DepartmentMarkerResourceFactory
 * @package Api\V1\Rest\Department
 */
class DepartmentMarkerResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerMapper');
        return new DepartmentMarkerResource($mapper);
    }
}