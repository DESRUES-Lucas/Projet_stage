app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/meeting_app/project/plan', {
                templateUrl: '/meeting_app/project/plan',
                controller: 'MeetingAppPlanCtrl'
            })

            .when('/ng/meeting_app/project/new', {
                templateUrl: '/meeting_app/project/form',
                controller: 'MeetingAppProjectsFormCtrl'
            })

            .when('/ng/meeting_app/project/:id', {
                templateUrl: '/meeting_app/project/form',
                controller: 'MeetingAppProjectsFormCtrl'
            })

        ;
    }]);

