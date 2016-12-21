// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'com_zeapps_contact',
    function_name:'search_code_naf',
    templateUrl:'/com_zeapps_contact/code_naf/modal_code_naf',
    controller:'ZeAppsContactsModalCodeNafCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return 'Recherche d\'un code NAF';
        }
    }
});


app.controller('ZeAppsContactsModalCodeNafCtrl', function($scope, $uibModalInstance, $http, titre, option) {
    $scope.titre = titre ;


    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };



    var loadList = function () {
        var options = {};
        $http.post('/com_zeapps_contact/code_naf/getAll', options).then(function (response) {
            if (response.status == 200) {
                $scope.code_naf = response.data ;
            }
        });
    };
    loadList() ;


    $scope.loadCodeNaf = function (code_naf_id) {

        // search the company
        var code_naf = false ;
        for (var i = 0 ; i < $scope.code_naf.length ; i++) {
            if ($scope.code_naf[i].code_naf == code_naf_id) {
                code_naf = $scope.code_naf[i] ;
                break;
            }
        }

        $uibModalInstance.close(code_naf);
    }

}) ;