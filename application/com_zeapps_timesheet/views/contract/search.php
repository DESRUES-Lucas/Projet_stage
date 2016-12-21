<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id = "content">
    <a href="/ng/com_zeapps_timesheet/contract/new" class="btn btn-primary"><span i8n="Nouveau contrat"></span></span></a>



    <h3 i8n="Liste des contrats"></h3>

    <div class="col-md-12" >
        <table class="table table-bordered table-striped table-condensed table-responsive" >
            <thead>
            <tr>
                <th i8n="Client"></th>
                <th i8n="Libellé"></th>
                <th i8n="Nombre d'heure"></th>
                <th i8n="Seuil d'alerte"></th>
                <th i8n="Date d'ouverture"></th>
                <th i8n="Date de fin"></th>

                <th class="text-right" i8n="Actions"></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="contract in contracts" class="{{contract.warning}}">
                <td>{{contract.company_name}}</td>
                <td>{{contract.contract_name}}</td>
                <td>{{contract.time}}</td>
                <td>{{contract.alert}}</td>
                <td>{{contract.opened_at != "0000-00-00" ? (contract.opened_at | date:"dd/MM/yyyy") : '-'}}</td>
                <td>{{contract.end_at != "0000-00-00" ? (contract.end_at | date:"dd/MM/yyyy") : '-'}}</td>

                <td>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs" ng-click= "edit_contract(contract.id)" i8n="Editer"></button>
                        <button type="button" class="btn btn-danger btn-xs" ng-click= "delete_contract(contract.id)" i8n="Supprimer"></button>
                        <a href="/ng/com_zeapps_timesheet/timesheet/{{contract.id}}/new" type="button" class="btn btn-default btn-xs" i8n="Nouvelle feuille de temps"></a>
                        <a href="/ng/com_zeapps_timesheet/timesheet/{{contract.id}}/search" type="button" class="btn btn-default btn-xs" i8n="Mes feuilles de temps"></a>
                    </div>
                </td>
            </tr>

            </tbody>

        </table>
    </div>