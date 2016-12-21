<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="breadcrumb"><a href="/ng/com_zeapps_timesheet/timesheet/search"><span i8n="Feuilles de temps"></span></a></div>

<div id = "content">

    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label i8n="Temps passé"></label>
                        <input type="number" min="0" step="1"  ng-model="form.time_spent" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Date"></label>
                        <input type="date"  ng-model="form.date_work" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Motif"></label>
                        <input type="text" ng-model="form.reason" class="form-control" >
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


