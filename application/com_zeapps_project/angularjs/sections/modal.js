// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'com_zeapps_project',
    function_name:'search_section',
    templateUrl:'/com_zeapps_project/section/modal_section',
    controller:'ZeAppsProjectsModalSectionCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return 'Recherche d\'une section';
        }
    }
});


app.controller('ZeAppsProjectsModalSectionCtrl', function($scope, $uibModalInstance, $http, titre, option) {
    $scope.titre = titre ;


    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };



    var loadList = function () {
        var options = {};
        $http.post('/com_zeapps_project/section/getAll/' + option.id_project, options).then(function (response) {
            if (response.status == 200) {
                $scope.sections = response.data ;
            }
        });
    };
    loadList() ;


    $scope.loadSection = function (id_company) {

        // search the company
        var section = false ;
        for (var i = 0 ; i < $scope.sections.length ; i++) {
            if ($scope.sections[i].id == id_company) {
                section = $scope.sections[i] ;
                break;
            }
        }

        $uibModalInstance.close(section);
    }

}) ;