<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Citerne type</div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/fr_abeko/citerne_type/new" class="btn btn-primary">Nouvelle citerne type</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="citernes_types.length">
                <thead>
                <tr>
                    <th>Usage</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="citerne_type in citernes_types">
                    <td><a href="/ng/fr_abeko/citerne_type/{{citerne_type.id}}">{{citerne_type.nom}}</a></td>
                    <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(citerne_type.id)">Supprimer</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>