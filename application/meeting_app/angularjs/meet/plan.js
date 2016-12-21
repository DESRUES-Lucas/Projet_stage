
app.controller('MeetingAppMeetPlanCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {




        var loadList = function () {

            $http.get('/meeting_app/meet/getMeetByProject/'+ $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.meets = response.data ;

                }
            });
        };
        loadList() ;




        $scope.addMeet = function () {
            console.log(id_project);
            zeapps_modal.loadModule("meeting_app", "addMeet", {id_project:id_project}, function(objReturn) {

                loadList() ;
            });

        };

        $scope.edit_meet = function (id) {
            zeapps_modal.loadModule("meeting_app", "addMeet", {id:id}, function(objReturn) {

                loadList() ;
            });
        };


        /**
         * Delete a meet
         */

        $scope.delete_meet = function (id_meet) {
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
                    $http.get('/meeting_app/meet/delete/' + id_meet).then(function (response) {
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





    }]);

