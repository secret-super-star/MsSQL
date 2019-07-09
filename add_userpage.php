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

        <div class="row table_row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add account</h4>
              </div>
              <div class="card-body">
                <form action="add_user.php" class="add_form" method="post">

                  <div class="row col-md-12">

                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Bet365 username</label>
                        <input type="text" class="form-control" name='username' value="" required>
                      </div>
                    </div>

                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Bet365 password</label>
                        <input type="text" class="form-control password" name='password' value="" required>
                      </div>
                    </div>



                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Initial Balance</label>
                        <input type="number" min='0' class="form-control" name='balance' value="0" required>
                      </div>
                    </div>

                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <p><input type="checkbox"> I have set the account Laguage to English</p>
                        <p><input type="checkbox"> I have set Timezone to UK</p>
                        <p><input type="checkbox"> I have set the Maximum inactivity Time to 12h</p>
                        <p><input type="checkbox"> I have set the odds to decimal</p>
                      </div>
                    </div>

                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <p><strong>Terms of service</strong></p>
                        <textarea name="name" class="form-control" rows="30" style="max-height : 500px;">Last Updated: 8 February 2019
We are a private club, which only by invitation can people sign up!

Please read these Terms and Conditions (“Terms”, “terms and Conditions”) carefully before using the site www.autobot365.com
Your access to and use of the service is subject to your acceptance and compliance with these Terms. These terms apply to all visitors, users and other persons who access or use the service.
By accessing or using the service, you agree to be bound by these Terms. If you do not agree to any part of the terms, you will not be able to access the service.

Availability, errors and inaccuracies
We are constantly updating our product and service offerings in the service. The products or services available in our service may be incorrectly evaluated, incorrectly described or unavailable, and we may experience delays in updating information about the service and in our advertising on other sites.
We cannot and do not guarantee the accuracy or integrity of any information, including prices, product images, specifications, availability and services. We reserve the right to change or update information and correct errors, inaccuracies or omissions at any time without notice.

Content
Our service allows you to publish, link, store, share and make available certain information, texts, graphics, videos or other materials (“content”). You are responsible for the content you post on the service, including its legality, reliability and suitability.
By publishing content on the service, you grant us the right and license to use, modify, perform publicly, publicly display, reproduce and distribute such content on and through the service. You retain any and all rights over any content you submit, post or display on or through the service and you are responsible for protecting these rights. You agree that this license includes the right to make your content available to other users of the service, who may also use your content subject to these Terms.
You hereby represent and warrant to us that: (i) the Content is yours (you own it) or you have the right to use it and grant us the rights and license as provided in this agreement, and (ii) the posting of your Content on or through the Service does not violate the privacy rights, publicity rights, copyrights, contract rights or any other rights of any other person.

Account
When you create an account with us, you must provide us with accurate, complete and current information at all times. Failure to do so constitutes a breach of the terms, which may result in the immediate termination of your account in our service.
You are responsible for protecting the password you use to access the service and for any activities or actions under your password, whether your password with our service or a third-party service.
You agree not to disclose your password to third parties. You must notify us immediately after you learn of any breach of security or unauthorized use of your account.
You can't use it as a username a name of another person or entity or that is not lawfully available for use, a name or trademark that is subject to any rights of any other person or entity other than you without appropriate authorization, or a name that is otherwise offensive, vulgar or obscene.

Links to other sites
Our service may contain links to third party sites or services that are not owned or controlled by AUTOBET365BOT
AUTOBET365BOT has no control over and assumes no responsibility for the content, privacy policies or practices of any third-party websites or services. You also acknowledge and agree that AUTOBET365BOT will not be liable, directly or indirectly, for any damage or loss caused or allegedly caused by or in connection with the use or reliance on any content, goods or services available on or through these sites or services.
It is highly recommended that you read the terms and conditions and privacy policies of any third-party websites or services you visit.

Bet365 Accounts
Customers must use real accounts. If the account is closed, it is the responsibility of the client alone.
The client authorizes the AUTOBOT365 team to have access to the passwords of the Bet365 accounts to connect the accounts to the servers.
The client knows that even if we were hacked, or had a collaborator with ulterior motives. Since the method of withdrawal in each Bet365 has to be the same as the deposit, it will be unlikely embezzlement.

Cost
Every Saturday the customer has to make the payment (SKRILL, NETELLER or Bitcoin) of 50% of the profit that his Bots have made in the last 7 days, otherwise the service will be automatically suspended until the settlement of the debt.
If there is a week that the customer has no profit, he can use the service (as long as it exists) until he recovers the lost.

Tailors
Our affiliates receive on Mondays 10% of the total profit (20% of what AUTOBET365BOT receives from its direct customers) for an indefinite period.
The affiliates undertake to advertise the business Word-of-mouth, in private, rather than advertising on the web.

Termination
We may terminate or suspend your account immediately, without notice or liability, for any reason, including, without limitation, if you violate the terms.
After the termination, your right to use the service will cease immediately. If you want to close your account, you can simply stop using the service.

Limitation of liability
In no event shall the AUTOBOT365, nor any of its officers, directors, employees, partners, agents, suppliers, or affiliates, be liable to you for any direct, indirect, incidental, special, consequential, punitive or other damages whatsoever, including, but not limited to, loss of profits, data, use, good-will , or other intangible losses, resulting from (i) your access to, use of, or inability to access or use the Service; (ii) any conduct or content of any third party on the Service; or (iii) any content obtained from the Service,; and (iv) the use of, access to, or alteration is not authorized to transmit, or the content, whether based on warranty, contract, tort (including negligence) or under any other legal theory, whether or not we have been advised of the possibility of such damages and even if a remedy set forth herein fails of its essential purpose.

Legal Notice
Your use of the service is at your own risk. The service is provided on a “AS IS” and “as available " basis. The service is provided without warranties of any kind, express or implied, including, but not limited to, implied warranties of merchantability, fitness for a specific purpose, Non-Violation or performance course.
The AUTOBET365 its parent, subsidiaries, affiliates, and its licensors do not warrant that a) the Service will function uninterrupted, secure or available at any given time and the specific location; b) any errors or defects will be corrected; or (c) the results of using the Service will meet your requirements.

Change
We reserve the right, in our sole discretion, to modify or replace these terms at any time. If a review is material, we will try to provide at least 15 days in advance before any new terms enter into force. What constitutes a material change will be determined in our sole discretion.
By continuing to access or use our service after these revisions take effect, you agree to be bound by the revised terms. If you do not agree to the new terms, stop using the service.

Contact Us.
If you have any questions about these Terms, please contact us.
</textarea>
                      </div>
                    </div>

                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <p><input type="checkbox"> I have read and accept the terms and service</p>
                      </div>
                    </div>

                    <div class="col-md-12 pr-1 text-right">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="button">Submit</button>
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
    $('.add_form').submit(function (e){
      e.preventDefault();

        var items = $(this).find('input[type=checkbox]');

        for(let i=0;i<items.length;i++){
          if(!$(items[i]).prop('checked')){
            alert('Confirm all the checkboxes');
            return false;
          }
        }

        $.ajax({
            url: '/add_user.php',
            type: 'post',
            data: $('.add_form').serialize(),
            dataType: 'json',
            cache: false,
            success: function (data, textStatus, jQxhr) {
              console.log(data['success']);
              if(data['success'] == false) {
                nowuiDashboard.showNotification('top','center', 'Cannot create user.', 'danger')
              } else {
                nowuiDashboard.showNotification('top','center', 'New user has been created.' , 'primary')
              }

            },
            error: function (jqXhr, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        }).done(function () { });
    })
  </script>
</body>

</html>
