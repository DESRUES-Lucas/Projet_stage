<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a href="/ng/com_zeapps_project/projects"><span i8n="Projets"></span></a> &gt; <b>#{{projet.id}} - {{projet.company_name}} :
        {{projet.project_name}}</b>
    <div class="pull-right">

        <button type="button" class="btn btn-warning btn-xs" ng-click="download_pdf()" i8n="Télécharger en PDF"> </button>
        <a href="/ng/com_zeapps_project/project/{{projet.id}}/section/add" type="button" class="btn btn-success btn-xs" i8n="Ajouter une section"></a>
        <a href="/ng/com_zeapps_project/project/{{projet.id}}/section/0/task/add" type="button" class="btn btn-success btn-xs" i8n="Ajouter une tâche"></a>
    </div>
</div>



<div id="content">



    <div class="row section_project" ng-show="tasks_without_sections.length">
        <div class="col-md-12">
            <h3 i8n="Sans section"></h3>

            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="tasks_without_sections.length">
                <thead>
                <tr>
                    <th>#</th>
                    <th i8n="Tâche"></th>
                    <th i8n="Attribué à"></th>
                    <th i8n="Échéance"></th>
                    <th i8n="Avancement"></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody ui-sortable="sortableOptionsTask" ng-model="tasks_without_sections">

                <tr ng-repeat="task in tasks_without_sections">
                    <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/0/task/{{task.id}}">{{task.id}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/0/task/{{task.id}}">{{task.title}}</a> <span class="glyphicon glyphicon-align-justify" ng-show="task.description != ''" data-toggle="tooltip" data-placement="bottom" title="{{task.description}}"></span>
                    </td>
                    <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/0/task/{{task.id}}">{{task.name_assigned_to}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/0/task/{{task.id}}"><span ng-show="task.due_date != '0000-00-00'">{{task.due_date | date : 'dd/MM/yyyy'}}</span></a></td>
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
                            <span class="btn btn-primary btn-xs moveElement" ng-show="tasks_without_sections.length > 1"><span class="glyphicon glyphicon-align-justify"></span></span>
                            <button type="button" class="btn btn-success btn-xs" ng-click="completed_task(0, task.id)" i8n="Terminer"></button>
                            <button type="button" class="btn btn-primary btn-xs" ng-click="edit_task(0, task.id)" i8n="Editer"></button>
                            <button type="button" class="btn btn-danger btn-xs" ng-click="delete_task(0, task.id)" i8n="Supprimer"></button>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
















    <div ui-sortable="sortableOptions" ng-model="sections" class="div_sortable">
        <div class="row section_project" ng-repeat="section in sections">
            <div class="col-md-12">
                <h3>{{section.name}}
                    <div class="pull-right">


                        <div class="btn btn-primary btn-xs moveElement" ng-show="sections.length > 1"><span class="glyphicon glyphicon-align-justify"></span></div>

                        <button type="button" class="btn btn-success btn-xs" ng-click="add_task(section.id)" i8n="Ajouter une tâche"></button>
                        <button type="button" class="btn btn-primary btn-xs" ng-click="edit_section(section.id)" i8n="Editer"></button>
                        <button type="button" class="btn btn-danger btn-xs" ng-click="delete_section(section.id)" i8n="Supprimer"></button>
                    </div>
                </h3>

                <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="section.tasks.length">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th i8n="Tâche"></th>
                        <th i8n="Attribué à"></th>
                        <th i8n="Échéance"></th>
                        <th i8n="Avancement"></th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody ui-sortable="section.sortableOptionsTask" ng-model="section.tasks">

                    <tr ng-repeat="task in section.tasks">
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section.id}}/task/{{task.id}}">{{task.id}}</a></td>
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section.id}}/task/{{task.id}}">{{task.title}}</a>  <span class="glyphicon glyphicon-align-justify" ng-show="task.description != ''" data-toggle="tooltip" data-placement="bottom" title="{{task.description}}"></span>
                        </td>
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section.id}}/task/{{task.id}}">{{task.name_assigned_to}}</a></td>
                        <td><a href="/ng/com_zeapps_project/project/{{projet.id}}/section/{{section.id}}/task/{{task.id}}"><span ng-show="task.due_date != '0000-00-00'">{{task.due_date | date : 'dd/MM/yyyy'}}</span></a></td>
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
                                <div class="btn btn-primary btn-xs moveElement" ng-show="section.tasks.length > 1" ng-mousedown="startMoveTask(section.id)" data-section="{{section.id}}"><span class="glyphicon glyphicon-align-justify"></span></div>
                                <button type="button" class="btn btn-success btn-xs" ng-click="completed_task(section.id, task.id)" i8n="Terminer"></button>
                                <button type="button" class="btn btn-primary btn-xs" ng-click="edit_task(section.id, task.id)" i8n="Editer"></button>
                                <button type="button" class="btn btn-danger btn-xs" ng-click="delete_task(section.id, task.id)" i8n="Supprimer"></button>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>




</div>