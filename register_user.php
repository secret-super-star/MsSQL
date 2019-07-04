<?php

include('config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$refferal = $_POST['refferal'];

$tsql = "insert into SystemUsers (Username, Password, Referral) values ('$username', '$password', '$refferal')";

$stmt = sqlsrv_query( $conn, $tsql);
$obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
print_r($stmt);


?>
