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

        <form name="newProduct" class="col-md-9">
            <div class="well">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label i8n="Nom du produit"> <span class="required">*</span></label>
                            <input type="text" ng-model="form.name" class="form-control" ng-required="true">
                        </div>

                    </div>

                    <div class="form-group">
                        <input type="hidden" ng-model="form.category" ng-required="true">
                    </div>

                    <div class="col-md-12">

                        <div class="form-group">
                            <label i8n="Description courte"> <span class="required">*</span> <span ng-class="descState(form.desc_short.length, max_length.desc_short)">{{ form.desc_short.length || 0 }}/{{ max_length.desc_short }}</span></label>
                            <input type="text" ng-model="form.desc_short" class="form-control" ng-required="true">
                        </div>

                    </div>

                </div>
            </div>




            <div class="well">
                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label i8n="Prix"> <span class="required">*</span></label>
                            <div class="input-group">
                                <input type="number" min="0" step="0.01" ng-model="form.price" class="form-control" ng-required="true">
                                <span class="input-group-addon">€</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label i8n="Compte Comptable"> <span class="required">*</span></label>
                            <input type="text" ng-model="form.account" class="form-control" ng-required="true">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label i8n="TVA"> <span class="required">*</span></label>
                            <input type="text" ng-model="form.taxe" class="form-control" ng-required="true">
                        </div>

                    </div>
                </div>
            </div>




            <div class="well">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label i8n="Description longue"><span ng-class="descState(form.desc_long.length, max_length.desc_long)">{{ form.desc_long.length || 0 }}/{{ max_length.desc_long }}</span></label>
                            <textarea class="form-control" rows="3" ng-model="form.desc_long"></textarea>
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
                    <button type="button" class="btn btn-success" ng-class="newProduct.$invalid ? 'disabled':'' " ng-click="save()" i8n="Enregistrer"></button>
                    <button type="button" class="btn btn-danger btn-sm" ng-show="form.id" ng-click="delete(form.id)" i8n="Supprimer"></button>
                    <button type="button" class="btn btn-default btn-sm" ng-click="cancel()" i8n="Annuler"></button>
                </div>
            </div>
        </form>
    </div>

</div>