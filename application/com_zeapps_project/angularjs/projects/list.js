app.requires.push('treeGrid');


app.controller('ComZeappsProjectListCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("com_ze_apps_project", "com_zeapps_projects_list");







        $scope.tree_data = [];




        $scope.col_defs = [
            {
                field: "name",
                displayName:"Nom",
                sortable:true,
                cellTemplate: "<a href=\"/ng/com_zeapps_project/project/view/{{row.branch['id']}}\">{{row.branch[col.field]}}</a>",
            },
            {
                field: "next_due",
                displayName:"Prochaine échéance"
            },
            {
                field: "nb_tasks",
                displayName:"# tâches"
            },
            {
                field: "nb_tasks_unallocated",
                displayName:"# tâches non assignées"
            },
            {
                field: "action",
                displayName:"-",
                cellTemplate: "<button type=\"button\" class=\"btn btn-primary btn-sm\" ng-hide=\"row.branch['sublevel']\" ng-click=\"cellTemplateScope.edit(row.branch['id'])\"><span class=\"glyphicon glyphicon-pencil\"></span></button> " +
                "<button type=\"button\" class=\"btn btn-primary btn-sm\" ng-hide=\"row.branch['sublevel']\" ng-click=\"cellTemplateScope.archived(row.branch['id'])\"><span class=\"glyphicon glyphicon-inbox\"></span></button> " +
                "<button type=\"button\" class=\"btn btn-danger btn-sm\" ng-hide=\"row.branch['sublevel']\" ng-click=\"cellTemplateScope.delete(row.branch['id'])\"><span class=\"glyphicon glyphicon-trash\"></span></button>",
                cellTemplateScope: {
                    edit: function(argIdProject) {         // this works too: $scope.someMethod;
                        $location.path("/ng/com_zeapps_project/project/" + argIdProject);
                    },
                    archived: function(argIdProject) {         // this works too: $scope.someMethod;
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
                                    return 'Souhaitez-vous terminer ce projet ?';
                                },
                                action_danger: function () {
                                    return 'Annuler';
                                },
                                action_primary: function () {
                                    return false;
                                },
                                action_success: function () {
                                    return 'Je confirme l\'archivage';
                                }
                            }
                        });

                        modalInstance.result.then(function (selectedItem) {
                            if (selectedItem.action == 'danger') {

                            } else if (selectedItem.action == 'success') {
                                $http.get('/com_zeapps_project/project/archived/' + argIdProject).then(function (response) {
                                    if (response.status == 200) {
                                        loadList() ;
                                    }
                                });
                            }

                        }, function () {
                            //console.log("rien");
                        });
                    },
                    delete: function(argIdProject) {         // this works too: $scope.someMethod;
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

                        modalInstance.result.then(function (selectedItem) {
                            if (selectedItem.action == 'danger') {

                            } else if (selectedItem.action == 'success') {
                                $http.get('/com_zeapps_project/project/delete/' + argIdProject).then(function (response) {
                                    if (response.status == 200) {
                                        loadList() ;
                                    }
                                });
                            }

                        }, function () {
                            //console.log("rien");
                        });
                    },
                }
            },

        ];















        var reloadJTreeTable = false ;


        $scope.filter_priority = [
            {id:0, label:"Basse", value:true},
            {id:1, label:"Normale", value:true},
            {id:2, label:"Haute", value:true},
        ];


        $scope.filter_status = [
            {id:0, label:"Actif", value:true},
            {id:99, label:"Terminé", value:false},
            {id:1, label:"Reporté", value:false},
            {id:2, label:"Annulé", value:false},
        ];



        $scope.critere_affichage_1 = "2" ;
        $scope.critere_affichage_2 = "0" ;
        $scope.critere_affichage_3 = "0" ;
        $scope.critere_affichage_4 = "0" ;


        if ($rootScope.filter_search_project) {
            if ($rootScope.filter_search_project.filter_priority) {
                $scope.filter_priority = $rootScope.filter_search_project.filter_priority ;
            }
            if ($rootScope.filter_search_project.filter_status) {
                $scope.filter_status = $rootScope.filter_search_project.filter_status ;
            }
            if ($rootScope.filter_search_project.critere_affichage_1) {
                $scope.critere_affichage_1 = $rootScope.filter_search_project.critere_affichage_1 ;
            }
            if ($rootScope.filter_search_project.critere_affichage_2) {
                $scope.critere_affichage_2 = $rootScope.filter_search_project.critere_affichage_2 ;
            }
            if ($rootScope.filter_search_project.critere_affichage_3) {
                $scope.critere_affichage_3 = $rootScope.filter_search_project.critere_affichage_3 ;
            }
            if ($rootScope.filter_search_project.critere_affichage_4) {
                $scope.critere_affichage_4 = $rootScope.filter_search_project.critere_affichage_4 ;
            }
        }

        $scope.update_filter = function() {
            $rootScope.filter_search_project = {} ;
            $rootScope.filter_search_project.filter_priority = $scope.filter_priority ;
            $rootScope.filter_search_project.filter_status = $scope.filter_status ;
            $rootScope.filter_search_project.critere_affichage_1 = $scope.critere_affichage_1 ;
            $rootScope.filter_search_project.critere_affichage_2 = $scope.critere_affichage_2 ;
            $rootScope.filter_search_project.critere_affichage_3 = $scope.critere_affichage_3 ;
            $rootScope.filter_search_project.critere_affichage_4 = $scope.critere_affichage_4 ;

            if ($scope.critere_affichage_1 == 0) {
                $scope.critere_affichage_2 = "0" ;
                $scope.critere_affichage_3 = "0" ;
                $scope.critere_affichage_4 = "0" ;
            } else if ($scope.critere_affichage_2 == 0) {
                $scope.critere_affichage_3 = "0" ;
                $scope.critere_affichage_4 = "0" ;
            } else if ($scope.critere_affichage_3 == 0) {
                $scope.critere_affichage_4 = "0" ;
            }



            loadList() ;
        };





        var getTypeCritereAffichage = function (argIdCritereAffichage) {
            if (argIdCritereAffichage == "1") {
                return "status";
            } else if (argIdCritereAffichage == "2") {
                return "priority";
            } else if (argIdCritereAffichage == "3") {
                return "name_user_project_manager";
            } else if (argIdCritereAffichage == "4") {
                return "company_name";
            }
        };



        var getValueListStatus = function (argValue) {
            var val_return = "" ;

            for (var i = 0 ; i < com_zeapps_project_list_status.length ; i++) {
                if (com_zeapps_project_list_status[i].value == argValue) {
                    val_return = com_zeapps_project_list_status[i].label ;
                }
            }

            return val_return ;
        };

        var getValueListPriority= function (argValue) {
            var val_return = "" ;

            for (var i = 0 ; i < com_zeapps_project_list_priority.length ; i++) {
                if (com_zeapps_project_list_priority[i].value == argValue) {
                    val_return = "Priorité " + com_zeapps_project_list_priority[i].label ;
                }
            }

            return val_return ;
        };


        var loadList = function () {

            var critereAffichage = [] ;
            var nbCritereAffichage = 0 ;
            $scope.tree_data = [] ;



            var options = {};

            options.critere_affichage_1 = "0" ;
            options.critere_affichage_2 = "0" ;
            options.critere_affichage_3 = "0" ;
            options.critere_affichage_4 = "0" ;




            options.filter_priority = [] ;
            options.filter_status = [] ;
            options.critere_affichage_1 = $scope.critere_affichage_1 ;
            if ($scope.critere_affichage_1 != "0") {
                nbCritereAffichage++;
                critereAffichage.push(getTypeCritereAffichage($scope.critere_affichage_1)) ;
                options.critere_affichage_2 = $scope.critere_affichage_2 ;

                if ($scope.critere_affichage_2 != "0") {
                    nbCritereAffichage++;
                    critereAffichage.push(getTypeCritereAffichage($scope.critere_affichage_2)) ;
                    options.critere_affichage_3 = $scope.critere_affichage_3 ;

                    if ($scope.critere_affichage_3 != "0") {
                        nbCritereAffichage++;
                        critereAffichage.push(getTypeCritereAffichage($scope.critere_affichage_3)) ;
                        options.critere_affichage_4 = $scope.critere_affichage_4;

                        if ($scope.critere_affichage_4 != "0") {
                            nbCritereAffichage++;
                            critereAffichage.push(getTypeCritereAffichage($scope.critere_affichage_4));
                        }
                    }
                }
            }


            for (var i = 0 ; i < $scope.filter_priority.length ; i++) {
                if ($scope.filter_priority[i].value) {
                    options.filter_priority.push($scope.filter_priority[i].id) ;
                }
            }
            for (var i = 0 ; i < $scope.filter_status.length ; i++) {
                if ($scope.filter_status[i].value) {
                    options.filter_status.push($scope.filter_status[i].id) ;
                }
            }



            $http.post('/com_zeapps_project/project/getAll', options).then(function (response) {
                if (response.status == 200) {
                    $scope.projects = response.data ;

                    var idProject = "" ;
                    for (var i = 0 ; i < $scope.projects.length ; i++) {
                        if (i > 0) {
                            idProject += "," ;
                        }
                        idProject += $scope.projects[i].id ;
                    }

                    // charge les stats du projet
                    var options = {} ;
                    options.ids_project = idProject ;
                    $http.post('/com_zeapps_project/project/get_stat', options).then(function (response) {
                        if (response.status == 200) {
                            var stat_tasks = response.data ;

                            for (var i = 0 ; i < $scope.projects.length ; i++) {
                                $scope.projects[i].next_due = "" ;
                                $scope.projects[i].nb_tasks = 0 ;
                                $scope.projects[i].nb_tasks_unallocated = 0 ;
                                $scope.projects[i].over_due = false ;

                                for (var j = 0 ; j < stat_tasks.length ; j++) {
                                    if (stat_tasks[j][0] == $scope.projects[i].id) {
                                        $scope.projects[i].next_due = stat_tasks[j][2] ;
                                        $scope.projects[i].nb_tasks = stat_tasks[j][3] ;
                                        $scope.projects[i].nb_tasks_unallocated = stat_tasks[j][4] ;

                                        if (stat_tasks[j][5]) {
                                            $scope.projects[i].over_due = true ;
                                        }

                                        break;
                                    }
                                }
                            }




                            // recalcul le tableau
                            var lastValue = [] ;
                            for (var i = 0 ; i < nbCritereAffichage ; i++) {
                                lastValue[i] = "fdqf5dqsfq89f8fq59bf5fq48fds48dfqs48df48sq8qf4s" ;
                            }




                            $scope.tree_data = [];

                            var obj_niv_1 = {} ;
                            var obj_niv_2 = {} ;
                            var obj_niv_3 = {} ;
                            var obj_niv_4 = {} ;

                            for (var i = 0 ; i < $scope.projects.length ; i++) {
                                var forceLoadSubLevel = false ;
                                // test s'il y a un changement de niveau 1
                                if (nbCritereAffichage >= 1 && lastValue[0] != $scope.projects[i][critereAffichage[0]]) {
                                    lastValue[0] = $scope.projects[i][critereAffichage[0]] ;
                                    var info = lastValue[0] ;
                                    if (critereAffichage[0] == 'priority') {
                                        info = getValueListPriority($scope.projects[i][critereAffichage[0]]) ;
                                    } else if (critereAffichage[0] == 'status') {
                                        info = getValueListStatus($scope.projects[i][critereAffichage[0]]) ;
                                    }


                                    obj_niv_1 = {name:info, sublevel:"sublevel_class", expanded:true, children:[]} ;
                                    forceLoadSubLevel = true ;
                                    $scope.tree_data.push(obj_niv_1);
                                }

                                if (nbCritereAffichage >= 2 && (lastValue[1] != $scope.projects[i][critereAffichage[1]] || forceLoadSubLevel)) {
                                    lastValue[1] = $scope.projects[i][critereAffichage[1]] ;
                                    var info = lastValue[1] ;
                                    if (critereAffichage[1] == 'priority') {
                                        info = getValueListPriority($scope.projects[i][critereAffichage[1]]) ;
                                    } else if (critereAffichage[1] == 'status') {
                                        info = getValueListStatus($scope.projects[i][critereAffichage[1]]) ;
                                    }


                                    obj_niv_2 = {name:info, sublevel:"sublevel_class", expanded:true, children:[]} ;
                                    obj_niv_1.children.push(obj_niv_2);
                                }

                                if (nbCritereAffichage >= 3 && (lastValue[2] != $scope.projects[i][critereAffichage[2]] || forceLoadSubLevel)) {
                                    lastValue[2] = $scope.projects[i][critereAffichage[2]] ;
                                    var info = lastValue[2] ;
                                    if (critereAffichage[2] == 'priority') {
                                        info = getValueListPriority($scope.projects[i][critereAffichage[2]]) ;
                                    } else if (critereAffichage[2] == 'status') {
                                        info = getValueListStatus($scope.projects[i][critereAffichage[2]]) ;
                                    }


                                    obj_niv_3 = {name:info, sublevel:"sublevel_class", expanded:true, children:[]} ;
                                    obj_niv_2.children.push(obj_niv_3);
                                }

                                if (nbCritereAffichage >= 4 && (lastValue[3] != $scope.projects[i][critereAffichage[3]] || forceLoadSubLevel)) {
                                    lastValue[3] = $scope.projects[i][critereAffichage[3]] ;
                                    var info = lastValue[3] ;
                                    if (critereAffichage[3] == 'priority') {
                                        info = getValueListPriority($scope.projects[i][critereAffichage[3]]) ;
                                    } else if (critereAffichage[3] == 'status') {
                                        info = getValueListStatus($scope.projects[i][critereAffichage[3]]) ;
                                    }


                                    obj_niv_4 = {name:info, sublevel:"sublevel_class", expanded:true, children:[]} ;
                                    obj_niv_3.children.push(obj_niv_4);
                                }


                                // ajoute le contenu du projet sur le bon niveau
                                var data = {} ;
                                data.id = $scope.projects[i].id ;
                                data.name = $scope.projects[i].id ;

                                if ($scope.projects[i].company_name != '') {
                                    data.name += " - " + $scope.projects[i].company_name ;
                                }

                                if ($scope.projects[i].project_name != '') {
                                    data.name += " - " + $scope.projects[i].project_name ;
                                }

                                data.name_user_project_manager = $scope.projects[i].name_user_project_manager ;
                                data.next_due = $scope.projects[i].next_due ;
                                data.nb_tasks = $scope.projects[i].nb_tasks ;
                                data.nb_tasks_unallocated = $scope.projects[i].nb_tasks_unallocated ;

                                if (nbCritereAffichage == 0) {
                                    $scope.tree_data.push(data) ;
                                } else if (nbCritereAffichage == 1) {
                                    obj_niv_1.children.push(data) ;
                                } else if (nbCritereAffichage == 2) {
                                    obj_niv_2.children.push(data) ;
                                } else if (nbCritereAffichage == 3) {
                                    obj_niv_3.children.push(data) ;
                                } else if (nbCritereAffichage == 4) {
                                    obj_niv_4.children.push(data) ;
                                }
                            }
                        }
                    });
                }
            });
        };
        loadList() ;





        var isStatusShow = false ;
        $scope.show_status = function () {
            if (isStatusShow) {
                isStatusShow = false;
                $(".col-table-data").removeClass('col-md-9');
                $(".col-table-data").addClass('col-md-12');
                $(".col-status").hide();
            } else {
                isStatusShow = true ;
                $(".col-table-data").removeClass('col-md-12');
                $(".col-table-data").addClass('col-md-9');
                $(".col-status").show();
            }

        };
        $(".col-status").hide();






        $scope.archived = function (argIdProject) {
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
                        return 'Souhaitez-vous terminer ce projet ?';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return false;
                    },
                    action_success: function () {
                        return 'Je confirme l\'archivage';
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    $http.get('/com_zeapps_project/project/archived/' + argIdProject).then(function (response) {
                        if (response.status == 200) {
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });
        };


        $scope.edit = function (argIdProject) {
            $location.path("/ng/com_zeapps_project/project/" + argIdProject);
        };


        $scope.delete = function (argIdProject) {
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

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    $http.get('/com_zeapps_project/project/delete/' + argIdProject).then(function (response) {
                        if (response.status == 200) {
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };


    }]);