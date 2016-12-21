// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'meeting_app',
    function_name:'addSubject',
    templateUrl:'/meeting_app/subject/modalSubject',
    controller:'MeetingAppModalSubjectsFormCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return "Ajout d'un sujet" ;
        }
    }
});


app.controller('MeetingAppModalSubjectsFormCtrl', function($scope, $uibModalInstance, $http, titre, option, $routeParams) {


    /**
     * Persist in database
     */
    $scope.save = function () {
        var $data = {};
        var subject = false;
        /************ Check if fields(name and description) are completed *************/

        if ($scope.form.name != undefined) {
            if ($routeParams.id_meet && $routeParams.id_meet != 0 && $routeParams.id_project && $routeParams.id_project != 0 ) {
                $data.id_meet = $routeParams.id_meet;
                $data.id_project = $routeParams.id_project;
            }

            $data.name = $scope.form.name;



            $http.post('/meeting_app/subject/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                console.log(obj.data);
                $uibModalInstance.close(subject);
            });
        }
    }



    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };






}) ;