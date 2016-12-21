<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Articles composés > {{form.nom}} <span ng-show="form.ref && form.ref != ''">({{form.ref}})</span></div>
<div id="content">


    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Réf. :</label>
                        <input type="text" class="form-control" ng-model="form.ref">
                    </div>
                </div>
            </div>

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
                        <label>Descriptif :</label>
                        <textarea class="form-control" rows="3" ng-model="form.descriptif"></textarea>
                    </div>
                </div>
            </div>











            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Libellé</th>
                                <th>Quantité</th>
                                <th>Tarif HT unitaire</th>
                                <th>Total HT</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="produit in produits" ng-show="produit.delete == 'N'">
                                <td>{{produit.reference}}</td>
                                <td>{{produit.libelle}}</td>
                                <td>
                                    <span ng-show="produit.editer == 'N'">{{produit.quantite}}</span>
                                    <input type="text" class="form-control" ng-model="produit.quantite" ng-show="produit.editer == 'Y'">
                                </td>
                                <td>{{produit.prix_achat_ht | number:2}}</td>
                                <td>{{produit.prix_achat_ht*produit.quantite | number:2}}</td>
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
                                <td colspan="4">Total brut</td>
                                <td>{{total_brut | number:2}}</td>
                                <td class="text-center">
                                   &nbsp;
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">Total avec marge</td>
                                <td>{{total_avec_marge | number:2}}</td>
                                <td class="text-center">
                                    &nbsp;
                                </td>
                            </tr>



                            <tr>
                                <td colspan="6" class="text-center">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Prix HT :</label>
                        <input type="text" class="form-control" ng-model="form.prix_ht">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="form.calcul_auto_prix" ng-true-value="'Y'"  ng-false-value="'N'"> Appliquer automatique le calcul du prix sur le prix unitaire des pièces x marge
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Coef. de marge :</label>
                        <input type="text" class="form-control" ng-model="form.coef_marge">
                    </div>
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