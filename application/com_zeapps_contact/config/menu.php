<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["order"] = 10 ;
$menuEssential[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["order"] = 20 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_company" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["order"] = 1 ;
$menuLeft[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_contact" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["order"] = 2 ;
$menuLeft[] = $tabMenu ;




/********** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_company" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["order"] = 1 ;
$menuHeader[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_contact" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["order"] = 2 ;
$menuHeader[] = $tabMenu ;


