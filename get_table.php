<?php

include('config.php');
$user_name = $_POST['user_name'];
$table_filter = $_POST['table_filter'];

$result_table = array();

if($table_filter == 'month') {
    $tsql = "select * from BetsDone where TimeStamp >= (CURRENT_TIMESTAMP-30) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$user_name."' order by TimeStamp ASC ";
}

if($table_filter == 'week') {
    $tsql = "select * from BetsDone where TimeStamp >= (CURRENT_TIMESTAMP-6) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$user_name."' order by TimeStamp ASC";
}

if($table_filter == 'time') {
    $tsql = "select * from BetsDone where TimeStamp >= DATEADD(hh, -24, GETDATE()) and ClientUsername = '".$user_name."' order by TimeStamp ASC";
}

$stmt = sqlsrv_query( $conn, $tsql);
$return['table'] = array();
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $obj['Evaluation'] = round((float)$obj['Evaluation'] * 100 , 2);
    $obj['OddDecimal'] = round((float)$obj['OddDecimal'], 2);
    $obj['Evaluation'] = $obj['Evaluation'].'%';
    $result_table[] = $obj;
}

foreach($result_table as $result){
    $return['table'][] = $result;
}


echo json_encode($return);

?>