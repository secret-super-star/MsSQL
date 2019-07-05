<?php

include('config.php');

if(!isset($_SESSION['username'])){
    header("location:index.php");
}

$user_id = $_SESSION["id"];

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

        <a href="./dashboard.php" class="simple-text logo-normal">
          <?php echo $_SESSION['username']; ?>
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <div class="action_bar mt-4">
          <a href="./dashboard.php" style="color:white">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
          </a>
          <br>
          <br>

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

          <a href="./summary.php" style="color:white">
            <i class="now-ui-icons files_paper"></i> <span>Account Summary</span>
          </a>

        </div>

        <hr>
        <ul class="nav user_list">
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

        <div class="row table_row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">User lists</h4>
              </div>
              <div class="card-body">
                <div class="">
                  <table class="accounts_table"style="width:100%" >
                    <thead class="">
                      <th>
                        Username
                      </th>
                      <th>
                        Balance
                      </th>
                      <th>
                        Delete
                      </th>

                    </thead>
                    <tbody id='accounts_table'>
                      <?php
                      while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                        ?>
                        <tr>
                          <td><?php echo $obj['Bet365User'] ?></td>
                          <td><?php echo $obj['KellyBalance'] ?></td>
                          <td> <a href='/remove_user.php?id=<?php echo $obj['id'] ?>' class="btn btn-primary delete_user">Delete</a> </td>
                        </tr>
                        <?php
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
  <script src="../assets/js/now-ui-dashboard.js?v=1.3.0" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    datatable = $(".accounts_table").DataTable({
        // paging: false,
        searching: false,
        info: false
    });

    $('.delete_user').click(function (e){
      e.preventDefault();
      if(window.confirm("Are you sure?")){
        window.location.href = $(this).attr('href');
      }
    })
  </script>

</body>

</html>
