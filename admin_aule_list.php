<?php
    include 'inc/header.php';
    Session::CheckSession();
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
<?php
    if (isset($_GET['remove_log'])) {
      $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_log']);
      $remove_log = $users->deleteLoginById($remove);
    }
    if (isset($remove_log)) {
      echo $remove_log;
    }

    if (isset($_GET['deactive_log'])) {
      $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive_log']);
      $deactive_log = $users->LoginDeactiveByAdmin($deactive);
    }

    if (isset($deactive_log)) {
      echo $deactive_log;
    }
    if (isset($_GET['active_log'])) {
      $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active_log']);
      $active_log = $users->LoginActiveByAdmin($active);
    }

    if (isset($active_log)) {
      echo $active_log;
    }
?>
<div class="card">
    <div class="card-header">
      <h3 style="margin:0">
            <span class="badge badge-lg badge-primary text-white"><i class="fas fa-list mr-2"></i>
            :
            <?php
              require('./config/counter.php');
              
              $sql = "SELECT * FROM aule";
              $mysqliStatus = $mysqli->query($sql);
              $rows_count_value = mysqli_num_rows($mysqliStatus);
              $e = 'Nessuno';
              if($rows_count_value >0){
                echo $rows_count_value;
              }else{
                echo $e;
              }
              $mysqli->close();
            ?>  
            </span>
          <a href="admin_aule_list.php" class="btn btn-warning float-right"><i class="fas fa-sync"></i></a>
      </h3>
    </div>
    <div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th  class="text-center">#</th>
                <th  class="text-center">Aula Nr.</th>
                <th  width='25%' class="text-center">Azioni</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $allUser = $users->selectAllAuleData();
                    if ($allUser) {
                      $i = 0;
                    foreach ($allUser as  $value) {
                      $i++;
                ?>
                    <tr class="text-center"
                      <?php if (Session::get("id") == $value->id) {
                        echo "style='background:#d9edf7' ";
                      } ?>
                    >
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->aula; ?></td>
                        <td>
                            <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                <?php if (Session::get("id") == $value->id) {
                                  echo "disabled";
                                } ?>
                            btn-sm " href="?remove_log=<?php echo $value->id;?>">Remove</a>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                      <tr class="text-center">
                      <td colspan="7"><h3 style="margin:0">Nessun utente rilevato!</h3></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
  include 'inc/footer.php';
?>