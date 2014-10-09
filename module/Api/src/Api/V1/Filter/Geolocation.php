<?php
namespace Api\V1\Filter;

use Zend\Console\Prompt\Number;
use Zend\Filter\Exception;
use Zend\Filter\FilterInterface;

class Geolocation implements FilterInterface
{
    public function filter($value)
    {
        $ll = explode(',', $value);
        if (count($ll) != 2) {
            return false;
        }
        return array(
            'latitude' => floatval($ll[0]),
            'longitude' => floatval($ll[1])
        );
    }
}