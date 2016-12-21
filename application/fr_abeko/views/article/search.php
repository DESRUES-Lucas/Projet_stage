<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb"> Abeko > <span i8n="Articles de base"></span></div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/fr_abeko/article/new" class="btn btn-primary" i8n="Nouvel article"></a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="articles.length">
                <thead>
                <tr>
                    <th i8n="Référence"></th>
                    <th i8n="Référence fournisseur"></th>
                    <th i8n="Libellé de l'article"></th>
                    <th i8n="Tarif HT"></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="article in articles">
                    <td><a href="/ng/fr_abeko/article/{{article.id}}">{{article.reference}}</a></td>
                    <td><a href="/ng/fr_abeko/article/{{article.id}}">{{article.reference_fournisseur}}</a></td>
                    <td><a href="/ng/fr_abeko/article/{{article.id}}">{{article.libelle}}</a></td>
                    <td><a href="/ng/fr_abeko/article/{{article.id}}">{{article.prix_achat_ht}}</a></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" ng-click="duplicate(article.id)" i8n="Dupliquer"></button>
                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(article.id)" i8n="Supprimer"></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>