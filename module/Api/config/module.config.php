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
            'api.rest.place' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/place[/:place_id]',
                    'defaults' => [
                        'controller' => 'Api\\V1\\Rest\\Place\\Controller',
                    ],
                ],
            ],
            'api.rest.place-type' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/place-type[/:place_type_id]',
                    'defaults' => [
                        'controller' => 'Api\\V1\\Rest\\PlaceType\\Controller',
                    ],
                ],
            ],
            'api.rest.place-marker' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/api/place-marker',
                    'defaults' => [
                        'controller' => 'Api\\V1\\Rest\\PlaceMarker\\Controller',
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
                0 => 'GET',
            ],
            'collection_http_methods' => [
                0 => 'GET',
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
        'Api\\V1\\Rest\\Place\\Controller' => [
            'listener' => 'Api\\V1\\Rest\\Place\\PlaceResource',
            'route_name' => 'api.rest.place',
            'route_identifier_name' => 'place_id',
            'collection_name' => 'place',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                //
            ],
            'page_size' => 20,
            'page_size_param' => null,
            'entity_class' => 'Api\\V1\\Rest\\Place\\PlaceEntity',
            'collection_class' => 'Api\\V1\\Rest\\Place\\PlaceCollection',
            'service_name' => 'Place',
        ],
        'Api\\V1\\Rest\\PlaceType\\Controller' => [
            'listener' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeResource',
            'route_name' => 'api.rest.place-type',
            'route_identifier_name' => 'place_type_id',
            'collection_name' => 'place_type',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                //
            ],
            'page_size' => 10,
            'page_size_param' => null,
            'entity_class' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeEntity',
            'collection_class' => 'Api\\V1\\Rest\\PlaceType\\PlaceTypeCollection',
            'service_name' => 'PlaceType',
        ],
        'Api\\V1\\Rest\\PlaceMarker\\Controller' => [
            'listener' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerResource',
            'route_name' => 'api.rest.place-marker',
            'route_identifier_name' => 'place_marker_id',
            'collection_name' => 'place_marker',
            'entity_http_methods' => [
                0 => 'GET',
//                1 => 'PATCH',
//                2 => 'PUT',
//                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
//                1 => 'POST',
            ],
            'collection_query_whitelist' => [
                'north-east-bound',
                'south-west-bound',
            ],
            'page_size' => 10,
            'page_size_param' => null,
            'entity_class' => 'Api\\V1\\Rest\\Marker\\MarkerEntity',
//            'collection_class' => 'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerCollection',
            'service_name' => 'PlaceMarker',
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
            'Api\\V1\\Rest\\Place\\Controller' => 'HalJson',
            'Api\\V1\\Rest\\PlaceMarker\\Controller' => 'HalJson',
            'Api\\V1\\Rest\\PlaceType\\Controller' => 'HalJson',
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
            'Api\\V1\\Rest\\Place\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Api\\V1\\Rest\\PlaceMarker\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Api\\V1\\Rest\\PlaceType\\Controller' => [
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
            'Api\\V1\\Rest\\Place\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'Api\\V1\\Rest\\PlaceMarker\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
            'Api\\V1\\Rest\\PlaceType\\Controller' => [
                0 => 'application/vnd.api.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-content-validation' => [
        'Api\\V1\\Rest\\PlaceMarker\\Controller' => [
            'input_filter' => 'Api\\V1\\Rest\\PlaceMarker\\Validator'
        ]
    ],
    'input_filter_specs' => [
        'Api\\V1\\Rest\\PlaceMarker\\Validator' => [
            0 => [
                'name' => 'north-east-bound',
                'required' => true,
                'filters' => [],
                'validators' => [],
                'allow_empty' => false,
                'continue_if_empty' => false,
            ],
            1 => [
                'name' => 'south-west-bound',
                'required' => true,
                'filters' => [],
                'validators' => [],
                'allow_empty' => false,
                'continue_if_empty' => false,
            ],
        ]
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
            'Api\\V1\\Rest\\Place\\PlaceEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.place',
                'route_identifier_name' => 'place_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ],
            'Api\\V1\\Rest\\PlaceMarker\\PlaceMarkerEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.place-marker',
                'route_identifier_name' => 'place_marker_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ],
            'Api\\V1\\Rest\\PlaceType\\PlaceTypeEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api.rest.place-type',
                'route_identifier_name' => 'place_type_id',
                'hydrator' => 'Zend\\Stdlib\\Hydrator\\ArraySerializable',
            ],
        ],
    ],
];