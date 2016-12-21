app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_timesheet/contract/search', {
                templateUrl: '/com_zeapps_timesheet/contract/search',
                controller: 'ComZeappsTimesheetContractSearchCtrl'
            })

            .when('/ng/com_zeapps_timesheet/contract/new', {
                templateUrl: '/com_zeapps_timesheet/contract/form',
                controller: 'ComZeappsTimesheetContractFormCtrl'
            })

            .when('/ng/com_zeapps_timesheet/contract/:id', {
                templateUrl: '/com_zeapps_timesheet/contract/form',
                controller: 'ComZeappsTimesheetContractFormCtrl'
            })


        ;
    }]);

