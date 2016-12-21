app.controller('FrAbekoCiterneTarifListCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_citerne_tarif");

        $scope.tarifs = [] ;


        var loadList = function () {
            var options = {};
            $http.post('/fr_abeko/tarifciterne/getAll', options).then(function (response) {
                if (response.status == 200) {
                    $scope.tarifs = response.data ;
                }
            });
        };
        loadList() ;



        $scope.duplicate = function(tarifId){
            $http.post('/fr_abeko/tarifciterne/duplicate/' + tarifId).then(function (response) {
                if (response.data) {
                    $scope.tarifs.push(response.data);
                }
            });
        };

        $scope.delete = function (argIdUser) {
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
                        return 'Souhaitez-vous supprimer définitivement ce tarif ?';
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
                    $http.get('/fr_abeko/tarifciterne/delete/' + argIdUser).then(function (response) {
                        if (response.status == 200) {
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };

    }]);