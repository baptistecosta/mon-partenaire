<?php
namespace Api\V1\Rest\PlaceType;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PlaceTypeResourceFactory
 * @package Api\V1\Rest\PlaceType
 */
class PlaceTypeResourceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Api\\V1\\Rest\\PlaceType\\PlaceTypeMapper');
        return new PlaceTypeResource($mapper);
    }
}