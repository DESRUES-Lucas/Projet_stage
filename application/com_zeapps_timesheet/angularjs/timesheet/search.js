app.controller('ComZeappsTimesheetTimesheetSearchCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        $scope.contract_id = $routeParams.id;

        //Select only timesheet created by the current user
        var loadTimesheetByUser = function()
        {
            $http.get('/com_zeapps_timesheet/timesheet/getTimesheetByUser/'+ $scope.contract_id).then(function (response) {
                if (response.data && response.data != "false") {

                    $scope.timesheets = response.data;

                }
                else{
                    delete $scope.timesheets;
                }
            });
        };
        loadTimesheetByUser() ;


        // search the current user as an object
        var getContractId = function()
        {
            $http.get('/com_zeapps_timesheet/contract/get/'+ $scope.contract_id).then(function (response) {
                if (response.data && response.data != "false") {
                        console.log(response.data);
                    $scope.contract = response.data;

                }

            });
        };
        getContractId();





        $scope.edit_timesheet = function(timesheet_id){
            $location.path("/ng/com_zeapps_timesheet/timesheet/"+ $scope.contract_id +'/'+ timesheet_id);
        };






        $scope.delete_timesheet = function (id) {
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
                    $http.get('/com_zeapps_timesheet/timesheet/delete/' + id).then(function (response) {
                        if (response.status == 200) {
                            loadTimesheetByUser() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };





    }]);