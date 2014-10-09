<?php
namespace Api\V1\Rest\PlaceMarker;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PlaceMarkerMapperFactory
 * @package Api\V1\Rest\PlaceMarker
 */
class PlaceMarkerMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $adapter = $services->get('db.adapter.my-tennis-pal');

        $mapper = new PlaceMarkerMapper();
        return $mapper->setAdapter($adapter)
            ->setTableName('places');
    }
}