<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a href="/ng/meeting_app/project/plan" i8n="Projet > ">  </a><span i8n="Réunion"></span></div>
<div id="content">
    <a href="/ng/meeting_app/project/plan"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour aux projets</i></a>
    <div class="col-md-12 clearfix ">
        <h2 class="meetingapp-title" i8n="Liste des Réunions"> </h2>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered table-striped  table-responsive meetingapp-table">
            <thead>
                <tr>
                    <td><b i8n="Libellé"></b></td>
                    <td><b i8n="Description"></b></td>
                    <td><b i8n="Date Prévu"></b></td>
                    <td class="text-right"><b i8n="Actions"></b></td>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="meet in meets">
                    <td><b> <a href="/ng/meeting_app/subject/plan/{{meet.id_project}}/{{meet.id}}">{{meet.name}}</a></b></td>
                    <td> <a href="/ng/meeting_app/subject/plan/{{meet.id_project}}/{{meet.id}}">{{meet.description}}</a></td>
                    <td> <a href="/ng/meeting_app/subject/plan/{{meet.id_project}}/{{meet.id}}">{{meet.date_meet != "0000-00-00" ? (meet.date_meet | date:"dd/MM/yyyy") : '-'}}</a></td>
                    <td>
                        <div class="pull-right meetingapp-edit-trash-icon">
                            <a href="/ng/meeting_app/subject/plan/{{meet.id}}"></a>
                            <i class="fa fa-pencil fa-2x" aria-hidden="true" ng-click="edit_meet(meet.id)" ></i>
                            <i class="fa fa-trash fa-2x" aria-hidden="true" ng-click="delete_meet(meet.id)"></i>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</div>



