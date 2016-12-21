// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'meeting_app',
    function_name:'addMeet',
    templateUrl:'/meeting_app/meet/modalAddMeet',
    controller:'MeetingAppModalAddMeetFormCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return "Ajout d'une réunion" ;
        }
    }
});


app.controller('MeetingAppModalAddMeetFormCtrl', function($scope, $uibModalInstance, $http, titre, option, $routeParams) {


    /**
     * Persist in database
     */
    $scope.save = function (id_project) {
        var $data = {};
        var meet = false;
        /************ Check if fields(name, date and description) are completed *************/

        if ($scope.form.name != undefined && $scope.form.date_meet != undefined) {

            $data.id_project = option.id_project;


            $data.id = $scope.form.id;
            $data.name = $scope.form.name;
            $data.description = $scope.form.description;
            if($scope.form.date_meet) {
                var y = $scope.form.date_meet.getFullYear();
                var M = $scope.form.date_meet.getMonth();
                var d = $scope.form.date_meet.getDate();

                var date = new Date(Date.UTC(y, M, d));

                $data.date_meet = date;
            }


            $http.post('/meeting_app/meet/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                console.log(obj.data);
                $uibModalInstance.close(meet);
            });
        }
    }




    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    // charge la fiche

    if (option.id && option.id != 0) {
        $http.get('/meeting_app/meet/get/' + option.id).then(function (response) {
            if (response.status == 200) {
                $scope.form = response.data;
                $scope.form.date_meet = new Date($scope.form.date_meet);
            }
        });
    }







}) ;