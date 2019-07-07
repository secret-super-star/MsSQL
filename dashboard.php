<?php

include('config.php');

if(!isset($_SESSION['username'])){
    header("location:index.php");
}

$tsql = "select * from SystemUsers where id = '".$_SESSION['id']."'";
$stmt = sqlsrv_query( $conn, $tsql);
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
  $advanced = $obj['AdvancedUser'];
}

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
  <link rel="stylesheet" href="../assets/css/daterangepicker.min.css"/>
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
          <li data-value="All" class=""><a href="./summary.php"><i class="now-ui-icons design_app"></i><p style='font-size : 14px;'>All Accounts</p></a></li>
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

      <div class="panel-header panel-header-lg" style='height : 400px;'>
        <canvas id="chart_year"></canvas>
      </div>
      <div class="content">
        <div class="row card_row">
            <div class="col-lg-4">
                <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Last 30 days</h5>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="chart_month"></canvas>
                    </div>
                </div>
                <div class="card-footer ">
                  <div class="stats">
                    <i class="now-ui-icons loader_refresh spin"></i>  Updated <span class='card_update'>1</span> minutes ago
                  </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Last 7 days</h5>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="chart_week"></canvas>
                    </div>
                </div>
                <div class="card-footer ">
                  <div class="stats">
                    <i class="now-ui-icons loader_refresh spin"></i> Updated <span class='card_update'>1</span> minutes ago
                  </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Last 24 hours</h5>

                </div>
                <div class="card-body">
                    <div class="chart-area">
                    <canvas id="chart_time"></canvas>
                    </div>
                </div>
                <div class="card-footer ">
                  <div class="stats">
                    <i class="now-ui-icons loader_refresh spin"></i> Updated <span class='card_update'>1</span> minutes ago
                  </div>
                </div>
                </div>
            </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Today Resume</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Bets Done</label>
                        <input type="text"  class="form-control bets_done" placeholder="" value="" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Unsettled</label>
                        <input type="text" class="form-control unsettled" placeholder="" value="" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Settled</label>
                        <input type="text" class="form-control settled" placeholder="" value="" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>In Stake</label>
                        <input type="text" class="form-control instake" placeholder="" value="" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Profit</label>
                        <input type="text" class="form-control profit" placeholder="" value="" readonly>
                      </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>ROI</label>
                        <input type="text" class="form-control roi" placeholder="" value="" readonly>
                      </div>
                    </div>

                  </div>

                </form>
              </div>
            </div>
          </div>

        </div>

        <?php
          if($advanced == true){
        ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Settings</h5>
              </div>
              <div class="card-body">
                <form action="save_setting.php" method="post">
                  <div class="row">
                      <input type="hidden" class="form-control account_id" name="account_id" placeholder="" value="" readonly>
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Fixed Return Value</label>
                          <input type="text" class="form-control frv" name="frv" placeholder="" value="" >
                        </div>
                      </div>
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Max per Event</label>
                          <input type="text" class="form-control mpe" name="mpe" placeholder="" value="" >
                        </div>
                      </div>
                      <div class="col-md-12 pr-1">
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php
          }
        ?>

        <div class="row table_row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Bets History</h4>
                <button class="btn btn-primary btn-sm filter_button" data-value='time'>Last 24 hours</button>
                <button class="btn btn-default btn-sm filter_button" data-value='week'>Last 7 days</button>
                <button class="btn btn-default btn-sm filter_button" data-value='month'>Last 30 days</button>
                <input id="date-range" size="40" value="">
              </div>
              <div class="card-body">
                <div class="">
                  <table class="status_table"style="width:100%" >
                    <thead class="">
                      <th>
                        Date
                      </th>
                      <th>
                        Event
                      </th>
                      <th>
                        Stake
                      </th>
                      <th style='width: 50px !important;'>
                        Evaluation
                      </th>
                      <th style='width: 40px !important;'>
                        Odd
                      </th>
                      <th >
                        Market
                      </th>
                      <!-- <th >
                        Result
                      </th> -->
                      <th style='width: 40px !important;'>
                        Profit
                      </th>
                    </thead>
                    <tbody id='status_table'>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ">
                <div class="stats">
                  <i class="now-ui-icons loader_refresh spin"></i> Updated <span class='table_update'>1</span> minutes ago
                </div>
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
  <script type="text/javascript" src="../assets/js/moment.min.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.daterangepicker.min.js"></script>

  <script type="text/javascript">
    var username = '<?php echo $_GET['username'] ?>';
  </script>

  <script src="../assets/js/custom.js"></script>

</body>

</html>
