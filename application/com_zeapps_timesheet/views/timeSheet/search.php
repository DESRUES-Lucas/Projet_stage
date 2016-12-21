
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"><a href="/ng/com_zeapps_timesheet/timesheet/search"><span i8n="Feuilles de temps"></span></a></div>



<div id = "content">
    <a href="/ng/com_zeapps_timesheet/timesheet/{{contract_id}}/new" class="btn btn-primary" i8n="Nouvelle feuille de temps"></a>
    <a href="/ng/com_zeapps_timesheet/contract/search" class="btn btn-primary" i8n="Liste des contrats"></a>


    <div class="col-md-12" >
        <h3>{{contract.contract_name | uppercase}}</h3>
        <table class="table table-bordered table-striped table-condensed table-responsive" >
            <thead>
            <tr>

                <th i8n="Utilisateur"></th>
                <th i8n="Temps passé"></th>
                <th i8n="Date"></th>
                <th i8n="Motif"></th>
                <th class="text-right" i8n="Action"></th>

            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="timesheet in timesheets" >

                <td>{{timesheet.user_name}}</td>
                <td>{{timesheet.time_spent}}</td>
                <td>{{timesheet.date_work != "0000-00-00" ? (timesheet.date_work | date:"dd/MM/yyyy") : '-'}}</td>
                <td>{{timesheet.reason}}</td>
                <td>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs" ng-click= "edit_timesheet(timesheet.id)" i8n="Editer"></button>
                        <button type="button" class="btn btn-danger btn-xs" ng-click= "delete_timesheet(timesheet.id)" i8n="Supprimer"></button>
                    </div>
                </td>

            </tr>

            </tbody>

        </table>
    </div>
</div>