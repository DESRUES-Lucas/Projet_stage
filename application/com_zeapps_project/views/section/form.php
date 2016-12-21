<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a href="/ng/com_zeapps_project/projects">Projets</a> &gt; <a href="/ng/com_zeapps_project/project/view/{{project.id}}">#{{project.id}} - {{project.company_name}} :
    {{project.project_name}}</a><span i8n="Section"></span></div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label i8n="Nom de la section"></label>
                        <input type="text" ng-model="form.name" class="form-control">
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