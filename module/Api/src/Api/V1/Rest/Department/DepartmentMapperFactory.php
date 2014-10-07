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
        $adapter = $serviceLocator->get('db.adapter.localities');
        $albumMapper = new DepartmentMapper();
        return $albumMapper->setAdapter($adapter);
    }
}