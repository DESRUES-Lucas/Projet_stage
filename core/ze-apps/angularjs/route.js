app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider

            .when('/', {
                redirectTo: '/ng/com_zeapps_contact/companies'
            })

            .when('/ng/', {
                redirectTo: '/ng/com_zeapps_contact/companies'
            })

            .when('/ng/com_zeapps/config', {
                templateUrl: '/ze-apps/config/',
                controller: 'ComZeAppsConfigCtrl'
            })

            .when('/ng/com_zeapps/users', {
                templateUrl: '/ze-apps/user/',
                controller: 'ComZeAppsUsersCtrl'
            })
            .when('/ng/com_zeapps/users/view/:id?', {
                templateUrl: '/ze-apps/user/form ',
                controller: 'ComZeAppsUsersFormCtrl'
            })


            .when('/ng/com_zeapps/groups', {
                templateUrl: '/ze-apps/group/',
                controller: 'ComZeAppsGroupsCtrl'
            })
            .when('/ng/com_zeapps/groups/view/:id?', {
                templateUrl: '/ze-apps/group/form ',
                controller: 'ComZeAppsGroupsFormCtrl'
            })



            .when('/ng/com_zeapps/profile/view', {
                templateUrl:'/ze-apps/profile/view',
                controller: 'ComZeAppsProfileViewCtrl'
            })

            .when('/ng/com_zeapps/profile/edit', {
                templateUrl:'/ze-apps/profile/form',
                controller: 'ComZeAppsProfileFormCtrl'
            })

            .when('/ng/com_zeapps/profile/notifications', {
                templateUrl:'/ze-apps/profile/notifications',
                controller: 'ComZeAppsProfileNotificationsCtrl'
            })


            .otherwise({
                templateUrl: '/ze-apps/zeapps/pagenotfound'
            })


        ;
    }]);

