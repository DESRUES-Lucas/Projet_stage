app.controller('FrAbekoLogoSearchCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal, zeapps_modal) {

        var loadList = function () {
            var options = {};
            $http.post('/fr_abeko/logo/getAll', options).then(function (response) {

                if (response.status == 200) {
                    $scope.logos = response.data ;
                }
            });
        };
        loadList() ;



        $scope.delete = function (logoId) {
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
                        return 'Souhaitez-vous supprimer définitivement ce contact ?';
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
                    $http.get('/fr_abeko/logo/delete/' + logoId).then(function (response) {
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