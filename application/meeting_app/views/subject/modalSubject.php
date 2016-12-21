<div class="modal-header meetingapp-modal-header">
    <h3 class="modal-title" i8n="Nouveau Sujet"></h3>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label i8n="Nom du Projet"></label>
                <input type="text" ng-model="form.name" class="form-control" required/>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" class="btn btn-success" ng-click="save()" value="Enregistrer"/>
    <button class="btn btn-danger" type="button" ng-click="cancel()">Annuler</button>
</div>