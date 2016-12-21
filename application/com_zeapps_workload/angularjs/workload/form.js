/**
 * Controller of the workload form view
 */
app.controller('ComZeappsWorkloadWorkloadsFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_workload", "com_zeapps_workloads_workload");

        $scope.form = [];


        $http.get('/com_zeapps_workload/status/getall/').then(function (response) {
            if(response.data){
                $scope.statuses = response.data;
                $scope.form.status = response.data[0].id;
            }
        });


        /**
         * Persist in database
         */
        $scope.save = function () {
            var $data = {};

            if ($scope.form.company != undefined && $scope.form.folder != undefined) {
                if ($routeParams.id != 0) {
                    $data.id = $routeParams.id;
                }

                $data.company = $scope.form.company;
                $data.folder = $scope.form.folder;
                $data.amount = $scope.form.amount;
                $data.commission = $scope.form.commission;
                //$data.margin = $scope.form.margin;
                $data.invoiced = $scope.form.invoiced;
                //$data.still_payable = $scope.form.still_payable;
                if($scope.form.opened_at) {
                    var y = $scope.form.opened_at.getFullYear();
                    var M = $scope.form.opened_at.getMonth();
                    var d = $scope.form.opened_at.getDate();

                    var date = new Date(Date.UTC(y, M, d));

                    $data.opened_at = date;
                }

                if($scope.form.delivered_at) {
                    var y2 = $scope.form.delivered_at.getFullYear();
                    var M2 = $scope.form.delivered_at.getMonth();
                    var d2 = $scope.form.delivered_at.getDate();

                    var date2 = new Date(Date.UTC(y2, M2, d2));

                    $data.delivered_at = date2;
                }

                $data.status = $scope.form.status;

                $http.post('/com_zeapps_workload/workload/save', $data).then(function (obj) {
                    // pour que la page puisse être redirigé
                    console.log(obj.data);
                    $location.path("/ng/com_zeapps_workload/workload/plan");
                });
            }
        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_workload/workload/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                    $scope.form.amount = parseFloat($scope.form.amount);
                    $scope.form.commission = parseFloat($scope.form.commission);
                    $scope.form.invoiced = parseFloat($scope.form.invoiced);

                    $scope.form.opened_at = new Date($scope.form.opened_at);
                    $scope.form.delivered_at = new Date($scope.form.delivered_at);
                }
            });
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_workload/workload/plan");
        }
    }]);

