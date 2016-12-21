<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > plan</div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/fr_abeko/plan/form" class="btn btn-primary">Nouveau plan</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="plans.length">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>M<sup>3</sup></th>
                    <th>Largeur</th>
                    <th>Profondeur</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="plan in plans">
                    <td><a href="/ng/fr_abeko/plan/view/{{plan.id}}">{{plan.nom}}</a></td>
                    <td><a href="/ng/fr_abeko/plan/view/{{plan.id}}">{{plan.nom_bache}}</a></td>
                    <td><a href="/ng/fr_abeko/plan/view/{{plan.id}}">{{plan.m3}}</a></td>
                    <td><a href="/ng/fr_abeko/plan/view/{{plan.id}}">{{plan.largeur}}</a></td>
                    <td><a href="/ng/fr_abeko/plan/view/{{plan.id}}">{{plan.profondeur}}</a></td>
                    <td><button type="button" class="btn btn-danger btn-sm" ng-click="delete(plan.id)">Supprimer</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>