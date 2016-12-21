app.controller('FrAbekoArticleComposeListCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_article_compose");


        $scope.articles = [] ;


        var loadList = function () {
            var options = {};
            $http.post('/fr_abeko/articlecompose/getAll', options).then(function (response) {
                if (response.status == 200) {
                    $scope.articles = response.data ;
                }
            });
        };
        loadList() ;



        $scope.duplicate = function(id){
            $http.post('/fr_abeko/articlecompose/duplicate/' + id).then(function (response) {
                if (response.data) {
                    $scope.articles.push(response.data);
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
                        return 'Souhaitez-vous supprimer définitivement cet article ?';
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
                    $http.get('/fr_abeko/articlecompose/delete/' + argIdUser).then(function (response) {
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