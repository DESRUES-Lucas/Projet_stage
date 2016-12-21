app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider
            .when('/ng/com_zeapps_contact/contacts', {
                templateUrl: '/com_zeapps_contact/contacts/search',
                controller: 'ComZeappsContactContactsListCtrl'
            })
            .when('/ng/com_zeapps_contact/contacts/new', {
                templateUrl: '/com_zeapps_contact/contacts/form',
                controller: 'ComZeappsContactContactsFormListCtrl'
            })
            .when('/ng/com_zeapps_contact/contacts/:id', {
                templateUrl: '/com_zeapps_contact/contacts/form',
                controller: 'ComZeappsContactContactsFormListCtrl'
            })

        ;
    }]);

