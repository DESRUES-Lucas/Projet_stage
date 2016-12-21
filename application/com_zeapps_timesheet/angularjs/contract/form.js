app.controller('ComZeappsTimesheetContractFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {


        $scope.$parent.loadMenu("com_ze_apps_timesheet", "com_zeapps_timesheets_timesheet");

        $scope.form = {
            time: 0,
            alert: 0
        };


        $scope.loadCompany = function () {
            zeapps_modal.loadModule("com_zeapps_contact", "search_company", {}, function(objReturn) {
                //console.log(objReturn);
                if (objReturn) {
                    $scope.form.id_company = objReturn.id;
                    $scope.form.company_name = objReturn.company_name;
                } else {
                    $scope.form.id_company = 0;
                    $scope.form.company_name = '';
                }
            });
        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.removeCompany = function() {
            $scope.form.id_company = 0;
            $scope.form.company_name = '';
        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $scope.save = function () {
            var $data = {};

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.company_id = $scope.form.id_company;
            $data.company_name = $scope.form.company_name;
            $data.contract_name = $scope.form.contract_name;
            $data.time = $scope.form.time;
            $data.alert = $scope.form.alert;
            if($scope.form.opened_at) {
                var y = $scope.form.opened_at.getFullYear();
                var M = $scope.form.opened_at.getMonth();
                var d = $scope.form.opened_at.getDate();

                var date = new Date(Date.UTC(y, M, d));

                $data.opened_at = date;
            }

            if($scope.form.end_at) {
                var y2 = $scope.form.end_at.getFullYear();
                var M2 = $scope.form.end_at.getMonth();
                var d2 = $scope.form.end_at.getDate();

                var date2 = new Date(Date.UTC(y2, M2, d2));

                $data.end_at = date2;
            }


            $http.post('/com_zeapps_timesheet/contract/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/com_zeapps_timesheet/contract/search");
            });
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_timesheet/contract/search");
        }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // load the list and transform strings to number or date

        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_timesheet/contract/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                    $scope.form.time = parseInt($scope.form.time);
                    $scope.form.alert = parseInt($scope.form.alert);

                    $scope.form.opened_at = new Date($scope.form.opened_at);
                    $scope.form.end_at = new Date($scope.form.end_at);

                }
            });
        }


    }]);
