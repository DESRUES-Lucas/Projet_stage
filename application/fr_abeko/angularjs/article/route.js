app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/article', {
                templateUrl: '/fr_abeko/article/search',
                controller: 'FrAbekoArticleListCtrl'
            })
            .when('/ng/fr_abeko/article/new', {
                templateUrl: '/fr_abeko/article/view',
                controller: 'FrAbekoArticleViewCtrl'
            })
            .when('/ng/fr_abeko/article/:id', {
                templateUrl: '/fr_abeko/article/view',
                controller: 'FrAbekoArticleViewCtrl'
            })

        ;
    }]);

