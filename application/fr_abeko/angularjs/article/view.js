app.controller('FrAbekoArticleViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_article");

        $scope.form = [];





        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/fr_abeko/article/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                }
            });
        }


        $scope.save = function () {
            var $data = {} ;

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.reference = $scope.form.reference ;
            $data.reference_fournisseur = $scope.form.reference_fournisseur ;
            $data.libelle = $scope.form.libelle ;
            $data.descriptif = $scope.form.descriptif ;
            $data.id_fournisseur = $scope.form.id_fournisseur ;
            $data.nom_fournisseur = $scope.form.nom_fournisseur ;
            $data.prix_achat_ht = getNumberTxt($scope.form.prix_achat_ht) ;

            $data.produits = $scope.produits ;


            $http.post('/fr_abeko/article/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/fr_abeko/article");
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/article");
        }




        var getNumberTxt = function (value) {
            if (isNaN(value) && value && value != null) {
                value = value.replace(",", ".");
            }
            return value ;
        }

    }]);