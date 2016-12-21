app.controller('FrAbekoArticleComposeViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_article_compose");

        $scope.form = [];
        $scope.produits = [];
        $scope.total_brut = 0 ;
        $scope.total_avec_marge = 0 ;






        var loadListListProduit = function (argIdArticle) {
            var options = {};
            $http.post('/fr_abeko/articlecompose/getLignesAll/' + argIdArticle, options).then(function (response) {
                if (response.status == 200) {
                    $scope.produits = response.data ;


                    for(var i=0; i < $scope.produits.length ; i++) {
                        $scope.produits[i].editer = 'N' ;
                        $scope.produits[i].update = 'N' ;
                        $scope.produits[i].delete = 'N' ;
                    }

                    updateTarif() ;
                }
            });
        };


        $scope.ajouter_ligne = function() {
            // charge la modal de la liste de produit
            zeapps_modal.loadModule("fr_abeko", "search_article", {}, function(objReturn) {
                //console.log(objReturn);
                if (objReturn) {
                    objReturn.editer = 'N' ;
                    objReturn.update = 'N' ;
                    objReturn.delete = 'N' ;

                    objReturn.id_produit = objReturn.id ;
                    objReturn.id = 0 ;
                    objReturn.quantite = 1 ;

                    $scope.produits.push(objReturn) ;

                    updateTarif() ;
                }
            });
        };


        $scope.editer_ligne = function(produit) {
            produit.editer = 'Y' ;
        };

        $scope.valider_ligne = function(produit) {
            produit.editer = 'N' ;
            produit.update = 'Y' ;

            updateTarif() ;
        };

        $scope.delete_ligne = function(produit) {
            produit.delete = 'Y' ;

            updateTarif() ;
        };
        
        




        var updateTarif = function() {
            $scope.total_brut = 0 ;
            $scope.total_avec_marge = 0 ;


            var tarif = 0 ;
            for(var i=0; i < $scope.produits.length ; i++) {
                if ($scope.produits[i].delete == 'N') {
                    var tarif_achat = getNumberTxt($scope.produits[i].prix_achat_ht) * 1 ;
                    var quantite = getNumberTxt($scope.produits[i].quantite) * 1 ;
                    tarif += (tarif_achat * quantite) ;
                }
            }

            $scope.total_brut = arrondi2Chiffres(tarif) ;


            var coef = getNumberTxt($scope.form.coef_marge) ;
            if (coef != 0) {
                tarif = tarif * coef ;
            }

            tarif = arrondi2Chiffres(tarif) ;
            $scope.total_avec_marge = tarif ;




            if ($scope.form.calcul_auto_prix == 'Y') {
                $scope.form.prix_ht = tarif ;
            }
        };















        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/fr_abeko/articlecompose/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;

                    loadListListProduit($routeParams.id) ;
                }
            });
        }


        $scope.save = function () {
            updateTarif() ;

            var $data = {} ;

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.ref = $scope.form.ref ;
            $data.nom = $scope.form.nom ;
            $data.descriptif = $scope.form.descriptif ;
            $data.prix_ht = getNumberTxt($scope.form.prix_ht) ;
            $data.calcul_auto_prix = $scope.form.calcul_auto_prix ;
            $data.coef_marge = getNumberTxt($scope.form.coef_marge) ;

            $data.produits = $scope.produits ;

            $http.post('/fr_abeko/articlecompose/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/fr_abeko/article_compose");
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/article_compose");
        }



        var getNumberTxt = function (value) {
            if (isNaN(value) && value && value != null) {
                value = value.replace(",", ".");
            }
            return value ;
        }

        var arrondi3Chiffres = function (value) {
            return Math.round(value*1000)/1000;
        }
        var arrondi2Chiffres = function (value) {
            return Math.round(value*100)/100;
        }

    }]);