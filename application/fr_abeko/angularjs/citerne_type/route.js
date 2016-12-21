app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/citerne_type', {
                templateUrl: '/fr_abeko/citernetype/search',
                controller: 'FrAbekoCiterneTypeListCtrl'
            })
            .when('/ng/fr_abeko/citerne_type/new', {
                templateUrl: '/fr_abeko/citernetype/view',
                controller: 'FrAbekoCiterneTypeViewCtrl'
            })
            .when('/ng/fr_abeko/citerne_type/:id', {
                templateUrl: '/fr_abeko/citernetype/view',
                controller: 'FrAbekoCiterneTypeViewCtrl'
            })

        ;
    }]);

