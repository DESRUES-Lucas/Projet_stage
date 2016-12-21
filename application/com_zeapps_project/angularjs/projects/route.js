app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_project/projects', {
                templateUrl: '/com_zeapps_project/project/search',
                controller: 'ComZeappsProjectListCtrl'
            })
            .when('/ng/com_zeapps_project/project/new', {
                templateUrl: '/com_zeapps_project/project/form',
                controller: 'ComZeappsProjectFormCtrl'
            })
            .when('/ng/com_zeapps_project/project/:id', {
                templateUrl: '/com_zeapps_project/project/form',
                controller: 'ComZeappsProjectFormCtrl'
            })
            .when('/ng/com_zeapps_project/project/view/:id', {
                templateUrl: '/com_zeapps_project/project/view',
                controller: 'ComZeappsProjectViewCtrl'
            })
        ;
    }]);

