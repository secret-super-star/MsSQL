<?php
session_start();
$serverName = "127.0.0.1,1433";
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