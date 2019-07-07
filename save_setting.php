<?php

include('config.php');

if(!isset($_SESSION['username'])){
    header("location:index.php");
}

$account_id = $_POST['account_id'];
$frv = $_POST['frv'];
$mpe = $_POST['mpe'];


$tsql = "update clients set Stake='".$frv."' , MaxPerEvent = '".$mpe."' where id = '".$account_id."'";
$stmt1 = sqlsrv_query( $conn, $tsql);

$tsql = "select * from clients where id = '".$account_id."'";
$stmt1 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
    $username = $obj['Bet365User'];
}

header("location:dashboard.php?username=".$username."");
