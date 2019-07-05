<?php

include('config.php');
$user_id = $_SESSION['id'];

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
    $result_week[$today] =0;
    $return['week']['label'][]=$week_array1[$j];
    $today++;
    if($today >31 ) $today = 1;
}



$tsql = "select Bet365User from clients where SystemUsersID = '".$user_id."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $client_name = $obj['Bet365User'];

    $tsql1 = "select * from BetsDone where TimeStamp >= (CURRENT_TIMESTAMP-6) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$client_name."'";
    $stmt1 = sqlsrv_query( $conn, $tsql1);
    while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
      $timestamp = strtotime($obj['TimeStamp']);
      $php_date = getdate($timestamp);
      $result_week[$php_date['mday']] += (float)$obj1['Profit'];
    }
}

foreach($result_week as $result){
      $return['week']['data'][] = round($result,2);
}

echo json_encode($return);
