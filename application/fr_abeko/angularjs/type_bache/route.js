app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/type_bache', {
                templateUrl: '/fr_abeko/typebache/search',
                controller: 'FrAbekoTypeBacheListCtrl'
            })
            .when('/ng/fr_abeko/type_bache/new', {
                templateUrl: '/fr_abeko/typebache/view',
                controller: 'FrAbekoTypeBacheViewCtrl'
            })
            .when('/ng/fr_abeko/type_bache/:id', {
                templateUrl: '/fr_abeko/typebache/view',
                controller: 'FrAbekoTypeBacheViewCtrl'
            })

        ;
    }]);

