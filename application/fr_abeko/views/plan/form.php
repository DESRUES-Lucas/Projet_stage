<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > plan</div>
<div id="content">


    <!-- 0) Fil d'arianne -->
    <div class="row" ng-show="fil_arianne != ''">
        <div class="col-md-12">
            {{fil_arianne}}
        </div>
    </div>



    <!-- 1) choix du type de citerne -->
    <div class="row" ng-show="etape == 1">
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Veuillez choisir un type de citerne</h3>

                        <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="citernes_types.length">

                            <tbody>
                            <tr ng-repeat="citerne_type in citernes_types">
                                <td><a href="#" ng-click="choix_citerne(citerne_type.id)">{{citerne_type.nom}}</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>





    <!-- 2) choix du tarif -->
    <div class="row" ng-show="etape == 2">
        <div class="col-md-12">
            <h3>Veuillez choisir un tarif</h3>

            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="tarifs.length">
                <tbody>
                <tr ng-repeat="tarif in tarifs">
                    <td><a href="#" ng-click="choix_tarif(tarif.id)">{{tarif.nom}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>





    <!-- 3) choix du nombre de m3 -->
    <div class="row" ng-show="etape == 3">
        <div class="col-md-12">
            <h3>Veuillez choisir un volume</h3>

            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="m3.length">
                <tbody>
                <tr ng-repeat="volume in m3">
                    <td><a href="#" ng-click="choix_volume(volume)">{{volume}} m<sup>3</sup></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>






    <!-- 4) choix des dimensions -->
    <div class="row" ng-show="etape == 4">
        <div class="col-md-12">
            <h3>Veuillez choisir une taille</h3>

            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="dimensions.length">
                <tbody>
                <tr ng-repeat="dimension in dimensions">
                    <td><a href="#" ng-click="choix_dimension(dimension.id)">{{dimension.largeur}} x {{dimension.profondeur}} m.</sup></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>







    <!-- 5) Nom du plan -->
    <div class="row" ng-show="etape == 5">
        <div class="col-md-12">
            <h3>Veuillez donner un nom au plan</h3>

            <form>
                <div class="form-group">
                    <label>Nom :</label>
                    <input type="text" class="form-control" ng-model="form.nom">
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-primary" ng-click="enregistrer()">Enregistrer</button>
                </div>

            </form>

        </div>
    </div>






    <!-- 99) message d'erreur -->
    <div class="row" ng-show="etape == 99">
        <div class="col-md-12">
            <h3>{{msgErreur}}</h3>
        </div>
    </div>


</div>