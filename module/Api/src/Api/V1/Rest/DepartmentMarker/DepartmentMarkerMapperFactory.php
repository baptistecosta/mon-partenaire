<?php
namespace Api\V1\Rest\DepartmentMarker;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class DepartmentMarkerMapperFactory
 * @package Api\V1\Rest\DepartmentMarker
 */
class DepartmentMarkerMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('db.adapter.localities');
        $albumMapper = new DepartmentMarkerMapper();
        return $albumMapper->setAdapter($adapter);
    }
}