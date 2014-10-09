<?php
namespace Api\V1\Rest\PlaceMarker;

use Api\V1\Filter\Geolocation;
use Zend\InputFilter\Input;
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
        $southWestBound = new Input('south-west-bound');
        $southWestBound->getFilterChain()
            ->attach(new Geolocation());

        $northEastBound = new Input('north-east-bound');
        $northEastBound->getFilterChain()
            ->attach(new Geolocation());

        $inputFilter = new InputFilter();
        return $inputFilter
            ->add($southWestBound)
            ->add($northEastBound);
    }
}