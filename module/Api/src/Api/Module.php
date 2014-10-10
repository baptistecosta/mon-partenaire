<?php
namespace Api;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface, ServiceProviderInterface, BootstrapListenerInterface, ControllerProviderInterface
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
            'invokables' => [
                'place' => 'Api\\V1\\Service\\Place\\Place'
            ],
            'factories' => [
                'Api\\V1\\Rest\\Department\\Resource' => 'Api\\V1\\Rest\\Department\\DepartmentResourceFactory',
                'Api\\V1\\Rest\\Department\\Mapper' => 'Api\\V1\\Rest\\Department\\DepartmentMapperFactory',

                'Api\\V1\\Rest\\DepartmentMarker\\Resource' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerResourceFactory',
                'Api\\V1\\Rest\\DepartmentMarker\\Mapper' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerMapperFactory',

                'Api\\V1\\Rest\\Place\\Resource' => 'Api\\V1\\Rest\\Place\\PlaceResourceFactory',
                'Api\\V1\\Rest\\Place\\Mapper' => 'Api\\V1\\Rest\\Place\\PlaceMapperFactory',

                'Api\\V1\\Rest\\PlaceMarker\\Resource' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerResourceFactory',
                'Api\\V1\\Rest\\PlaceMarker\\Mapper' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerMapperFactory',
                'Api\\V1\\Rest\\PlaceMarker\\InputFilter' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerInputFilterFactory',

                'Api\\V1\\Rest\\PlaceType\\Resource' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeResourceFactory',
                'Api\\V1\\Rest\\PlaceType\\Mapper' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeMapperFactory',

                'Api\\V1\\Rest\\ScrappedDepartment\\Mapper' => 'Api\\V1\\Rest\\ScrappedDepartment\\ScrappedDepartmentMapperFactory',
            ],
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to seed
     * such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getControllerConfig()
    {
        return [
            'factories' => [
                'Api\\V1\\Rpc\\Place\\Controller' => 'Api\\V1\\Rpc\\Place\\PlaceControllerFactory',
            ],
        ];
    }
}
