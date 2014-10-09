<?php
namespace Api\V1\Rest\PlaceMarker;

/**
 * Class PlaceMarkerResourceFactory
 * @package Api\V1\Rest\Department
 */
class PlaceMarkerResourceFactory
{
    public function __invoke($services)
    {
        $mapper = $services->get('Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerMapper');

        return new PlaceMarkerResource($mapper);
    }
}