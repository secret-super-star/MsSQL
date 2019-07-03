<?php

include('config.php');
$user_name = $_POST['user_name'];
// $user_name = "paskouma";
$return = array();

$result_year = array();
for($i=1;$i<=12;$i++){
    $result_year[$i]['val'] =0;
    $result_year[$i]['count'] =0;
}
$tsql = "select * from AccountsBalance where FORMAT(TimeStamp,'yyyy') = FORMAT( GETDATE( ) ,'yyyy' ) and ClientUsername = '".$user_name."'";
$stmt1 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
    $timestamp = strtotime($obj['TimeStamp']);
    $php_date = getdate($timestamp);
    $result_year[$php_date['mon']]['val'] += (float)$obj['Balance'];
    $result_year[$php_date['mon']]['count'] ++;
}

foreach($result_year as $result){
    if($result['count'] > 0){
        $return['year'][] = round($result['val']/$result['count'],2);
    } else {
        $return['year'][] = 0;
    }

}

$result_mon = array();
$today = date('j');
for($i=$today;$i<=31;$i++){
    $result_mon[$i]['val'] =0;
    $result_mon[$i]['count'] =0;
    $return['month']['label'][]=$i;
}
for($i=1;$i<$today;$i++){
    $result_mon[$i]['val'] =0;
    $result_mon[$i]['count'] =0;
    $return['month']['label'][]=$i;
}
// $tsql = "select * from AccountsBalance where FORMAT(TimeStamp,'MM/yyyy') = FORMAT( GETDATE( ) ,'MM/yyyy' ) and ClientUsername = '".$user_name."'";
$tsql = "select * from AccountsBalance where TimeStamp >= (CURRENT_TIMESTAMP-30) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$user_name."' order by TimeStamp ASC";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $timestamp = strtotime($obj['TimeStamp']);
    $php_date = getdate($timestamp);
    $result_mon[$php_date['mday']]['val'] += (float)$obj['Balance'];
    $result_mon[$php_date['mday']]['count'] ++;
}

foreach($result_mon as $result){
    if($result['count'] > 0){
        $return['month']['data'][] = round($result['val']/$result['count'],2);
    } else {
        $return['month']['data'][] = 0;
    }

}



$result_week = array();
$today = date('j');
$count = 0;

$week_day = date('w');
$week_array = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
$week_array1 = array();
for($i=0;$i<7;$i++){
  $week_array1[] = $week_array[$week_day];
  $week_day++;
  if($week_day > 6) $week_day=0;
}

for($j=0;$j<7;$j++){
    $today --;
    if($today == 0) $today =31;
}

for($j=0;$j<7;$j++){

    $result_week[$today]['val'] =0;
    $result_week[$today]['count'] =0;
    $return['week']['label'][]=$week_array1[$j];
    $today++;
    if($today >31 ) $today = 1;
}

// $tsql = "select * from AccountsBalance where FORMAT(TimeStamp,'MM/yyyy') = FORMAT( GETDATE( ) ,'MM/yyyy' ) and ClientUsername = '".$user_name."'";
$tsql = "select * from AccountsBalance where TimeStamp >= (CURRENT_TIMESTAMP-6) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$user_name."' order by TimeStamp ASC";
$stmt2 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){
    $timestamp = strtotime($obj['TimeStamp']);
    $php_date = getdate($timestamp);
    $result_week[$php_date['mday']]['val'] += (float)$obj['Balance'];
    $result_week[$php_date['mday']]['count'] ++;
}

foreach($result_week as $result){
    if($result['count'] > 0){
        $return['week']['data'][] = round($result['val']/$result['count'],2);
    } else {
        $return['week']['data'][] = 0;
    }

}

$result_time = array();
$time_now = date('H');

for($i=0;$i<24;$i++){
    $time_now ++;
    if($time_now > 23) $time_now =0;
    $result_time[$time_now]['val'] =0;
    $result_time[$time_now]['count'] =0;
    $return['time']['label'][]=$time_now.":00";
}
$tsql = "select * from AccountsBalance where TimeStamp >= DATEADD(hh, -24, GETDATE()) and ClientUsername = '".$user_name."' and ClientUsername = '".$user_name."' order by TimeStamp ASC";
$stmt3 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC)){

    $timestamp = strtotime($obj['TimeStamp']);
    $php_date = getdate($timestamp);
    $result_time[$php_date['hours']]['val'] += (float)$obj['Balance'];
    $result_time[$php_date['hours']]['count'] ++;
}

foreach($result_time as $result){
    if($result['count'] > 0){
        $return['time']['data'][] = round($result['val']/$result['count'],2);
    } else {
        $return['time']['data'][] = 0;
    }

}

$tsql = "select count(*) as count from BetsDone where FORMAT(TimeStamp,'yyyy-MM-dd') = FORMAT( GETDATE( ) ,'yyyy' ) and ClientUsername = '".$user_name."'";
$stmt4 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)){
    $return['resume']['betcount'] = $obj['count'];
}

$tsql = "select count(*) as count from BetsDone where FORMAT(TimeStamp,'yyyy-MM-dd') = FORMAT( GETDATE( ) ,'yyyy' ) and ClientUsername = '".$user_name."' and OutCome ='unsettled'";
$stmt4 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)){
    $return['resume']['Unsettled'] = $obj['count'];
}

$tsql = "select count(*) as count from BetsDone where FORMAT(TimeStamp,'yyyy-MM-dd') = FORMAT( GETDATE( ) ,'yyyy' ) and ClientUsername = '".$user_name."' and OutCome ='settled'";
$stmt4 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)){
    $return['resume']['settled'] = $obj['count'];
}

$tsql = "select sum(Stake) as Stake from BetsDone where FORMAT(TimeStamp,'yyyy-MM-dd') = FORMAT( GETDATE( ) ,'yyyy' ) and ClientUsername = '".$user_name."'";
$stmt4 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)){
    $return['resume']['Stake'] = $obj['Stake'];
}

$tsql = "select sum(Profit) as Profit from BetsDone where FORMAT(TimeStamp,'yyyy-MM-dd') = FORMAT( GETDATE( ) ,'yyyy' ) and ClientUsername = '".$user_name."'";
$stmt4 = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)){
    $return['resume']['Profit'] = $obj['Profit'];
}

$return['resume']['ROI'] = $obj['ROI'];

echo json_encode($return);
die();


// echo "<pre>";
// print_r($result_time);
// echo "</pre>";
// die();
