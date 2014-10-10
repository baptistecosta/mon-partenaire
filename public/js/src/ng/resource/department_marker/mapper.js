(function() {
    'use strict';

    var app = angular.module('myTennisPal');

    app.factory('departmentMarkerMapper', [
        '$http',
        function($http) {
            return {
                fetchMany: function(params) {
                    return $http
                        .get('/api/department-marker')
                }
            };
        }
    ]);

})();