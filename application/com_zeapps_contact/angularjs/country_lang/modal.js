// declare the modal to the app service
listModuleModalFunction.push({
    module_name:'com_zeapps_contact',
    function_name:'search_country_lang',
    templateUrl:'/com_zeapps_contact/country_lang/modal_country_lang',
    controller:'ZeAppsContactsModalCountryLangCtrl',
    size:'lg',
    resolve:{
        titre: function () {
            return 'Recherche d\'un Pays';
        }
    }
});


app.controller('ZeAppsContactsModalCountryLangCtrl', function($scope, $uibModalInstance, $http, titre, option) {
    $scope.titre = titre ;


    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };



    var loadList = function () {
        var options = {};
        $http.post('/com_zeapps_contact/country_lang/getAll', options).then(function (response) {
            if (response.status == 200) {
                $scope.country_lang = response.data ;
            }
        });
    };
    loadList() ;


    $scope.loadCountryLang = function (country_lang_id) {


        var country_lang = false ;
        for (var i = 0 ; i < $scope.country_lang.length ; i++) {
            if ($scope.country_lang[i].id_country == country_lang_id) {
                country_lang = $scope.country_lang[i] ;
                break;
            }
        }

        $uibModalInstance.close(country_lang);
    }

}) ;