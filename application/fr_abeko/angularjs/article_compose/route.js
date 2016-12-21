app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/article_compose', {
                templateUrl: '/fr_abeko/articlecompose/search',
                controller: 'FrAbekoArticleComposeListCtrl'
            })
            .when('/ng/fr_abeko/article_compose/new', {
                templateUrl: '/fr_abeko/articlecompose/view',
                controller: 'FrAbekoArticleComposeViewCtrl'
            })
            .when('/ng/fr_abeko/article_compose/:id', {
                templateUrl: '/fr_abeko/articlecompose/view',
                controller: 'FrAbekoArticleComposeViewCtrl'
            })

        ;
    }]);

