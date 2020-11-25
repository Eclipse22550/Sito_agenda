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
    <link rel="stylesheet" href="./assets/style/agenda.css">
    <link rel="stylesheet" href="./assets/style/file.css">
    <link rel="stylesheet" href="./assets/style/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <?php
      if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
      }
    ?>
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
          <a class="navbar-brand" href="index.php"><i class="fas fa-sticky-note mr-2"></i></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        	  <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
              <?php if (Session::get('user_code') == TRUE) {?>
              <?php if (Session::get('roleid') == '4'){?>
                <li class="nav-item">
                  <div class="dropdown show">
                    <a class="btn dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v mr-2"></i>Menu</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="addHour.php">Aggiungi giorno</a>
                      <a class="dropdown-item" href="addClass.php">Aggiungi aula</a>
                      <a class="dropdown-item" href="addSig.php">Aggiungi docente</a>
                    </div>
                  </div>
                </li>
              <?php }?>
              <?php if (Session::get('roleid') == '15398') {?>
                <li class="nav-item">
                  <div class="dropdown show">
                    <a class="btn dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v mr-2"></i>Menu admin</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="index.php">Index page</a>
                      <a class="dropdown-item" href="login4Role.php">Login super-admin</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="addHour.php">Aggiungi giorno</a>
                      <a class="dropdown-item" href="addClass.php">Aggiungi aula</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="addUser.php">Registra un utente</a>
                      <a class="dropdown-item" href="regDoc.php">Registra un docente</a>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <div class="dropdown show">
                    <a class="btn dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-database mr-2"></i>Database</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="admin_block_list.php">Blocchi</a>
                      <a class="dropdown-item" href="admin_aule_list.php">Aule</a>
                      <a class="dropdown-item" href="admin_docenti_list.php">Docenti</a>
                    </div>
                  </div>
                </li>
              <?php } ?>
                <li class="nav-item">
                  <a class="nav-link" href="index.php"><i class="fas fa-home mr-2"></i>Home</a>
                </li>
                <li class="nav-item
                  <?php
                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current = basename($path, '.php');
                    if ($current == 'addUser') {
                      echo "active";
                    }
                  ?>
                ">
                  <a class="nav-link" href="agenda.php"><i class="fas fa-calendar-times mr-2"></i>Agenda</span></a>
                </li>
                <li class="nav-item
                  <?php
                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current = basename($path, '.php');
                    if ($current == 'Test') {
                      echo "active";
                    }
                  ?>
                ">
                  <a class="nav-link" href="Test.php"><i class="fas fa-graduation-cap mr-2"></i>Test</span></a>
                </li>
                <li class="nav-item
                  <?php
                    $path = $_SERVER['SCRIPT_FILENAME'];
                    $current = basename($path, '.php');
                    if ($current == 'addUser') {
                      echo "disable";
                    }
                  ?>
                ">
                  <a class="nav-link" href="compito.php"><i class="fas fa-list-alt mr-2"></i>Compiti</span></a>
                </li>
              <li class="nav-item
                <?php 
                  $path = $_SERVER['SCRIPT_FILENAME'];
                  $current = basename($path, '.php');
                  if ($current == 'profile') {
                    echo "active";
                  }
                ?>
              ">
                <a class="nav-link" href="docenti.php"><i class="fas fa-users mr-2"></i>Docenti</span></a>
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
                    <a class="dropdown-item" href="myProfile.php"><i class="fab fa-500px mr-2"></i>Profilo</a>
                    <a class="dropdown-item" href="managementDates.php"><i class="fas fa-keyboard mr-2"></i>Gestione dati</a>
                    <a class="dropdown-item" href="?action=logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          <?php }else{ ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php"><i class="fas fa-user mr-2"></i>Accedi</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php"><i class="fas fa-user-plus mr-2"></i>Registrazione</a>
            </li>
          <?php } ?>
        </div>
      </nav>