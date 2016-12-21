<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Projets</div>
<div id="content">


    <div class="row">
        <div class="col-md-6">
            <a href="/ng/com_zeapps_project/project/new" class="btn btn-primary" i8n="Nouveau projet"></a>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <button type="button" class="btn btn-default" ng-click="show_status()"><span
                        class="glyphicon glyphicon-filter"></span></button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-table-data">



            <tree-grid
                tree-data="tree_data"
                col-defs= "col_defs"
                expand-on="expanding_property"
                template-url="/com_zeapps_project/project/template_treegrid"
            ></tree-grid>





            <!--
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="projects.length" id="table_projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Nom</th>
                    <th>Prochaine échéance</th>
                    <th># tâches</th>
                    <th># tâches non assignées</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="project in projects">
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.id}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.company_name}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.project_name}}</a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.next_due}}<span
                                class="glyphicon glyphicon-exclamation-sign" style="color: #dd0000;"
                                ng-show="project.over_due"></span></a></td>
                    <td><a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.nb_tasks}}</a></td>
                    <td>
                        <a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{project.nb_tasks_unallocated}}</a>
                    </td>
                    <td style="white-space: nowrap">

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <span class="glyphicon glyphicon-cog"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#" ng-click="edit(project.id)"><span
                                            class="glyphicon glyphicon-pencil"></span> Editer</a></li>
                                <li><a href="#" ng-click="archived(project.id)"><span
                                            class="glyphicon glyphicon-inbox"></span> Terminer</a></li>
                                <li><a href="#" ng-click="delete(project.id)"><span
                                            class="glyphicon glyphicon-trash"></span> Supprimer</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
            -->
        </div>







        <div class="col-md-3 col-status">
            <div style="background-color: #cccccc; margin-top: 20px;">
                <div style="background-color: #000000; color:#ffffff; padding: 10px;">
                    <strong i8n="Filtre"></strong>
                </div>

                <div style="padding: 10px;">

                    <strong><u i8n="Priorité"> :</u></strong><br>
                    <div class="checkbox" ng-repeat="priority in filter_priority">
                        <label>
                            <input type="checkbox" ng-model="priority.value" ng-change="update_filter()"> {{priority.label}}
                        </label>
                    </div>






                    <strong><u i8n="Statut"> :</u></strong><br>
                    <div class="checkbox" ng-repeat="status in filter_status">
                        <label>
                            <input type="checkbox" ng-model="status.value" ng-change="update_filter()"> {{status.label}}
                        </label>
                    </div>
                </div>





                <div style="background-color: #000000; color:#ffffff; padding: 10px;">
                    <strong i8n="Affichage"></strong>
                </div>

                <div style="padding: 10px;">

                    <strong><u i8n="Niveau 1 :"> </u></strong><br>
                    <select ng-model="critere_affichage_1" class="form-control" ng-change="update_filter()">
                        <option value="0" i8n="Aucun"></option>
                        <option value="1" ng-hide="critere_affichage_2=='1' || critere_affichage_3=='1' || critere_affichage_4=='1'" i8n="Statut"></option>
                        <option value="2" ng-hide="critere_affichage_2=='2' || critere_affichage_3=='2' || critere_affichage_4=='2'" i8n="Priorité"></option>
                        <option value="3" ng-hide="critere_affichage_2=='3' || critere_affichage_3=='3' || critere_affichage_4=='3'" i8n="Responsable"></option>
                        <option value="4" ng-hide="critere_affichage_2=='4' || critere_affichage_3=='4' || critere_affichage_4=='4'" i8n="Client"></option>
                    </select>

                    <div ng-show="critere_affichage_1!='0'">
                        <strong><u i8n="Niveau 2 :"> </u></strong><br>
                        <select ng-model="critere_affichage_2" class="form-control" ng-change="update_filter()">
                            <option value="0" i8n="Aucun"></option>
                            <option value="1" ng-hide="critere_affichage_1=='1' || critere_affichage_3=='1' || critere_affichage_4=='1'" i8n="Statut"></option>
                            <option value="2" ng-hide="critere_affichage_1=='2' || critere_affichage_3=='2' || critere_affichage_4=='2'" i8n="Priorité"></option>
                            <option value="3" ng-hide="critere_affichage_1=='3' || critere_affichage_3=='3' || critere_affichage_4=='3'" i8n="Responsable"></option>
                            <option value="4" ng-hide="critere_affichage_1=='4' || critere_affichage_3=='4' || critere_affichage_4=='4'" i8n="Client"></option>
                        </select>

                        <div ng-show="critere_affichage_2!='0'">
                            <strong><u i8n="Niveau 3 :"> </u></strong><br>
                            <select ng-model="critere_affichage_3" class="form-control" ng-change="update_filter()">
                                <option value="0" i8n="Aucun"></option>
                                <option value="1" ng-hide="critere_affichage_2=='1' || critere_affichage_1=='1' || critere_affichage_4=='1'" i8n="Statut"></option>
                                <option value="2" ng-hide="critere_affichage_2=='2' || critere_affichage_1=='2' || critere_affichage_4=='2'" i8n="Priorité"></option>
                                <option value="3" ng-hide="critere_affichage_2=='3' || critere_affichage_1=='3' || critere_affichage_4=='3'" i8n="Responsable"></option>
                                <option value="4" ng-hide="critere_affichage_2=='4' || critere_affichage_1=='4' || critere_affichage_4=='4'" i8n="Client"></option>
                            </select>

                            <div ng-show="critere_affichage_3!='0'">
                                <strong><u i8n="Niveau  4 :"></u></strong><br>
                                <select ng-model="critere_affichage_4" class="form-control" ng-change="update_filter()">
                                    <option value="0" i8n="Aucun"></option>
                                    <option value="1" ng-hide="critere_affichage_2=='1' || critere_affichage_3=='1' || critere_affichage_1=='1'" i8n="Statut"></option>
                                    <option value="2" ng-hide="critere_affichage_2=='2' || critere_affichage_3=='2' || critere_affichage_1=='2'" i8n="Priorité"></option>
                                    <option value="3" ng-hide="critere_affichage_2=='3' || critere_affichage_3=='3' || critere_affichage_1=='3'" i8n="Responsable"></option>
                                    <option value="4" ng-hide="critere_affichage_2=='4' || critere_affichage_3=='4' || critere_affichage_1=='4'" i8n="Client"></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>


</div>