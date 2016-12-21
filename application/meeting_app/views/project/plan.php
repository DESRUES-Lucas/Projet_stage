<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><span i8n="Projet"></span></div>

<div id = "content" ng-click="project_detail">
    <div class="row">
        <div class="col-md-12 clearfix ">
            <h2 class="meetingapp-title">Liste des Projets
                <a href="/ng/meeting_app/project/new" class="pull-right">
                    <span class="little">nouveau projet</span> <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </h2>
        </div>
    </div>
    <div ng-repeat="project in projects">
        <div class="meetingapp-cell row" >
            <b class="col-md-12" >{{project.name | uppercase}}</b>
            <div class="col-md-6 col-md-offset-6" style="Font-Weight: Bold">
                Statut

                <br/>
            </div>
            <div class="pull-right meetingapp-edit-trash-icon">
                <i class="fa fa-pencil fa-2x" aria-hidden="true" ng-click="edit_project(project.id)" ></i>
                <i class="fa fa-trash fa-2x" aria-hidden="true" ng-click="delete_project(project.id)"></i>
            </div>
            <div class="col-md-4">
               <a href="ng/meeting_app/meet/plan/{{project.id}}" class="btn btn-default">
                   <strong>{{project.nbMeets}} Réunion<span ng-if="project.nbMeets > 1"></span></strong>
               </a></br>
            </div>
            <div class="col-md-5">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="{{project.advancement}}" aria-valuemin="0" aria-valuemax="100" ng-style="{width: project.advancement+'%'}" style="min-width: 2em;">
                        {{project.advancement}}%
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                    <button class="pointer btn btn-default" ng-click="addMeet(project.id)">
                        Ajouter une réunion
                    </button>
            </div>
        </div>
        <br/>
    </div>
</div>





