<?php

include('config.php');

if(!isset($_SESSION['username'])){
    header("location:index.php");
}

$week_day = date('w');

$date_l1 = ($week_day + 2) % 7  ;
if(($week_day + 2) % 7 == 0) $date_l1 = 7;
$date_l2 = 7 - $date_l1 ;

$date = date("m/d/Y", strtotime("-$date_l1 day"));
$date1 = date("m/d/Y", strtotime("+$date_l2 day"));

$period = $date . " to " . $date1;

$user_name = $_SESSION['username'];
$user_id = $_SESSION['id'];

$tsql = "select count(*) as count from SystemUsers where Referral = '".$user_name."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $Affiliates =  $obj['count'];
}

$betsdone = 0;
$total_stake = 0;
$total_profit = 0;
$commission = 0;
$week_profit = 0;

$tsql = "select sum(WeekProfit) as WeekProfit from clients where SystemUsersID = '".$user_id."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  $week_profit = round($obj['WeekProfit'], 2);
}

$tsql = "select Bet365User from clients where SystemUsersID = '".$user_id."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $client_name = $obj['Bet365User'];

    $tsql1 = "select count(*) as count, sum(Stake) as Stake, sum(Profit) as Profit from BetsDone where TimeStamp >= (CURRENT_TIMESTAMP-6) and TimeStamp <= (CURRENT_TIMESTAMP-1) and ClientUsername = '".$client_name."'";
    $stmt1 = sqlsrv_query( $conn, $tsql1);
    while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
      $betsdone += $obj1['count'];
      $total_stake += $obj1['Stake'];
      $total_profit += $obj1['Profit'];
    }
}

$tsql = "select commission from SystemUsers where id = '".$user_id."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $commission =  $obj['commission'];
}

$tsql = "select * from clients where SystemUsersID = '".$user_id."' and Enabled='true'";

