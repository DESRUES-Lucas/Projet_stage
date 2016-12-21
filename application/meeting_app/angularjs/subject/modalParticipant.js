// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'meeting_app',
    function_name:'addParticipant',
    templateUrl:'/meeting_app/subject/modalParticipant',
    controller:'MeetingAppModalParticipantsFormCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return "Ajout d'un participant" ;
        }
    }
});


app.controller('MeetingAppModalParticipantsFormCtrl', function($scope, $uibModalInstance, $http, titre, option, $routeParams) {


   var loadList = function(){

       $http.post('/meeting_app/subject/getUsers').then(function (response) {
           if (response.status == 200) {
               $scope.users = response.data ;

           }
       });
   };
    loadList() ;



    $scope.addParticipant = function(user_id){

        var data = {};
        var subject = false;

        if ($routeParams.id_meet && $routeParams.id_meet != 0 ) {
            data.id_meet = $routeParams.id_meet;

        }
            data.id_note = option.id_note;
            data.id_participant = user_id;


        $http.post('/meeting_app/subject/addParticipant', data).then(function (obj) {



            $uibModalInstance.close(obj.data);
            loadList();


        });

    }





}) ;