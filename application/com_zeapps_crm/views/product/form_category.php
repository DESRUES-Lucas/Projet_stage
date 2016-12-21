<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Produits"></div>
<div id="content">

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" ng-show="error">{{ error }}</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="well">
                <zeapps-happylittletree
                    data-tree="tree.branches"
                    data-active-branch="activeCategory"
                </zeapps-happylittletree>
            </div>
        </div>

        <form name="newCategory" class="col-md-9">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label i8n="Nom de la catégorie"> <span class="required">*</span></label>
                            <input type="text" ng-model="form.name" class="form-control" ng-required="true">
                            <input type="hidden" ng-model="form.id_parent">
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <span class="required">*</span><span i8n="champs obligatoires"></span>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success" ng-class="newCategory.$invalid ? 'disabled':'' " ng-click="save()" i8n="Enregistrer"></button>
                    <button type="button" class="btn btn-danger btn-sm" ng-click="delete(form.id)" i8n="Supprimer"></button>
                    <button type="button" class="btn btn-default btn-sm" ng-click="cancel()" i8n="Annuler"></button>
                </div>
            </div>
        </form>
    </div>

</div>