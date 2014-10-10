<?php
namespace Api\V1\Rpc\Place;

use Api\V1\Filter\Geolocation;
use Zend\Db\Adapter\Adapter;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ContentNegotiation\ViewModel;

/**
 * Class PlaceController
 * @package Api\V1\Rpc\Place
 */
class PlaceController extends AbstractActionController
{
    public function findAction()
    {
        $postData = $this->bodyParams();

        $geolocationFilter = new Geolocation();
        $filteredGeolocation = $geolocationFilter->filter($postData['geolocation']);

        if ($this->getServiceLocator()->get('place')->run($filteredGeolocation)) {
            return new ViewModel();
        } else {
            return new ApiProblemResponse(new ApiProblem(400, 'The request you made was malformed'));
        }
    }

    public function deduplicateAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('db.adapter.my-tennis-pal');

        $uniqueId = uniqid();

        $sql = "
            DROP TABLE IF EXISTS places_tmp;
            CREATE TABLE places_tmp LIKE places;
            INSERT INTO places_tmp SELECT * FROM places GROUP BY latitude, longitude;
            RENAME TABLE places TO places_{$uniqueId};
            RENAME TABLE places_tmp TO places;
            DELETE ppt FROM places_place_types ppt LEFT JOIN places p ON p.id = ppt.place_id WHERE id IS NULL;
        ";
        $dbAdapter->query($sql, Adapter::QUERY_MODE_EXECUTE);
        return new ViewModel();
    }
}