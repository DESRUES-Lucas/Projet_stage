<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a href="/ng/com_zeapps_project/projects"><span i8n="Projets"></span></a>
    &gt; <a href="/ng/com_zeapps_project/project/view/{{project.id}}">#{{project.id}} - {{project.company_name}} :
        {{project.project_name}}</a>
    <span ng-show="section">&gt; <a href="/ng/com_zeapps_project/project/view/{{project.id}}">{{section.name}}</a></span>
    &gt;<span i8n="Tâche"></span></div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label i8n="Section"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.section_name" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_section">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeSection()"
                                        ng-show="form.id_section != 0 && form.id_section != undefined">x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadSection()">...
                                </button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label i8n="Nom"></label>
                        <input type="text" ng-model="form.title" class="form-control">
                    </div>


                    <div class="form-group">
                        <label i8n="Description"></label>
                        <textarea class="form-control" rows="5" ng-model="form.description"></textarea>
                    </div>


                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label i8n="Attribué à"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_assigned_to" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_assigned_to">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeAssignedTo()"
                                        ng-show="form.id_assigned_to != 0 && form.id_assigned_to != undefined">x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadAssignedTo()">...</button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label i8n="Date d'échéance"></label>
                        <p class="input-group">
                            <input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="form.due_date" is-open="popup2.opened" datepicker-options="dateOptions"/>
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-default" ng-click="open2()"><i
                                        class="glyphicon glyphicon-calendar"></i></button>
                              </span>
                        </p>
                    </div>


                    <div class="form-group">
                        <label i8n="Avancement"></label>
                        <select ng-model="form.progress" class="form-control">
                            <option value="0">0 %</option>
                            <option value="10">10 %</option>
                            <option value="20">20 %</option>
                            <option value="30">30 %</option>
                            <option value="40">40 %</option>
                            <option value="50">50 %</option>
                            <option value="60">60 %</option>
                            <option value="70">70 %</option>
                            <option value="80">80 %</option>
                            <option value="90">90 %</option>
                            <option value="100">100 %</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label i8n="Temps estimé en heure"></label>
                        <input type="text" ng-model="form.estimated_time_hours" class="form-control">
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-success" ng-click="save()" i8n="Enregistrer"></button>
                <button type="button" class="btn btn-default btn-sm" ng-click="cancel()" i8n="Annuler"></button>
            </div>
        </div>

    </form>


</div>