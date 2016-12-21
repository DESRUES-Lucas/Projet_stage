
app.controller('MeetingAppPlanCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        /*********** Load all projects saved in BDD ***********/

        var loadList = function () {
            $http.get('/meeting_app/project/getAll').then(function (response) {
                if (response.status == 200) {
                    $scope.projects = response.data ;
                    console.log("toto");
                }
            });
        };
        loadList() ;


        /*********** Delete project with id_project in argument ***********/

        $scope.delete_project = function (id_project) {
            //console.log($scope.delete);
            var modalInstance = $uibModal.open({

                animation: true,
                templateUrl: '/assets/angular/popupModalDeBase.html',
                controller: 'ZeAppsPopupModalDeBaseCtrl',
                size: 'lg',
                resolve: {
                    titre: function () {
                        return 'Attention';
                    },
                    msg: function () {
                        return 'Souhaitez-vous supprimer définitivement ce projet ?';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return false;
                    },
                    action_success: function () {
                        return 'Je confirme la suppression';
                    }

                }

            });

            /********** Send the Http request to the Php controller and reload projects **********/

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    // console.log(workload_id);
                    $http.get('/meeting_app/project/delete/' + id_project).then(function (response) {
                        if (response.status == 200) {
                            console.log(response.data);
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };



        $scope.edit_project = function (id_project) {
            $location.path("/ng/meeting_app/project/" + id_project);
        };


        /******** Call addMeet Modal *********/

        $scope.addMeet = function (id_project) {
            zeapps_modal.loadModule("meeting_app", "addMeet", {id_project:id_project}, function(objReturn) {

            loadList();
            });

        };





    }]);

