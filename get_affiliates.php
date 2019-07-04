<?php

include('config.php');

$tsql = "select * from BetsDone where TimeStamp >= (CURRENT_TIMESTAMP-6) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$user_name."' order by TimeStamp ASC";
$stmt2 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){
    $timestamp = strtotime($obj['TimeStamp']);
    $php_date = getdate($timestamp);
    $result_week[$php_date['mday']]['val'] += (float)$obj['Balance'];
    $result_week[$php_date['mday']]['count'] ++;
}
