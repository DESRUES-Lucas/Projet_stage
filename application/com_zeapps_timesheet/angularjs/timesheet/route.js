app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_timesheet/timesheet/:id/search', {
                templateUrl: '/com_zeapps_timesheet/timesheet/search',
                controller: 'ComZeappsTimesheetTimesheetSearchCtrl'
            })

            .when('/ng/com_zeapps_timesheet/timesheet/:id_contract/new', {
                templateUrl: '/com_zeapps_timesheet/timesheet/form',
                controller: 'ComZeappsTimesheetTimesheetFormCtrl'
            })

            .when('/ng/com_zeapps_timesheet/timesheet/:id_contract/:id', {
                templateUrl: '/com_zeapps_timesheet/timesheet/form',
                controller: 'ComZeappsTimesheetTimesheetFormCtrl'
            })


        ;
    }]);

