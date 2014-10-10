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
        function($scope, $http, url, navigatorGeolocation, marker, departmentMarkerMapper, placeMarkerMapper) {
            var map;

            var placeMarkers = [];

            $scope.markersData = [];
            $scope.links = {};
            $scope.page = 1;
            $scope.pageCount = null;
            $scope.pageSize = null;
            $scope.placesCount = null;

            function initMap(lat, lng) {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: new google.maps.LatLng(lat, lng)
                });

                google.maps.event.addListenerOnce(map, 'idle', function() {
                    putDepartmentMarkers();
                    putMarkers();
                });
                google.maps.event.addListener(map, 'dragend', putMarkers);
                google.maps.event.addListener(map, 'zoom_changed', putMarkers);
            }

            function putDepartmentMarkers() {
                departmentMarkerMapper
                    .fetchMany()
                    .success(function(res) {
                        var markersData = res._embedded.department_marker;
                        marker.attachMany(marker.createMany(markersData), map);
                    })
                    .error(console.error);
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

                marker.deleteMany(placeMarkers);
                placeMarkers = marker.createMany($scope.markersData);
                marker.attachMany(placeMarkers, map);
            }

            function deletePlaceMarkers() {
                marker.deleteMany(placeMarkers);
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
                var m = marker.find($index, placeMarkers);
                if (m) {
                    m.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
                }
            };

            $scope.onPlaceRowLeave = function($index) {
                var m = marker.find($index, placeMarkers);
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