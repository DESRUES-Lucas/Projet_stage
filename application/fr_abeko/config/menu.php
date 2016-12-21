<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Plans" ;
$tabMenu["url"] = "/ng/fr_abeko/plan" ;
$tabMenu["order"] = 1 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_plan" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Plans" ;
$tabMenu["url"] = "/ng/fr_abeko/plan" ;
$tabMenu["order"] = 1 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_citerne_type" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Citernes type" ;
$tabMenu["url"] = "/ng/fr_abeko/citerne_type" ;
$tabMenu["order"] = 2 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_citerne_tarif" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Tarifs citernes" ;
$tabMenu["url"] = "/ng/fr_abeko/citerne_tarif" ;
$tabMenu["order"] = 3 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_type_bache" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Bâches" ;
$tabMenu["url"] = "/ng/fr_abeko/type_bache" ;
$tabMenu["order"] = 4 ;
$menuLeft[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_article" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Articles de base" ;
$tabMenu["url"] = "/ng/fr_abeko/article" ;
$tabMenu["order"] = 5 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_article_compose" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Articles composés" ;
$tabMenu["url"] = "/ng/fr_abeko/article_compose" ;
$tabMenu["order"] = 6 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_logo" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Gestionnaire logos" ;
$tabMenu["url"] = "/ng/fr_abeko/logo/search" ;
$tabMenu["order"] = 7 ;
$menuLeft[] = $tabMenu ;




/********** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "fr_abeko_plan" ;
$tabMenu["space"] = "fr_abeko" ;
$tabMenu["label"] = "Plans" ;
$tabMenu["url"] = "/ng/fr_abeko/plan" ;
$tabMenu["order"] = 1 ;
$menuHeader[] = $tabMenu ;