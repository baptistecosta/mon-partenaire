(function() {
    'use strict';

    var app = angular.module('myTennisPal');

    app.factory('placeMarkerMapper', [
        '$http',
        function($http) {
            return {
                fetchMany: function(params) {
                    return $http
                        .get('http://mon-partenaire.loc/api/place-marker', {
                            params: params
                        });
                }
            };
        }
    ]);

})();
