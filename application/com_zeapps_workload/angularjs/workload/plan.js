/**
 * Created by nous on 27/09/2016.
 */
app.controller('ComZeappsWorkloadPlanCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {



        $scope.$parent.loadMenu("com_ze_apps_workload", "com_zeapps_workloads_workload");




        // charge la fiche
        var loadList = function () {

            $scope.workloadsArray = {};

            $http.get('/com_zeapps_workload/status/getall/').then(function (response) {
                if(response.data){
                    angular.forEach(response.data, function(workloadTable){
                        $scope.workloadsArray[workloadTable.id] = workloadTable;
                        $scope.workloadsArray[workloadTable.id].workloads = [];
                    });
                    $http.get('/com_zeapps_workload/workload/getall/').then(function (response) {
                        if (response.status == 200) {

                            if (response.data) {
                                angular.forEach(response.data, function(workload){
                                    $scope.workloadsArray[parseInt(workload.status)].workloads.push(workload);
                                });

                            }

                        }
                    });
                }
            });

        };
        loadList() ;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //Preparation à la suppression d'un plan de charge

        $scope.delete_workload = function (workload_id) {
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
                        return 'Souhaitez-vous supprimer définitivement ce plan ?';
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
                    // console.log(workload_id);
                    $http.get('/com_zeapps_workload/workload/delete/' + workload_id).then(function (response) {
                        if (response.status == 200) {
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // Edition d'un plan de charge

        $scope.edit_workload = function (workload_id) {
            $location.path("/ng/com_zeapps_workload/workload/" + workload_id);
        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // Drag and Drop d'un tableau à l'autre

        $scope.sortable = {
            connectWith: ".sortableContainer",
            placeholder: "app",
            stop: function( event, ui ) {

                var idObj = $(ui.item[0]).attr("data-id") ;
                var ligneSelectionnee = $(".ligne_tableau_" + idObj) ;
                var typeTableauDestination = ligneSelectionnee.parent().attr("data-type") ;

                var position = -1 ;
                var positionDefinitive = 0 ;
                $("tr", ligneSelectionnee.parent()).each(function () {
                    position++ ;
                    if (idObj == $(this).attr("data-id")) {
                        positionDefinitive = position++ ;
                        console.log(positionDefinitive)
                    }
                }) ;

                var data = {} ;
                data.idObj = idObj ;
                data.typeTableauDestination = typeTableauDestination ;
                data.position = positionDefinitive ;
                //console.log(data);

                $http.post('/com_zeapps_workload/workload/save_position', data);
            }
        };







        $scope.getTotal = function(array, attr){
            var total = 0;

            for(var i = 0; i < array.length; i++){

                total += parseFloat(array[i][attr]) ;
            }

            return total;
        };


    }]);

