app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_crm/product/', {
                templateUrl: '/com_zeapps_crm/product/view',
                controller: 'ComZeappsCrmProductViewCtrl'
            })

            .when('/ng/com_zeapps_crm/product/category/:id', {
                templateUrl: '/com_zeapps_crm/product/view',
                controller: 'ComZeappsCrmProductViewCtrl'
            })

            .when('/ng/com_zeapps_crm/product/:id', {
                templateUrl: '/com_zeapps_crm/product/details',
                controller: 'ComZeappsCrmProductDetailsCtrl'
            })

            .when('/ng/com_zeapps_crm/product/:id/edit', {
                templateUrl: '/com_zeapps_crm/product/form',
                controller: 'ComZeappsCrmProductFormCtrl'
            })

            .when('/ng/com_zeapps_crm/product/:id_delete/delete', {
                templateUrl: '/com_zeapps_crm/product/form',
                controller: 'ComZeappsCrmProductFormCtrl'
            })

            .when('/ng/com_zeapps_crm/product/new_product/:category', {
                templateUrl: '/com_zeapps_crm/product/form',
                controller: 'ComZeappsCrmProductFormCtrl'
            })

            .when('/ng/com_zeapps_crm/product/new_category/:id_parent', {
                templateUrl: '/com_zeapps_crm/product/form_category',
                controller: 'ComZeappsCrmProductFormCategoryCtrl'
            })

            .when('/ng/com_zeapps_crm/product/category/:id/edit', {
                templateUrl: '/com_zeapps_crm/product/form_category',
                controller: 'ComZeappsCrmProductFormCategoryCtrl'
            })

            .when('/ng/com_zeapps_crm/product/category/:id_delete/delete', {
                templateUrl: '/com_zeapps_crm/product/form_category',
                controller: 'ComZeappsCrmProductFormCategoryCtrl'
            })
        ;
    }]);