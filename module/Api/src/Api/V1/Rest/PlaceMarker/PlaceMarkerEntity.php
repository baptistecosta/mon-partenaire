<?php
namespace Api\V1\Rest\PlaceMarker;

use Zend\Stdlib\ArraySerializableInterface;

/**
 * Class PlaceMarkerEntity
 * @package Api\V1\Rest\PlaceMarker
 */
class PlaceMarkerEntity implements ArraySerializableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var float
     */
    protected $latitude;

    /**
     * @var float
     */
    protected $longitude;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $title;

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setLatitude($array['latitude']);
        $this->setLongitude($array['longitude']);
        $this->setIcon('');
        $this->setTitle($array['name']);
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'icon' => $this->getIcon(),
            'title' => $this->getTitle(),
        ];
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $lat
     */
    public function setLatitude($lat)
    {
        $this->latitude = $lat;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $lng
     */
    public function setLongitude($lng)
    {
        $this->longitude = $lng;
    }
}