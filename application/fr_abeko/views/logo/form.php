<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id = "content">
    <form  name="form" >
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" ng-model="form.libelle" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" ngf-select ng-model="file" name="file" ngf-pattern="'image/*'"
                             ngf-accept="'image/*'" ngf-max-size="20MB" ngf-min-height="100"
                             ngf-resize="{width: 100, height: 100}" required/>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" class="btn btn-success" ng-click="upload()"  value="Enregistrer"/>
                <button type="button" class="btn btn-default btn-sm" ng-click="cancel()">Annuler</button>
            </div>
        </div>
    </form>
</div>

