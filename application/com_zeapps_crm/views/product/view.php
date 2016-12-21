<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Produits"></div>
<div id="content">

    <div class="row">
        <div class="col-md-3">
            <div class="well">
                <zeapps-happylittletree
                    data-tree="tree.branches"
                    data-active-branch="activeCategory"
                </zeapps-happylittletree>
            </div>
        </div>

        <div class="col-md-9">
            <div class="clearfix">
                <div class="pull-right">
                    <a class='text-success add-new-branch' ng-href='/ng/com_zeapps_crm/product/new_category/{{ activeCategory.data.id || 0 }}'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span><span i8n="Sous-categorie"></span></a>
                    <a class='text-success add-new-leaf' ng-href='/ng/com_zeapps_crm/product/new_product/{{ activeCategory.data.id || 0 }}'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span><span i8n="Produit"></span></a>
                </div>
                <h3 class="text-capitalize active-category-title">
                    {{ activeCategory.data.name }}
                    <a class="no-deco faded" ng-href="/ng/com_zeapps_crm/product/category/{{ activeCategory.data.id }}/edit" ng-show="activeCategory.data.id > 0">
                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                    </a>
                    <a class="no-deco faded" ng-href="/ng/com_zeapps_crm/product/category/{{ activeCategory.data.id }}/delete" ng-show="activeCategory.data.id > 0">
                        <span class="glyphicon glyphicon-trash text-danger"></span>
                    </a>
                </h3>
                <div class="row" ng-show="activeCategory.data.branches">
                    <h5 i8n="Sous-Categories"></h5>
                    <ul ui-sortable="sortableOptions" id="sortable" class="branch-list list-unstyled col-md-4" ng-model="activeCategory.data.branches">
                        <li id="{{ branch.id }}" class="branch branch-sortable" ng-repeat="branch in activeCategory.data.branches">
                            <span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>
                            {{ branch.name }} <i>({{ branch.nb_products }} produit<span ng-show="branch.nb_products > 1">s</span>)</i>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-3 pull-right">
                        <input class="form-control" type="text" ng-model="quicksearch" placeholder="Recherche rapide">
                    </div>
                    <h5 i8n="Produits"></h5>
                    <table class="table table-striped">
                        <tr>
                            <th i8n="Nom du produit"></th>
                            <th i8n="Prix"></th>
                            <th i8n="Compte comptable"></th>
                            <th i8n="TVA"></th>
                            <th i8n="Modifier"></th>
                            <th i8n="Supprimer"></th>
                        </tr>
                        <tr class="leaf" ng-repeat="product in products | filter:quicksearch | orderBy: 'name'">
                            <td><a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}">{{ product.name }}</a></td>
                            <td><a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}">{{ product.price | currency }}</a></td>
                            <td><a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}">{{ product.account }}</a></td>
                            <td><a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}">{{ product.taxe }}</a></td>
                            <td><a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}/edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            <td><a ng-href="/ng/com_zeapps_crm/product/{{ product.id }}/delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>