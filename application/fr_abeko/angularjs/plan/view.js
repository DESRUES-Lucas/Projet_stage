app.controller('FrAbekoPlanViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$q', '$uibModal', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $q, $uibModal, zeapps_modal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_plan");


        $scope.addingPosition = false;
        $scope.deletingPosition = false;

        $scope.form = [];
        $scope.tarifs = [];

        $scope.newPosition = {
            type_position: '',
            position: {}
        };

        $scope.options = {
            axes: false,
            dimensions: false,
            dimensionsType: {
                citern: true,
                flanc: true,
                fond: true,
                tropPlein: true,
                event: true
            },
            enroulement: false,
            enroulementDirection: 1,
            marquage: false,
            marquagePosition: 'top',
            all: false,
            only_active: false
        };


        var loadPlan = function(){
            $http.get('/fr_abeko/plan/get/' + $routeParams.id).then(function (response) {
                if (response.data && response.data != "false") {
                    $scope.form = response.data;
                    $scope.options.largeur = response.data.largeur;
                    $scope.options.profondeur = response.data.profondeur;
                    $scope.options.marquagePosition = response.data.marquage;
                    $scope.options.enroulementDirection = response.data.enroulement;
                }
            });
        };
        var loadPositions = function(){
            $scope.positions = {
                flanc : [],
                fond : [],
                tropPlein : [],
                event : []
            };
            $http.get('/fr_abeko/plan/getPositions/' + $routeParams.id).then(function(response){
                if(response.data && response.data != "false"){
                    for(var i = 0; i < response.data.length; i++){
                        $scope.positions[response.data[i].type_position].push(response.data[i]);
                    }
                }
            });
        };
        var loadProduits = function(){
            $scope.produits = [];
            $scope.accessoires = [];
            $http.get('/fr_abeko/plan/getProduits/' + $routeParams.id).then(function(response){
                if(response.data && response.data != "false"){
                    for(var i = 0; i < response.data.length; i++){
                        if(response.data[i].id_position == 0){
                            $scope.accessoires.push(response.data[i]);
                        }
                        else{
                            $scope.produits.push(response.data[i]);
                        }
                    }
                }
            });
        };
        var init = function(){
            // charge la fiche
            if ($routeParams.id && $routeParams.id != 0) {
                loadPlan();
                loadPositions();
                loadProduits();
            } else {
                $location.path("/ng/fr_abeko/plan");
            }
        };
        init();

        $scope.toggleAdd = function(){
            $scope.addingPosition = !$scope.addingPosition;
        };

        $scope.toggleDelete = function(){
            $scope.deletingPosition = !$scope.deletingPosition;
        };

        $scope.showTropPleinOption = function(side){
            if($scope.newPosition.type_position == 'tropPlein') {
                if ($scope.options.profondeur && $scope.options.largeur) {
                    var halfwayProfondeur = ( parseFloat($scope.options.profondeur).toFixed(3) * 1000 ) / 2;
                    for (var i = 0; i < $scope.positions.tropPlein.length; i++) {
                        if (side == 'gauche' && parseInt($scope.positions.tropPlein[i].x) < halfwayProfondeur)
                            return false;
                        else if (side == 'droite' && parseInt($scope.positions.tropPlein[i].x) > halfwayProfondeur)
                            return false;
                    }
                }
                return true;
            }
            return false;
        };

        $scope.add = function(toggle){
            if($scope.newPosition.type_position != '') {
                var position = {
                    id_plan: $routeParams.id,
                    type_position: $scope.newPosition.type_position
                };

                var largeur = parseFloat($scope.options.largeur).toFixed(3) * 1000;
                var profondeur = parseFloat($scope.options.profondeur).toFixed(3) * 1000;

                if (position.type_position == 'event') {
                    position.x = parseInt(profondeur / 2);
                    position.y = parseInt(largeur / 2);
                }
                else if (position.type_position == 'tropPlein') {
                    position.y = parseInt(largeur / 2);

                    var offset = (parseFloat($scope.options.profondeur) / 6).toFixed(2);

                    if (offset > 1.6) {
                        offset = 1.80;
                    }
                    else {
                        offset[2] = offset[3] > 7 ? offset[2] + 1 : offset[2];
                        offset[3] = offset[3] > 7 ? 0 : ( offset[3] < 3 ? 0 : 5);
                    }

                    offset = parseFloat(offset).toFixed(3) * 1000;

                    if ($scope.newPosition.position.tropPlein == "droite")
                        position.x = profondeur - offset;
                    else
                        position.x = offset;
                }
                else if (position.type_position == 'flanc') {
                    if ($scope.newPosition.position.flanc == 'haut') {
                        position.x = 1500;
                        position.y = 0;
                    }
                    else if ($scope.newPosition.position.flanc == 'droite') {
                        position.x = profondeur;
                        position.y = 1500;
                    }
                    else if ($scope.newPosition.position.flanc == 'bas') {
                        position.x = 1500;
                        position.y = largeur;
                    }
                    else if ($scope.newPosition.position.flanc == 'gauche') {
                        position.x = 0;
                        position.y = 1500;
                    }
                }
                else {
                    position.x = 1500;
                    position.y = 1500;
                }

                var formatted_data = angular.toJson(position);
                $http.post('/fr_abeko/plan/addPosition/', formatted_data).then(function(response){
                    if(response.data && response.data != 'false'){
                        position.id = response.data;
                        $scope.positions[position.type_position].push(position);
                    }
                });

                if (toggle)
                    $scope.toggleAdd();

                $scope.newPosition = {
                    type_position: '',
                    position: {}
                };
            }
        };

        $scope.del = function(position){
            var defer = $q.defer();
            $http.get('/fr_abeko/plan/delPosition/' + position.id).then(function(response){
                if(response.data && response.data != 'false') {
                    angular.forEach($scope.positions, function (positionArr, type_position) {
                        if (positionArr.indexOf(position) > -1) {
                            if (positionArr.length > 1)
                                positionArr.splice(positionArr.indexOf(position), 1);
                            else
                                $scope.positions[type_position] = [];
                            for (var i = 0; i < $scope.produits.length; i++) {
                                if ($scope.produits[i].id_position == position.id) {
                                    $scope.produits.splice(i, 1);
                                }
                            }
                        }
                    });
                    defer.resolve();
                }
                else{
                    defer.reject();
                }
            });
            return defer.promise;
        };

        $scope.updatePositions = function(){

            var data = {
                positions: {}
            };

            data.positions = angular.toJson($scope.positions);
            data.positions = angular.fromJson(data.positions);

            angular.forEach(data.positions, function(positionArr){
                for(var i=0; i<positionArr.length; i++){
                    delete positionArr[i].coordinates;
                }
            });

            var formatted_data = angular.toJson(data);
            $http.post('/fr_abeko/plan/updatePosition/', formatted_data);
        };

        $scope.findPosition = function(produit){
            var position = '';
            var type = {
                flanc: 'Fl',
                fond: 'Fo',
                tropPlein: 'TP',
                event: 'Ev'
            };
            angular.forEach($scope.positions, function(positionArr, type_position){
                for(var i=0; i<positionArr.length; i++){
                    if(positionArr[i].id == produit.id_position){
                        position = type[type_position] + '.' + i;
                    }
                }
            });
            return position;
        };

        $scope.ajoutProduit = function(idPosition, type_position) {
            // charge la modal de la liste de produit
            zeapps_modal.loadModule("fr_abeko", "search_article_plan", {type_point:type_position, idCiterneType:$scope.form.id_citerne_type}, function(objReturn) {
                if (objReturn) {

                    var produit = {};

                    produit.id_plan = $routeParams.id;
                    produit.id_article_compose = objReturn.id ;
                    produit.type_position = type_position;
                    produit.id_position = idPosition;
                    produit.article = objReturn;

                    var data = {};

                    data.id_article_compose = produit.id_article_compose;
                    data.id_plan = produit.id_plan;
                    data.id_position = produit.id_position;

                    var formatted_data = angular.toJson(data);
                    $http.post('/fr_abeko/plan/addProduit/', formatted_data).then(function(response){
                        if(response.data && response.data != 'false'){
                            produit.id = response.data;
                            $scope.produits.push(produit);
                        }
                    });
                }
            });
        };

        $scope.deleteProduit = function(produit, arr) {
            $http.get('/fr_abeko/plan/delProduit/' + produit.id).then(function(response){
                console.log(response.data);
                if(response.data && response.data != 'false'){
                    if(arr == 'produit') {
                        $scope.produits.splice($scope.produits.indexOf(produit), 1);
                    }
                    else if(arr == 'accessoire') {
                        $scope.accessoires.splice($scope.accessoires.indexOf(produit), 1);
                    }
                }
            });
        };

        $scope.pdf = function () {
            // sauvegarde du plan avant de générer le PDF

            var data = {} ;

            if ($routeParams.id != 0) {
                data.id = $routeParams.id;
            }

            data.nom = $scope.form.nom ;
            data.enroulement = $scope.options.enroulementDirection ;
            data.marquage = $scope.options.marquagePosition ;

            var formatted_data = angular.toJson(data);


            $http.post('/fr_abeko/plan/save', formatted_data).then(function (response) {
                if(response.data && response.data != 'false') {

                    var plan = $("#plan");

                    plan.css("width", "700px");
                    plan.css("height", "500px");

                    var data = {};

                    var canvas = document.getElementById("plan");
                    data.form = $scope.form;
                    data.img = canvas.toDataURL("image/png");
                    data.produits = $scope.produits;
                    plan.css("width", "100%");
                    plan.css("height", "500px");


                    $http.post('/fr_abeko/plan/savePDF', data).then(function (response) {
                        if (response.data && response.data != 'false') {
                            window.document.location.href = '/fr_abeko/plan/downloadPDF';
                        }
                    });
                }

            });

        };

        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/plan");
        }

    }]);