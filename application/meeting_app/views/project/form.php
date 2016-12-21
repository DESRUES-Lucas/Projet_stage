<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a i8n="Projet"></a></div>


<div id = "content">

    <form class="meetingapp-form">
        <div class="meetingapp-modal-header">
            <h3 class="modal-title" i8n="Nouveau Projet"></h3>
        </div>

        <div class="well meetingapp-well">

            <div class="row">
                    <div class="col-md-12">


                        <div class="form-group">
                            <label i8n="Nom du Projet"></label>
                            <input type="text" ng-model="form.name" class="form-control" required >
                        </div>


                        <div class="form-group">
                            <label i8n="Description"></label>
                            <textarea class="form-control" ng-model="form.description" rows="3" required></textarea>
                        </div>


                    </div>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" class="btn btn-success" ng-click="save()" value="Enregistrer"/>
                <button type="button" class="btn btn-default btn-sm" ng-click="cancel()" i8n="Annuler"></button>
            </div>
        </div>

    </form>
</div>


