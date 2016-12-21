app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_workload/workload/plan', {
                templateUrl: '/com_zeapps_workload/workload/plan',
                controller: 'ComZeappsWorkloadPlanCtrl'
            })


            .when('/ng/com_zeapps_workload/workload/new', {
                templateUrl: '/com_zeapps_workload/workload/form',
                controller: 'ComZeappsWorkloadWorkloadsFormCtrl'
            })

            .when('/ng/com_zeapps_workload/workload/:id', {
                templateUrl: '/com_zeapps_workload/workload/form',
                controller: 'ComZeappsWorkloadWorkloadsFormCtrl'
            })
        ;
    }]);

