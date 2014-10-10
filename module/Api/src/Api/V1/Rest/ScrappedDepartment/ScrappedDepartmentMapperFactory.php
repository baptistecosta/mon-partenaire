<?php
namespace Api\V1\Rest\ScrappedDepartment;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ScrappedDepartmentMapperFactory
 * @package Api\V1\Rest\ScrappedDepartment
 */
class ScrappedDepartmentMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = new ScrappedDepartmentMapper();
        return $mapper
            ->setAdapter($serviceLocator->get('db.adapter.my-tennis-pal'))
            ->setTableName('scrapped_departments');
    }
}