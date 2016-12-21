<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Projets" ;
$tabMenu["url"] = "/ng/com_zeapps_project/projects" ;
$tabMenu["order"] = 50 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_projects_list" ;
$tabMenu["space"] = "com_ze_apps_project" ;
$tabMenu["label"] = "Projets" ;
$tabMenu["url"] = "/ng/com_zeapps_project/projects" ;
$tabMenu["order"] = 1 ;
$menuLeft[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_projects_my_task" ;
$tabMenu["space"] = "com_ze_apps_project" ;
$tabMenu["label"] = "Mes tâches" ;
$tabMenu["url"] = "/ng/com_zeapps_project/my_tasks" ;
$tabMenu["order"] = 2 ;
$menuLeft[] = $tabMenu ;




/********** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_projects_list" ;
$tabMenu["space"] = "com_ze_apps_project" ;
$tabMenu["label"] = "Projets" ;
$tabMenu["url"] = "/ng/com_zeapps_project/projects" ;
$tabMenu["order"] = 1 ;
$menuHeader[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_projects_my_task" ;
$tabMenu["space"] = "com_ze_apps_project" ;
$tabMenu["label"] = "Mes tâches" ;
$tabMenu["url"] = "/ng/com_zeapps_project/my_tasks" ;
$tabMenu["order"] = 2 ;
$menuHeader[] = $tabMenu ;

