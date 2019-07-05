<?php

$client_name = $_POST['username'];

$tsql1 = "select count(*) as count, sum(Stake) as Stake, sum(Profit) as Profit from BetsDone where ClientUsername = '".$client_name."'";
$stmt1 = sqlsrv_query( $conn, $tsql1);
while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
  $return['count'] += $obj1['count'];
  $return['Stake'] += $obj1['Stake'];
  $return['Profit'] += $obj1['Profit'];
}

$tsql1 = "select count(*) as count from BetsDone where ClientUsername = '".$client_name."' and OutCome ='unsettled'";
$stmt1 = sqlsrv_query( $conn, $tsql1);
while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
  $return['unsettled'] += $obj1['count'];
}

$tsql1 = "select count(*) as count from BetsDone where ClientUsername = '".$client_name."' and OutCome ='settled'";
$stmt1 = sqlsrv_query( $conn, $tsql1);
while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
  $return['settled'] += $obj1['count'];
}

echo json_encode($return);

?>
