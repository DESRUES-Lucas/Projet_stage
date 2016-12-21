app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_crm/quotes', {
                templateUrl: '/com_zeapps_contact/companies/search',
                controller: 'ComZeappsContactCompaniesListCtrl'
            })



            .when('/ng/com_zeapps_crm/quote/:id', {
                templateUrl: '/com_zeapps_crm/quotes/view',
                controller: 'ComZeappsCrmQuoteViewCtrl'
            })




            /*.when('/ng/com_zeapps_contact/companies/new', {
                templateUrl: '/com_zeapps_contact/companies/form',
                controller: 'ComZeappsContactCompaniesFormListCtrl'
            })
            .when('/ng/com_zeapps_contact/companies/new/retour/:url_retour', {
                templateUrl: '/com_zeapps_contact/companies/form',
                controller: 'ComZeappsContactCompaniesFormListCtrl'
            })






            .when('/ng/com_zeapps_contact/companies/:id/edit', {
                templateUrl: '/com_zeapps_contact/companies/form',
                controller: 'ComZeappsContactCompaniesFormListCtrl'
            })
            .when('/ng/com_zeapps_contact/companies/:id/edit/retour/:url_retour', {
                templateUrl: '/com_zeapps_contact/companies/form',
                controller: 'ComZeappsContactCompaniesFormListCtrl'
            })*/

        ;
    }]);

