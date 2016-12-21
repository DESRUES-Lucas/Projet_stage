app.controller('ComZeappsCrmQuoteViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_crm_quote");



        /******* gestion de la tabs *********/
        $scope.navigationState = 'body';
        if ($rootScope.comZeappsCrmLastShowTabQuote) {
            $scope.navigationState = $rootScope.comZeappsCrmLastShowTabQuote ;
        }

        // pour détecter les changements sur le models
        $scope.$watch('navigationState', function(scope){
            $rootScope.comZeappsCrmLastShowTabQuote = $scope.navigationState ;
        }, true);
        /******* FIN : gestion de la tabs *********/







        // calcul le nombre de résultat
        //$scope.nb_resultat = $rootScope.companies_search_list.length ;
        $scope.nb_result = 123 ;


        // calcul la position du résultat actuel
        $scope.result_order = 4 ;
        $scope.result_first = 2 ;
        $scope.result_previous = 2 ;
        $scope.result_next = 2 ;
        $scope.result_last = 2 ;

        /*
         $scope.result_order = 0 ;
         $scope.result_first = 0 ;
         $scope.result_previous = 0 ;
         $scope.result_next = 0 ;
         $scope.result_last = 0 ;


        for (var i = 0 ; i < $rootScope.companies_search_list.length ; i++) {
            if ($rootScope.companies_search_list[i].id == $routeParams.id) {
                $scope.companie_order = i + 1 ;
                if (i > 0) {
                    $scope.result_previous = $rootScope.companies_search_list[i-1].id ;
                }

                if ((i+1) < $rootScope.companies_search_list.length) {
                    $scope.result_next = $rootScope.companies_search_list[i+1].id ;
                }
            }
        }

        // recherche la première companie de la liste
        if ($rootScope.companies_search_list[0].id != $routeParams.id) {
            $scope.result_first = $rootScope.companies_search_list[0].id ;
        }

        // recherche la dernière companie de la liste
        if ($rootScope.companies_search_list[$rootScope.companies_search_list.length-1].id != $routeParams.id) {
            $scope.result_last = $rootScope.companies_search_list[$rootScope.companies_search_list.length-1].id ;
        }
         */



    }]);