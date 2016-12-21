<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Tarifs citernes</div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/fr_abeko/citerne_tarif/new" class="btn btn-primary">Nouveau tarif</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="tarifs.length">
                <thead>
                <tr>
                    <th>Nom du tarif</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="tarif in tarifs | filter:nom">
                    <td><a href="/ng/fr_abeko/citerne_tarif/{{tarif.id}}">{{tarif.nom}}</a></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" ng-click="duplicate(tarif.id)">Dupliquer</button>
                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(tarif.id)">Supprimer</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>