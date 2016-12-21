<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Réunion" ;
$tabMenu["url"] = "/ng/meeting_app/project/plan" ;
$tabMenu["order"] = 8 ;
$menuEssential[] = $tabMenu ;






/********** insert in top menu ************/




$tabMenu = array () ;
$tabMenu["id"] = "meeting_app_project" ;
$tabMenu["space"] = "meeting_app" ;
$tabMenu["label"] = "Projet" ;
$tabMenu["url"] = "/ng/meeting_app/project/plan" ;
$tabMenu["order"] = 3 ;
$menuHeader[] = $tabMenu ;


