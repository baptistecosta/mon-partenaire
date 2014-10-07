<?php
namespace Api\V1\Rest\PlaceType;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PlaceTypeMapperFactory
 * @package Api\V1\Rest\PlaceType
 */
class PlaceTypeMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('db.adapter.my-tennis-pal');
        $albumMapper = new PlaceTypeMapper();
        return $albumMapper->setAdapter($adapter);
    }
}