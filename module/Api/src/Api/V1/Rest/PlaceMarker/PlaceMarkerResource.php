<?php
namespace Api\V1\Rest\PlaceMarker;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use ZF\Rest\AbstractResourceListener;

/**
 * Class PlaceMarkerResource
 * @package Api\V1\Rest\Department
 */
class PlaceMarkerResource extends AbstractResourceListener implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @var PlaceMarkerMapper
     */
    protected $mapper;

    /**
     * @param $mapper
     */
    function __construct($mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param array $params
     * @return mixed
     */
    public function fetchAll($params = [])
    {
        $inputFilter = $this->getServiceLocator()->get('Api\\V1\\Rest\\PlaceMarker\\InputFilter');
        $inputFilter->setData((array)$params);
        if ($inputFilter->isValid()) {
            return $this->mapper->fetchAll($inputFilter->getValues());
        }

        return false;
    }
}