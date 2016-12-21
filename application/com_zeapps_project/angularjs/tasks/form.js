app.controller('ComZeappsProjectTaskFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {

        $scope.$parent.loadMenu("com_ze_apps_project", "com_zeapps_projects_list");

        $scope.form = [];
        $scope.form.due_date = null;
        $scope.section = false ;




        $scope.format = 'dd/MM/yyyy' ;
        $scope.popup2 = {
            opened: false
        };

        $scope.dateOptions = {
            dateDisabled: disabled,
            formatYear: 'yy',
            startingDay: 1
        };


        // Disable weekend selection
        function disabled(data) {
            var date = data.date,
                mode = data.mode;
            return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
        }

        $scope.open2 = function() {
            $scope.popup2.opened = true;
        };






        // load the project
        var loadDataProject = function () {
            if ($routeParams.id_project && $routeParams.id_project != 0) {
                $http.get('/com_zeapps_project/project/get/' + $routeParams.id_project).then(function (response) {
                    if (response.status == 200) {
                        $scope.project = response.data;
                        loadDataSection();
                    }
                });
            } else {
                loadDataSection();
            }
        }






        // load the section
        var loadDataSection = function() {
            if ($routeParams.id_section && $routeParams.id_section != 0) {
                $http.get('/com_zeapps_project/section/get/' + $routeParams.id_section).then(function (response) {
                    if (response.status == 200) {
                        $scope.section = response.data;

                        $scope.form.id_section = $scope.section.id;
                        $scope.form.section_name = $scope.section.name;
                    }
                });
            }
        }









        // charge la fiche
        var loadDataTask = function() {
            if ($routeParams.id && $routeParams.id != 0) {
                $http.get('/com_zeapps_project/task/get/' + $routeParams.id).then(function (response) {
                    if (response.status == 200) {
                        $scope.form = response.data;

                        if ($scope.form.due_date == "0000-00-00") {
                            $scope.form.due_date = null ;
                        } else {
                            $scope.form.due_date = new Date($scope.form.due_date);
                        }

                        loadDataProject() ;
                    }
                });
            } else {
                loadDataProject() ;
            }
        }
        loadDataTask() ;







        $scope.loadSection = function () {
            zeapps_modal.loadModule("com_zeapps_project", "search_section", {id_project:$routeParams.id_project}, function(objReturn) {
                if (objReturn) {
                    $scope.form.id_section = objReturn.id;
                    $scope.form.section_name = objReturn.name;
                } else {
                    $scope.form.id_section = 0;
                    $scope.form.section_name = '';
                }
            });
        };

        $scope.removeSection = function() {
            $scope.form.id_section = 0;
            $scope.form.section_name = '';
        };






        $scope.loadAssignedTo = function () {
            zeapps_modal.loadModule("com_zeapps_core", "search_user", {}, function(objReturn) {
                if (objReturn) {
                    $scope.form.id_assigned_to = objReturn.id;
                    $scope.form.name_assigned_to = objReturn.firstname + ' ' + objReturn.lastname;
                } else {
                    $scope.form.id_assigned_to = 0;
                    $scope.form.name_assigned_to = '';
                }
            });
        };

        $scope.removeAssignedTo = function() {
            $scope.form.id_assigned_to = 0;
            $scope.form.name_assigned_to = '';
        };









        $scope.save = function () {
            var $data = {};

            if ($routeParams.id != 0) {
                $data.id = $routeParams.id;
            }

            $data.id_project = $routeParams.id_project;
            $data.id_section = $scope.form.id_section;
            $data.title = $scope.form.title;
            $data.description = $scope.form.description;
            $data.progress = $scope.form.progress;
            $data.due_date = getDateMysql($scope.form.due_date);
            $data.id_assigned_to = $scope.form.id_assigned_to;
            $data.name_assigned_to = $scope.form.name_assigned_to;
            if ($scope.form.estimated_time_hours) {
                $data.estimated_time_hours = arrondi2Chiffres($scope.form.estimated_time_hours);
            } else {
                $data.estimated_time_hours = 0;
            }



            $http.post('/com_zeapps_project/task/save', $data).then(function (obj) {
                // pour que la page puisse être redirigé
                $location.path("/ng/com_zeapps_project/project/view/" + $routeParams.id_project);
            });
        }

        $scope.cancel = function () {
            $location.path("/ng/com_zeapps_project/project/view/" + $routeParams.id_project);
        }



        var getDateMysql = function(date) {
            var dateMysql = '0000-00-00';
            if (date) {
                dateMysql = date.getFullYear() + '-' +
                    ('00' + (date.getMonth() + 1)).slice(-2) + '-' +
                    ('00' + date.getDate()).slice(-2) ;
            }
            return dateMysql ;
        }


        var getNumber = function (value) {
            if (isNaN(value)) {
                value = value.replace(",", ".");
            }
            return value * 1 ;
        };

        var arrondi2Chiffres = function (value) {
            value = getNumber(value);
            return Math.round(value*100)/100;
        }



    }]);