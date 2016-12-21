<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Articles de base</div>
<div id="content">
    <a href="/ng/fr_abeko/logo/new" class="btn btn-primary">Nouveau logo</a>



    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" >
                <tbody>
                <tr ng-repeat="logo in logos">
                    <td>{{logo.libelle}}</td>
                    <td><img ng-src="{{logo.path}}"></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(logo.id)">Supprimer</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>