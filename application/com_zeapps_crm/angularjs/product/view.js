app.controller('ComZeappsCrmProductViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', 'zeapps_productFactory',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, zeapps_productFactory) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_crm_product");

        $scope.activeCategory = {
            data: ''
        };

        $scope.tree = {
            branches: []
        };

        $scope.quicksearch = "";

        $scope.products;

        zeapps_productFactory.get.tree().then(function (response) {
            if (response.status == 200) {
                var id = $routeParams.id || 0;
                $scope.tree.branches = response.data;
                zeapps_productFactory.openTree($scope.tree, id);
                zeapps_productFactory.get.category(id).then(function (response) {
                    if (response.status == 200) {
                        $scope.activeCategory.data = response.data;
                    }
                });
            }
        });

        $scope.sortableOptions = {
            stop: function(event, ui){
                var data = {
                    categories: []
                };
                for(var i=0; i < $scope.activeCategory.data.branches.length; i++){
                    $scope.activeCategory.data.branches[i].sort = i;
                    data.categories[i] = $scope.activeCategory.data.branches[i];
                }
                zeapps_productFactory.update.category_order(data).then(function(response){
                    if (response.status != 200) {
                        alert('There was an error when trying to access the Server, please try again ! If the problem persists contact the administrator of this website.');
                    }
                });
            }
        };

        $scope.$watch('activeCategory.data', function(value, old, scope){
            if(typeof(value.id) !== 'undefined'){
                zeapps_productFactory.get.products_of(value.id).then(function (response) {
                    if (response.status == 200) {
                        if(!angular.isArray(response.data)){
                            if(response.data != "false") {
                                scope.products = new Array(response.data);
                            }
                            else
                                scope.products = new Array();
                        }
                        else{
                            scope.products = response.data;
                        }
                    }
                });
            }
        });
    }]);