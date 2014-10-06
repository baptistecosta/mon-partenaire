<?php
return [
    'router' => [
        'routes' => [
            'api.rest.department' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/department[/:department_id]',
                    'defaults' => [
                        'controller' => 'Api\\V1\\Rest\\Department\\Controller',
                    ],
                ],
            ],
            'api.rest.department-marker' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/department-marker[/:department_id]',
                    'defaults' => [
                        'controller' => 'Api\\V1\\Rest\\DepartmentMarker\\Controller',
                    ],
                ],
            ],
            'api.rest.tennis-place' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/tennis-place[/:tennis_place_id]',
                    'defaults' => [
                        'controller' => 'Api\\V1\\Rest\\TennisPlace\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-rest' => [
        'Api\\V1\\Rest\\Department\\Controller' => [
            'listener' => 'Api\\V1\\Rest\\Department\\DepartmentResource',
            'route_name' => 'api.rest.department',
            'route_identifier_name' => 'department_id',
            'collection_name' => 'department',
            'entity_http_methods' => [
                0 => 'GET'
            ],
            'collection_http_methods' => [
                0 => 'GET'
            ],
            'collection_query_whitelist' => [
                //
            ],
            'page_size' => 10,
            'page_size_param' => null,
            'entity_class' => 'Api\\V1\\Rest\\Department\\DepartmentEntity',
            'collection_class' => 'Api\\V1\\Rest\\Department\\DepartmentCollection',
            'service_name' => 'Department',
        ],
        'Api\\V1\\Rest\\DepartmentMarker\\Controller' => [
            'listener' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerResource',
            'route_name' => 'api.rest.department-marker',
            'route_identifier_name' => 'department_id',
            'collection_name' => 'department_marker',
            'entity_http_methods' => [
                0 => 'GET'
            ],
            'collection_http_methods' => [
                0 => 'GET'
            ],
            'collection_query_whitelist' => [
                //
            ],
            'page_size' => 10,
            'page_size_param' => null,
            'entity_class' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerEntity',
            'collection_class' => 'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerCollection',
            'service_name' => 'DepartmentMarker',
        ],
        'Api\\V1\\Rest\\TennisPlace\\Controller' => [
            'listener' => 'Api\\V1\\Rest\\TennisPlace\\TennisPlaceResource',
            'route_name' => 'api.rest.tennis-place',
            'route_identifier_name' => 'tennis_place_id',
            'collection_name' => 'tennis_place',
            'entity_http_methods' => [
                0 => 'GET'
            ],
            'collection_http_methods' => [
                0 => 'GET'
            ],
            'collection_query_whitelist' => [
                //
            ],
            'page_size' => 10,
            'page_size_param' => null,
            'entity_class' => 'Api\\V1\\Rest\\TennisPlace\\TennisPlaceEntity',
            'collection_class' => 'Api\\V1\\Rest\\TennisPlace\\TennisPlaceCollection',
            'service_name' => 'TennisPlace',
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'api.rest.department'
        ],
    ],
    'service_manager' => [
        'invokables' => [
            //
        ],
        'initializers' => [
            //
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Api\\V1\\Rest\\Department\\Controller' => 'HalJson',
            'Api\\V1\\Rest\\DepartmentMarker\\Controller' => 'HalJson',
            'Api\\V1\\Rest\\TennisPlace\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Api\\V1\\Rest\\Department\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Api\\V1\\Rest\\DepartmentMarker\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Api\\V1\\Rest\\Department\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'Api\\V1\\Rest\\DepartmentMarker\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'Api\\V1\\Rest\\TennisPlace\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Api\\V1\\Rest\\Department\\DepartmentEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.department',
                'route_identifier_name' => 'department_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ],
            'Api\\V1\\Rest\\Department\\DepartmentCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.department',
                'route_identifier_name' => 'department_id',
                'is_collection' => true,
            ],
            'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.department-marker',
                'route_identifier_name' => 'department_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ],
            'Api\\V1\\Rest\\DepartmentMarker\\DepartmentMarkerCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.department-marker',
                'route_identifier_name' => 'department_id',
                'is_collection' => true,
            ],
            'Api\\V1\\Rest\\TennisPlace\\TennisPlaceEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.tennis-place',
                'route_identifier_name' => 'tennis_place_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ],
        ],
    ],
];