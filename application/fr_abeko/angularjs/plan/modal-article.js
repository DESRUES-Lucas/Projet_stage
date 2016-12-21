// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'fr_abeko',
    function_name:'search_article_plan',
    templateUrl:'/fr_abeko/articlecompose/modal_search_article_compose',
    controller:'FrAbekoModalSearchArticleComposePlanCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return 'Recherche d\'un article composé';
        }
    }
});


app.controller('FrAbekoModalSearchArticleComposePlanCtrl', function($scope, $uibModalInstance, $http, titre, option) {
    $scope.titre = titre ;

    $scope.produits_loaded = [];
    $scope.produits = [];


    var optionModal = option ;



    $scope.updateList = function () {
        var tabCodeProduit = [];
        var tabLibelleProduit = [];


        if ($scope.filtre_code_produit && $scope.filtre_code_produit != "") {
            var filtre_code_produit = $scope.filtre_code_produit + "";
            tabCodeProduit = filtre_code_produit.toLowerCase().split(" ") ;
        }


        if ($scope.filtre_libelle && $scope.filtre_libelle != '') {
            var filtre_libelle = $scope.filtre_libelle + "" ;
            tabLibelleProduit = filtre_libelle.toLowerCase().split(" ");
        }


        $scope.produits = [];
        for (var i = 0 ; i < $scope.produits_loaded.length ; i++) {
            var produit_correspond = true ;

            if (tabCodeProduit.length > 0) {
                for (var j = 0 ; j < tabCodeProduit.length ; j++) {
                    if ($scope.produits_loaded[i].ref.toLowerCase().indexOf(tabCodeProduit[j]) < 0) {
                        produit_correspond = false ;
                    }
                }
            }

            if (tabLibelleProduit.length > 0) {
                for (var j = 0 ; j < tabLibelleProduit.length ; j++) {
                    if ($scope.produits_loaded[i].nom.toLowerCase().indexOf(tabLibelleProduit[j]) < 0) {
                        produit_correspond = false ;
                    }
                }
            }

            if (produit_correspond) {
                $scope.produits.push($scope.produits_loaded[i]) ;
            }
        }
    };



    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };



    var loadList = function () {
            $http.get('/fr_abeko/citernetype/getLignesAll/' + optionModal.idCiterneType + '/Y').then(function (response) {
            if (response.status == 200) {
                var dataReturn = response.data ;

                $scope.produits = [] ;
                $scope.produits_loaded = [] ;

                for (var i = 0 ; i < dataReturn.length ; i++) {
                    var tabPoint = dataReturn[i].type_point.split(",") ;
                    if (tabPoint.indexOf(optionModal.type_point) >= 0) {
                        $scope.produits.push(dataReturn[i]) ;
                        $scope.produits_loaded.push(dataReturn[i]) ;
                    }
                }
            }
        });
    };
    loadList() ;


    $scope.returnProduct = function (id_produit) {
        var produit = false ;
        for (var i = 0 ; i < $scope.produits.length ; i++) {
            if ($scope.produits[i].id == id_produit) {
                produit = $scope.produits[i] ;
                break;
            }
        }

        $uibModalInstance.close(produit);
    }

}) ;