<?php

include('config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$balance = $_POST['balance'];
$user_id = $_SESSION['id'];

$tsql = "insert into clients (Bet365User, Bet365Pass, KellyBalance, SystemUsersID) values ('$username', '$password', '$balance', '$user_id'); SELECT SCOPE_IDENTITY() AS IDENTITY_COLUMN_NAME";

$stmt = sqlsrv_query($conn, $tsql);

sqlsrv_next_result($stmt);
sqlsrv_fetch($stmt);
$id = sqlsrv_get_field($stmt, 0);

$return['success'] = $id;

echo json_encode($return);

?>
