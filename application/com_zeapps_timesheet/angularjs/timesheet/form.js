app.controller('ComZeappsTimesheetTimesheetFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        if($routeParams.id && $routeParams.id != 0){
            $http.get('/com_zeapps_timesheet/timesheet/get/'+ $routeParams.id).then(
                function(response){
                    if(response.data && response.data != "false"){
                        $scope.form = response.data;
                        $scope.form.time_spent = parseInt($scope.form.time_spent);
                        $scope.form.date_work = new Date($scope.form.date_work);

                    }

                }
            );
        }

        $scope.save = function () {
            var $data = {};

            if ($routeParams.id_contract != 0) {
                $data.contract_id = $routeParams.id_contract;
            }
            if($routeParams.id && $routeParams.id != 0){
                $data.id = $routeParams.id;
            }

            $data.time_spent = $scope.form.time_spent;

            if($scope.form.date_work) {
                var y = $scope.form.date_work.getFullYear();
                var M = $scope.form.date_work.getMonth();
                var d = $scope.form.date_work.getDate();

                var date = new Date(Date.UTC(y, M, d));

                $data.date_work = date;

            }

            $data.reason = $scope.form.reason;


            $http.post('/com_zeapps_timesheet/timesheet/save', $data).then(function (obj) {

                // pour que la page puisse être redirigé
                $location.path("/ng/com_zeapps_timesheet/timesheet/"+$routeParams.id_contract+"/search");
            });
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_timesheet/contract/search");
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    }]);
