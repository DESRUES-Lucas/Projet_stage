<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Tarifs citernes > {{form.nom}}</div>
<div id="content">


    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" class="form-control" ng-model="form.nom">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Type bache :</label>
                        <select class="form-control" ng-model="form.id_bache">
                            <option ng-selected="form.id_bache == 0" value="0">--</option>
                            <option ng-repeat="bache in baches" ng-selected="form.id_bache == bache.id" value="{{bache.id}}">{{bache.nom}}</option>
                        </select>
                    </div>
                </div>
            </div>







            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>m<sup>3</sup></th>
                                <th>Largeur</th>
                                <th>Profondeur</th>
                                <th>Tarif HT</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="ligne in ligne_tarifs" ng-show="ligne.delete == 'N'">
                                <td>
                                    <span ng-show="ligne.edit == 'N'">{{ligne.m3}}</span>
                                    <input type="text" class="form-control" ng-model="ligne.m3" ng-show="ligne.edit == 'Y'">
                                </td>
                                <td>
                                    <span ng-show="ligne.edit == 'N'">{{ligne.largeur | number:2}}</span>
                                    <input type="text" class="form-control" ng-model="ligne.largeur" ng-show="ligne.edit == 'Y'">
                                </td>
                                <td>
                                    <span ng-show="ligne.edit == 'N'">{{ligne.profondeur | number:2}}</span>
                                    <input type="text" class="form-control" ng-model="ligne.profondeur" ng-show="ligne.edit == 'Y'">
                                </td>
                                <td>
                                    <span ng-show="ligne.edit == 'N'">{{ligne.tarif | currency:'€':2}}</span>
                                    <input type="text" class="form-control" ng-model="ligne.tarif" ng-show="ligne.edit == 'Y'">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="valider_ligne(ligne)" ng-show="ligne.edit == 'Y'">
                                        Valider
                                    </button>

                                    <button type="button" class="btn btn-primary btn-sm" ng-click="editer_ligne(ligne)" ng-show="ligne.edit == 'N'">
                                        Editer
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" ng-click="delete_ligne(ligne)" ng-show="ligne.edit == 'N'">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>


                            <tr>
                                <td><input type="text" class="form-control" ng-model="m3"></td>
                                <td><input type="text" class="form-control" ng-model="largeur"></td>
                                <td><input type="text" class="form-control" ng-model="profondeur"></td>
                                <td><input type="text" class="form-control" ng-model="tarif"></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" ng-click="ajouter_ligne()">
                                        Ajouter
                                    </button>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-success" ng-click="save()">Enregistrer</button>
                    <button type="button" class="btn btn-default btn-sm" ng-click="cancel()">Annuler</button>
                </div>
            </div>


        </div>
    </form>




</div>