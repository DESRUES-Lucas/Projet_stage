
app.controller('MeetingAppProjectsFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal) {


        $scope.form = [];

        /**
         * Persist in database
         */
        $scope.save = function () {
            var $data = {};

            /************ Check if fields(name and description) are completed *************/

            if ($scope.form.name != undefined && $scope.form.description != undefined) {
                if ($routeParams.id != 0) {
                    $data.id = $routeParams.id;
                }

                $data.name = $scope.form.name;
                $data.description = $scope.form.description;


                $http.post('/meeting_app/project/save', $data).then(function (obj) {
                    // pour que la page puisse être redirigé
                    console.log(obj.data);
                    $location.path("/ng/meeting_app/project/plan");


                });
             }
            }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // charge la fiche
        if ($routeParams.id && $routeParams.id != 0) {
            $http.get('/meeting_app/project/get/' + $routeParams.id).then(function (response) {
                if (response.status == 200) {
                    $scope.form = response.data;
                }
            });
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.cancel = function () {
            $location.path("/ng/meeting_app/project/plan");
        }



    }]);





