<?php

include('config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$refferal = $_POST['refferal'];

$tsql = "insert into SystemUsers (Username, Password, Referral) values ('$username', '$password', '$refferal'); SELECT SCOPE_IDENTITY() AS IDENTITY_COLUMN_NAME";

$stmt = sqlsrv_query( $conn, $tsql);

sqlsrv_next_result($stmt);
sqlsrv_fetch($stmt);
$id = sqlsrv_get_field($stmt, 0);

$_SESSION["username"] = $username;
$_SESSION["id"] = $id;

header("location:dashboard.php");

?>
