<?php
namespace Api;

use Api\V1\Rest\Department\DepartmentMapper;
use Api\V1\Rest\DepartmentMarker\DepartmentMarkerMapper;
use Api\V1\Rest\TennisPlace\TennisPlaceMapper;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceManager;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface, ServiceProviderInterface, BootstrapListenerInterface
{
    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {

    }

    public function getConfig()
    {
        $config = [];
        $configFiles = [
            include __DIR__ . '/../../config/module.config.php',
//            include __DIR__ . '/../../config/zf-mvc-auth.config.php',
        ];

        foreach ($configFiles as $file) {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, $file);
        }
        return $config;
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Api\\V1\\Rest\\Department\\DepartmentResource' => 'Api\\V1\\Rest\\Department\\DepartmentResourceFactory',
                'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerResource' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerResourceFactory',
                'Api\\V1\\Rest\\TennisPlace\\TennisPlaceResource' => 'Api\\V1\\Rest\\TennisPlace\\TennisPlaceResourceFactory',
                'Api\\V1\\Rest\\Department\\DepartmentMapper' => function (ServiceManager $serviceManager) {
                    $adapter = $serviceManager->get('db.adapter.localities');
                    $albumMapper = new DepartmentMapper();
                    return $albumMapper->setAdapter($adapter);
                },
                'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerMapper' => function (ServiceManager $serviceManager) {
                    $adapter = $serviceManager->get('db.adapter.localities');
                    $albumMapper = new DepartmentMarkerMapper();
                    return $albumMapper->setAdapter($adapter);
                },
                'Api\\V1\\Rest\\TennisPlace\\TennisPlaceMapper' => function (ServiceManager $serviceManager) {
                    $adapter = $serviceManager->get('db.adapter.my-tennis-pal');
                    $albumMapper = new TennisPlaceMapper();
                    return $albumMapper->setAdapter($adapter);
                },
            ],
        ];
    }
}
