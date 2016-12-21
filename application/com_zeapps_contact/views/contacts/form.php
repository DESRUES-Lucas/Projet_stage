<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb" i8n="Contacts"></div>
<div id="content">


    <form>
        <div class="well">
            <div class="row">
                <div class="col-md-6">



                    <div class="form-group">
                        <label i8n="Salutation"></label>
                        <select ng-model="form.title_name" class="form-control">
                            <option value="M." i8n="M."></option>
                            <option value="Mme" i8n="Mme"></option>
                            <option value="Mlle" i8n="Mlle"></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label i8n="Prénom"></label>
                        <input type="text" ng-model="form.first_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Nom"></label>
                        <input type="text" ng-model="form.last_name" class="form-control">
                    </div>





                    <div class="form-group">
                        <label i8n="Société"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_company" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_company">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCompany()"
                                        ng-show="form.id_company != 0 && form.id_company != undefined">x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCompany()">...</button>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label i8n="Email"></label>
                        <input type="text" ng-model="form.email" class="form-control">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="form.email_opt_out" i8n="Rejet des mails">
                        </label>
                    </div>

                    <div class="form-group">
                        <label i8n="Mobile"></label>
                        <input type="text" ng-model="form.mobile" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Téléphone"></label>
                        <input type="text" ng-model="form.phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Autre téléphone"></label>
                        <input type="text" ng-model="form.other_phone" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Télécopie"></label>
                        <input type="text" ng-model="form.fax" class="form-control">
                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group">
                        <label i8n="Gestionnaire du Compte"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.name_user_account_manager" class="form-control" disabled>
                            <input type="hidden" ng-model="form.id_user_account_manager">

                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeAccountManager()"
                                        ng-show="form.id_user_account_manager != 0 && form.id_user_account_manager != undefined">x
                                </button>
                                <button class="btn btn-default" type="button" ng-click="loadAccountManager()">...</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label i8n="Service"></label>
                        <input type="text" ng-model="form.department" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Fonction"></label>
                        <input type="text" ng-model="form.job" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Assistant"></label>
                        <input type="text" ng-model="form.assistant" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Assistant téléphone"></label>
                        <input type="text" ng-model="form.assistant_phone" class="form-control">
                    </div>




                    <div class="form-group">
                        <label>Skype ID</label>
                        <input type="text" ng-model="form.skype_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" ng-model="form.twitter" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Date de naissance"></label>
                        <input type="date" ng-model="form.date_of_birth" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="URL du site web"></label>
                        <input type="text" ng-model="form.website_url" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Compte comptable"></label>
                        <input type="text" ng-model="form.accounting_number" class="form-control">
                    </div>

                </div>
            </div>
        </div>



        <div class="well">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label i8n="Adresse de facturation"></label>
                        <input type="text" ng-model="form.address_1" class="form-control">
                        <input type="text" ng-model="form.address_2" class="form-control">
                        <input type="text" ng-model="form.address_3" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="État"></label>
                        <input type="text" ng-model="form.state" class="form-control">
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label i8n="Code postal"></label>
                        <input type="text" ng-model="form.zipcode" class="form-control">
                    </div>

                    <div class="form-group">
                        <label i8n="Ville"></label>
                        <input type="text" ng-model="form.city" class="form-control">
                    </div>



                    <div class="form-group">
                        <label i8n="Pays"></label>
                        <div class="input-group">
                            <input type="text" ng-model="form.country_lang_name" class="form-control" disabled>


                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="removeCountryLang()"
                                        <!--ng-show="form.country_lang != '' && form.country_lang != undefined"-->x
                                </button>
                            <button class="btn btn-default" type="button" ng-click="loadCountryLang()">...</button>
                            </span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="well">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label i8n="Commentaire"></label>
                        <textarea class="form-control" rows="3" ng-model="form.comment"></textarea>
                    </div>
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-success" ng-click="save()" i8n="Enregistrer"></button>
                <button type="button" class="btn btn-default btn-sm" ng-click="cancel()" i8n="Annuler"></button>
            </div>
        </div>
    </form>


</div>