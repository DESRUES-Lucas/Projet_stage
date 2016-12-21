<div class="modal-header meetingapp-modal-header">
    <h3 class="modal-title" i8n="Nouvelle réunion"></h3>
</div>


<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label i8n="Nom de la réunion"></label>
                <input type="text" ng-model="form.name" class="form-control" required/>
            </div>
            <div class="form-group">
                <label i8n="Description"></label>
                <textarea type="text" ng-model="form.description" class="form-control" ></textarea>
            </div>
            <div class="form-group">
                <label i8n="Date"></label>
                <input type="date" ng-model="form.date_meet" class="form-control" required/>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" class="btn btn-success" ng-click="save()" value="Enregistrer"/>
    <button class="btn btn-danger" type="button" ng-click="cancel()">Annuler</button>
</div>