$stmt = sqlsrv_query( $conn, $tsql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>

  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link href="../assets/css/custom.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> -->
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo text-center">

        <a href="./summary.php" class="simple-text logo-normal">
          <?php echo $_SESSION['username']; ?>
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <div class="action_bar mt-4">

          <a href="./add_userpage.php" style="color:white">
            <i class="fas fa-user-plus"></i> <span>Add Account</span>
          </a>
          <br>
          <br>

          <a href="./remove_userpage.php" style="color:white">
            <i class="fas fa-user-minus"></i> <span>Remove Account</span>
          </a>
          <br>
          <br>


          <a href="./affiliates.php" style="color:white">
            <i class="now-ui-icons files_paper"></i> <span>View Affiliates Performance</span>
          </a>
          <br>
          <br>



        </div>

        <hr>
        <ul class="nav user_list">
          <li data-value="All" class="active"><a href="./summary.php"><i class="now-ui-icons design_app"></i><p style='font-size : 14px;'>All Accounts</p></a></li>
          <?php
          while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
            ?>
            <li data-value="<?php echo $obj['Bet365User'] ?>" ><a href="./dashboard.php?username=<?php echo $obj['Bet365User'] ?>"><i class="now-ui-icons design_app"></i><p><?php echo $obj['Bet365User'] ?></p></a></li>
            <?php
          }
          ?>
        </ul>
        <!-- <div class='p-2'>
            <select name="cars" class="custom-select" id='user_select'>
            </select>
        </div> -->

      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav">

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="/logout.php">Log Out</a>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <div class="panel-header panel-header-lg" style='height : 100px;'>

      </div>
      <div class="content">
        <div class="row card_row">
          <div class="col-lg-12 col-md-12">
              <div class="card card-chart">
              <div class="card-header">
                  <h5 class="card-category">This week. <strong  style="font-size : 14px; color: black;"> <?php echo $period ?> </strong></h5>
              </div>
              <div class="card-body">
                  <div class="chart-area">
                  <canvas id="chart_week"></canvas>
                  </div>
              </div>
              <div class="card-footer ">

              </div>
              </div>
          </div>
        </div>
        <div class="row table_row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Affiliates Performance  <strong style="font-size : 14px; color: black;"> <?php echo $period ?> </strong></h4>

              </div>
              <div class="card-body">
                <form>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Affiliate Link</label>&nbsp;<a href="http://178.238.233.75/register.php?ref=<?php echo $_SESSION['username']; ?>">Go this link</a>
                        <input type="text"  class="form-control bets_done" placeholder="" value="http://178.238.233.75/register.php?ref=<?php echo $_SESSION['username']; ?>">
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Affiliates</label>
                        <input type="text"  class="form-control bets_done" placeholder="" value="<?php echo $Affiliates ?>">
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Bets</label>
                        <input type="text" class="form-control unsettled" placeholder="" value="<?php echo $betsdone; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Total Stake</label>
                        <input type="text" class="form-control settled" placeholder="" value="<?php echo $total_stake; ?>">
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Total Profit</label>
                        <input type="text" class="form-control instake" placeholder="" value="<?php echo $total_profit; ?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Week Profit (Real Win/Loss in the period)</label>
                        <input type="text" class="form-control profit" placeholder="" value="<?php echo $week_profit; ?>">
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Commission calculated</label>
                        <input type="text" class="form-control profit" placeholder="" value="<?php echo $week_profit/$commission; ?>">
                      </div>
                    </div>


                  </div>

                </form>
              </div>
              <div class="card-footer ">

              </div>
            </div>
          </div>
        </div>

        <div class="row table_row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Affiliates <strong style="font-size : 14px; color: black;"> <?php echo $period ?> </strong></h4>

              </div>
              <div class="card-body">
                <div class="">
                  <table class="affiliates_table"style="width:100%" >
                    <thead class="">
                      <th>
                        Name
                      </th>
                      <th>
                        Accounts
                      </th>
                      <th>
                        Bets Done
                      </th>
                      <th>
                        Stake
                      </th>
                      <th>
                        Profit
                      </th>
                    </thead>
                    <tbody id='status_table'>
                      <?php
                        $tsql = "select * from SystemUsers where Referral = '".$user_name."'";
                        $stmt = sqlsrv_query( $conn, $tsql);
                        while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

                            echo "<tr>";
                            echo "<td>".$obj['Username']."</td>";

                            $tsql1 = "select count(*) as count from clients where SystemUsersID = '".$obj['id']."'";
                            $stmt1 = sqlsrv_query( $conn, $tsql1);

                            while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
                              echo "<td>".$obj1['count']."</td>";
                            }

                            $betsdone = 0;
                            $stake = 0;
                            $profit = 0;

                            $tsql1 = "select * from clients where SystemUsersID = '".$obj['id']."'";
                            $stmt1 = sqlsrv_query( $conn, $tsql1);

                            while($obj1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)){
                                $tsql2 = "select count(*) as count, sum(Stake) as stake from BetsDone where ClientUsername = '".$obj1['Bet365User']."'";
                                $stmt2 = sqlsrv_query( $conn, $tsql2);

                                while($obj2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){
                                    $betsdone += $obj2['count'];
                                    $stake += $obj2['stake'];
                                }

                                $tsql2 = "select sum(Stake) as stake from BetsDone where ClientUsername = '".$obj1['Bet365User']."' and OutCome='settled'";
                                $stmt2 = sqlsrv_query( $conn, $tsql2);

                                while($obj2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){
                                    $profit += $obj2['stake'];
                                }

                            }

                            echo "<td>".$betsdone."</td>";
                            echo "<td>".$stake."</td>";
                            echo "<td>".$profit."</td>";
                            echo "</tr>";
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ">

              </div>
            </div>
          </div>
        </div>

      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>

              <li>
                <a href="">
                  About Us
                </a>
              </li>

            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  <script src="../assets/js/affiliate.js" type="text/javascript"></script>
  <script type="text/javascript">

    datatable = $(".affiliates_table").DataTable({
        // paging: false,
        stateSave: true,
        searching: false,
        info: false
    });

  </script>
</body>

</html>
