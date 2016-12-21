app.controller('ComZeappsCrmProductDetailsCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', 'zeapps_productFactory',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zeapps_productFactory) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_crm_product");

        $scope.error = "";

        if($routeParams.id && $routeParams.id > 0) {
            zeapps_productFactory.get.product($routeParams.id).then(function (response) {
                if (response.status == 200) {
                    if (typeof(response.data.error) === 'undefined') {
                        $scope.product = response.data;
                        zeapps_productFactory.get.category($scope.product.category).then(function (response) {
                            if (response.status == 200) {
                                if (typeof(response.data.error) === 'undefined') {
                                    $scope.category = response.data;
                                }
                                else {
                                    $scope.error = response.data.error;
                                }
                            }
                        });
                    }
                    else {
                        $scope.error = response.data.error;
                    }
                }
            });
        }
    }]);