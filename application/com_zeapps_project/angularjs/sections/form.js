app.controller('ComZeappsSectionFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_project", "com_zeapps_projects");

        $scope.form = [];

        // load the project
        if ($routeParams.id_project && $routeParams.id_project != 0) {
            $http.get('/com_zeapps_project/project/get/' + $routeParams.id_project).then(function (response) {
                if (response.status == 200) {
                    $scope.project = response.data;
                }
            });
        }



        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_project/section/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                }
            });
        }





        $scope.save = function () {
            var $data = {};

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.id_project = $routeParams.id_project;
            $data.name = $scope.form.name;


            $http.post('/com_zeapps_project/section/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/com_zeapps_project/project/view/" + $routeParams.id_project);
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_project/project/view/" + $routeParams.id_project);
        }

    }]);