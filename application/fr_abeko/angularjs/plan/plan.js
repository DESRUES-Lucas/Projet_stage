app.directive('planCitern',
    function($rootScope, $timeout){
        return{
            restrict: 'E',
            replace: true,
            scope: {
                positions: '=',
                produits: '=',
                options: '=',
                ajoutProduit: '&',
                del: '&',
                updatePositions: '&'
            },
            template:   "<div>" +
                            "<canvas id='plan' width='640' height='500' style='background-color: #ffffff;width: 100%'></canvas>" +
                            "<div class='form-group' ng-show='selectedDimension && options.dimensions'>" +
                                "<label for='dimensionValue'>Position pour {{ selectedDimension.name }} sur la {{ (selectedDimension.axis == 'x') ? 'profondeur' : 'largeur' }} </label>" +
                                "<span class='input-group'>" +
                                    "<div class='input-group-addon'>mm</div>" +
                                    "<input type='number' min='0' id='dimensionValue' class='form-control' ng-model='selectedDimension.value'>" +
                                    "<span class='input-group-btn'>" +
                                        "<button class='btn btn-success' ng-click='updateSize()'>Valider</button>" +
                                    "</span>" +
                                "</span>" +
                            "</div>" +
                            "<div ng-show='clickedPosition'>" +
                                "<button class='btn btn-sm btn-success' ng-click='ajoutProduit()(clickedPosition.id, clickedPosition.type_position)' ng-show='clickedPosition && !hasProduct(clickedPosition)'>Placer un produit sur la position</button>" +
                                "<button class='btn btn-sm btn-danger' ng-click='delPosition()'>Supprimer la position</button>" +
                            "</div>" +
                        "</div>",
            link: function(scope){

                scope.$watch('positions', function(value, oldValue){
                    if(value != undefined && value != oldValue){
                        getMeasurementsCoordinates();
                        drawMap();
                        scope.updatePositions()();
                    }
                }, true);

                scope.$watch('options', function(value, oldValue){
                    if(value != undefined && value != oldValue){
                        longueur_mm = parseFloat(scope.options.profondeur).toFixed(3)*1000;
                        largeur_mm = parseFloat(scope.options.largeur).toFixed(3)*1000;
                        getMeasurementsCoordinates();
                        drawMap();
                    }
                }, true);

                scope.$watch('produits', function(value, oldValue){
                    if(value != undefined && value != oldValue){
                        getMeasurementsCoordinates();
                        drawMap();
                    }
                }, true);

                scope.$on("$destroy", function() {
                    $(window).off("resize");
                });

                $(window).resize(function () {
                    drawMap() ;
                });

                scope.updateSize = function(){
                    var oldValue = Math.round(scope.selectedDimension.position.coordinates['axis' + scope.selectedDimension.axis.toUpperCase()].size / coef);
                    var variation = oldValue - scope.selectedDimension.value;
                    var positionFinal = scope.selectedDimension.position[scope.selectedDimension.axis] - variation;
                    if(positionFinal > 0 &&
                        ( (scope.selectedDimension.axis == 'x' && positionFinal < longueur_mm) ||
                        (scope.selectedDimension.axis == 'y' && positionFinal < largeur_mm) )) {
                        scope.selectedDimension.position[scope.selectedDimension.axis] = positionFinal;
                        scope.updatePositions()();
                    }
                };

                scope.delPosition = function(){
                    scope.del()(scope.clickedPosition).then(function(){
                        if ($rootScope.$$phase) {
                            scope.$evalAsync(function(){
                                scope.clickedPosition = false;
                            });
                        } else {
                            scope.$apply(function(){
                                scope.clickedPosition = false;
                            });
                        }
                        drawMap();
                    });
                };


                /************* paramètre *************/
                // FUCK THOSE SHITS
                var marge_gauche = 60 ;
                var marge_droite = 60 ;
                var marge_haut = 60 ;
                var marge_bas = 60 ;
                /************* END : paramètre *************/




                /************* initialisation de variable *************/
                var coef = 1;
                var grabbedPosition = false;
                var dragging;
                var longueur_mm = 5000;
                var largeur_mm = 2500;
                var canvasSize_x = longueur_mm * coef;
                var canvasSize_y = largeur_mm * coef;
                /************* END : initialisation de variable *************/

                function sqr(a) {
                    return a*a;
                }

                scope.hasProduct = function(position){
                    for (var j = 0 ; j < scope.produits.length ; j++) {
                        if (position.id == scope.produits[j].id_position) {
                            return true;
                        }
                    }
                    return false;
                };

                scope.getMeasurementCoordinates = function(x,y,x2,y2){

                    var coordinates = {
                        axisX : {
                            x: 0,
                            y: 0,
                            size: 0
                        },
                        axisY : {
                            x: 0,
                            y: 0,
                            size: 0
                        }
                    };

                    coordinates.axisX.size = Math.abs(x2 - x);
                    coordinates.axisY.size = Math.abs(y2 - y);

                    coordinates.axisX.x = (x2 - x) / 2 + x;
                    coordinates.axisX.y = y2;

                    coordinates.axisY.x = x2;
                    coordinates.axisY.y = (y2 - y) / 2 + y;

                    return coordinates;
                };

                var getMeasurementsCoordinates = function(){

                    var coordinate;
                    var x; var x_previous;
                    var y; var y_previous;
                    var i;

                    // event
                    for(i=0;i<scope.positions.event.length;i++){
                        if( ( scope.options.only_active && scope.hasProduct(scope.positions.event[i]) ) || !scope.options.only_active) {
                            x = scope.positions.event[i].x * coef;
                            y = scope.positions.event[i].y * coef;
                            coordinate = scope.getMeasurementCoordinates(0, 0, x, y);
                            scope.positions.event[i].coordinates = coordinate;
                        }
                        else{
                            delete scope.positions.event[i].coordinates;
                        }
                    }

                    // tropPlein
                    for(i=0;i<scope.positions.tropPlein.length;i++){
                        if( ( scope.options.only_active && scope.hasProduct(scope.positions.tropPlein[i]) ) || !scope.options.only_active) {
                            x = scope.positions.tropPlein[i].x * coef;
                            y = scope.positions.tropPlein[i].y * coef;
                            if( x > canvasSize_x / 2 ){
                                coordinate = scope.getMeasurementCoordinates(canvasSize_x, 0, x, y);
                            }
                            else{
                                coordinate = scope.getMeasurementCoordinates(0, 0, x, y);
                            }
                            scope.positions.tropPlein[i].coordinates = coordinate;
                        }
                        else{
                            delete scope.positions.tropPlein[i].coordinates;
                        }
                    }

                    // fond
                    for(i=0;i<scope.positions.fond.length;i++){
                        if( ( scope.options.only_active && scope.hasProduct(scope.positions.fond[i]) ) || !scope.options.only_active) {
                            x = scope.positions.fond[i].x * coef;
                            y = scope.positions.fond[i].y * coef;
                            coordinate = scope.getMeasurementCoordinates(0, 0, x, y);
                            scope.positions.fond[i].coordinates = coordinate;
                        }
                        else{
                            delete scope.positions.fond[i].coordinates;
                        }
                    }

                    // flanc
                    var haut = [];var bas = [];var gauche = [];var droite = [];
                    // sort them by side
                    for(i=0;i<scope.positions.flanc.length;i++){
                        if( ( scope.options.only_active && scope.hasProduct(scope.positions.flanc[i]) ) || !scope.options.only_active) {
                            if (scope.positions.flanc[i].x == 0) {
                                gauche.push(scope.positions.flanc[i]);
                            }
                            else if (scope.positions.flanc[i].x == longueur_mm) {
                                droite.push(scope.positions.flanc[i]);
                            }
                            else if (scope.positions.flanc[i].y == 0) {
                                haut.push(scope.positions.flanc[i]);
                            }
                            else if (scope.positions.flanc[i].y == largeur_mm) {
                                bas.push(scope.positions.flanc[i]);
                            }
                        }
                        else{
                            delete scope.positions.flanc[i].coordinates;
                        }
                    }
                    // then sort them by distance from the origin and get measurement from one point to the next
                    gauche.sort(function(a,b){ return a.y - b.y;});
                    droite.sort(function(a,b){ return a.y - b.y;});
                    haut.sort(function(a,b){ return a.x - b.x;});
                    bas.sort(function(a,b){ return a.x - b.x;});
                    for(i=0; i<gauche.length;i++){
                        x = gauche[i].x * coef;
                        y = gauche[i].y * coef;
                        if(i == 0){
                            coordinate = scope.getMeasurementCoordinates(0, 0, x, y);
                            gauche[i].coordinates = coordinate;
                        }
                        else{
                            x_previous = gauche[i-1].x * coef;
                            y_previous = gauche[i-1].y * coef;
                            coordinate = scope.getMeasurementCoordinates(x_previous, y_previous, x, y);
                            gauche[i].coordinates = coordinate;
                        }
                    }
                    for(i=0; i<droite.length;i++){
                        x = droite[i].x * coef;
                        y = droite[i].y * coef;
                        if(i == 0){
                            coordinate = scope.getMeasurementCoordinates(canvasSize_x, 0, x, y);
                            droite[i].coordinates = coordinate;
                        }
                        else{
                            x_previous = droite[i-1].x * coef;
                            y_previous = droite[i-1].y * coef;
                            coordinate = scope.getMeasurementCoordinates(x_previous, y_previous, x, y);
                            droite[i].coordinates = coordinate;
                        }
                    }
                    for(i=0; i<haut.length;i++){
                        x = haut[i].x * coef ;
                        y = haut[i].y * coef ;
                        if(i == 0){
                            coordinate = scope.getMeasurementCoordinates(0, 0, x, y);
                            haut[i].coordinates = coordinate;
                        }
                        else{
                            x_previous = haut[i-1].x * coef;
                            y_previous = haut[i-1].y * coef;
                            coordinate = scope.getMeasurementCoordinates(x_previous, y_previous, x, y);
                            haut[i].coordinates = coordinate;
                        }
                    }
                    for(i=0; i<bas.length;i++){
                        x = bas[i].x * coef ;
                        y = bas[i].y * coef ;
                        if(i == 0){
                            coordinate = scope.getMeasurementCoordinates(0, canvasSize_y, x, y);
                            bas[i].coordinates = coordinate;
                        }
                        else{
                            x_previous = bas[i-1].x * coef ;
                            y_previous = bas[i-1].y * coef ;
                            coordinate = scope.getMeasurementCoordinates(x_previous, y_previous, x, y);
                            bas[i].coordinates = coordinate;
                        }
                    }
                };

                function drawPosition(ctx, x, y, rayon, info, couleurFond, couleurBordure, lineWidth) {
                    if (rayon < 10) {
                        rayon = 10 ;
                    }


                    ctx.font = "10pt verdana";
                    ctx.textAlign = 'center';
                    ctx.strokeStyle = couleurBordure;
                    ctx.fillStyle = couleurFond;

                    ctx.beginPath();
                    ctx.lineWidth = lineWidth ;
                    ctx.arc(x, y, rayon, 0, Math.PI*2, true);
                    ctx.fill();
                    ctx.stroke();

                    // ecrit le n° de la position
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(info, x, y + 5);
                }


                function drawFond(ctx, x, y, largeur, info, couleurFond, couleurBordure, lineWidth) {
                    if (largeur < 10) {
                        largeur = 10 ;
                    }


                    ctx.font = "10pt verdana";
                    ctx.textAlign = 'center';
                    ctx.strokeStyle = couleurBordure;
                    ctx.fillStyle = couleurFond;

                    ctx.beginPath();
                    ctx.lineWidth = lineWidth ;
                    ctx.fillRect(x - (largeur/2), y - (largeur/2), largeur, largeur);
                    ctx.strokeRect(x - (largeur/2), y - (largeur/2), largeur, largeur);

                    // ecrit le n° de la position
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(info, x, y + 5);
                }

                function drawMarquage(ctx, position, largeur, canvasSize_x, canvasSize_y){
                    if (largeur < 10) {
                        largeur = 10 ;
                    }
                    var x = 0; var y = 0;

                    var text = 'M';

                    if(position == 'top'){
                        x = canvasSize_x/ 2 + marge_gauche;
                        y = marge_haut - largeur / 2 - 5;
                    }
                    else if(position == 'bottom'){
                        x = canvasSize_x/ 2 + marge_gauche;
                        y = marge_haut + canvasSize_y + largeur / 2 + 5;
                    }
                    else if(position == 'left'){
                        x = marge_gauche - largeur / 2 - 5;
                        y = canvasSize_y/ 2 + marge_haut;
                    }
                    else if(position == 'right'){
                        x = marge_gauche + canvasSize_x + largeur / 2 + 5;
                        y = canvasSize_y/2 + marge_haut;
                    }

                    ctx.font = "11pt verdana";
                    ctx.textAlign = 'center';
                    ctx.strokeStyle = "#DF3A01";
                    ctx.fillStyle = "#ffffff";

                    ctx.fillRect(x - (largeur/2), y - (largeur/2), largeur, largeur);
                    ctx.strokeRect(x - (largeur/2), y - (largeur/2), largeur, largeur);


                    ctx.fillStyle = "#DF3A01" ;
                    ctx.fillText(text, x, y + 5);

                    ctx.strokeStyle = "#000000";
                }

                function drawEnroulement(ctx, sens, canvasSize_x, canvasSize_y){

                    var text = '';

                    if(sens > 0){
                        text = "Sens d'enroulement --->";
                    }
                    else{
                        text = "<-- Sens d'enroulement";
                    }
                    var x = ( canvasSize_x - ctx.measureText(text).width + marge_gauche )/ 2; var y = canvasSize_y - 5;

                    ctx.font = "9pt verdana";
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(text, x, y);

                }

                function drawCiternMeasure(ctx, canvasSize_x, canvasSize_y) { // we are drawing both X and Y measures

                    // determine le centre de la droite
                    var xCentre = {
                        x: marge_gauche + canvasSize_x/2,
                        y: marge_haut/2
                    };
                    var yCentre = {
                        x: marge_gauche/2,
                        y: marge_haut + canvasSize_y/2
                    };

                    // Start by drawing X measurement

                    ctx.strokeStyle = "#0000A8";
                    ctx.fillStyle = "#000000";
                    ctx.textAlign = 'center';

                    if(canvasSize_x > 0) {
                        // main bar
                        ctx.beginPath();
                        ctx.moveTo(xCentre.x - (canvasSize_x / 2), xCentre.y);
                        ctx.lineTo(xCentre.x + (canvasSize_x / 2), xCentre.y);
                        ctx.fill();
                        ctx.stroke();
                        ctx.closePath();

                        if(scope.options.profondeur) {
                            // Value
                            ctx.font = "9pt verdana";
                            var profondeurReelle = parseFloat(scope.options.profondeur);
                            var textX = profondeurReelle.toFixed(3)*1000 + " mm";
                            ctx.fillText(textX, xCentre.x, xCentre.y - 2);
                        }
                    }

                    // Onto Y measurement

                    if(canvasSize_y > 0) {
                        // main bar
                        ctx.beginPath();
                        ctx.moveTo(yCentre.x, yCentre.y - (canvasSize_y / 2));
                        ctx.lineTo(yCentre.x, yCentre.y + (canvasSize_y / 2));
                        ctx.fill();
                        ctx.stroke();
                        ctx.closePath();

                        if(scope.options.largeur) {

                            // We do all of that to write it vertically !
                            ctx.save();

                            ctx.translate(yCentre.x, yCentre.y);
                            ctx.rotate(-Math.PI/2);

                            // Value
                            ctx.font = "9pt verdana";
                            var largeurReelle = parseFloat(scope.options.largeur);
                            var textY = largeurReelle.toFixed(3)*1000 + " mm";
                            ctx.fillText(textY, 0, -2);

                            ctx.restore();
                        }
                    }

                    ctx.strokeStyle = "#000000";
                    ctx.fillStyle = "#000000";
                }

                function drawMeasurementLines(ctx) {

                    angular.forEach(scope.positions, function(array, type_position){
                        if(scope.options.dimensionsType[type_position]) {
                            for (var i = 0; i < array.length; i++) {

                                if(array[i].coordinates != undefined) {

                                    // Start by drawing X measurement line

                                    ctx.strokeStyle = "#0000A8";
                                    ctx.lineWidth = 1;
                                    ctx.fillStyle = "#000000";
                                    ctx.textAlign = 'center';

                                    if (array[i].coordinates.axisX.size > 0) {
                                        // main bar
                                        ctx.beginPath();
                                        ctx.moveTo(array[i].coordinates.axisX.x - (array[i].coordinates.axisX.size / 2) + marge_gauche, array[i].coordinates.axisX.y + marge_haut);
                                        ctx.lineTo(array[i].coordinates.axisX.x + (array[i].coordinates.axisX.size / 2) + marge_gauche, array[i].coordinates.axisX.y + marge_haut);
                                        ctx.fill();
                                        ctx.stroke();
                                        ctx.closePath();
                                    }

                                    // Onto Y measurement line

                                    ctx.strokeStyle = "#0000A8";
                                    ctx.lineWidth = 1;
                                    ctx.fillStyle = "#000000";
                                    ctx.textAlign = 'center';

                                    if (array[i].coordinates.axisY.size > 0) {
                                        // main bar
                                        ctx.beginPath();
                                        ctx.moveTo(array[i].coordinates.axisY.x + marge_gauche, array[i].coordinates.axisY.y - (array[i].coordinates.axisY.size / 2) + marge_haut);
                                        ctx.lineTo(array[i].coordinates.axisY.x + marge_gauche, array[i].coordinates.axisY.y + (array[i].coordinates.axisY.size / 2) + marge_haut);
                                        ctx.fill();
                                        ctx.stroke();
                                        ctx.closePath();
                                    }

                                    ctx.strokeStyle = "#000000";
                                    ctx.fillStyle = "#000000";
                                }
                            }
                        }
                    });
                }

                function drawMeasurementValues(ctx) {

                    var axis;

                    angular.forEach(scope.positions, function(array, type_position){
                        if(scope.options.dimensionsType[type_position]) {
                            for (var i = 0; i < array.length; i++) {

                                if(scope.selectedDimension && array[i] == scope.selectedDimension.position) {
                                    axis = scope.selectedDimension.axis;
                                }
                                else{
                                    axis = '';
                                }

                                if(array[i].coordinates != undefined) {

                                    // Start by drawing X measurement value

                                    ctx.strokeStyle = "#0000A8";
                                    ctx.lineWidth = 1;
                                    ctx.fillStyle = "#000000";
                                    ctx.textAlign = 'center';

                                    if (array[i].coordinates.axisX.size > 0) {
                                        ctx.font = "9pt verdana";
                                        if (axis == 'x')
                                            ctx.fillStyle = "#ff0000";
                                        var profondeurReelle = Math.round(array[i].coordinates.axisX.size / coef);
                                        var textX = profondeurReelle + " mm";
                                        ctx.fillText(textX, array[i].coordinates.axisX.x + marge_gauche, array[i].coordinates.axisX.y - 2 + marge_haut);
                                    }

                                    // Onto Y measurement value

                                    ctx.strokeStyle = "#0000A8";
                                    ctx.lineWidth = 1;
                                    ctx.fillStyle = "#000000";
                                    ctx.textAlign = 'center';

                                    if (array[i].coordinates.axisY.size > 0) {
                                        // We do all of that to write it vertically !
                                        ctx.save();

                                        ctx.translate(array[i].coordinates.axisY.x + marge_gauche, array[i].coordinates.axisY.y + marge_haut);
                                        ctx.rotate(-Math.PI / 2);

                                        // Value
                                        ctx.font = "9pt verdana";
                                        if (axis == 'y')
                                            ctx.fillStyle = "#ff0000";
                                        var largeurReelle = Math.round(array[i].coordinates.axisY.size / coef);
                                        var textY = largeurReelle + " mm";
                                        ctx.fillText(textY, 0, -2);

                                        ctx.restore();
                                    }

                                    ctx.strokeStyle = "#000000";
                                    ctx.fillStyle = "#000000";
                                }
                            }
                        }
                    });
                }


                function drawAxes(ctx, canvasSize_x, canvasSize_y){

                    drawDashedLine(ctx, 0, canvasSize_y/2, canvasSize_x, canvasSize_y/2, 3, 3);
                    drawDashedLine(ctx, canvasSize_x/2, 0, canvasSize_x/2, canvasSize_y, 3, 3);

                }

                function drawDashedLine(ctx, x, y, x2, y2, dash, gap){

                    var step = dash + gap;

                    var distance = Math.sqrt(sqr(y2 - y) + sqr(x2 - x));

                    var current = {
                        x: x,
                        y: y
                    };

                    var xVariation = x2 - x != 0 ? 1 : 0;
                    var yVariation = y2 - y != 0 ? 1 : 0;

                    ctx.lineWidth = 1;
                    ctx.strokeStyle = "#999999";

                    ctx.beginPath();
                    ctx.moveTo(x, y);

                    while(distance > step){

                        current.x += xVariation * dash; current.y += yVariation * dash;
                        ctx.lineTo(current.x, current.y);
                        current.x += xVariation * gap; current.y += yVariation * gap;
                        ctx.moveTo(current.x, current.y);

                        distance -= step;
                    }

                    ctx.fill();
                    ctx.stroke();
                    ctx.closePath();

                    ctx.lineWidth = 2;
                    ctx.strokeStyle = "#000000";
                }


                function drawMap() {

                    var plan = $("#plan");

                    // pour fixer la taille du canvas sinon il fait un zoom
                    plan.attr("width", plan.width());
                    plan.attr("height", plan.height());


                    // on garde une mage de 20px (gauche et haut), 60px (droite et bas)
                    var taileMaxX = plan.width() - (marge_gauche + marge_droite);
                    var taileMaxY = plan.height() - (marge_haut + marge_bas);


                    // calcul du coef du plan
                    var coef_x = taileMaxX / longueur_mm;
                    var coef_y = taileMaxY / largeur_mm;


                    if (coef_x < coef_y) {
                        coef = coef_x;
                    } else {
                        coef = coef_y;
                    }

                    canvasSize_x = longueur_mm * coef;
                    canvasSize_y = largeur_mm * coef;

                    var canvasTotalSize_x = canvasSize_x + marge_gauche + marge_droite  ;
                    var canvasTotalSize_y = canvasSize_y + marge_haut + marge_bas ;

                    var moncanvas = document.getElementById("plan");
                    var ctx = moncanvas.getContext("2d");

                    // met un fond blanc
                    ctx.fillStyle = "#ffffff";
                    ctx.fillRect(0, 0, plan.width(), plan.height());

                    ctx.strokeStyle = "#000000";

                    if (coef) {

                        // dessine la limite de la bache
                        ctx.lineWidth = 2;
                        ctx.strokeRect(marge_gauche, marge_haut, canvasSize_x, canvasSize_y);

                        if(scope.options.axes)
                            drawAxes(ctx, canvasTotalSize_x, canvasTotalSize_y);

                        if(scope.options.enroulement)
                            drawEnroulement(ctx, scope.options.enroulementDirection, canvasSize_x, canvasTotalSize_y);

                        var largeurMarquage = canvasSize_x * 0.05 ;
                        if(scope.options.marquage)
                            drawMarquage(ctx, scope.options.marquagePosition, largeurMarquage, canvasSize_x, canvasSize_y);

                        if(scope.options.dimensions && scope.options.dimensionsType.citern)
                            drawCiternMeasure(ctx, canvasSize_x, canvasSize_y);

                        if(scope.options.dimensions)
                            drawMeasurementLines(ctx);

                        var couleurActif = "#00dd00" ;
                        var couleurInactif = "#ffffff" ;
                        var couleurBorderDefault = "#000000" ;
                        var couleurBorderSelected = "#ff0000" ;

                        angular.forEach(scope.positions, function(position, type_position){
                            for(var i = 0; i < position.length; i++){
                                var couleurFond = couleurInactif;
                                var couleurBorder = couleurBorderDefault;
                                var lineWidth = 1;
                                var x; var y; var largeurPoint;

                                if(scope.hasProduct(position[i]))
                                    couleurFond = couleurActif;

                                if(position[i] == scope.clickedPosition) {
                                    couleurBorder = couleurBorderSelected;
                                    lineWidth = 5;
                                }

                                if(scope.options.only_active){
                                    if(couleurFond == couleurActif) {

                                        x = (position[i].x * coef) + marge_gauche;
                                        y = (position[i].y * coef) + marge_haut;

                                        if (type_position == 'fond') {
                                            largeurPoint = canvasSize_x * 0.07;
                                            drawFond(ctx, x, y, largeurPoint, 'Fo.' + i, couleurFond, couleurBorder, lineWidth);
                                        }
                                        else if (type_position == 'tropPlein') {
                                            largeurPoint = canvasSize_x * 0.035;
                                            drawPosition(ctx, x, y, largeurPoint, 'TP.' + i, couleurFond, couleurBorder, lineWidth);
                                        }
                                        else if (type_position == 'event') {
                                            largeurPoint = canvasSize_x * 0.035;
                                            drawPosition(ctx, x, y, largeurPoint, 'Ev.' + i, couleurFond, couleurBorder, lineWidth);
                                        }
                                        else {
                                            largeurPoint = canvasSize_x * 0.035;
                                            drawPosition(ctx, x, y, largeurPoint, 'Fl.' + i, couleurFond, couleurBorder, lineWidth);
                                        }
                                    }
                                }
                                else{
                                    x = (position[i].x * coef) + marge_gauche ;
                                    y = (position[i].y * coef) + marge_haut ;

                                    if(type_position == 'fond'){
                                        largeurPoint = canvasSize_x * 0.07 ;
                                        drawFond(ctx, x, y, largeurPoint, 'Fo.'+i, couleurFond, couleurBorder, lineWidth);
                                    }
                                    else if(type_position == 'tropPlein'){
                                        largeurPoint = canvasSize_x * 0.035 ;
                                        drawPosition(ctx, x, y, largeurPoint, 'TP.'+i, couleurFond, couleurBorder, lineWidth);
                                    }
                                    else if(type_position == 'event'){
                                        largeurPoint = canvasSize_x * 0.035 ;
                                        drawPosition(ctx, x, y, largeurPoint, 'Ev.'+i, couleurFond, couleurBorder, lineWidth);
                                    }
                                    else{
                                        largeurPoint = canvasSize_x * 0.035 ;
                                        drawPosition(ctx, x, y, largeurPoint, 'Fl.'+i, couleurFond, couleurBorder, lineWidth);
                                    }
                                }
                            }

                        });

                        if(scope.options.dimensions)
                            drawMeasurementValues(ctx);


                    }


                    // action sur le clic
                    moncanvas.onmousedown = function (e) {

                        var radius = longueur_mm * 0.035;

                        if ($rootScope.$$phase) {
                            scope.$evalAsync(function(){
                                scope.clickedPosition = false;
                                delete scope.selectedDimension;
                            });
                        } else {
                            scope.$apply(function(){
                                scope.clickedPosition = false;
                                delete scope.selectedDimension;
                            });
                        }

                        angular.forEach(scope.positions, function(positionArr, type_position) {
                            for (var j = 0; j < positionArr.length; j++) {
                                if (( (scope.options.only_active && scope.hasProduct(positionArr[j])) || !scope.options.only_active )) {
                                    if (((parseFloat(positionArr[j].x) - radius) * coef + marge_gauche) <= e.offsetX && ((parseFloat(positionArr[j].x) + radius) * coef + marge_gauche) >= e.offsetX
                                        && ((parseFloat(positionArr[j].y) - radius) * coef + marge_haut) <= e.offsetY && ((parseFloat(positionArr[j].y) + radius) * coef + marge_haut) >= e.offsetY) {
                                        if ($rootScope.$$phase) {
                                            scope.$evalAsync(function () {
                                                scope.clickedPosition = positionArr[j];
                                            });
                                        } else {
                                            scope.$apply(function () {
                                                scope.clickedPosition = positionArr[j];
                                            });
                                        }
                                        if (type_position != 'tropPlein' && type_position != 'event') {
                                            dragging = $timeout(function (position) {
                                                grabbedPosition = position;
                                            }, 100, true, positionArr[j]);
                                        }
                                    }
                                    if(scope.options.dimensions && scope.options.dimensionsType[type_position] && type_position != 'tropPlein' && type_position != 'event') {

                                        if(positionArr[j].coordinates != undefined) {

                                            // X measurement
                                            if (positionArr[j].coordinates.axisX.size > 0) {
                                                ctx.font = "9pt verdana";
                                                var profondeurReelle = Math.round(positionArr[j].coordinates.axisX.size / coef);
                                                var textX = profondeurReelle + " mm";
                                                var textXWidth = ctx.measureText(textX).width;
                                                if ((positionArr[j].coordinates.axisX.x - textXWidth / 2 + marge_gauche) <= e.offsetX &&
                                                    (positionArr[j].coordinates.axisX.x + textXWidth / 2 + marge_gauche) >= e.offsetX &&
                                                    (positionArr[j].coordinates.axisX.y - 11 + marge_haut) <= e.offsetY &&
                                                    (positionArr[j].coordinates.axisX.y - 2 + marge_haut) >= e.offsetY) {

                                                    positionArr[j].x = parseInt(positionArr[j].x);
                                                    if ($rootScope.$$phase) {
                                                        scope.$evalAsync(function () {
                                                            scope.selectedDimension = {
                                                                name: type_position.charAt(0).toUpperCase() + type_position.slice(1, 2) + '.' + j,
                                                                position: positionArr[j],
                                                                value: Math.round(positionArr[j].coordinates.axisX.size / coef),
                                                                axis: "x"
                                                            };
                                                        });
                                                    } else {
                                                        scope.$apply(function () {
                                                            scope.selectedDimension = {
                                                                name: type_position.charAt(0).toUpperCase() + type_position.slice(1, 2) + '.' + j,
                                                                position: positionArr[j],
                                                                value: Math.round(positionArr[j].coordinates.axisX.size / coef),
                                                                axis: "x"
                                                            };
                                                        });
                                                    }
                                                    break;
                                                }
                                            }
                                            // Y measurement
                                            if (positionArr[j].coordinates.axisY.size > 0) {
                                                ctx.font = "9pt verdana";
                                                var largeurReelle = Math.round(positionArr[j].coordinates.axisY.size / coef);
                                                var textY = largeurReelle + " mm";
                                                var textYWidth = ctx.measureText(textY).width;
                                                if ((positionArr[j].coordinates.axisY.y - textYWidth / 2 + marge_haut) <= e.offsetY &&
                                                    (positionArr[j].coordinates.axisY.y + textYWidth / 2 + marge_haut) >= e.offsetY &&
                                                    (positionArr[j].coordinates.axisY.x - 11 + marge_gauche) <= e.offsetX &&
                                                    (positionArr[j].coordinates.axisY.x - 2 + marge_gauche) >= e.offsetX) {

                                                    positionArr[j].y = parseInt(positionArr[j].y);
                                                    if ($rootScope.$$phase) {
                                                        scope.$evalAsync(function () {
                                                            scope.selectedDimension = {
                                                                name: type_position.charAt(0).toUpperCase() + type_position.slice(1, 2) + '.' + j,
                                                                position: positionArr[j],
                                                                value: Math.round(positionArr[j].coordinates.axisY.size / coef),
                                                                axis: "y"
                                                            };
                                                        });
                                                    } else {
                                                        scope.$apply(function () {
                                                            scope.selectedDimension = {
                                                                name: type_position.charAt(0).toUpperCase() + type_position.slice(1, 2) + '.' + j,
                                                                position: positionArr[j],
                                                                value: Math.round(positionArr[j].coordinates.axisY.size / coef),
                                                                axis: "y"
                                                            };
                                                        });
                                                    }
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        });
                        drawMap();
                    };


                    moncanvas.onmouseup = function () {
                        if(grabbedPosition){
                            scope.updatePositions()();
                        }
                        grabbedPosition = false;
                        if(dragging)
                            $timeout.cancel(dragging);
                        drawMap();
                    };


                    moncanvas.onmousemove = function (e) {
                        var hideCursor = true ;

                        var radius = longueur_mm * 0.035;

                        // recherche si la souris est dans la zone d'un point
                        angular.forEach(scope.positions, function(positionArr, type_position){
                            if(type_position != 'tropPlein' && type_position != 'event') {
                                for (var j = 0; j < positionArr.length; j++) {
                                    if(( (scope.options.only_active && scope.hasProduct(positionArr[j])) || !scope.options.only_active )) {
                                        if (((parseFloat(positionArr[j].x) - radius) * coef + marge_gauche) <= e.offsetX &&
                                            ((parseFloat(positionArr[j].x) + radius) * coef + marge_gauche) >= e.offsetX &&
                                            ((parseFloat(positionArr[j].y) - radius) * coef + marge_haut) <= e.offsetY &&
                                            ((parseFloat(positionArr[j].y) + radius) * coef + marge_haut) >= e.offsetY) {
                                            $("#plan").css("cursor", "pointer");
                                            hideCursor = false;
                                            break;
                                        }
                                    }
                                    // Ou dans la zone d'une dimension si elles sont affichées
                                    if(scope.options.dimensions && scope.options.dimensionsType[type_position]) {


                                        if(positionArr[j].coordinates != undefined) {

                                            if (positionArr[j].coordinates.axisX.size > 0) {
                                                ctx.font = "9pt verdana";
                                                var profondeurReelle = Math.round(positionArr[j].coordinates.axisX.size / coef);
                                                var textX = profondeurReelle + " mm";
                                                var textXWidth = ctx.measureText(textX).width;
                                                if ((positionArr[j].coordinates.axisX.x - textXWidth / 2 + marge_gauche) <= e.offsetX &&
                                                    (positionArr[j].coordinates.axisX.x + textXWidth / 2 + marge_gauche) >= e.offsetX &&
                                                    (positionArr[j].coordinates.axisX.y - 11 + marge_haut) <= e.offsetY &&
                                                    (positionArr[j].coordinates.axisX.y - 2 + marge_haut) >= e.offsetY) {
                                                    $("#plan").css("cursor", "pointer");
                                                    hideCursor = false;
                                                    break;
                                                }
                                            }
                                            // Y measurement
                                            if (positionArr[j].coordinates.axisY.size > 0) {
                                                ctx.font = "9pt verdana";
                                                var largeurReelle = Math.round(positionArr[j].coordinates.axisY.size / coef);
                                                var textY = largeurReelle + " mm";
                                                var textYWidth = ctx.measureText(textY).width;
                                                if ((positionArr[j].coordinates.axisY.y - textYWidth / 2 + marge_haut) <= e.offsetY &&
                                                    (positionArr[j].coordinates.axisY.y + textYWidth / 2 + marge_haut) >= e.offsetY &&
                                                    (positionArr[j].coordinates.axisY.x - 11 + marge_gauche) <= e.offsetX &&
                                                    (positionArr[j].coordinates.axisY.x - 2 + marge_gauche) >= e.offsetX) {
                                                    $("#plan").css("cursor", "pointer");
                                                    hideCursor = false;
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        if (hideCursor) {
                            $("#plan").css("cursor", "default");
                        }

                        if(grabbedPosition){ // Currently dragging a position
                            if(grabbedPosition.x == 0 || grabbedPosition.x == longueur_mm){ // We are moving a left or right flanc position, so we only allow y-axis movement
                                if(e.offsetY >= (1000*coef + marge_haut) && e.offsetY <= ((largeur_mm - 1000)*coef + marge_haut))
                                    grabbedPosition.y = (e.offsetY - marge_haut) / coef;
                                else if(e.offsetY < (1000*coef + marge_haut))
                                    grabbedPosition.y = 1000;
                                else
                                    grabbedPosition.y = largeur_mm - 1000;
                            }
                            else if (grabbedPosition.y == 0 || grabbedPosition.y == largeur_mm){ // We are moving a top or bottom flanc position, so we only allow x-axis movement
                                if(e.offsetX >= (1000*coef + marge_gauche) && e.offsetX <= ((longueur_mm - 1000)*coef + marge_gauche))
                                    grabbedPosition.x = (e.offsetX - marge_gauche) / coef;
                                else if(e.offsetX < (1000*coef + marge_gauche))
                                    grabbedPosition.x = 1000;
                                else
                                    grabbedPosition.x = longueur_mm - 1000;
                            }
                            else{ // We are moving a fond position, we can move on both axis
                                // Y
                                if(e.offsetY >= (1000*coef + marge_haut) && e.offsetY <= ((largeur_mm - 1000)*coef + marge_haut))
                                    grabbedPosition.y = (e.offsetY - marge_haut) / coef;
                                else if(e.offsetY < (1000*coef + marge_haut))
                                    grabbedPosition.y = 1000;
                                else
                                    grabbedPosition.y = largeur_mm - 1000;
                                // X
                                if(e.offsetX >= (1000*coef + marge_gauche) && e.offsetX <= ((longueur_mm - 1000)*coef + marge_gauche))
                                    grabbedPosition.x = (e.offsetX - marge_gauche) / coef;
                                else if(e.offsetX < (1000*coef + marge_gauche))
                                    grabbedPosition.x = 1000;
                                else
                                    grabbedPosition.x = longueur_mm - 1000;
                            }
                            grabbedPosition.x = Math.round(grabbedPosition.x);
                            grabbedPosition.y = Math.round(grabbedPosition.y);
                            getMeasurementsCoordinates();
                            drawMap();
                        }
                    };
                }
            }
        }
});