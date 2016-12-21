<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > <span i8n="Articles de base"></span> > {{form.libelle}} <span ng-show="form.reference && form.reference != ''">({{form.reference}})</span></div>
<div id="content">


    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Réf. :</label>
                        <input type="text" class="form-control" ng-model="form.reference">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Réf. fournisseur :</label>
                        <input type="text" class="form-control" ng-model="form.reference_fournisseur">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" class="form-control" ng-model="form.libelle">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Descriptif :</label>
                        <textarea class="form-control" rows="3" ng-model="form.descriptif"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Fournisseur :</label>
                        <input type="text" class="form-control" ng-model="form.nom_fournisseur">
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Prix d'achat HT :</label>
                        <input type="text" class="form-control" ng-model="form.prix_achat_ht">
                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success" ng-click="save()">Enregistrer</button>
                    <button type="button" class="btn btn-default btn-sm" ng-click="cancel()">Annuler</button>
                </div>
            </div>


        </div>
    </form>




</div>