<?php
  include 'inc/head.php';
  Session::Check4Role();
  $logMsg = Session::get('logMsg');
  if (isset($logMsg)) {
    echo $logMsg;
  }
  $msg = Session::get('msg');
  if (isset($msg)) {
    echo $msg;
  }
  Session::set("msg", NULL);
  Session::set("logMsg", NULL);
?>
<div class="card">
  <div class="card-header">
    <div class="card bg-success">
      <div class="card-header card-lg">
        <strong>Stato</strong>
      </div>
      <div class="card-body">

      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h3 style="margin:0"><i class="fas fa-database mr-2"></i>Super admin</h3> 
          </div>
          <div class="card-body">
            <h3>
              <span class="badge badge-lg badge-primary">
                <i class="fas fa-database mr-2"></i>:
                <?php
                  require('./config/counter.php');
                  $sql = "SELECT * FROM admin";
                  $mysqliStatus = $mysqli->query($sql);
                  $rows_count_value = mysqli_num_rows($mysqliStatus);
                  echo $rows_count_value; 
                  $mysqli->close();	
                ?>
              </span>
            </h3>
            <p class="card-text">Database con i dati degli utenti(ruolo 4).</p>
            <a href="" class="btn btn-primary float-right">Mostra i risultati</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h3 style="margin:0"><i class="fas fa-database mr-2"></i>Login</h3> 
          </div>
          <div class="card-body">
            <h3>
              <span class="badge badge-lg badge-primary">
                <i class="fas fa-database mr-2"></i>:
                <?php
                  require('./config/counter.php'); 
                  $sql = "SELECT * FROM login";
                  $mysqliStatus = $mysqli->query($sql);
                  $rows_count_value = mysqli_num_rows($mysqliStatus);
                  echo $rows_count_value; 
                  $mysqli->close();	
                ?>
              </span>
            </h3>
            <p class="card-text">Database con i dati degli utenti(ruolo 1 -> 3).</p>
            <a href="admin_login_list.php" class="btn btn-primary float-right">Mostra i risultati</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">
            <h3 style="margin:0"><i class="fas fa-database mr-2"></i>Eventi</h3> 
          </div>
          <div class="card-body">
            <h3>
              <span class="badge badge-lg badge-primary">
                <i class="fas fa-database mr-2"></i>:
                <?php
                  require('./config/counter.php');
                  $sql = "SELECT * FROM events";
                  $mysqliStatus = $mysqli->query($sql);
                  $rows_count_value = mysqli_num_rows($mysqliStatus);
                  echo $rows_count_value; 
                  $mysqli->close();	
                ?>
              </span>
            </h3>
            <p class="card-text">Database con gli eventi.</p>
            <a href="admin_events_list.php" class="btn btn-primary float-right">Mostra i risultati</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
    include 'inc/footer.php';
?>