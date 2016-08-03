<?php

//ini_set('display_startup_errors',1);
//ini_set('display_errors',1);
//error_reporting(-1);
include_once '../class/pdo_db.php';
include_once '../class/cloudconfig.php';

$objCC = new cloudconfig();

$router = $objCC->fetchRouters($_REQUEST['mac']);

if (count($router) == 0) {
    $objCC->insertRouter($_REQUEST['mac'],$_REQUEST['nasid']);
} else {
    $objCC->updateRouter($_REQUEST['mac']);
}

$arrCommand = $objCC->fetchCommand($_REQUEST['mac']);
if (count($arrCommand) > 0) {
    foreach ($arrCommand as $key => $value) {
        echo $value['command'] . "\n";
        $objCC->deleteCommand($value);
    }
}

$arrKickUsers = $objCC->fetchKickUserWithNas($_REQUEST['nasid']);

if (count($arrKickUsers) > 0) {
    foreach ($arrKickUsers as $key => $arrSingleRecord) {

        echo "chilli_query logout " . $arrSingleRecord['user_identifier'] . "\n";
        $result = $objCC->deleteKickUser($arrSingleRecord);
    }
}
?>
