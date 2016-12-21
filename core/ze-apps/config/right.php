<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$rightList = array();


$tabTempRight = array() ;
$tabTempRight["space"] = "com_ze_apps_config" ;
$tabTempRight["id"] = "com_ze_apps_administrator" ;
$tabTempRight["section"] = "Administrateur" ;
$tabTempRight["label"] = "Administrateur" ;
$rightList[] = $tabTempRight ;






$tabTempRight = array() ;
$tabTempRight["space"] = "com_ze_apps_config" ;
$tabTempRight["id"] = "com_ze_apps_users_view" ;
$tabTempRight["section"] = "Utilisateurs" ;
$tabTempRight["label"] = "Visualisation" ;
$rightList[] = $tabTempRight ;

$tabTempRight = array() ;
$tabTempRight["space"] = "com_ze_apps_config" ;
$tabTempRight["id"] = "com_ze_apps_users_edit" ;
$tabTempRight["section"] = "Utilisateurs" ;
$tabTempRight["label"] = "Edition" ;
$rightList[] = $tabTempRight ;

$tabTempRight = array() ;
$tabTempRight["space"] = "com_ze_apps_config" ;
$tabTempRight["id"] = "com_ze_apps_users_delete" ;
$tabTempRight["section"] = "Utilisateurs" ;
$tabTempRight["label"] = "Suppression" ;
$rightList[] = $tabTempRight ;




// charge les droits des applications
$folderApp = FCPATH . "application" ;
// charge tous les fichiers de conf des menus
if($folder = opendir($folderApp)) {
    while(false !== ($folderItem = readdir($folder)))
    {
        $folderModule = $folderApp . "/" . $folderItem ;
        if(is_dir($folderModule) && $folderItem != '.' && $folderItem != '..') {
            if (is_file($folderModule . '/config/right.php')) {
                require_once $folderModule . '/config/right.php' ;
            }
        }
    }
}