<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > Articles composés</div>
<div id="content">


    <div class="row">
        <div class="col-md-12">
            <a href="/ng/fr_abeko/article_compose/new" class="btn btn-primary">Nouvel article</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="articles.length">
                <thead>
                <tr>
                    <th>Code produit</th>
                    <th>Libellé de l'article</th>
                    <th>Tarif HT</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="article in articles">
                    <td><a href="/ng/fr_abeko/article_compose/{{article.id}}">{{article.ref}}</a></td>
                    <td><a href="/ng/fr_abeko/article_compose/{{article.id}}">{{article.nom}}</a></td>
                    <td><a href="/ng/fr_abeko/article_compose/{{article.id}}">{{article.prix_ht}}</a></td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" ng-click="duplicate(article.id)">Dupliquer</button>
                        <button type="button" class="btn btn-danger btn-sm" ng-click="delete(article.id)">Supprimer</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>