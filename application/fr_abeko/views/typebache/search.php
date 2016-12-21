<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Bâches</div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/fr_abeko/type_bache/new" class="btn btn-primary">Nouvelle bâche</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="baches.length">
                <thead>
                <tr>
                    <th>Nom de la bâche</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="bache in baches">
                    <td><a href="/ng/fr_abeko/type_bache/{{bache.id}}">{{bache.nom}}</a></td>
                    <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(bache.id)">Supprimer</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>