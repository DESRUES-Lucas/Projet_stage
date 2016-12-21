<div class="modal-header meetingapp-modal-header">
    <h3 class="modal-title" i8n="Nouveau Participant"></h3>
</div>

<div id="content">



    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-condensed table-responsive" >
                <thead>
                    <tr>
                        <th i8n="Nom"></th>
                        <th i8n="Prénom"></th>
                        <th i8n="Email"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr  ng-repeat="user in users">
                        <td ng-click="addParticipant(user.id)" class="pointer">{{user.lastname}}</a></td>
                        <td ng-click="addParticipant(user.id)" class="pointer">{{user.firstname}}</td>
                        <td ng-click="addParticipant(user.id)" class="pointer">{{user.email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


</div>