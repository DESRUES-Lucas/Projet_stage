<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Entreprises"></div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/com_zeapps_contact/companies/new" class="btn btn-primary" i8n="Nouvelle entreprise"></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="companies.length">
                <thead>
                <tr>
                    <th i8n="Nom"></th>
                    <th i8n="Téléphone"></th>
                    <th i8n="Ville"></th>
                    <th i8n="Gestionnaire du compte"></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="company in companies">
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.company_name}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.phone}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.billing_city}}</a></td>
                    <td><a href="/ng/com_zeapps_contact/companies/{{company.id}}">{{company.name_user_account_manager}}</a></td>
                    <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(company.id)" i8n="Supprimer"></button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>