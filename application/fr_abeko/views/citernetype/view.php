<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Citerne type > {{form.nom}}</div>
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
                        <label>Tarifs applicables :</label>
                    </div>

                    <div class="checkbox" ng-repeat="tarif in tarifs">
                        <label>
                            <input type="checkbox" ng-model="tarif.value" ng-true-value="'Y'"  ng-false-value="'N'"> {{tarif.nom}}
                        </label>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Pièces disponibles</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Libellé</th>
                            <th>Tarif HT unitaire</th>
                            <th>Type de position</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="produit in produits" ng-show="produit.delete == 'N'">
                            <td>{{produit.ref}}</td>
                            <td>{{produit.nom}}</td>
                            <td>{{produit.prix_ht | number:2}}</td>
                            <td class="text-left">

                                <span ng-show="produit.editer == 'N'">{{produit.type_point}}</span>


                                <div class="checkbox" ng-repeat="point in type_position" ng-show="produit.editer == 'Y'">
                                    <label>
                                        <input type="checkbox" ng-model="produit.type_point_form[point]"> {{point}}
                                    </label>
                                </div>

                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary btn-sm" ng-click="valider_ligne(produit)" ng-show="produit.editer == 'Y'">
                                    Valider
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" ng-click="editer_ligne(produit)" ng-show="produit.editer == 'N'">
                                    Editer
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" ng-click="delete_ligne(produit)" ng-show="produit.editer == 'N'">
                                    Supprimer
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="text-center">
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