<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><b><a href="/ng/com_zeapps_project/my_tasks"><span i8n="Mes tâches"></span></a></b></div>



<div id="content">





    <strong ng-show="projets.length == 0" i8n="Aucune tâche assignée"></strong>








    <div ng-repeat="projet in projets">
        <div class="row">
            <div class="col-md-12">
                <div class="titleProjectMyTask">{{projet.company_name}} : {{projet.project_name}} (#{{projet.id}})</div>
            </div>
        </div>


        <div class="row section_project" ng-repeat="section in projet.section_list">
            <div class="col-md-12">
                <h3>{{section[1]}}</h3>

                <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="section[2].length">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th i8n="Tâche"></th>
                        <th i8n="Échéance"></th>
                        <th i8n="Avancement"></th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr ng-repeat="task in section[2]">
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section[0]}}/task/{{task.id}}">{{task.id}}</a></td>
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section[0]}}/task/{{task.id}}">{{task.title}}</a> <span class="glyphicon glyphicon-align-justify" ng-show="task.description != ''" data-toggle="tooltip" data-placement="bottom" title="{{task.description}}"></span></td>
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section[0]}}/task/{{task.id}}"><span ng-show="task.due_date != '0000-00-00'">{{task.due_date | date : 'dd/MM/yyyy'}}</span></a></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{task.progress}}" aria-valuemin="0"
                                     aria-valuemax="100" style="width: {{task.progress}}%;">
                                    {{task.progress}}%
                                </div>
                            </div>
                        </td>
                        <td style="white-space: nowrap">
                            <div class="pull-right">
                                <button type="button" class="btn btn-success btn-xs" ng-click="completed_task(section[0], task.id)" i8n="Terminer"></button>
                                <button type="button" class="btn btn-primary btn-xs" ng-click="edit_task(projet.id, section[0], task.id)" i8n="Editer"></button>
                                <button type="button" class="btn btn-danger btn-xs" ng-click="delete_task(section[0], task.id)" i8n="Supprimer"></button>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>



    </div>









</div>