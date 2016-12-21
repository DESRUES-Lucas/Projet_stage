app.controller('ComZeappsProjectFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_project", "com_zeapps_projects_list");

        $scope.form = [];

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/com_zeapps_project/project/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                }
            });
        }







        $scope.loadProjectManager = function () {
            zeapps_modal.loadModule("com_zeapps_core", "search_user", {}, function(objReturn) {
                if (objReturn) {
                    $scope.form.id_user_project_manager = objReturn.id;
                    $scope.form.name_user_project_manager = objReturn.firstname + ' ' + objReturn.lastname;
                } else {
                    $scope.form.id_user_project_manager = 0;
                    $scope.form.name_user_project_manager = '';
                }
            });
        };

        $scope.removeProjectManager = function() {
            $scope.form.id_user_project_manager = 0;
            $scope.form.name_user_project_manager = '';
        };








        $scope.loadCompany = function () {
            zeapps_modal.loadModule("com_zeapps_contact", "search_company", {}, function(objReturn) {
                //console.log(objReturn);
                if (objReturn) {
                    $scope.form.id_company = objReturn.id;
                    $scope.form.company_name = objReturn.company_name;
                } else {
                    $scope.form.id_company = 0;
                    $scope.form.company_name = '';
                }
            });
        };

        $scope.removeCompany = function() {
            $scope.form.id_company = 0;
            $scope.form.company_name = '';
        };











        $scope.save = function () {
            var $data = {};

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.id_user_project_manager = $scope.form.id_user_project_manager;
            $data.name_user_project_manager = $scope.form.name_user_project_manager;
            $data.project_name = $scope.form.project_name;
            $data.id_company = $scope.form.id_company;
            $data.company_name = $scope.form.company_name;
            $data.priority = $scope.form.priority;
            $data.status = $scope.form.status;


            $http.post('/com_zeapps_project/project/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/com_zeapps_project/projects");
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_project/projects");
        }

    }]);