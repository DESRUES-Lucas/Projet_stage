<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="breadcrumb"><a href="/ng/com_zeapps_timesheet/contract/search"><span i8n="Contrats"></span></a></div>

<div id = "content">

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
                        <label i8n="Libellé"></label>
                        <input type="text" ng-model="form.contract_name" class="form-control" required>
                    </div>


                    <div class="form-group">
                        <label i8n="Heures vendues"></label>
                        <input type="number" min="0" step="1"  ng-model="form.time" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Seuil d'alerte"></label>
                        <input type="number" min="0" step="1" ng-model="form.alert" class="form-control">
                    </div>

                </div>


                <div class="col-md-6">



                    <div class="form-group">
                        <label i8n="Date d'ouverture du contrat"></label>
                        <input type="date" ng-model="form.opened_at" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Date de fin contrat"></label>
                        <input type="date" ng-model="form.end_at" class="form-control">
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


