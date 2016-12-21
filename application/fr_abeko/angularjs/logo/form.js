
app.controller('FrAbekoLogoFormCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'Upload',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, Upload) {

        $scope.form = [];




        $scope.cancel = function () {
            $location.path("/ng/fr_abeko/logo/search");
        }



            $scope.upload = function () {
                var options = {
                    width: 150

                };

                Upload.resize($scope.file, options).then(function(resizedFile){
                Upload.upload({
                    url: '/fr_abeko/logo/save',
                    data: {file: resizedFile, libelle: $scope.form.libelle}
                }).then(function (resp) {

                    console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
                    Upload.imageDimensions($scope.file).then(function(dimensions){console.log(dimensions.width, dimensions.height);});
                }, function (resp) {
                    console.log('Error status: ' + resp.status);
                }, function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
                });

                });

            };


    }]);

