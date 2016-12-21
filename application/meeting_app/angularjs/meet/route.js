app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/meeting_app/meet/plan/:id', {
                templateUrl: '/meeting_app/meet/plan',
                controller: 'MeetingAppMeetPlanCtrl'
            })

        ;
    }]);

