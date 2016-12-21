app.controller('ComZeappsTimesheetContractSearchCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        $scope.$parent.loadMenu("com_ze_apps_timesheet", "com_zeapps_timesheets_timesheet");


        var loadList = function () {
            var options = {};

            $http.post('/com_zeapps_timesheet/contract/getAll', options).then(function (response) {
                if (response.status == 200) {

                    console.log(response.data);

                    $scope.contracts = response.data ;
                }
            });
        };
        loadList() ;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $scope.delete_contract = function (id) {
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
                        return 'Souhaitez-vous supprimer définitivement ce contact ?';
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
                    $http.get('/com_zeapps_timesheet/contract/delete/' + id).then(function (response) {
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





        $scope.edit_contract = function(timesheet_id){
            $location.path("/ng/com_zeapps_timesheet/contract/" + timesheet_id);
        };


    }]);