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
        $mapper = $services->get('Api\\V1\\Rest\\Department\\Mapper');
        return new DepartmentResource($mapper);
    }
}