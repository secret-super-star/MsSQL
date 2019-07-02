<?php

include('config.php');
// $user_name = $_POST['user_name'];
$user_name = "paskouma";
$return = array();

$result_mon = array();
for($i=1;$i<=31;$i++){
    $result_mon[$i]['val'] =0;
    $result_mon[$i]['count'] =0;
}
$tsql = "select * from AccountsBalance where FORMAT(TimeStamp,'MM/yyyy') = FORMAT( GETDATE( ) ,'MM/yyyy' ) and ClientUsername = '".$user_name."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $timestamp = strtotime($obj['TimeStamp']);
    $php_date = getdate($timestamp);
    $result_mon[$php_date['mday']]['val'] += (float)$obj['Balance'];
    $result_mon[$php_date['mday']]['count'] ++;
}

foreach($result_mon as $result){
    if($result['count'] > 0){
        $return['month'][] = round($result['val']/$result['count'],2);
    } else {
        $return['month'][] = 0;
    }
    
}

echo "<pre>";

print_r($result_mon);

echo "</pre>";
die();
