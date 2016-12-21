<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Devis"></div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <div class="titleWell" i8n="Devis"> : 2016-07-1233</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs" ng-click="cancel()"><span class="glyphicon glyphicon-arrow-left"></span></button>
                        <button type="button" class="btn btn-success btn-xs" ng-click="edit()"><span class="glyphicon glyphicon-pencil"></span></button>


                        <div class="btn-group btn-group-xs" role="group" ng-if="nb_result > 0">
                            <button type="button" class="btn btn-default" ng-class="result_first == 0 ? 'disabled' :''" ng-click="first_result()"><span class="glyphicon glyphicon-fast-backward"></span></button>
                            <button type="button" class="btn btn-default" ng-class="result_previous == 0 ? 'disabled' :''" ng-click="previous_result()"><span class="glyphicon glyphicon-chevron-left"></span></button>
                            <button type="button" class="btn btn-default disabled">{{result_order}}/{{nb_result}}</button>
                            <button type="button" class="btn btn-default" ng-class="result_next == 0 ? 'disabled' :''" ng-click="next_result()"><span class="glyphicon glyphicon-chevron-right"></span></button>
                            <button type="button" class="btn btn-default" ng-class="result_last == 0 ? 'disabled' :''" ng-click="last_result()"><span class="glyphicon glyphicon-fast-forward"></span></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <div class="col-md-6">
            <div class="well">
                <strong i8n="Adresse de facturation"> :</strong><br>
                R-Numerique<br>
                Nicolas Ramel<br>
                81 mail Francois Mitterrand<br>
                35000 Rennes
            </div>
        </div>

        <div class="col-md-6">
            <div class="well">
                <strong i8n="Adresse de livraison"> :</strong><br>
                R-Numerique<br>
                Nicolas Ramel<br>
                81 mail Francois Mitterrand<br>
                35000 Rennes
            </div>
        </div>


        <ul df-tab-menu menu-control="{{navigationState}}" theme="bootstrap" role="tablist"
            class="df-tab-menu nav nav-tabs">
            <li data-menu-item="body"><a href="#" data-ng-click="navigationState = 'body'" i8n="Corps"></a></li>
            <li data-menu-item="header"><a href="#" data-ng-click="navigationState = 'header'" i8n="Entête"></a></li>
            <li data-menu-item="condition"><a href="#" data-ng-click="navigationState = 'condition'" i8n="Conditions"></a></li>
            <li data-menu-item="activity"><a href="#" data-ng-click="navigationState = 'activity'" i8n="Activité"></a></li>
            <li data-menu-item="document"><a href="#" data-ng-click="navigationState = 'document'"i8n="Documents"></a></li>

            <li data-more-menu-item><a class="btn btn-primary"><span class="glyphicon glyphicon-menu-down"></span></a>
            </li>
        </ul>


        <div ng-show="navigationState=='body'">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped table-condensed table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th i8n="Désignation"></th>
                            <th i8n="Quantité"></th>
                            <th i8n="Remise"></th>
                            <th i8n="Prix unitaire"></th>
                            <th i8n="Montant HT"></th>
                            <th i8n="Montant TTC"></th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>ABC12</td>
                            <td><strong>Site Internet :</strong><br>
                                Conception graphique<br>
                                Developpement<br>
                                Référencement
                            </td>
                            <td class="text-right">1</td>
                            <td class="text-right">0%</td>
                            <td class="text-right">1&nbsp;500 €</td>
                            <td class="text-right">1&nbsp;500 €</td>
                            <td class="text-right">1&nbsp;800 €</td>

                            <td class="text-right">
                                <button type="button" class="btn btn-success btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-pencil"></span></button>
                                <button type="button" class="btn btn-danger btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td>ABC12</td>
                            <td><strong>Site Internet :</strong><br>
                                Conception graphique<br>
                                Developpement<br>
                                Référencement
                            </td>
                            <td class="text-right">1</td>
                            <td class="text-right">0%</td>
                            <td class="text-right">1&nbsp;500 €</td>
                            <td class="text-right">1&nbsp;500 €</td>
                            <td class="text-right">1&nbsp;800 €</td>

                            <td class="text-right">
                                <button type="button" class="btn btn-success btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-pencil"></span></button>
                                <button type="button" class="btn btn-danger btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                        <tr class="sous-total">
                            <td colspan="5" class="text-right" i8n="Sous-Total"></td>
                            <td class="text-right">3&nbsp;000 €</td>
                            <td class="text-right">4&nbsp;600 €</td>

                            <td class="text-right">
                                <button type="button" class="btn btn-danger btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                        <tr>
                            <td>ABC12</td>
                            <td><strong>Site Internet :</strong><br>
                                Conception graphique<br>
                                Developpement<br>
                                Référencement
                            </td>
                            <td class="text-right">1</td>
                            <td class="text-right">0%</td>
                            <td class="text-right">1&nbsp;500 €</td>
                            <td class="text-right">1&nbsp;500 €</td>
                            <td class="text-right">1&nbsp;800 €</td>

                            <td class="text-right">
                                <button type="button" class="btn btn-success btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-pencil"></span></button>
                                <button type="button" class="btn btn-danger btn-sm" ng-click=""><span
                                        class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-6" i8n="Total HT avant remise">

                            </div>
                            <div class="col-md-6 text-right">
                                99 999,99 €
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" i8n="Total TTC avant remise">

                            </div>
                            <div class="col-md-6 text-right">
                                99 999,99 €
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6" i8n="Remise">

                            </div>
                            <div class="col-md-6 text-right">
                                99 999,99 €
                            </div>
                        </div>

                        <hr>

                        <div class="row total">
                            <div class="col-md-6" i8n="Total HT">

                            </div>
                            <div class="col-md-6 text-right">
                                99 999,99 €
                            </div>
                        </div>

                        <div class="row total">
                            <div class="col-md-6" i8n="Total TTC">

                            </div>
                            <div class="col-md-6 text-right">
                                99 999,99 €
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </form>


</div>