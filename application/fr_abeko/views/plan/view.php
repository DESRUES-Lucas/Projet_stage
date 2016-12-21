<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Plans > {{form.nom}}</div>
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
                <div class="col-lg-7">
                    <plan-citern data-positions="positions" data-produits="produits" data-options="options" data-ajout-produit="ajoutProduit" data-del="del" data-update-positions="updatePositions"></plan-citern>
                </div>
                <div class="col-lg-5">
                    <button class="btn btn-sm btn-success" ng-click="toggleAdd()">
                        <span class="glyphicon glyphicon-plus"></span>
                        Ajouter une position
                    </button>
                    <div ng-show="addingPosition">
                        <form name="newPosition">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type_position" value="flanc" ng-model="newPosition.type_position">
                                    Flanc
                                </label>
                                <div class="radio col-xs-offset-1" ng-show="newPosition.type_position == 'flanc'">
                                    <label>
                                        <input type="radio" name="position" value="haut" ng-model="newPosition.position.flanc">
                                        En haut
                                    </label>
                                </div>
                                <div class="radio col-xs-offset-1" ng-show="newPosition.type_position == 'flanc'">
                                    <label>
                                        <input type="radio" name="position" value="droite" ng-model="newPosition.position.flanc">
                                        A droite
                                    </label>
                                </div>
                                <div class="radio col-xs-offset-1" ng-show="newPosition.type_position == 'flanc'">
                                    <label>
                                        <input type="radio" name="position" value="bas" ng-model="newPosition.position.flanc">
                                        En bas
                                    </label>
                                </div>
                                <div class="radio col-xs-offset-1" ng-show="newPosition.type_position == 'flanc'">
                                    <label>
                                        <input type="radio" name="position" value="gauche" ng-model="newPosition.position.flanc">
                                        A gauche
                                    </label>
                                </div>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type_position" value="fond" ng-model="newPosition.type_position">
                                    Fond
                                </label>
                            </div>
                            <div class="radio" ng-hide="positions.tropPlein.length >= 2">
                                <label>
                                    <input type="radio" name="type_position" value="tropPlein" ng-model="newPosition.type_position">
                                    Trop-plein
                                </label>
                                <div>
                                    <div class="radio col-xs-offset-1" ng-show="showTropPleinOption('gauche')">
                                        <label>
                                            <input type="radio" name="position" value="gauche" ng-model="newPosition.position.tropPlein">
                                            A gauche
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div class="radio col-xs-offset-1" ng-show="showTropPleinOption('droite')">
                                        <label>
                                            <input type="radio" name="position" value="droite" ng-model="newPosition.position.tropPlein">
                                            A droite
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="radio" ng-hide="positions.event.length >= 1">
                                <label>
                                    <input type="radio" name="type_position" value="event" ng-model="newPosition.type_position">
                                    Event
                                </label>
                            </div>
                            <button class="btn btn-sm btn-success" ng-click="add(true)">Valider</button>
                            <button class="btn btn-sm btn-primary" ng-click="add(false)">Valider et ajouter une autre position</button>
                        </form>
                    </div>
                    <h3 class="text-center">Options</h3>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="options.only_active"> Voir uniquement les points avec des pièces
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="options.dimensions"> Afficher les dimensions
                        </label>
                        <div class="checkbox col-xs-offset-1" ng-show="options.dimensions">
                            <label>
                                <input type="checkbox" ng-model="options.dimensionsType.citern"> Citerne
                            </label>
                        </div>
                        <div class="checkbox col-xs-offset-1" ng-show="options.dimensions">
                            <label>
                                <input type="checkbox" ng-model="options.dimensionsType.flanc"> Flanc
                            </label>
                        </div>
                        <div class="checkbox col-xs-offset-1" ng-show="options.dimensions">
                            <label>
                                <input type="checkbox" ng-model="options.dimensionsType.fond"> Fond
                            </label>
                        </div>
                        <div class="checkbox col-xs-offset-1" ng-show="options.dimensions">
                            <label>
                                <input type="checkbox" ng-model="options.dimensionsType.tropPlein"> Trop Plein
                            </label>
                        </div>
                        <div class="checkbox col-xs-offset-1" ng-show="options.dimensions">
                            <label>
                                <input type="checkbox" ng-model="options.dimensionsType.event"> Event
                            </label>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="options.axes"> Afficher les axes
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="options.marquage"> Afficher le marquage
                        </label>
                        <div class="radio col-xs-offset-1" ng-show="options.marquage">
                            <label>
                                <input type="radio" name="marquage" value="top" ng-model="options.marquagePosition">
                                Haut
                            </label>
                        </div>
                        <div class="radio col-xs-offset-1" ng-show="options.marquage">
                            <label>
                                <input type="radio" name="marquage" value="right" ng-model="options.marquagePosition">
                                Droite
                            </label>
                        </div>
                        <div class="radio col-xs-offset-1" ng-show="options.marquage">
                            <label>
                                <input type="radio" name="marquage" value="bottom" ng-model="options.marquagePosition">
                                Bas
                            </label>
                        </div>
                        <div class="radio col-xs-offset-1" ng-show="options.marquage">
                            <label>
                                <input type="radio" name="marquage" value="left" ng-model="options.marquagePosition">
                                Gauche
                            </label>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="options.enroulement"> Fleche d'enroulement
                        </label>
                        <div class="radio col-xs-offset-1" ng-show="options.enroulement">
                            <label>
                                <input type="radio" name="enroulement" value="1" ng-model="options.enroulementDirection">
                                Vers la droite
                            </label>
                        </div>
                        <div class="radio col-xs-offset-1" ng-show="options.enroulement">
                            <label>
                                <input type="radio" name="enroulement" value="-1" ng-model="options.enroulementDirection">
                                Vers la gauche
                            </label>
                        </div>
                    </div>
                </div>
            </div>








            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Pièces</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Libellé</th>
                            <th>Tarif HT unitaire</th>
                            <th>Type de position</th>
                            <th>Position</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="produit in produits | orderBy:'type_position'">
                            <td>{{produit.article.ref}}</td>
                            <td>{{produit.article.nom}}</td>
                            <td>{{produit.article.prix_ht | currency:'€':2}}</td>
                            <td class="text-left">{{produit.type_position}}</td>
                            <td class="text-left">{{ findPosition(produit) }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" ng-click="deleteProduit(produit, 'produit')">
                                    Supprimer
                                </button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Accessoires</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Ref</th>
                            <th>Libellé</th>
                            <th>Tarif HT unitaire</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="accessoire in accessoires">
                            <td>{{accessoire.article.ref}}</td>
                            <td>{{accessoire.article.nom}}</td>
                            <td>{{accessoire.article.prix_ht | currency:'€':2}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" ng-click="deleteProduit(accessoire, 'accessoire')">
                                    Supprimer
                                </button>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary" ng-click="pdf()">Obtenir le PDF</button>
                    <button type="button" class="btn btn-default btn-sm" ng-click="cancel()">retour</button>
                </div>
            </div>



        </div>
    </form>
</div>