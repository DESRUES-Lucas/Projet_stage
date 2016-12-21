<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" class="meetingapp-breadcrumb"><a href="/ng/meeting_app/project/plan" i8n="Projet > "></a><span i8n="Réunion > "></span><span i8n="Sujets"></span></div>
<div class="taskBar" >
    <div class="col-md-12  text-center meetingapp-min-font ">
        <div  class="col-md-1 ">
            <i class="fa fa-tasks fa-3x meetingapp-circle pointer" ng-model="task" ng-click="createNote('task')"  aria-hidden="true"></i><br/>
            Tâche
        </div>
        <div class="col-md-1 ">
            <i class="fa fa-calendar fa-3x meetingapp-circle pointer" ng-model="deadline" ng-click="createNote('deadline')" aria-hidden="true"></i><br/>
            Echéance
        </div>
        <div class="col-md-1 ">
            <i class="fa fa-pencil fa-3x meetingapp-circle pointer" ng-model="remark" ng-click="createNote('remark')" aria-hidden="true"></i><br/>
            Remarque
        </div>
        <div class="col-md-1">
            <i class="fa fa-phone fa-3x meetingapp-circle pointer" ng-model="call" ng-click="createNote('call')" aria-hidden="true"></i><br/>
            Appel
        </div>
        <div class="col-md-1">
            <i class="fa fa-users fa-3x meetingapp-circle pointer" ng-model="meeting" ng-click="createNote('meeting')" aria-hidden="true"></i><br/>
            Réunion
        </div>
        <div class="col-md-1">
            <i class="fa fa-file-o fa-3x meetingapp-circle pointer" ng-model="document" ng-click="createNote('document')" aria-hidden="true"></i><br/>
            Document
        </div>
        <div class="col-md-1">
            <i class="fa fa-question fa-3x meetingapp-circle pointer" ng-model="question" ng-click="createNote('question')" aria-hidden="true"></i><br/>
            Question
        </div>
        <div class="col-md-1">
            <i class="fa fa-lightbulb-o fa-3x meetingapp-circle pointer" ng-model="idea" ng-click="createNote('idea')" aria-hidden="true"></i><br/>
            Idée
        </div>
        <div class="col-md-1">
            <i class="fa fa-handshake-o fa-3x meetingapp-circle pointer" ng-model="customer" ng-click="createNote('customer')" aria-hidden="true"></i><br/>
            Client
        </div>
        <div class="col-md-1">
            <i class="fa fa-camera fa-3x meetingapp-circle pointer" ng-model="picture" ng-click="createNote('picture')" aria-hidden="true"></i><br/>
            Photo
        </div>
        <div class="col-md-1">
            <i class="fa fa-envelope-o fa-3x meetingapp-circle pointer" ng-model="mail" ng-click="createNote('mail')" aria-hidden="true"></i><br/>
            Mail
        </div>
        <div class="col-md-1">
            <i class="fa fa-exclamation-triangle fa-3x meetingapp-circle pointer" ng-model="danger" ng-click="createNote('danger')" aria-hidden="true"></i><br/>
            Danger
        </div>
    </div>

