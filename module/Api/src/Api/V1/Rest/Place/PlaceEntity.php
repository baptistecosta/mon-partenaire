<?php
namespace Api\V1\Rest\Place;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Class PlaceEntity
 * @package Api\V1\Rest\Place
 */
class PlaceEntity implements ArraySerializableInterface
{
    protected $id;

    protected $name;

    protected $latitude;

    protected $longitude;

    protected $types;

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setName($array['name']);
        $this->setLatitude($array['latitude']);
        $this->setLongitude($array['longitude']);
        $this->setTypes($array['types']);
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'types' => $this->getTypes(),
        ];
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }
}