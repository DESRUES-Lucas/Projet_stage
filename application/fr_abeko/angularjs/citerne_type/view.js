app.controller('FrAbekoCiterneTypeViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_citerne_type");



        $scope.form = [];
        $scope.tarifs = [];
        $scope.produits = [];

        $scope.type_position = [] ;
        $scope.type_position.push('evacuation') ;
        $scope.type_position.push('aspiration') ;
        $scope.type_position.push('trop-plein') ;
        $scope.type_position.push('event') ;



        var loadListTarif = function () {
            var options = {};
            $http.post('/fr_abeko/tarifciterne/getAll', options).then(function (response) {
                if (response.status != 200) {
                } else {
                    $scope.tarifs = response.data;

                    if ($scope.form.tarif_applicable && $scope.form.tarif_applicable != "") {
                        var tabTarifApplicable = ($scope.form.tarif_applicable + "").split(",");

                        for (var i = 0 ; i < tabTarifApplicable.length ; i++) {
                            var value = tabTarifApplicable[i].trim() ;

                            for (var j = 0 ; j < $scope.tarifs.length ; j++) {
                                if ($scope.tarifs[j].id == value) {
                                    $scope.tarifs[j].value = 'Y' ;
                                }
                            }
                        }
                    }
                }
            });
        };



        var loadListListProduit = function (argIdCiterne) {
            var options = {};
            $http.post('/fr_abeko/citernetype/getLignesAll/' + argIdCiterne, options).then(function (response) {
                if (response.status == 200) {
                    $scope.produits = response.data ;


                    for (var i_produit = 0 ; i_produit < $scope.produits.length ; i_produit++) {
                        var tab_type_point = $scope.produits[i_produit].type_point.split(",") ;
                        $scope.produits[i_produit].type_point_form = {};

                        for (var i = 0; i < $scope.type_position.length; i++) {
                            $scope.produits[i_produit].type_point_form[$scope.type_position[i]] = false;

                            for (var i_point = 0; i_point < tab_type_point.length; i_point++) {
                                if (tab_type_point[i_point] == $scope.type_position[i]) {
                                    $scope.produits[i_produit].type_point_form[$scope.type_position[i]] = true;
                                }
                            }
                        }
                    }


                    for(var i=0; i < $scope.produits.length ; i++) {
                        $scope.produits[i].editer = 'N' ;
                        $scope.produits[i].update = 'N' ;
                        $scope.produits[i].delete = 'N' ;
                    }
                }
            });
        };

        $scope.ajouter_ligne = function() {
            // charge la modal de la liste de produit
            zeapps_modal.loadModule("fr_abeko", "search_article_compose", {}, function(objReturn) {
                if (objReturn) {
                    objReturn.editer = 'N' ;
                    objReturn.update = 'N' ;
                    objReturn.delete = 'N' ;


                    objReturn.id_article_compose = objReturn.id ;
                    objReturn.id = 0 ;


                    objReturn.type_point_form = {};
                    for (var i = 0; i < $scope.type_position.length; i++) {
                        objReturn.type_point_form[$scope.type_position[i]] = false;
                    }

                    $scope.produits.push(objReturn) ;
                }
            });
        };


        var updateListPosition = function () {
            // génère la liste des types de position
            for (var i_produit = 0 ; i_produit < $scope.produits.length ; i_produit++) {
                $scope.produits[i_produit].type_point = "" ;

                for (var i = 0; i < $scope.type_position.length; i++) {
                    if ($scope.produits[i_produit].type_point_form[$scope.type_position[i]]) {
                        if ($scope.produits[i_produit].type_point != '') {
                            $scope.produits[i_produit].type_point += "," ;
                        }
                        $scope.produits[i_produit].type_point += $scope.type_position[i] ;
                    }
                }
            }
        };

        $scope.editer_ligne = function(produit) {
            produit.editer = 'Y' ;
        };

        $scope.valider_ligne = function(produit) {
            produit.editer = 'N' ;
            produit.update = 'Y' ;
            updateListPosition() ;
        };

        $scope.delete_ligne = function(produit) {
            produit.delete = 'Y' ;
        };








        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/fr_abeko/citernetype/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;

                    loadListTarif() ;

                    loadListListProduit($routeParams.id) ;
                }
            });
        } else {
            loadListTarif() ;
        }


        $scope.save = function () {
            var $data = {} ;

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.nom = $scope.form.nom ;


            $data.tarif_applicable = "" ;
            for (var j = 0 ; j < $scope.tarifs.length ; j++) {
                if ($scope.tarifs[j].value == 'Y') {
                    if ($data.tarif_applicable != '') {
                        $data.tarif_applicable += ',' ;
                    }
                    $data.tarif_applicable += $scope.tarifs[j].id ;
                }
            }

            for (var i = 0 ; i < $scope.produits.length ; i++) {
                if ($scope.produits[i].editer == 'Y') {
                    $scope.valider_ligne($scope.produits[i]);
                }
            }

            $data.liste_point_actif = "" ;


            $data.produits = $scope.produits ;


            $http.post('/fr_abeko/citernetype/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/fr_abeko/citerne_type");
            });
        };

        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/citerne_type");
        };

    }]);