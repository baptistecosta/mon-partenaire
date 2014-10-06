<?php
namespace Api\V1\Rest\TennisPlace;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class TennisPlaceResourceFactory
 * @package Api\V1\Rest\TennisPlace
 */
class TennisPlaceResourceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Api\\V1\\Rest\\TennisPlace\\TennisPlaceMapper');
        return new TennisPlaceResource($mapper);
    }
}