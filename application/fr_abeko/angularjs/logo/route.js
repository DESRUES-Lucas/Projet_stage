app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/logo/search', {
                templateUrl: '/fr_abeko/logo/search',
                controller: 'FrAbekoLogoSearchCtrl'
            })
            .when('/ng/fr_abeko/logo/new', {
                templateUrl: '/fr_abeko/logo/form',
                controller: 'FrAbekoLogoFormCtrl'
            })

        ;
    }]);

