app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/meeting_app/subject/plan/:id_project/:id_meet', {
                templateUrl: '/meeting_app/subject/plan',
                controller: 'MeetingAppSubjectsPlanCtrl'
            })

            .when('/ng/meeting_app/subject/new', {
                templateUrl: '/meeting_app/subject/form',
                controller: 'MeetingAppSubjectsFormCtrl'
            })

            .when('/ng/meeting_app/user/:id', {
                templateUrl: '/meeting_app/subject/plan',
                controller: 'MeetingAppSubjectsPlanCtrl'
            })


        ;
    }]);

