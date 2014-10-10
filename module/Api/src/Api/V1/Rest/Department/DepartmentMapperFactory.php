<?php
namespace Api\V1\Rest\Department;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DepartmentMapperFactory
 * @package Api\V1\Rest\Department
 */
class DepartmentMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $albumMapper = new DepartmentMapper();
        return $albumMapper
            ->setAdapter($serviceLocator->get('db.adapter.localities'))
            ->setTableName('departments');
    }
}