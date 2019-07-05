<?php
include('config.php');

$user_id = $_GET['id'];

$tsql = "update clients set Enabled='f' where id = '".$user_id."' and Enabled='true'";
$stmt = sqlsrv_query( $conn, $tsql);

header("location:remove_userpage.php");

?>
