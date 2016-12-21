<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="breadcrumb">Abeko > plan</div>
<div id="content">


    <form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <h4>Dimensions</h4>
                    <div class="form-group">
                        <label>Longueur : (m)</label>
                        <input type="text" class="form-control updateDrawMap" id="longueur" value="5">
                    </div>
                    <div class="form-group">
                        <label>Largeur : (m)</label>
                        <input type="text" class="form-control updateDrawMap" id="largeur" value="2,5">
                    </div>

                    <div class="form-group">
                        <label>ø position : (mm)</label>
                        <input type="text" class="form-control updateDrawMap" id="diametre_position" value="100">
                    </div>
                </div>


                <div class="col-md-3">
                    <h4>Positions maxi</h4>
                    <div class="form-group">
                        <label>Longueur</label>
                        <input type="text" class="form-control updateDrawMap" id="nb_position_longueur" value="4">
                    </div>
                    <div class="form-group">
                        <label>Largeur</label>
                        <input type="text" class="form-control updateDrawMap" id="nb_position_largeur" value="3">
                    </div>
                </div>

                <div class="col-md-3">
                    <h4>Espace entre positions mini (mm)</h4>
                    <div class="form-group">
                        <label>Longueur</label>
                        <input type="text" class="form-control updateDrawMap" id="espace_position_longueur" value="1500">
                    </div>
                    <div class="form-group">
                        <label>Largeur</label>
                        <input type="text" class="form-control updateDrawMap" id="espace_position_largeur" value="1500">
                    </div>
                </div>


                <div class="col-md-3">
                    <h4>Espace entre positions et bordure (mm)</h4>
                    <div class="form-group">
                        <label>Longueur</label>
                        <input type="text" class="form-control updateDrawMap" id="espace_bordure_position_longueur" value="200">
                    </div>
                    <div class="form-group">
                        <label>Largeur</label>
                        <input type="text" class="form-control updateDrawMap" id="espace_bordure_position_largeur" value="200">
                    </div>
                </div>


            </div>


            <div class="row" id="ligne_plan">
                <div class="col-md-8">
                    <canvas id="plan" width="640" height="500" style="background-color: #ffffff;width: 100%"></canvas>
                </div>
                <div class="col-md-4">
                    <table class="table table-bordered table-striped table-condensed table-responsive" ng-show="tabPointPiece.length">
                        <thead>
                        <tr>
                            <th>Pt</th>
                            <th>Pièce</th>
                            <th>Qte</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="piece in tabPointPiece">
                            <td>{{piece.idPoint}}</td>
                            <td>{{piece.libelle}}</td>
                            <td>{{piece.qte}}</td>
                            <td class="pointerToDelete" ng-click="removePiece(piece.idTemp)">Supp.</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>





        </div>
    </form>




</div>