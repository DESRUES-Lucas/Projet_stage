<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Projets"></div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-6">


                    <div class="form-group">
                        <label i8n="Société"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.company_name" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_company">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCompany()"
                                        ng-show="form.id_company != 0 && form.id_company != undefined">x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadCompany()">...
                                </button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label i8n="Nom du projet"></label>
                        <input type="text" ng-model="form.project_name" class="form-control">
                    </div>


                    <div class="form-group">
                        <label>Statut</label>
                        <select ng-model="form.status" class="form-control">
                            <option value="0" i8n="Actif"></option>
                            <option value="99" i8n="Terminé"></option>
                            <option value="1" i8n="Reporté"></option>
                            <option value="2" i8n="Annulé"></option>
                        </select>
                    </div>

                </div>


                <div class="col-md-6">

                    <div class="form-group">
                        <label i8n="Gestionnaire du projet"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_user_project_manager" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_user_project_manager">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeProjectManager()"
                                        ng-show="form.id_user_project_manager != 0 && form.id_user_project_manager != undefined">
                                    x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadProjectManager()">...
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label i8n="Priorité"></label>
                        <select ng-model="form.priority" class="form-control">
                            <option value="0" i8n="Basse"></option>
                            <option value="1" i8n="Normale"></option>
                            <option value="2" i8n="Haute"></option>
                        </select>
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