app.controller('ComZeappsCrmProductFormCategoryCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_productFactory',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_productFactory) {

        $scope.$parent.loadMenu("com_ze_apps_sales", "com_zeapps_crm_product");

        $scope.activeCategory = {
            data: ''
        };

        $scope.tree = {
            branches: []
        };

        $scope.form = [];

        $scope.error = '';

        if ($routeParams.id && $routeParams.id > 0) {
            zeapps_productFactory.get.tree().then(function (response) {
                if (response.status == 200) {
                    $scope.tree.branches = response.data;
                    zeapps_productFactory.get.category($routeParams.id).then(function (response) {
                        if (response.status == 200) {
                            $scope.form = response.data;
                            zeapps_productFactory.get.category($scope.form.id_parent).then(function (response) {
                                if (response.status == 200) {
                                    $scope.activeCategory.data = response.data;
                                    zeapps_productFactory.openTree($scope.tree, $scope.activeCategory.data.id);
                                }
                            });
                        }
                    });
                }
            });
        }

        if($routeParams.id_parent && $routeParams.id_parent >= 0){
            zeapps_productFactory.get.tree().then(function (response) {
                if (response.status == 200) {
                    $scope.tree.branches = response.data;
                    zeapps_productFactory.openTree($scope.tree, $routeParams.id_parent);
                    zeapps_productFactory.get.category($routeParams.id_parent).then(function (response) {
                        if (response.status == 200) {
                            $scope.activeCategory.data = response.data;
                        }
                    });
                }
            });
        }

        if ($routeParams.id_delete && $routeParams.id_delete > 0) {
            zeapps_productFactory.get.tree().then(function (response) {
                if (response.status == 200) {
                    $scope.tree.branches = response.data;
                    zeapps_productFactory.get.category($routeParams.id_delete).then(function (response) {
                        if (response.status == 200) {
                            $scope.form = response.data;
                            zeapps_productFactory.get.category($scope.form.id_parent).then(function (response) {
                                if (response.status == 200) {
                                    $scope.activeCategory.data = response.data;
                                    zeapps_productFactory.openTree($scope.tree, $scope.activeCategory.data.id);
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
                scope.form.id_parent = value.id;
            }
        });

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
                        return 'Souhaitez-vous supprimer définitivement cette catégorie ?';
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
                    zeapps_productFactory.delete.category(id).then(function (response) {
                        if (response.status == 200) {
                            if(typeof(response.data.error) === 'undefined'){
                                if(response.data.hasProducts){
                                    $scope.force_delete(id);
                                }
                            }
                            else{
                                $scope.error = response.data.error;
                            }
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };

        $scope.force_delete = function (id) {
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
                        return 'La catégorie ou l\'une de ses sous-catégories possedent toujours des produits. Si vous confirmez la suppresion les produits seront archivés.';
                    },
                    action_danger: function () {
                        return 'Annuler';
                    },
                    action_primary: function () {
                        return 'Archiver les produits & supprimer la catégorie';
                    },
                    action_success: function () {
                        return 'Supprimer les produits & supprimer la catégorie';
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'primary') {
                    zeapps_productFactory.safe_delete.category(id).then(function (response) {
                        if (response.status == 200) {
                            if(typeof(response.data.error) === 'undefined'){
                                // pour que la page puisse être redirigé
                                if ($routeParams.url_retour) {
                                    $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
                                } else {
                                    $location.path("/ng/com_zeapps_crm/product/");
                                }
                            }
                            else{
                                $scope.error = response.data.error;
                            }
                        }
                    });
                } else if (selectedItem.action == 'success') {
                    zeapps_productFactory.force_delete.category(id).then(function (response) {
                        if (response.status == 200) {
                            if(typeof(response.data.error) === 'undefined'){
                                // pour que la page puisse être redirigé
                                if ($routeParams.url_retour) {
                                    $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
                                } else {
                                    $location.path("/ng/com_zeapps_crm/product/");
                                }
                            }
                            else{
                                $scope.error = response.data.error;
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
            data.id_parent = $scope.form.id_parent;

            zeapps_productFactory.save.category(data).then(function (response) {
                if(typeof(response.data.error) === 'undefined') {
                    // pour que la page puisse être redirigé
                    if ($routeParams.url_retour) {
                        $location.path($routeParams.url_retour.replace(charSepUrlSlashRegExp, "/"));
                    } else {
                        $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.id_parent);
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
                $location.path("/ng/com_zeapps_crm/product/category/" + $scope.form.id_parent);
            }
        };

    }]);