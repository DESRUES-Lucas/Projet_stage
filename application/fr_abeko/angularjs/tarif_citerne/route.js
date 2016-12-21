app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/fr_abeko/citerne_tarif', {
                templateUrl: '/fr_abeko/tarifciterne/search',
                controller: 'FrAbekoCiterneTarifListCtrl'
            })
            .when('/ng/fr_abeko/citerne_tarif/new', {
                templateUrl: '/fr_abeko/tarifciterne/view',
                controller: 'FrAbekoCiterneTarifViewCtrl'
            })
            .when('/ng/fr_abeko/citerne_tarif/:id', {
                templateUrl: '/fr_abeko/tarifciterne/view',
                controller: 'FrAbekoCiterneTarifViewCtrl'
            })

        ;
    }]);

