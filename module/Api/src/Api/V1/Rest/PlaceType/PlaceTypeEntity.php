<?php
namespace Api\V1\Rest\PlaceType;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Class PlaceTypeEntity
 * @package Api\V1\Rest\PlaceType
 */
class PlaceTypeEntity implements ArraySerializableInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    public function exchangeArray(array $array)
    {
        $this->setId($array['id']);
        $this->setName($array['name']);
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->getId(),
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