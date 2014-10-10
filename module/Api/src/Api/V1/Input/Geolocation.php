<?php
namespace Api\V1\Input;

use Zend\InputFilter\Input;
use \Api\V1\Filter\Geolocation as GeolocationFilter;

/**
 * Class Geolocation
 * @package Api\V1\Input
 */
class Geolocation extends Input
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        $this->getFilterChain()
            ->attach(new GeolocationFilter());
    }
}