app.controller('FrAbekoPlanFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_plan");


        $scope.fil_arianne = '' ;
        $scope.etape = 1 ;
        $scope.msgErreur = '' ;



        $scope.citernes_types = [] ;
        $scope.tarifs = [] ;
        $scope.tarifs_lignes = [] ;
        $scope.m3 = [] ;
        $scope.dimensions = [] ;


        var listPointActifToSave = '' ;
        var idCiterneToSave = 0 ;
        var idTarifToSave = 0 ;
        var idTarifLigneToSave = 0 ;
        var idBacheToSave = 0 ;
        var nomBacheToSave = '' ;
        var m3ToSave = 0 ;
        var largeurToSave = 0 ;
        var profondeurToSave = 0 ;
        var tarif_htToSave = 0 ;




        // 1) choix du type de citerne
        var loadListCiterneType = function () {
            var options = {};
            $http.post('/fr_abeko/citernetype/getAll', options).then(function (response) {
                if (response.status == 200) {
                    $scope.citernes_types = response.data ;
                }
            });
        };
        loadListCiterneType() ;

        $scope.choix_citerne = function(idCiterne) {
            idCiterneToSave = idCiterne ;

            for(var i = 0 ; i < $scope.citernes_types.length ; i++) {
                if ($scope.citernes_types[i].id == idCiterne) {
                    $scope.fil_arianne = $scope.citernes_types[i].nom ;
                    $scope.etape = 2 ;

                    listPointActifToSave = $scope.citernes_types[i].liste_point_actif ;
                    
                    loadListTarif($scope.citernes_types[i].tarif_applicable) ;
                    break;
                }
            }
        };






        // 2) choix du tarif
        var loadListTarif = function (listIdTarif) {
            if (listIdTarif != '') {
                $http.get('/fr_abeko/tarifciterne/get_by_id_tarif/' + listIdTarif).then(function (response) {
                    if (response.status == 200) {
                         console.log(response.data);
                        $scope.tarifs = response.data;
                    }
                });
            } else {
                $scope.etape = 99 ;
                $scope.msgErreur = 'Aucun tarif pour ce type de citerne' ;
            }
        };

        $scope.choix_tarif = function(idTarif) {
            idTarifToSave = idTarif ;

            for(var i = 0 ; i < $scope.tarifs.length ; i++) {
                if ($scope.tarifs[i].id == idTarif) {
                    $scope.fil_arianne += " > " + $scope.tarifs[i].nom ;
                    $scope.etape = 3 ;

                    idBacheToSave = $scope.tarifs[i].id_bache ;
                    nomBacheToSave = $scope.tarifs[i].nom ;

                    loadListTarifM3(idTarif) ;
                    break;
                }
            }
        };





        // 3) choix du nombre de m3
        var loadListTarifM3 = function (idTarif) {
            $http.get('/fr_abeko/tarifciterne/getLignesAll/' + idTarif).then(function (response) {
                if (response.status == 200) {
                    $scope.tarifs_lignes = response.data;
                    $scope.m3 = [] ;

                    if ($scope.tarifs_lignes.length) {
                        for (var i = 0 ; i < $scope.tarifs_lignes.length ; i++) {
                            if ($scope.m3.indexOf($scope.tarifs_lignes[i].m3) < 0) {
                                $scope.m3.push($scope.tarifs_lignes[i].m3) ;
                            }
                        }
                    } else {
                        $scope.etape = 99 ;
                        $scope.msgErreur = 'Aucun volume défini pour ce tarif' ;
                    }
                }
            });
        };

        $scope.choix_volume = function(volume) {
            $scope.fil_arianne += " > " + volume + " m3" ;
            $scope.etape = 4 ;

            $scope.dimensions = [] ;

            m3ToSave = volume ;

            for (var i = 0 ; i < $scope.tarifs_lignes.length ; i++) {
                if ($scope.tarifs_lignes[i].m3 == volume) {
                    $scope.dimensions.push($scope.tarifs_lignes[i]) ;
                }
            }
        };



        $scope.choix_dimension = function (idTarifLigne) {
            idTarifLigneToSave = idTarifLigne ;
            for (var i = 0 ; i < $scope.tarifs_lignes.length ; i++) {
                if ($scope.tarifs_lignes[i].id == idTarifLigne) {
                    $scope.etape = 5 ;
                    $scope.fil_arianne += " > " + $scope.tarifs_lignes[i].largeur + " x " + $scope.tarifs_lignes[i].profondeur ;

                    largeurToSave = $scope.tarifs_lignes[i].largeur ;
                    profondeurToSave = $scope.tarifs_lignes[i].profondeur ;
                }
            }
        };



        $scope.enregistrer = function () {
            var $data = {} ;

            $data.nom = $scope.form.nom ;
            $data.id_citerne_type = idCiterneToSave ;
            $data.id_tarif_applicable = idTarifToSave ;
            $data.id_tarif_applicable_ligne = idTarifLigneToSave ;
            $data.liste_point_actif = listPointActifToSave ;
            $data.m3 = m3ToSave ;
            $data.largeur = largeurToSave ;
            $data.profondeur = profondeurToSave ;
            $data.tarif_ht = tarif_htToSave ;
            $data.id_bache = idBacheToSave ;
            $data.nom_bache = nomBacheToSave ;

            $http.post('/fr_abeko/plan/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/fr_abeko/plan/view/" + obj.data);
            });
        };



    }]);