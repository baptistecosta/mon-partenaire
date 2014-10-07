<?php
namespace Api\V1\Rest\Place;

use Api\V1\Rest\PlaceType\PlaceTypeMapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PlaceMapperFactory
 * @package Api\V1\Rest\Place
 */
class PlaceMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $dbAdapter = $services->get('db.adapter.my-tennis-pal');

        /** @var PlaceTypeMapper $placeTypeMapper */
        $placeTypeMapper = $services->get('Api\\V1\\Rest\\PlaceType\\PlaceTypeMapper');

        $mapper = new PlaceMapper();
        return $mapper->setAdapter($dbAdapter)
            ->setPlaceTypeMapper($placeTypeMapper);
    }
}