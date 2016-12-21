app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_project/project/:id_project/section/:id_section/task/add', {
                templateUrl: '/com_zeapps_project/task/form',
                controller: 'ComZeappsProjectTaskFormCtrl'
            })
            .when('/ng/com_zeapps_project/project/:id_project/section/:id_section/task/:id', {
                templateUrl: '/com_zeapps_project/task/form',
                controller: 'ComZeappsProjectTaskFormCtrl'
            })
            .when('/ng/com_zeapps_project/my_tasks', {
                templateUrl: '/com_zeapps_project/task/mytask',
                controller: 'ComZeappsProjectMyTaskCtrl'
            })
        ;
    }]);

