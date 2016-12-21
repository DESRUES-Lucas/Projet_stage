
app.controller('MeetingAppSubjectsPlanCtrl', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', 'zeapps_modal', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, zeapps_modal, $uibModal) {

        $scope.notes = [];
        $scope.form = {};
        $scope.arrayNotes = {};

        $scope.test = {};



        $scope.edition_encours_global == false;


        $scope.addSubject = function () {

            zeapps_modal.loadModule("meeting_app", "addSubject", {}, function(objReturn) {
                loadList() ;
            });

        };


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $scope.addParticipant = function (note, $event) {
            note.edition_encours = false ;
            $event.stopPropagation();


            zeapps_modal.loadModule("meeting_app", "addParticipant", {"id_note":note.id}, function(objReturn) {
                if(objReturn)
                    note.participants.push(objReturn)
                    loadParticipant();
            });

            $scope.edition_encours_global = false ;

        };
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /*********** Check id send on URL and display the good project ***********/

        var getProjectId = function()
        {

            $http.get('/meeting_app/project/get/'+ $routeParams.id_project).then(function (response) {
                if (response.data && response.data != "false") {

                    $scope.project = response.data;
                }

            });
        };
        getProjectId();


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /*********** Check id send on URL and display the good project ***********/

        var getMeetId = function()
        {

            $http.get('/meeting_app/meet/get/'+ $routeParams.id_meet).then(function (response) {
                if (response.data && response.data != "false") {

                    $scope.meet = response.data;
                }

            });
        };
        getMeetId();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /*********** Load all subjects of a project saved in BDD ***********/

        var loadList = function () {

            $http.get('/meeting_app/subject/getSubByMeet/'+ $routeParams.id_meet).then(function (response) {
                if (response.status == 200) {
                    $scope.subjects = response.data ;
                    if (!$scope.arrayNotes[0])
                        $scope.arrayNotes[0] = [];
                    angular.forEach($scope.subjects, function(subject) {
                        if (!$scope.arrayNotes[subject.id])
                            $scope.arrayNotes[subject.id] = [];
                    });
                }
            });
        };
        loadList() ;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $scope.delete_subject = function (id_subject) {


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
                        return 'Souhaitez-vous supprimer définitivement ce sujet ?';
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

            /********** Send the Http request to the Php controller and reload projects **********/

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {
                    // console.log(workload_id);
                    $http.get('/meeting_app/subject/delete/' + id_subject).then(function (response) {
                        if (response.status == 200) {
                            console.log(response.data);
                            loadList() ;
                        }
                    });
                }

            }, function () {
                //console.log("rien");
            });

        };


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /******* Create an empty field for note *******/

        $scope.createNote = function (type_note) {
            if ($scope.edition_encours_global == false) {
                var data = {};

                data.name = "";
                data.description = "";
                data.description_edit = "";
                data.type_note = type_note;
                data.edition_encours = true ;
                data.position = 0;
                data.id_subject = 0;

                data.participants = [];

                if ( !$scope.arrayNotes[0]){
                    $scope.arrayNotes[0]= [];
                }
                $scope.arrayNotes[0].unshift(data);

                $scope.edition_encours_global = true;
            }
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /******** Load all notes in the view ********/

        var loadNotes = function () {

            $http.get('/meeting_app/subject/getNoteByMeet/'+ $routeParams.id_meet).then(function (response) {

                if (response.status == 200) {
                    $scope.notes = response.data ;
                    console.log(response.data)
                    angular.forEach($scope.notes, function(note){
                        if(!$scope.arrayNotes[note.id_subject])
                            $scope.arrayNotes[note.id_subject] = [];
                        $scope.arrayNotes[note.id_subject].push(note);
                    })
                }

            });
        };

        loadNotes() ;


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /****** Test for type logos with ng-class ********/


        $scope.foo = function(note){
            if (note["type_note"] == "task"){
                return "fa-tasks";
            }
            if (note["type_note"] == "deadline"){
                return "fa-calendar";
            }
            if (note["type_note"] == "remark"){
                return "fa-pencil";
            }
            if (note["type_note"] == "call") {
                return "fa-phone";
            }
            if (note["type_note"] == "meeting") {
                return "fa-users";
            }
            if (note["type_note"] == "document") {
                return "fa-file-o";
            }
            if (note["type_note"] == "question") {
                return "fa-question";
            }
            if (note["type_note"] == "idea"){
                return "fa-lightbulb-o";
            }
            if (note["type_note"] == "customer"){
                return  "fa-handshake-o";
            }
            if (note["type_note"] == "picture"){
                return "fa-camera";
            }
            if (note["type_note"] == "mail"){
                return "fa-envelope-o";
            }
            if (note["type_note"] == "danger"){
                return "fa-exclamation-triangle";
            }

        }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.delete_note = function (note, $event) {
            note.edition_encours = false ;
            $event.stopPropagation();
            if ( note ){


            //console.log($scope.delete);
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
                        return 'Souhaitez-vous supprimer définitivement cette note ?';
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

            /********** Send the Http request to the Php controller and reload projects **********/

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {

                    $http.get('/meeting_app/subject/deleteNote/' + note.id).then(function (response) {
                        if (response.status == 200) {
                            var index = $scope.arrayNotes[note.id_subject].indexOf(note);


                            $scope.arrayNotes[note.id_subject].splice(index, 1);

                            for ( var i = index ; i < $scope.arrayNotes[note.id_subject].length; i++){
                                $scope.arrayNotes[note.id_subject][i].position --;
                            }



                        }
                        $scope.edition_encours_global = false ;

                    });

                }

            }, function () {


                    //console.log("rien");

                });
            }

        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
        



        $scope.edition_encours_global = false ;
        $scope.edit_note = function (note) {
            if ($scope.edition_encours_global == false) {
                note.edition_encours = true;
                note.description_edit = note.description;

                $scope.edition_encours_global = true;
            }


        };


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        
        $scope.save_note = function (note, $event) {
            note.edition_encours = false ;
            $event.stopPropagation();
            var data = {};

            if ($routeParams.id_meet && $routeParams.id_meet != 0 && $routeParams.id_project && $routeParams.id_project != 0 ) {
                data.id_meet = $routeParams.id_meet;
                data.id_project = $routeParams.id_project;
            }



            data.id = note.id;
            data.description = note.description_edit;
            data.type_note = note.type_note ;
            data.position = note.position;
            data.id_subject = note.id_subject;



            $http.post('/meeting_app/subject/saveNote', angular.toJson(data)).then(function (obj) {

                note.id = obj.data.id;
                note.description = note.description_edit;
                console.log(obj.data);


            });

            $scope.edition_encours_global = false ;
        };


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        $scope.cancel_note = function (note, $event) {

            note.edition_encours = false ;

            $event.stopPropagation();

            /** If user don't write a description , logo is delete from display **/

            if (note.id == undefined){
                var index = $scope.arrayNotes[note.id_subject].indexOf(note);

                $scope.arrayNotes[note.id_subject].splice(index, 1);

            }

            $scope.edition_encours_global = false ;
        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Drag and Drop d'un tableau à l'autre

        $scope.sortableNote = {
            connectWith: ".noteContainer",
            placeholder: "app",
            delay: 300,
            axis: "y",
            stop: function( event, ui ) {

                //Id of dragged note
                var idObj = $(ui.item[0]).attr("data-id") ;
                console.log(idObj);
                //Select the table line and his parent ("tr")
                var selectedLine = $(".ligne_tableau_" + idObj) ;
                var subject_id =  selectedLine.parent().attr("data-type") ;



                var position = -1 ;
                var positionDefinitive = 0 ;

                //Select tbody and go through each row
                $("tr", selectedLine.parent()).each(function () {
                    position++ ;
                    if (idObj == $(this).attr("data-id")) {
                        positionDefinitive = position  ;

                    }
                }) ;
                var data = {} ;
                data.idObj = idObj ;
                data.id_subject = subject_id ;
                data.position = positionDefinitive ;

                $http.post('/meeting_app/subject/saveNotePosition', data);
            }

        }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $scope.draggableSubject = {
            connectWith: ".dropZone",
            placeholder: "app",

            stop: function( event, ui ) {

                //Id of dragged note
                var idObj = $(ui.item[0]).attr("data-id") ;

                console.log(event);
                console.log(ui);


            }

        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.done_note = function (note, $event) {
            note.edition_encours = false ;
            $event.stopPropagation();


            var data = {};

            if ($routeParams.id_meet && $routeParams.id_meet != 0 && $routeParams.id_project && $routeParams.id_project != 0 ) {
                data.id_meet = $routeParams.id_meet;
                data.id_project = $routeParams.id_project;
            }

            if(note.status == 0){
                note.status = 1;
            }
            else{
                note.status = 0;
            }
            data.id = note.id;
            data.status = note.status;


            $http.post('/meeting_app/subject/done_note', angular.toJson(data)).then(function (obj) {
                data.id = note.id;
                data.status = parseInt(note.status);
                console.log(obj.data);

            });

            $scope.edition_encours_global = false ;

        }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            var loadParticipant = function(){
                $http.get('/meeting_app/subject/loadParticipant/'+ $routeParams.id_meet).then(function (response) {

                    if (response.status == 200) {
                        $scope.participants = response.data ;
                        console.log($scope.participants)

                    }
                });
            }

            loadParticipant();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $scope.delete_participant = function (note, participant, $event) {


            note.edition_encours = false ;
            $event.stopPropagation();


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
                        return 'Souhaitez-vous supprimer définitivement ce projet ?';
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

            /********** Send the Http request to the Php controller and reload projects **********/

            modalInstance.result.then(function (selectedItem) {
                if (selectedItem.action == 'danger') {

                } else if (selectedItem.action == 'success') {

                    $http.get('/meeting_app/subject/deleteParticipant/' + participant.id).then(function (response) {
                        if (response.status == 200) {
                            console.log(response.data);
                            note.participants.splice(note.participants.indexOf(participant),1);

                        }
                    });

                    $scope.edition_encours_global = false ;
                }

            }, function () {
                //console.log("rien");
            });

        };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









    }]);



