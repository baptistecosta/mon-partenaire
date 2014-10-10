<?php
namespace Api\V1\Rest\PlaceMarker;

use Api\V1\Input\Geolocation as GeolocationFilter;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PlaceMarkerInputFilterFactory
 * @package Api\V1\Rest\PlaceMarker
 */
class PlaceMarkerInputFilterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $inputFilter = new InputFilter();
        return $inputFilter
            ->add(new GeolocationFilter('south-west-bound'))
            ->add(new GeolocationFilter('north-east-bound'));
    }
}