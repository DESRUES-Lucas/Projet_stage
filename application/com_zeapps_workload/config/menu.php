<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Plans de charges" ;
$tabMenu["url"] = "/ng/com_zeapps_workload/workload/plan" ;
$tabMenu["order"] = 99 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/


$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_workloads_workload" ;
$tabMenu["space"] = "com_ze_apps_workload" ;
$tabMenu["label"] = "Plan de Charges" ;
$tabMenu["url"] = "/ng/com_zeapps_workload/workload/plan" ;
$tabMenu["order"] = 1;
$menuLeft[] = $tabMenu ;



/********** insert in top menu ************/




$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_workloads_workload" ;
$tabMenu["space"] = "com_ze_apps_workload" ;
$tabMenu["label"] = "Plan de charges" ;
$tabMenu["url"] = "/ng/com_zeapps_workload/workload/plan" ;
$tabMenu["order"] = 3 ;
$menuHeader[] = $tabMenu ;


