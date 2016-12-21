app.controller('ComZeappsCrmProductFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_modal', 'zeapps_productFactory',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal, zeapps_productFactory) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_crm_product");

        $scope.activeCategory = {
            data: ''
        };

        $scope.tree = {
            branches: []
        };

        $scope.form = [];

        $scope.error = '';

        $scope.max_length = {
            desc_short: 140,
            desc_long: 1000
        };

        if ($routeParams.id && $routeParams.id > 0) {
            zeapps_productFactory.get.tree().then(function (response) {
                if (response.status == 200) {
                    $scope.tree.branches = response.data;
                    zeapps_productFactory.get.product($routeParams.id).then(function (response) {
                        if (response.status == 200) {
                            $scope.form = response.data;
                            $scope.form.price = parseFloat($scope.form.price);
                            zeapps_productFactory.openTree($scope.tree, $scope.form.category);
                            zeapps_productFactory.get.category($scope.form.category).then(function (response) {
                                if (response.status == 200) {
                                    $scope.activeCategory.data = response.data;
                                }
                            });
                        }
                    });
                }
            });
        }

        if ($routeParams.category) {
            zeapps_productFactory.get.tree().then(function (response) {
                if (response.status == 200) {
                    $scope.tree.branches = response.data;
                    zeapps_productFactory.openTree($scope.tree, $routeParams.category);
                    zeapps_productFactory.get.category($routeParams.category).then(function (response) {
                        if (response.status == 200) {
                            $scope.activeCategory.data = response.data;
                        }
                    });
                }
            });
        }

        if ($routeParams.id_delete) {
            zeapps_productFactory.get.tree().then(function (response) {
                if (response.status == 200) {
                    $scope.tree.branches = response.data;
                    zeapps_productFactory.get.product($routeParams.id_delete).then(function (response) {
                        if (response.status == 200) {
                            $scope.form = response.data;
                            $scope.form.price = parseFloat($scope.form.price);
                            zeapps_productFactory.openTree($scope.tree, $scope.form.category);
                            zeapps_productFactory.get.category($scope.form.category).then(function (response) {
                                if (response.status == 200) {
                                    $scope.activeCategory.data = response.data;
                                    $scope.delete($routeParams.id_delete);
                                }
                            });
                        }
                    });
                }
            });
        }

        $scope.$watch('activeCategory.data', function(value, old, scope){
            if(typeof(value.id) !== 'undefined'){
                scope.form.category = value.id;
            }
        });

        $scope.descState = function(current, max){
            if(current > max)
                return 'text-danger';
            else if(current > Math.ceil(max*0.9) && current < max)
                return 'text-warning';
            else
                return 'text-success';

        };

        $scope.delete = function (id) {
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
                        return 'Souhaitez-vous supprimer définitivement ce produit ?';
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
                    zeapps_productFactory.delete.product(id).then(function (response) {
                        if (response.status == 200) {
                            // pour que la page puisse être redirigé
                            if ($routeParams.url_retour) {
                                $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
                            } else {
                                $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.category);
                            }
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };

        $scope.save = function () {
            var data = {};

            if ($routeParams.id != 0) {
                data.id = $routeParams.id;
            }

            data.name = $scope.form.name;
            data.category = $scope.form.category;
            data.desc_short = $scope.form.desc_short;
            data.price = $scope.form.price;
            data.taxe = $scope.form.taxe;
            data.account = $scope.form.account;
            data.desc_long = $scope.form.desc_long;

            zeapps_productFactory.save.product(data).then(function (response) {
                if(typeof(response.data.error) === 'undefined') {
                    // pour que la page puisse être redirigé
                    if ($routeParams.url_retour) {
                        $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
                    } else {
                        $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.category);
                    }
                }
                else{
                    $scope.error = response.data.error;
                }
            });
        };

        $scope.cancel = function () {
            if ($routeParams.url_retour) {
                $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp,"/"));
            } else {
                $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.category);
            }
        };
    }]);