<?php

include('config.php');
$user_id = $_SESSION["id"];

$tsql = "select * from clients where SystemUsersID = '".$user_id."' and Enabled='true'";

$stmt = sqlsrv_query( $conn, $tsql);
$return = array();

while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $return[] = $obj['Bet365User'];
}
echo json_encode($return);

?>
