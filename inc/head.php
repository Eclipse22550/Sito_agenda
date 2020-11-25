<?php
  $filepath = realpath(dirname(__FILE__));
  include_once $filepath."/../lib/Session.php";
  Session::init();
  spl_autoload_register(function($classes){
    include 'classes/'.$classes.".php";
  });
  $users = new Users();
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
  <meta charset="utf-8">
		<title>Organizer</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/css/auth.css">
    <link rel="stylesheet" href="./assets/style/agenda.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  </head>
  <body>
    <?php
      if (isset($_GET['action']) && $_GET['action'] == 'logoutA') {
        Session::destroyA();
      }
      if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
      }
    ?>
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
          <a class="navbar-brand" href="indexRole4.php"><i class="fas fa-sticky-note mr-2"></i></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        	  <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
              <?php if (Session::get('id') == TRUE) {?>
              <?php if (Session::get('roleid') == '4') {?>
                <li class="nav-item">
                  <div class="dropdown show">
                    <a class="btn dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-database mr-2"></i>Menu</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="admin_sadmin_list.php">Super admin list</a>
                      <a class="dropdown-item" href="admin_login_list.php">Login list</a>
                      <a class="dropdown-item" href="admin_events_list.php">Event list</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="?action=logoutA">Accedi come admin</a>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="indexRole4.php"><i class="fas fa-home mr-2"></i>...</a>
                </li>
              <?php } ?>
                <li class="nav-item">
                  <a class="nav-link" href="indexRole4.php"><i class="fas fa-home mr-2"></i>Home</a>
                </li>
              <li class="nav-item">
                <div class="dropdown show">
                  <a class="btn dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user mr-2"></i>
                    <?php
                      $username = Session::get('username');
                      if (isset($username)) {
                        echo $username;
                      }
                    ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="myProfile4.php?id=<?php echo Session::get("id"); ?>"><i class="fab fa-500px mr-2"></i>Profilo</a>
                    <a class="dropdown-item" href="activateControl.php">
                      <i class="fas fa-bell mr-2">
                        <?php if($rows_count_value1 > 0){ ?>
                          <span class="badge badge-sm badge-danger">
                            <?php
                              require('./config/counter.php');
                              $sql1 = "SELECT isActive FROM login WHERE isActive = 1";
                              $mysqliStatus1 = $mysqli->query($sql1);
                              $rows_count_value1 = mysqli_num_rows($mysqliStatus1);
                              echo $rows_count_value1;
                              $mysqli->close();
                            ?>
                          </span>
                        <?php } ?>
                      </i>
                      Attivazioni
                    </a>
                    <a class="dropdown-item" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          <?php }?>
        </div>
      </nav>