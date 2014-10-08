(function() {
    'use strict';

    var app = angular.module('myTennisPal');

    app.controller('IndexController', [
        '$scope',
        '$http',
        'navigatorGeolocation',
        function($scope, $http, navigatorGeolocation) {
            var map;

            $scope.markersData = {};

            function initMap(lat, lng) {
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 9,
                    center: new google.maps.LatLng(lat, lng)
                });

                requestDepartmentMarkers(onRequestDepartmentMarkersSuccess);
            }

            function requestDepartmentMarkers(success) {
                $http
                    .get('/api/department-marker')
                    .success(success)
                    .error(console.error)
            }

            function onRequestDepartmentMarkersSuccess(res) {
                $scope.markersData = res._embedded.department_marker;

                $scope.markersData.forEach(function(markerData) {
                    var marker = new google.maps.Marker({
                        title: markerData.title,
                        position: new google.maps.LatLng(markerData.latitude, markerData.longitude),
                        map: map
                    });
                });
            }

            navigatorGeolocation.run(function(lat, lng) {
                initMap(lat, lng);
            }, function() {
                initMap(43.142859, 5.937183);
            });

        }
    ]);

})();