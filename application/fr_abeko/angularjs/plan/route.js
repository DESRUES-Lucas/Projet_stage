app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/plan', {
                templateUrl: '/fr_abeko/plan/search',
                controller: 'FrAbekoPlanListCtrl'
            })
            .when('/ng/fr_abeko/plan/view/:id', {
                templateUrl: '/fr_abeko/plan/view',
                controller: 'FrAbekoPlanViewCtrl'
            })
            .when('/ng/fr_abeko/plan/form', {
                templateUrl: '/fr_abeko/plan/form',
                controller: 'FrAbekoPlanFormCtrl'
            })
        ;
    }]);