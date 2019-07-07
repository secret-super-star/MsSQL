<?php
session_start();
ob_start();
$serverName = "178.238.233.75,1433";
$uid = "valuebets";
$pwd = "Bet365Share";
$databaseName = "AutoTraderPro";
$connectionInfo = array(
    "Database"=>$databaseName,
    "UID"=>$uid,
    "PWD"=>$pwd,
    "ReturnDatesAsStrings" => true
    );

$conn = sqlsrv_connect( $serverName, $connectionInfo);
