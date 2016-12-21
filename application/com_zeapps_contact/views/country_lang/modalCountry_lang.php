<div class="modal-header">
    <h3 class="modal-title">{{titre}}</h3>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="country_lang.length">
                <thead>
                <tr>
                    <th i8n="Pays"></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="country in country_lang">
                    <td><a href="#" ng-click="loadCountryLang(country.id_country)">{{country.name}}</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-danger" type="button" ng-click="cancel()" i8n="Annuler"></button>
</div>