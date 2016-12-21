app.controller('ComZeappsProjectMyTaskCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        $scope.$parent.loadMenu("com_ze_apps_project", "com_zeapps_projects_my_task");



        $scope.projets = [];




        // charge la fiche
        var loadTask = function () {
            $http.get('/com_zeapps_project/task/getmytask/').then(function (response) {
                if (response.status == 200) {
                    if (response.data == 'false') {
                        $scope.projets = [];
                    } else {
                        $scope.projets = response.data;
                    }
                }
            });
        };
        loadTask() ;











        $scope.edit_task = function(id_project, id_section, id_task) {
            $location.path("/ng/com_zeapps_project/project/" + id_project + "/section/" + id_section + "/task/" + id_task);
        };

        $scope.delete_task = function(id_section, id_task) {
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
                        return 'Souhaitez-vous supprimer définitivement cette tâche ?';
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

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    $http.get('/com_zeapps_project/task/delete/' + id_task).then(function (response) {
                        if (response.status == 200) {
                            loadTask() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });
        };




        $scope.completed_task = function(id_section, id_task) {
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
                        return 'Souhaitez-vous confirmer la fin de tâche ?';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return false;
                    },
                    action_success: function () {
                        return 'Je confirme la fin de tâche';
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    $http.get('/com_zeapps_project/task/completed/' + id_task).then(function (response) {
                        if (response.status == 200) {
                            loadTask() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });
        };




    }]);