</div>
<div id="content" class="meetingapp-content">


        <div class="meetingapp-top-margin">

            <h1 class="text-center">{{project.name | uppercase}} : {{meet.name}}</h1>

            <div  class=" col-md-3 meetingapp-left-menu" scrollspy="scrollspy">
                <div class="col-md-12 meetingapp-subtitle" >
                    <strong i8n="Ordre du jour"></strong><i class="fa fa-plus pull-right pointer" ng-click="addSubject()" style="margin-top: 3px" aria-hidden="true"></i>
                </div>
                <div class=" col-md-12 meetingapp-scroll" >
                    <ul  class="pointer" >
                        <li ng-repeat="subject in subjects" data-id="{{subject.id}}"><i class="fa fa-trash pull-right" aria-hidden="true" ng-click="delete_subject(subject.id)" ></i><strong>{{subject.name | uppercase}}</strong> </li>
                    </ul>
                </div>


                <br/>
                <div class="col-md-12 meetingapp-subtitle">
                    <strong i8n="Liste des participants"></strong>
                </div>
                <div class="col-md-12 meetingapp-scroll">
                    <ul ui-sortable="draggableParticipant" class="sourceParticipant first" ng-model="participants" >
                        <li ng-repeat="participant in participants" data-id="{{participant.id}}" class="pointer"><strong>{{participant.firstname}}  {{participant.lastname}}</strong></li>
                    </ul>
                </div>

            </div>


            <div class="col-md-9  meetingapp-task">
                <div class="col-md-12 ">
                    <table class="table pointer">
                        <tbody ui-sortable="sortableNote" class="noteContainer defaut col-md-12" ng-model="arrayNotes[0]" data-type="0">
                            <tr ng-repeat="note in arrayNotes[0]" data-id="{{note.id}}" class="ligne_tableau_{{note.id}} " ng-click="edit_note(note)"  >
                                <td>
                                    <span class="fa fa-2x note-circle" ng-class="foo(note)"></span>
                                </td>
                                <td class="meetingapp-textarea col-md-9 dropParticipant" ng-model="test">
                                    <div ng-show="note.edition_encours == true">
                                        <textarea input="text" {{note.id ? 'autofocus' : ''}}  ng-model="note.description_edit"></textarea><br>
                                        <button class="btn btn-success btn-sm" ng-click="save_note(note, $event)">Enregistrer</button>
                                        <button class="btn btn-warning btn-sm" ng-click="cancel_note(note, $event)">Annuler</button>
                                    </div>
                                    <div ng-show="note.edition_encours == false || note.edition_encours == undefined" >
                                        {{ note.description }}
                                    </div>
                                    <div ng-if="note.participants && note.participants.length > 0" class="participants">
                                        <strong>Participants:</strong> <span ng-repeat="participant in note.participants" class="participant">{{participant.firstname}} {{participant.lastname}} <i class="fa fa-trash text-danger" aria-hidden="true" ng-click="delete_participant(note, participant, $event)"></i>, </span>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <span class="fa-stack fa-lg " ng-click="done_note(note, $event)">
                                         <i class="fa fa-circle-o fa-stack-2x"></i>
                                         <i class="fa fa-check fa-stack-1x text-success" ng-show="note.status == 1"></i>
                                    </span>
                                </td>
                                <td>
                                    <i class="fa fa-user-plus fa-2x" aria-hidden="true" ng-click="addParticipant(note,$event)"></i>
                                </td>
                                <td  class="col-md-1">
                                    <i class="fa fa-times fa-2x text-danger" ng-click="delete_note(note, $event); " aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr ng-show = "arrayNotes[0].length < 1">
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div ng-repeat="subject in subjects" class="col-md-12 ">
                    <h4 class="subheader col-md-12">{{subject.name|uppercase}}</h4>

                    <table class="table pointer">
                        <tbody  ui-sortable="sortableNote" class="noteContainer defaut" ng-model="arrayNotes[subject.id]" data-type="{{ subject.id }}">
                            <tr ng-repeat="note in arrayNotes[subject.id] | orderBy:'position'" class="col-md-12 ligne_tableau_{{note.id}}" ng-click="edit_note(note)" data-id="{{note.id}}" >
                                <td>
                                    <span class="fa fa-2x note-circle" ng-class="foo(note)"></span>
                                </td>
                                <td class="meetingapp-textarea col-md-9">
                                    <div ng-show="note.edition_encours == true">
                                        <textarea input="text" {{note.id ? 'autofocus' : ''}}  ng-model="note.description_edit"></textarea><br>
                                        <button class="btn btn-success btn-sm" ng-click="save_note(note, $event)">Enregistrer</button>
                                        <button class="btn btn-warning btn-sm" ng-click="cancel_note(note, $event)">Annuler</button>
                                    </div>
                                    <div ng-show="note.edition_encours == false || note.edition_encours == undefined" >
                                        {{ note.description }}
                                    </div>
                                    <div ng-if="note.participants && note.participants.length > 0" class="participant">
                                        <strong>Participants:</strong> <span ng-repeat="participant in note.participants" class="participant">{{participant.firstname}} {{participant.lastname}} <i class="fa fa-trash text-danger" aria-hidden="true" ng-click="delete_participant(note, participant, $event)"></i>, </span>
                                    </div>
                                </td>
                                <td class="col-md-1">
                                    <span class="fa-stack fa-lg " ng-click="done_note(note, $event)">
                                         <i class="fa fa-circle-o fa-stack-2x"></i>
                                         <i class="fa fa-check fa-stack-1x text-success" ng-show="note.status == 1"></i>
                                    </span>
                                </td>
                                <td>
                                    <i class="fa fa-user-plus fa-2x" aria-hidden="true" ng-click="addParticipant(note,$event)"></i>
                                </td>
                                <td  class="col-md-1">
                                    <i class="fa fa-times fa-2x text-danger" ng-click="delete_note(note, $event); " aria-hidden="true"></i>
                                </td>
                            </tr>
                            <tr ng-show = "arrayNotes[subject.id].length < 1">
                                <td colspan="3"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>



</div>





