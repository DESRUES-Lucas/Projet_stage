app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_project/project/:id_project/section/add', {
                templateUrl: '/com_zeapps_project/section/form',
                controller: 'ComZeappsSectionFormCtrl'
            })
            .when('/ng/com_zeapps_project/project/:id_project/section/:id', {
                templateUrl: '/com_zeapps_project/section/form',
                controller: 'ComZeappsSectionFormCtrl'
            })
        ;
    }]);

