(function() {
    'use strict';

    var app = angular.module('myTennisPal');

    app.controller('IndexController', [
        '$scope',
        '$http',
        'url',
        'navigatorGeolocation',
        'marker',
        'departmentMarkerMapper',
        'placeMarkerMapper',
        function($scope, $http, url, navigatorGeolocation, markerService, departmentMarkerMapper, placeMarkerMapper) {
            var map;

            var placeMarkers = [];
            var departmentMarkers = [];

            $scope.markersData = [];
            $scope.links = {};
            $scope.page = 1;
            $scope.pageCount = null;
            $scope.pageSize = null;
            $scope.placesCount = null;

            function initMap(lat, lng) {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 7,
                    center: new google.maps.LatLng(lat, lng)
                });

                google.maps.event.addListener(map, 'dragend', putMarkers);
                google.maps.event.addListener(map, 'zoom_changed', putMarkers);
                google.maps.event.addListenerOnce(map, 'idle', function() {
                    putDepartmentMarkers();
                    putMarkers();
                });
            }

            function putDepartmentMarkers() {
                departmentMarkerMapper
                    .fetchMany()
                    .success(function(res) {
                        markerService.deleteMany(departmentMarkers);

                        var markersData = res._embedded.department_marker;
                        departmentMarkers = markerService.createMany(markersData, addDepartmentMarkerListeners);
                        markerService.attachMany(departmentMarkers, map);
                    })
                    .error(console.error);
            }

            function addDepartmentMarkerListeners(marker, markerData) {
                google.maps.event.addListener(marker, 'click', function(e) {
                    if (!markerData.isScrapped) {
                        $http
                            .post('http://mon-partenaire.loc/api/place/find', {
                                geolocation: markerData.latitude + ',' + markerData.longitude
                            })
                            .success(function(res) {
                                putDepartmentMarkers();
                            })
                            .error(console.error);
                    }
                });
            }

            function putMarkers() {
                $scope.page = 1;

                if (map.getZoom() >= 10) {
                    requestPlaceMarkers()
                } else {
                    deletePlaceMarkers();
                }
            }

            function requestPlaceMarkers(link) {
                var promise = link ? $http.get(link) : getPlaceMarkersPromise();
                promise
                    .success(onPlaceMarkerRequestSuccess)
                    .error(console.error);
            }

            function getPlaceMarkersPromise() {
                var bounds = map.getBounds(),
                    ne = bounds.getNorthEast(),
                    sw = bounds.getSouthWest();

                return placeMarkerMapper.fetchMany({
                    'south-west-bound': sw.lat() + ',' + sw.lng(),
                    'north-east-bound': ne.lat() + ',' + ne.lng()
                });
            }

            function onPlaceMarkerRequestSuccess(res) {
                $scope.pageCount = res.page_count;
                $scope.pageSize = res.page_size;
                $scope.placesCount = res.total_items;
                $scope.links = res._links;
                $scope.markersData = res._embedded.place_marker;

                markerService.deleteMany(placeMarkers);
                placeMarkers = markerService.createMany($scope.markersData);
                markerService.attachMany(placeMarkers, map);
            }

            function deletePlaceMarkers() {
                markerService.deleteMany(placeMarkers);
            }

            $scope.pageChange = function(link) {
                var queryParams = url.queryParams(link);
                $scope.page = queryParams.page ? queryParams.page : 1;

                requestPlaceMarkers(link);
            };

            $scope.rowIndex = function($index) {
                return ($index + 1) + (($scope.page - 1) * $scope.pageSize);
            };

            $scope.onPlaceRowEnter = function($index) {
                var m = markerService.find($index, placeMarkers);
                if (m) {
                    m.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
                }
            };

            $scope.onPlaceRowLeave = function($index) {
                var m = markerService.find($index, placeMarkers);
                if (m) {
                    m.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
                }
            };

            //initMap(43.1143760, 5.9416940);

            navigatorGeolocation.run(function(lat, lng) {
                initMap(lat, lng);
            }, function() {
                initMap(43.1143760, 5.9416940);
            });

        }
    ]);

})();