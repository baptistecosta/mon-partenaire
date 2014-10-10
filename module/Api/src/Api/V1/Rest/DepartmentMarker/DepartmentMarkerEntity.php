<?php
namespace Api\V1\Rest\DepartmentMarker;

use Zend\Stdlib\ArraySerializableInterface;

/**
 * Class DepartmentMarkerEntity
 * @package Api\V1\Rest\Department
 */
class DepartmentMarkerEntity implements ArraySerializableInterface
{
    protected $id;

    protected $latitude;

    protected $longitude;

    protected $icon;

    protected $title;

    protected $isScrapped;

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setLatitude($array['latitude']);
        $this->setLongitude($array['longitude']);
        $this->setIcon(empty($array['icon']) ? '' : $array['icon']);
        $this->setTitle($array['id'] . ' - ' . $array['name']);
        $this->setIsScrapped(!empty($array['scrapped_department_id']));
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'icon' => $this->getIcon(),
            'title' => $this->getTitle(),
            'isScrapped' => $this->getIsScrapped(),
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

    /**
     * @return mixed
     */
    public function getIsScrapped()
    {
        return $this->isScrapped;
    }

    /**
     * @param mixed $isScrapped
     */
    public function setIsScrapped($isScrapped)
    {
        $this->isScrapped = $isScrapped;
    }
}