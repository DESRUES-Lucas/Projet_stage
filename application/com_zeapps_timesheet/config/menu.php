<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Feuille de temps" ;
$tabMenu["url"] = "/ng/com_zeapps_timesheet/contract/search" ;
$tabMenu["order"] = 50 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/


$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_timesheets_timesheet" ;
$tabMenu["space"] = "com_ze_apps_timesheet" ;
$tabMenu["label"] = "Feuille de temps" ;
$tabMenu["url"] = "/ng/com_zeapps_timesheet/contract/search" ;
$tabMenu["order"] = 3 ;
$menuLeft[] = $tabMenu ;


/********** insert in top menu ************/




$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_timesheets_timesheet" ;
$tabMenu["space"] = "com_ze_apps_timesheet" ;
$tabMenu["label"] = "Feuille de temps" ;
$tabMenu["url"] = "/ng/com_zeapps_timesheet/contract/search" ;
$tabMenu["order"] = 3 ;
$menuHeader[] = $tabMenu ;


