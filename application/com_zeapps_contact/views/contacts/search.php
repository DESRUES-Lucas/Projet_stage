<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Contacts"></div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/com_zeapps_contact/contacts/new" class="btn btn-primary" i8n="Nouveau contact"></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="contacts.length">
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
                <tr ng-repeat="contact in contacts">
                    <td>{{contact.first_name}} {{contact.last_name}}</td>
                    <td>{{contact.phone}}</td>
                    <td>{{contact.city}}</td>
                    <td>{{contact.name_user_account_manager}}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(contact.id)" i8n="Supprimer"></button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>