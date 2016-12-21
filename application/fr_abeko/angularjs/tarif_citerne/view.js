app.controller('FrAbekoCiterneTarifViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_citerne_tarif");



        $scope.form = [];
        $scope.baches = [];
        $scope.ligne_tarifs = [];




        var loadListTypeBache = function () {
            var options = {};
            $http.post('/fr_abeko/typebache/getAll', options).then(function (response) {
                if (response.status == 200) {
                    $scope.baches = response.data ;
                }
            });
        };
        loadListTypeBache() ;






        var loadListLigneTarif = function (argIdTarif) {
            var options = {};
            $http.post('/fr_abeko/tarifciterne/getLignesAll/' + argIdTarif, options).then(function (response) {
                if (response.status == 200) {
                    $scope.ligne_tarifs = response.data ;

                    for(var i=0; i < $scope.ligne_tarifs.length ; i++) {
                        $scope.ligne_tarifs[i].edit = 'N' ;
                        $scope.ligne_tarifs[i].update = 'N' ;
                        $scope.ligne_tarifs[i].delete = 'N' ;
                    }
                }
            });
        };




        $scope.ajouter_ligne = function() {
            var ligne_tarif = {} ;
            ligne_tarif.id = 0 ;
            ligne_tarif.edit = 'N' ;
            ligne_tarif.update = 'N' ;
            ligne_tarif.delete = 'N' ;

            ligne_tarif.m3 = $scope.m3 ;
            ligne_tarif.largeur = $scope.largeur ;
            ligne_tarif.profondeur = $scope.profondeur ;
            ligne_tarif.tarif = getNumberTxt($scope.tarif) ;

            $scope.ligne_tarifs.push(ligne_tarif) ;

            $scope.m3 = "" ;
            $scope.largeur = "" ;
            $scope.profondeur = "" ;
            $scope.tarif = "" ;
        };


        $scope.editer_ligne = function (ligne) {
            ligne.edit = 'Y' ;
        };

        $scope.valider_ligne = function (ligne) {
            ligne.edit = 'N' ;
            ligne.update = 'Y' ;
        };

        $scope.delete_ligne = function (ligne) {

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
                        return 'Souhaitez-vous supprimer ce tarif ?';
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
                if (selectedItem.action == 'success') {
                    ligne.delete = 'Y' ;
                }

            }, function () {
                //console.log("rien");
            });



        };










        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/fr_abeko/tarifciterne/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;

                    loadListLigneTarif($routeParams.id) ;
                }
            });
        }


        $scope.save = function () {
            var $data = {} ;

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.nom = $scope.form.nom ;
            $data.id_bache = $scope.form.id_bache ;

            $data.ligne_tarifs = $scope.ligne_tarifs ;


            $http.post('/fr_abeko/tarifciterne/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/fr_abeko/citerne_tarif");
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/citerne_tarif");
        }



        var getNumberTxt = function (value) {
            if (isNaN(value) && value && value != null) {
                value = value.replace(",", ".");
            }
            return value ;
        }


    }]);