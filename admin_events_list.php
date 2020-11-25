<?php
    include 'inc/head.php';
    Session::Check4Role();
?>
<?php
    if (isset($_GET['remove_ve'])) {
      $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_ve']);
      $remove_ve = $users->deleteEventsAdById($remove);
    }
    if (isset($remove_ve)) {
      echo $remove_ve;
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
            <span class="badge badge-lg badge-primary text-white"><i class="fas fa-users mr-2"></i>
            :
            <?php
              require('./config/counter.php');
              
              $sql = "SELECT * FROM events WHERE matu = 0";
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
            <span class="badge badge-lg badge-secondary text-black"><i class="fas fa-user-times mr-2"></i>
            :
            <?php
              require('./config/counter.php');

              $sql1 = "SELECT * FROM events WHERE matu = 1";
              $mysqliStatus1 = $mysqli->query($sql1);
              $rows_count_value1 = mysqli_num_rows($mysqliStatus1);
              $e = 'Nessuno';
              if($rows_count_value1 >0){
                echo $rows_count_value1;
              }else{
                echo $e;
              }
              $mysqli->close();
            ?>  
            </span>
            <span class="badge badge-lg badge-warning text-black"><i class="fas fa-user mr-2"></i>
            :
            <?php
              require('./config/counter.php');
              $sql2 = "SELECT * FROM events WHERE matu = 2";
              $mysqliStatus2 = $mysqli->query($sql2);
              $rows_count_value2 = mysqli_num_rows($mysqliStatus2);
              $e = 'Nessuno';
              if($rows_count_value2 >0){
                echo $rows_count_value2;
              }else{
                echo $e;
              }
              $mysqli->close();
            ?>  
            </span>
          <a href="admin_events_list.php" class="btn btn-warning float-right"><i class="fas fa-sync"></i></a>
      </h3>
    </div>
    <div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th  class="text-center">Tag</th>
                <th  class="text-center">Data</th>
                <th  class="text-center">Nome</th>
                <th  class="text-center">Priorità</th>
                <th  class="text-center">Visibilità</th>
                <th  class="text-center">Classe</th>
                <th  width='25%' class="text-center">Azioni</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $allUser = $users->selectAllEventsTOTData();
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
                        <td><?php echo $value->tag; ?></td>
                        <td><?php echo $value->idate; ?></td>
                        <td><?php echo $value->ename; ?></td>
                        <td>
                            <?php if ($value->prio == '1') { ?>
                              <span class="badge badge-lg badge-danger text-white">Test semestrale</span>
                            <?php } ?>
                            <?php if ($value->prio == '2') { ?>
                              <span class="badge badge-lg badge-warning text-white">Test</span>
                            <?php } ?>
                            <?php if ($value->prio == '3') { ?>
                              <span class="badge badge-lg badge-success text-white">Compito ++</span>
                            <?php } ?>
                            <?php if ($value->prio == '4') { ?>
                              <span class="badge badge-lg badge-info text-white">Compito</span>
                            <?php } ?>
                            <?php if ($value->prio == '5') { ?>
                              <span class="badge badge-lg badge-info text-white">Esterna</span>
                            <?php } ?>
                        </td>
                        <td>
                          <?php if($value->vis == '1'){ ?>
                            <span class="badge badge-lg badge-success text-white">Pubblico</span>
                          <?php } ?>
                          <?php if($value->vis == '2'){ ?>
                            <span class="badge badge-lg badge-warning text-white">Privato</span>
                          <?php } ?>
                        </td>
                        <td>
                            <?php if($value->matu == '0'){ ?>
                                <span class="badge badge-lg badge-success text-white">Maturità</span>
                            <?php } ?>
                            <?php if($value->matu == '1'){ ?>
                                <span class="badge badge-lg badge-danger text-white">Non maturità</span>
                            <?php } ?>
                            <?php if($value->matu == '2'){ ?>
                                <span class="badge badge-lg badge-warning text-white">Professionale</span>
                            <?php } ?>
                        </td>
                        <td>
                          <?php if ( Session::get("roleid") == '4') {?>
                            <a class="btn btn-success btn-sm" href="viewEA.php?id=<?php echo $value->id;?>">View</a>
                            <a class="btn btn-info btn-sm " href="editEA.php?id=<?php echo $value->id;?>">Edit</a>
                            <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                <?php if ($value->idate > date(current)) {
                                  echo "disabled";
                                } ?>
                            btn-sm " href="?remove_ve=<?php echo $value->id;?>">Remove</a>
                          <?php } ?>
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