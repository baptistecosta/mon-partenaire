<?php
namespace Api\V1\Rpc\Place;

/**
 * Class PlaceControllerFactory
 * @package Api\V1\Rpc\Place
 */
class PlaceControllerFactory
{
    function __invoke($controllers)
    {
        return new PlaceController();
    }
}