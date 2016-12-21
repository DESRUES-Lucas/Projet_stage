<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Bâches > {{form.nom}}</div>
<div id="content">


    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" class="form-control" ng-model="form.nom">
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