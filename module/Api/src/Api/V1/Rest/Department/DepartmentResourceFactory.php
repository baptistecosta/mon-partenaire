<?php
namespace Api\V1\Rest\Department;

/**
 * Class DepartmentResourceFactory
 * @package Api\V1\Rest\Department
 */
class DepartmentResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Api\\V1\\Rest\\Department\\DepartmentMapper');
        return new DepartmentResource($mapper);
    }
}