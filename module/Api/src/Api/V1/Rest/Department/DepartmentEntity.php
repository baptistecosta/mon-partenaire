<?php
namespace Api\V1\Rest\Department;

use Zend\Stdlib\ArraySerializableInterface;

/**
 * Class DepartmentEntity
 * @package Api\V1\Rest\Department
 */
class DepartmentEntity implements ArraySerializableInterface
{
    protected $id;

    protected $prefectureId;

    protected $regionId;

    protected $name;

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setPrefectureId($array['prefecture_id']);
        $this->setRegionId($array['region_id']);
        $this->setName($array['name']);
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
            'prefectureId' => $this->getPrefectureId(),
            'regionId' => $this->getRegionId(),
            'name' => $this->getName(),
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
    public function getPrefectureId()
    {
        return $this->prefectureId;
    }

    /**
     * @param mixed $prefectureId
     */
    public function setPrefectureId($prefectureId)
    {
        $this->prefectureId = $prefectureId;
    }

    /**
     * @return mixed
     */
    public function getRegionId()
    {
        return $this->regionId;
    }

    /**
     * @param mixed $regionId
     */
    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;
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
}