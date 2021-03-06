<?php
namespace Api\V1\Service\Place;

use Api\V1\Rest\Department\DepartmentMapper;
use Api\V1\Rest\Place\PlaceMapper;
use SebastianBergmann\Exporter\Exception;
use Zend\Http\Client;
use Zend\Http\Header\Accept;
use Zend\Http\Request;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Stdlib\Parameters;

/**
 * Class Place
 * @package Api\V1\Service\Place
 */
class Place implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    protected $departmentId;

    protected $location;

    protected $placeTypes = [];

    protected $tennisPlaces = [];

    /**
     * @var Client
     */
    protected $httpClient;

    function __construct()
    {
        $this->httpClient = new Client(null, [
            'sslverifypeer' => false
        ]);
    }

    public function run($location)
    {
        if (empty($location)) {
            return false;
        }
        $this->location = $location;

        $this->getDepartmentId();
        $this->requestPlaceTypes();
        $this->requestTennisPlaces();
        $this->saveTennisPlaces();
        $this->saveScrappedDepartment($location);

        return true;
    }

    private function getDepartmentId()
    {
        /** @var DepartmentMapper $departmentMapper */
        $departmentMapper = $this->getServiceLocator()->get('Api\\V1\\Rest\\Department\\Mapper');
        if (!$this->departmentId = $departmentMapper->fetchUnscrappedDepartmentIdFromLocation($this->location)) {
            throw new Exception('No department found for this location');
        }
    }

    private function requestPlaceTypes()
    {
        $req = $this->getPlaceTypesRequest();
        $res = $this->sendHttpRequest($req);
        $data = $this->unserializeJsonData($res->getBody());

        $placeTypes = $data['_embedded']['place_type'];

        foreach ($placeTypes as $placeType) {
            $this->placeTypes[$placeType['name']] = $placeType['id'];
        }
    }

    private function requestTennisPlaces($token = null)
    {
        if ($token) {
            $req = $this->getSearchNearbyPlaceWithTokenRequest($token);
        } else {
            $req = $this->getSearchNearbyPlaceRequest();
        }
        $response = $this->sendHttpRequest($req);
        $data = $this->unserializeJsonData($response->getBody());
        $this->assertStatusIsOk($data['status']);

        $this->onTennisPlacesFound($data['results']);

        static $shield = 0;
        if (!empty($data['next_page_token']) && $shield++ <= 10) {
            sleep(2);
            $this->requestTennisPlaces($data['next_page_token']);
        }
    }

    private function saveTennisPlaces()
    {
        /** @var PlaceMapper $placeMapper */
        $placeMapper = $this->getServiceLocator()->get('Api\\V1\\Rest\\Place\\Mapper');

        foreach ($this->tennisPlaces as $tennisPlace) {
            $placeMapper->create($tennisPlace);
        }
    }

    private function saveScrappedDepartment()
    {
        $scrappedDepartmentMapper = $this->getServiceLocator()->get('Api\\V1\\Rest\\ScrappedDepartment\\Mapper');
        $scrappedDepartmentMapper->create($this->departmentId);
    }

    private function onTennisPlacesFound($places)
    {
        foreach ($places as $place) {
            $this->tennisPlaces[] = [
                'name' => $place['name'],
                'latitude' => $place['geometry']['location']['lat'],
                'longitude' => $place['geometry']['location']['lng'],
                'types' => $this->getPlaceTypesIdsFromName($place['types'])
            ];
        }
    }

    private function getPlaceTypesIdsFromName($placeTypeNames)
    {
        $types = [];
        foreach ($placeTypeNames as $name) {
            $types[] = $this->placeTypes[$name];
        }
        return $types;
    }

    private function sendHttpRequest(Request $request)
    {
        return $this->httpClient->send($request);
    }

    private function getPlaceTypesRequest()
    {
        $acceptHeader = new Accept();
        $acceptHeader->addMediaType('application/json');

        $req = new Request();
        $req->setUri('http://mon-partenaire.loc/api/place-type');
        $req->getHeaders()->addHeader($acceptHeader);
        return $req;
    }

    private function getSearchNearbyPlaceWithTokenRequest($token)
    {
        $req = new Request();
        $req->setUri('https://maps.googleapis.com/maps/api/place/nearbysearch/json');
        $req->setMethod(Request::METHOD_GET);
        $req->setQuery(new Parameters([
            'key' => 'AIzaSyDbJurRkujBxXxNxCNDW1LJ3c9HtQJ6yY8',
            'pagetoken' => $token
        ]));
        return $req;
    }

    private function getSearchNearbyPlaceRequest()
    {
        $req = new Request();
        $req->setUri('https://maps.googleapis.com/maps/api/place/nearbysearch/json');
        $req->setMethod(Request::METHOD_GET);
        $req->setQuery(new Parameters([
            'key' => 'AIzaSyDbJurRkujBxXxNxCNDW1LJ3c9HtQJ6yY8',
            'radius' => 50000,
            'name' => 'tennis',
            'keyword' => 'tennis',
            'language' => 'fr',
            'location' => $this->location['latitude'] . ',' . $this->location['longitude']
        ]));
        return $req;
    }

    public function assertStatusIsOk($status)
    {
        if ($status != 'OK') {
            throw new Exception($status);
        }
    }

    public function unserializeJsonData($response)
    {
        return json_decode($response, true);
    }
}
