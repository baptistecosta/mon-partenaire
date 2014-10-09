<?php
namespace Api;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
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
                'Api\\V1\\Rest\\Department\\DepartmentMapper' => 'Api\\V1\\Rest\\Department\\DepartmentMapperFactory',

                'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerResource' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerResourceFactory',
                'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerMapper' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerMapperFactory',

                'Api\\V1\\Rest\\Place\\PlaceResource' => 'Api\\V1\\Rest\\Place\\PlaceResourceFactory',
                'Api\\V1\\Rest\\Place\\PlaceMapper' => 'Api\\V1\\Rest\\Place\\PlaceMapperFactory',

                'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerResource' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerResourceFactory',
                'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerMapper' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerMapperFactory',
                'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerInputFilter' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerInputFilterFactory',

                'Api\\V1\\Rest\\PlaceType\\PlaceTypeResource' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeResourceFactory',
                'Api\\V1\\Rest\\PlaceType\\PlaceTypeMapper' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeMapperFactory',
            ],
        ];
    }
}
