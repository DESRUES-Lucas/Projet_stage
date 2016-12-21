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

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 clearfix">
                <a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}/delete" class="text-danger pull-right"><span class="glyphicon glyphicon-trash"></span></a>
                <a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}/edit" class="text-primary pull-right"><span class="glyphicon glyphicon-pencil"></span></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <strong i8n="Nom du produit"></strong><br>
                <p class="well">{{ product.name }}</p>
            </div>
            <div class="col-md-6">
                <strong i8n="Categorie"></strong><br>
                <p class="well">{{ category.name }}</p>
            </div>
            <div class="col-md-12">
                <strong i8n="Description courte"></strong><br>
                <p class="well">{{ product.desc_short }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong i8n="Prix"></strong><br>
                <p class="well">{{ product.price }}</p>
            </div>
            <div class="col-md-6">
                <strong i8n="TVA"></strong><br>
                <p class="well">{{ product.taxe }}</p>
            </div>
            <div class="col-md-6">
                <strong i8n="Compte Comptable"></strong><br>
                <p class="well">{{ product.account }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <strong i8n="Description longue"></strong><br>
                <p class="well">{{ product.desc_long }}</p>
            </div>
        </div>
    </div>

</div>