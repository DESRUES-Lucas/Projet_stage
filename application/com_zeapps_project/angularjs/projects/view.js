app.controller('ComZeappsProjectViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        $scope.$parent.loadMenu("com_ze_apps_project", "com_zeapps_projects_list");



        $scope.tasks_without_sections = [] ;
        $scope.sections = [] ;





        $scope.download_pdf = function() {
            $http.get('/com_zeapps_project/pdf/task_project/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    window.document.location.href = '/com_zeapps_project/pdf/downloadPDF' ;
                }
            });
        } ;





        var loadListSection = function () {
            $scope.sections = [] ;

            var options = {};
            $http.post('/com_zeapps_project/section/getAll/' + $routeParams.id, options).then(function (response) {
                if (response.status == 200) {
                    $scope.sections = response.data ;
                    loadListTask() ;
                }
            });
        };
        loadListSection() ;




        var loadListTask = function () {
            $scope.tasks_without_sections = [] ;



            var options = {};
            $http.post('/com_zeapps_project/task/getAll/' + $routeParams.id, options).then(function (response) {
                if (response.status == 200) {
                    $scope.tasks = response.data ;


                    for (var i = 0 ; i < $scope.tasks.length ; i++) {
                        if ($scope.tasks[i].id_section == 0) {
                            $scope.tasks_without_sections.push($scope.tasks[i]) ;
                        }
                    }



                    // ajoute les tâches sans section
                    for (var j = 0 ; j < $scope.sections.length ; j++) {
                        $scope.sections[j].tasks = [] ;
                        $scope.sections[j].sortableOptionsTask = {
                            start: function () {
                            },
                            stop: function (e, ui) {
                                for (var i_section = 0 ; i_section < $scope.sections.length ; i_section++) {
                                    if ($scope.sections[i_section].id == $scope.selectedSectionTask) {
                                        var logEntry = $scope.sections[i_section].tasks.map(function(i){
                                            return i.id;
                                        }).join(', ');

                                        var options = {} ;
                                        options.id_project = $routeParams.id ;
                                        options.id_section = $scope.selectedSectionTask ;
                                        options.ids = logEntry ;

                                        $http.post('/com_zeapps_project/task/updateOrder', options).then(function (response) {
                                            if (response.status == 200) {
                                                loadListTask() ;
                                            }
                                        });

                                        break;
                                    }
                                }
                            },
                            update: function (e, ui) {
                            },
                            cursor: "move",
                            axis: 'y',
                            delay: 150,
                            opacity: 0.5,
                            handle: ".moveElement",
                            testNicolas:1234
                        };

                        for (var i = 0 ; i < $scope.tasks.length ; i++) {
                            if ($scope.tasks[i].id_section == $scope.sections[j].id) {
                                $scope.sections[j].tasks.push($scope.tasks[i]);
                            }
                        }
                    }

                }
            });
        };




        $scope.sortableOptionsTask = {
            start: function () {
            },
            stop: function (e, ui) {
                var logEntry = $scope.tasks_without_sections.map(function(i){
                    return i.id;
                }).join(', ');

                var options = {} ;
                options.id_project = $routeParams.id ;
                options.id_section = 0 ;
                options.ids = logEntry ;

                $http.post('/com_zeapps_project/task/updateOrder', options).then(function (response) {
                    if (response.status == 200) {
                        loadListTask() ;
                    }
                });


            },
            update: function (e, ui) {
            },
            cursor: "move",
            axis: 'y',
            delay: 150,
            opacity: 0.5,
            handle: ".moveElement",
            testNicolas:1234
        };





        $scope.selectedSectionTask = 0 ;
        $scope.startMoveTask = function(idSection) {
            $scope.selectedSectionTask = idSection;
        };




        $scope.edit_section = function(id_section) {
            $location.path("/ng/com_zeapps_project/project/" + $routeParams.id + "/section/" + id_section);
        };

        $scope.add_task = function(id_section) {
            $location.path("/ng/com_zeapps_project/project/" + $routeParams.id + "/section/" + id_section + "/task/add");
        };

        $scope.delete_section = function(id_section) {
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
                        return 'Souhaitez-vous supprimer cette section ?<br>Toutes les tâches de cette section seront également supprimées';
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
                    $http.get('/com_zeapps_project/section/delete/' + id_section).then(function (response) {
                        if (response.status == 200) {
                            loadListSection();
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });
        };




        $scope.edit_task = function(id_section, id_task) {
            $location.path("/ng/com_zeapps_project/project/" + $routeParams.id + "/section/" + id_section + "/task/" + id_task);
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
                            loadListSection() ;
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
                            loadListSection() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });
        };








        // pour changer l'ordre des sections
        $scope.sortableOptions = {
            start: function () {
            },
            stop: function () {
                var logEntry = $scope.sections.map(function(i){
                    return i.id;
                }).join(', ');

                var options = {} ;
                options.id_project = $routeParams.id ;
                options.ids = logEntry ;

                $http.post('/com_zeapps_project/section/updateOrder', options).then(function (response) {
                    if (response.status == 200) {
                        loadListTask() ;
                    }
                });
            },
            update: function (e, ui) {

            },
            cursor: "move",
            axis: 'y',
            delay: 150,
            opacity: 0.5,
            handle: ".moveElement"
        };













        $scope.projet = {};

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_project/project/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.projet = response.data;
                }
            });
        }





    }]);