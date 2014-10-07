<?php
namespace Api\V1\Rest\Place;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PlaceResourceFactory
 * @package Api\V1\Rest\Place
 */
class PlaceResourceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Api\\V1\\Rest\\Place\\PlaceMapper');
        return new PlaceResource($mapper);
    }
}