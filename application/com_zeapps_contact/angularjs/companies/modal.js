// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'com_zeapps_contact',
    function_name:'search_company',
    templateUrl:'/com_zeapps_contact/companies/modal_company',
    controller:'ZeAppsContactsModalCompanyCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return 'Recherche d\'une entreprise';
        }
    }
});


app.controller('ZeAppsContactsModalCompanyCtrl', function($scope, $uibModalInstance, $http, titre, option) {
    $scope.titre = titre ;


    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };



    var loadList = function () {
        var options = {};
        $http.post('/com_zeapps_contact/companies/getAll', options).then(function (response) {
            if (response.status == 200) {
                $scope.companies = response.data ;
            }
        });
    };
    loadList() ;


    $scope.loadCompany = function (id_company) {

        // search the company
        var company = false ;
        for (var i = 0 ; i < $scope.companies.length ; i++) {
            if ($scope.companies[i].id == id_company) {
                company = $scope.companies[i] ;
                break;
            }
        }

        $uibModalInstance.close(company);
    }

}) ;