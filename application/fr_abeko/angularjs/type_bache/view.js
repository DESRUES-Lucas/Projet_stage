app.controller('FrAbekoTypeBacheViewCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_type_bache");



        $scope.form = [];

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/fr_abeko/typebache/get/' + $routeParams.id).then(function (response) {
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

            $data.nom = $scope.form.nom ;


            $http.post('/fr_abeko/typebache/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/fr_abeko/type_bache");
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/type_bache");
        }

    }]);