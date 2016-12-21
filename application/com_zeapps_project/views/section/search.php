<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"i8n="Projets"></div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/com_zeapps_project/project/new" class="btn btn-primary" i8n="Nouveau projet"></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="projects.length">
                <thead>
                <tr>
                    <th>#</th>
                    <th i8n="Client"></th>
                    <th i8n="Nom"></th>
                    <th i8n="Prochaine échéance"></th>
                    <th i8n="# tâches"></th>
                    <th i8n="# non assignés"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="project in projects">
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.id}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.company_name}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.project_name}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">##/##/##### <span class="glyphicon glyphicon-exclamation-sign" style="color: #dd0000;"></span></a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">##</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">##</a></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>


</div>