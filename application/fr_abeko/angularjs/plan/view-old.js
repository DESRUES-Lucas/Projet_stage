app.controller('***** sauvegarde *******FrAbekoPlanViewCtrl*************', ['$scope', '$route', '$routeParams', '$location', '$rootScope', '$http', '$uibModal',
    function ($scope, $route, $routeParams, $location, $rootScope, $http, $uibModal) {

        $scope.$parent.loadMenu("fr_abeko", "fr_abeko_plan");


        $scope.$on("$destroy", function() {
            $(window).off( "resize");
            $(".updateDrawMap").off("keyup");
        });


        $(window).resize(function () {
            drawMap() ;
        }) ;

        $(".updateDrawMap").keyup(function () {
            drawMap() ;
        }) ;





        /************* paramètre *************/
        var marge_gauche = 50 ;
        var marge_droite = 50 ;
        var marge_haut = 40 ;
        var marge_bas = 60 ;
        /************* END : paramètre *************/




        /************* initialisation de variable *************/
        var coef = 1;
        var tabPoint = [];
        $scope.tabPointPiece = [];
        /************* END : initialisation de variable *************/






        $scope.removePiece = function(idPiece) {
            for (var i = 0 ; i < $scope.tabPointPiece.length ; i++) {
                if ($scope.tabPointPiece[i].idTemp == idPiece) {
                    $scope.tabPointPiece.splice(i, 1);

                    // raffraichi le plan
                    drawMap();

                    break;
                }
            }
        };



        $scope.downloadPDF = function() {
            downloadURI("/assets/plan.pdf", "plan.pdf");
        }


        function downloadURI(uri, name) {
            var link = document.createElement("a");
            link.download = name;
            link.href = uri;
            link.click();
        }




        function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < 10; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        var getNumberTxt = function (value) {
            if (isNaN(value) && value && value != null) {
                value = value.replace(",", ".");
                value = value * 1;
            } else if (isNaN(value)) {
                value = 0;
            }
            value = value * 1

            return value;
        }

        function sqr(a) {
            return a*a;
        }

        function Distance(x1, y1, x2, y2) {
            return Math.sqrt(sqr(y2 - y1) + sqr(x2 - x1));
        }


        function calculAngle(x1, y1, x2, y2) {
            var aa = x2 - x1 ;
            var bb = y2 - y1 ;
            var cc = Distance(x1, y1, x2, y2) ;

            var alpha = 180/Math.PI*Math.acos((bb*bb-(-cc*cc)-aa*aa)/(2*bb*cc))
            if (isNaN(alpha)) {
                alpha = 0 ;
            }

            return alpha ;
        }






        function drawMeasure(ctx, x1, y1, x2, y2, decalage) {


            var mesure = Distance(x1, y1, x2, y2);
            var mesure_coef = mesure * coef ;




            // determine le centre de la droite
            var xCentre = 0;
            var yCentre = 0;

            if (x2 >= x1) {
                xCentre = ((x2 - x1) / 2) + x1;
            } else {
                xCentre = ((x1 - x2) / 2) + x2;
            }

            if (y2 >= y1) {
                yCentre = ((y2 - y1) / 2) + y1;
            } else {
                yCentre = ((y1 - y2) / 2) + y2;
            }


            // determine l'angle de la droite
            var alpha = calculAngle(x1, y1, x2, y2);





            ctx.save();

            ctx.translate((xCentre*coef) + marge_gauche, (yCentre*coef) + marge_haut);


            // rotation si la ligne n'est pas droite
            if (alpha != 0) {
                ctx.rotate((90-alpha) * Math.PI / 180);
            }

            // decalage de ligne
            ctx.translate(0, decalage);


            // parametre de la ligne
            ctx.lineWidth = 1;
            ctx.strokeStyle = "#000000";
            ctx.fillStyle = "#000000" ;


            // barre horizontale
            ctx.beginPath();
            ctx.moveTo((mesure_coef/2)*-1, 0);
            ctx.lineTo((mesure_coef/2), 0);
            ctx.fill();
            ctx.stroke();

            // barre verticale gauche
            ctx.beginPath();
            ctx.moveTo((mesure_coef/2)*-1, -10);
            ctx.lineTo((mesure_coef/2)*-1, 10);
            ctx.fill();
            ctx.stroke();

            // barre verticale droite
            ctx.beginPath();
            ctx.moveTo((mesure_coef/2), -10);
            ctx.lineTo((mesure_coef/2), 10);
            ctx.fill();
            ctx.stroke();

            ctx.translate(0, 15);
            ctx.font = "9pt verdana";
            ctx.textAlign = 'center';
            ctx.fillText((Math.round(mesure*100)/100) + " mm", 0, 0);


            ctx.restore();

        }






        function positionHasData(idPosition) {
            var dataTrouvee = false ;

            for (var i = 0 ; i < $scope.tabPointPiece.length ; i++) {
                if ($scope.tabPointPiece[i].idPoint == idPosition) {
                    dataTrouvee = true ;
                    break;
                }
            }

            return dataTrouvee ;
        }





        function drawMap() {
            var decalage_mesure = 30 ;


            tabPoint = [];




            // pour fixer la taille du canvas sinon il fait un zoom
            $("#plan").attr("width", $("#plan").width());
            $("#plan").attr("height", $("#plan").height());


            // on garde une mage de 20px (gauche et haut), 60px (droite et bas)
            var taileMaxX = $("#plan").width() - (marge_gauche + marge_droite);
            var taileMaxY = $("#plan").height() - (marge_haut + marge_bas);



            // calcul du coef du plan
            var longueur_mm = getNumberTxt($("#longueur").val()) * 1000;
            var largeur_mm = getNumberTxt($("#largeur").val()) * 1000;

            var coef_x = taileMaxX / longueur_mm;
            var coef_y = taileMaxY / largeur_mm;


            if (coef_x < coef_y) {
                coef = coef_x;
            } else {
                coef = coef_y;
            }



            var dimension_position = getNumberTxt($("#diametre_position").val());
            var nb_position_longueur = getNumberTxt($("#nb_position_longueur").val());
            var nb_position_largeur = getNumberTxt($("#nb_position_largeur").val());
            var espace_position_longueur = getNumberTxt($("#espace_position_longueur").val());
            var espace_position_largeur = getNumberTxt($("#espace_position_largeur").val());
            var espace_bordure_position_longueur = getNumberTxt($("#espace_bordure_position_longueur").val());
            var espace_bordure_position_largeur = getNumberTxt($("#espace_bordure_position_largeur").val());






            var moncanvas = document.getElementById("plan");
            var ctx = moncanvas.getContext("2d");



            // met un fond blanc
            ctx.fillStyle = "#ffffff";
            ctx.fillRect(0, 0, $("#plan").width(), $("#plan").height());







            ctx.strokeStyle = "#000000";


            if (coef) {

                // dessine la limite de la bache
                ctx.lineWidth = 2;
                ctx.strokeRect(marge_gauche, marge_haut, longueur_mm * coef, largeur_mm * coef);





                // affiche les mesures de la citerne
                drawMeasure(ctx, 0, largeur_mm, longueur_mm, largeur_mm, decalage_mesure) ;
                drawMeasure(ctx, longueur_mm, largeur_mm, longueur_mm, 0, decalage_mesure) ;








                // calcul la distance entre 2 position
                var dim_entre_point_longueur = (longueur_mm - (espace_bordure_position_longueur*2) - dimension_position) / (nb_position_longueur-1) ;
                var dim_entre_point_largeur = (largeur_mm - (espace_bordure_position_longueur*2) - dimension_position) / (nb_position_largeur-1) ;
                var posDepart_x = espace_bordure_position_longueur + (dimension_position / 2) ;
                var posDepart_y = espace_bordure_position_largeur + (dimension_position / 2) ;

                var dimRondPosition = dimension_position*coef ;
                if (dimRondPosition < 10) {
                    dimRondPosition = 10 ;
                }

                var idPosition = 0 ;
                ctx.font = "11pt verdana";
                ctx.textAlign = 'center';


                for (var i = 1 ; i <= nb_position_longueur ; i++) {
                    var position_x = posDepart_x + (dim_entre_point_longueur * (i-1)) ;
                    position_x *= coef ;
                    position_x += marge_gauche ;

                    var position_y_haut = espace_bordure_position_largeur + (dimension_position / 2) ;
                    position_y_haut *= coef ;
                    position_y_haut += marge_haut ;


                    var position_y_bas = largeur_mm - (espace_bordure_position_largeur + (dimension_position / 2)) ;
                    position_y_bas *= coef ;
                    position_y_bas += marge_haut ;





                    // point du haut
                    idPosition++;
                    if (positionHasData(idPosition)) {
                        ctx.fillStyle = "#00dd00" ;
                    } else {
                        ctx.fillStyle = "#ffffff" ;
                    }

                    ctx.beginPath();
                    ctx.lineWidth = 1 ;
                    ctx.arc(position_x, position_y_haut, dimRondPosition, 0, Math.PI*2, true);
                    ctx.fill();
                    ctx.stroke();

                    // ecrit le n° de la position
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(idPosition, position_x, position_y_haut+5);


                    // enregistre le point
                    tabPoint.push({id:idPosition, x1:position_x-dimRondPosition, y1:position_y_haut-dimRondPosition, x2: position_x+dimRondPosition, y2:position_y_haut+dimRondPosition});



                    // dessine la mesure
                    if (i == 1) {
                        x1 = 0 ;
                        y1 = (position_y_haut-marge_haut) / coef ;
                        x2 = (position_x-marge_gauche) / coef ;
                        y2 = (position_y_haut-marge_haut) / coef ;
                    } else {
                        x1 = (position_x-marge_gauche) / coef - dim_entre_point_longueur ;
                        y1 = (position_y_haut-marge_haut) / coef ;
                        x2 = (position_x-marge_gauche) / coef ;
                        y2 = (position_y_haut-marge_haut) / coef ;
                    }
                    drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;


                    if (nb_position_longueur == i) {
                        x1 = (position_x-marge_gauche) / coef ;
                        y1 = (position_y_haut-marge_haut) / coef ;
                        x2 = longueur_mm ;
                        y2 = (position_y_haut-marge_haut) / coef ;

                        drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;
                    }







                    // point du bas
                    idPosition++;

                    if (positionHasData(idPosition)) {
                        ctx.fillStyle = "#00dd00" ;
                    } else {
                        ctx.fillStyle = "#ffffff" ;
                    }

                    ctx.beginPath();
                    ctx.lineWidth = 1 ;
                    ctx.arc(position_x, position_y_bas, dimRondPosition, 0, Math.PI*2, true);
                    ctx.fill();
                    ctx.stroke();

                    // ecrit le n° de la position
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(idPosition, position_x, position_y_bas+5);


                    // enregistre le point
                    tabPoint.push({id:idPosition, x1:position_x-dimRondPosition, y1:position_y_bas-dimRondPosition, x2: position_x+dimRondPosition, y2:position_y_bas+dimRondPosition});


                }








                for (var i = 2 ; i < nb_position_largeur ; i++) {
                    var position_x_gauche = espace_bordure_position_longueur + (dimension_position / 2) ;
                    position_x_gauche *= coef ;
                    position_x_gauche += marge_gauche ;

                    var position_x_droite = longueur_mm - (espace_bordure_position_longueur + (dimension_position / 2)) ;
                    position_x_droite *= coef ;
                    position_x_droite += marge_gauche ;

                    var position_y = posDepart_y + (dim_entre_point_largeur * (i-1)) ;
                    position_y *= coef ;
                    position_y += marge_haut ;



                    // point du gauche
                    idPosition++;

                    if (positionHasData(idPosition)) {
                        ctx.fillStyle = "#00dd00" ;
                    } else {
                        ctx.fillStyle = "#ffffff" ;
                    }

                    ctx.beginPath();
                    ctx.lineWidth = 1 ;
                    ctx.arc(position_x_gauche, position_y, dimRondPosition, 0, Math.PI*2, true);
                    ctx.fill();
                    ctx.stroke();

                    // ecrit le n° de la position
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(idPosition, position_x_gauche, position_y+5);

                    // enregistre le point
                    tabPoint.push({id:idPosition, x1:position_x_gauche-dimRondPosition, y1:position_y-dimRondPosition, x2: position_x_gauche+dimRondPosition, y2:position_y+dimRondPosition});




                    // dessine la mesure
                    if (i == 2) {
                        x1 = (position_x_gauche-marge_gauche) / coef ;
                        y1 = (position_y-marge_haut) / coef  - dim_entre_point_largeur ;
                        x2 = (position_x_gauche-marge_gauche) / coef ;
                        y2 = 0 ;
                        drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;


                        x1 = (position_x_gauche-marge_gauche) / coef ;
                        y1 = (position_y-marge_haut) / coef ;
                        x2 = (position_x_gauche-marge_gauche) / coef ;
                        y2 = (position_y-marge_haut) / coef  - dim_entre_point_largeur ;
                        drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;
                    } else {
                        x1 = (position_x_gauche-marge_gauche) / coef ;
                        y1 = (position_y-marge_haut) / coef ;
                        x2 = (position_x_gauche-marge_gauche) / coef ;
                        y2 = (position_y-marge_haut) / coef - dim_entre_point_largeur ;
                        drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;
                    }


                    if (i == (nb_position_largeur-1)) {
                        x1 = (position_x_gauche-marge_gauche) / coef ;
                        y1 = (position_y-marge_haut) / coef + dim_entre_point_largeur ;
                        x2 = (position_x_gauche-marge_gauche) / coef ;
                        y2 = (position_y-marge_haut) / coef  ;
                        drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;

                        x1 = (position_x_gauche-marge_gauche) / coef ;
                        y1 = largeur_mm ;
                        x2 = (position_x_gauche-marge_gauche) / coef ;
                        y2 = (position_y-marge_haut) / coef + dim_entre_point_largeur  ;
                        drawMeasure(ctx, x1, y1, x2, y2, decalage_mesure) ;
                    }



                    // point du droite
                    idPosition++;

                    if (positionHasData(idPosition)) {
                        ctx.fillStyle = "#00dd00" ;
                    } else {
                        ctx.fillStyle = "#ffffff" ;
                    }

                    ctx.beginPath();
                    ctx.lineWidth = 1 ;
                    ctx.arc(position_x_droite, position_y, dimRondPosition, 0, Math.PI*2, true);
                    ctx.fill();
                    ctx.stroke();

                    // ecrit le n° de la position
                    ctx.fillStyle = "#000000" ;
                    ctx.fillText(idPosition, position_x_droite, position_y+5);

                    // enregistre le point
                    tabPoint.push({id:idPosition, x1:position_x_droite-dimRondPosition, y1:position_y-dimRondPosition, x2: position_x_droite+dimRondPosition, y2:position_y+dimRondPosition});
                }


                // affichage de l'icone danger si ecart sont inférieur à la norme
                if (dim_entre_point_longueur < espace_position_longueur || dim_entre_point_largeur < espace_position_largeur) {
                    var imageObj = new Image();
                    imageObj.onload = function() {
                        ctx.drawImage(this, 0, 0);
                    };

                    imageObj.src = "/assets/cache/images/fr_abeko/danger.png";
                }
            }






            // action sur le clic
            moncanvas.onmousedown = function (e) {
                var idPoint = 0 ;


                // recherche si la souris est dans la zone d'un point
                for (var i = 0 ; i < tabPoint.length; i++) {
                    if (tabPoint[i].x1 <= e.offsetX && tabPoint[i].x2 >=e.offsetX && tabPoint[i].y1 <= e.offsetY && tabPoint[i].y2 >= e.offsetY) {

                        idPoint = tabPoint[i].id ;

                        var modalInstance = $uibModal.open({
                            animation: true,
                            templateUrl: '/fr_abeko/plan/modal',
                            controller: 'FrAbekoPlanModalInstanceCtrl',
                            size: 'lg',
                            resolve: {
                                /*items: function () {
                                    return $scope.items;
                                }*/
                            }
                        });

                        modalInstance.result.then(function (selectedItem) {
                            $scope.tabPointPiece.push({idPoint:idPoint, idPiece:1, libelle:"Vannes", qte:1, idTemp:makeid()});

                            // recharge la carte
                            drawMap();

                        }, function () {
                            //console.log("rien");
                        });
                        break;
                    }
                }
            }







            // pour afficher le pointer sur les rond des positions (zone carré en réalité)
            moncanvas.onmousemove = function (e) {
                // recherche si la souris est dans la zone d'un point
                var hideCursor = true ;
                for (var i = 0 ; i < tabPoint.length; i++) {
                    if (tabPoint[i].x1 <= e.offsetX && tabPoint[i].x2 >=e.offsetX && tabPoint[i].y1 <= e.offsetY && tabPoint[i].y2 >= e.offsetY) {
                        $("#plan").css("cursor", "pointer");
                        hideCursor = false ;
                        break;
                    }
                }

                if (hideCursor) {
                    $("#plan").css("cursor", "default");
                }
            }
        }







        drawMap() ;

    }]);