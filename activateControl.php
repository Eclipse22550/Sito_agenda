<?php
  include 'inc/head.php';
  Session::Check4Role();

  if (isset($_GET['remove_act'])) {
    $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_act']);
    $remove_act = $users->deleteActById($remove);
  }
  if (isset($remove_act)) {
    echo $remove_act;
  } 
  if (isset($_GET['active_act'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active_act']);
    $active_act = $users->userActivation($active);
  }
  if (isset($active_act)) {
    echo $active_act;
  }
?>
<div class="card">
    <div class="card-header">
      <h3 style="margin:0">
            <span class="badge badge-lg badge-primary text-white"><i class="fas fa-users mr-2"></i>
            :
            <?php
              require('./config/counter.php');
              
              $sql = "SELECT * FROM login WHERE isActive = 1";
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

              $sql1 = "SELECT isActive FROM login WHERE isActive";
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
          <a href="activateControl.php" class="btn btn-warning float-right"><i class="fas fa-sync"></i></a>
      </h3>
    </div>
    <div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th  class="text-center">Nome</th>
                <th  class="text-center">Cognome</th>
                <th  class="text-center">Username</th>
                <th  class="text-center">Email</th>
                <th  class="text-center">Sato</th>
                <th  class="text-center">Ruolo</th>
                <th  width='25%' class="text-center">Azioni</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $allUser = $users->selectActivationData();
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
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->lname; ?></td>
                        <td><?php echo $value->username; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td>
                            <?php if ($value->isActive == '0') { ?>
                              <span class="badge badge-lg badge-info text-white">Actived</span>
                            <?php }else{ ?>
                              <span class="badge badge-lg badge-danger text-white">Disactived</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($value->roleid == '1') { ?>
                              <span class="badge badge-lg badge-info text-white">Admin</span>
                            <?php } ?>
                            <?php if ($value->roleid == '2') { ?>
                              <span class="badge badge-lg badge-info text-white">Moderatore</span>
                            <?php } ?>
                            <?php if ($value->roleid == '3') { ?>
                              <span class="badge badge-lg badge-info text-white">Utente</span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ( Session::get("roleid") == '4') {?>
                                <a class="btn btn-success btn-sm" href="viewA.php?id=<?php echo $value->id;?>">View</a>
                                <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                    <?php if (Session::get("id") == $value->id) {
                                      echo "disabled";
                                    } ?>
                                btn-sm " href="?remove_act=<?php echo $value->id;?>">Remove</a>
                            <?php if ($value->qta == '0') {  ?>
                                <a onclick="return confirm('Sei sicuro di disattivarlo?')" class="btn btn-warning
                                    <?php if (Session::get("id") == $value->id) {
                                      echo "disabled";
                                    } ?>
                                btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                            <?php } elseif($value->qta == '1'){?>
                                <a onclick="return confirm('Sei sicuro di attivarlo?')" class="btn btn-secondary
                                    <?php if (Session::get("id") == $value->id) {
                                      echo "disabled";
                                    } ?>
                                btn-sm " href="?active_act=<?php echo $value->id;?>">Active</a>
                            <?php } ?>
                            <?php  }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '2'){ ?>
                              <a class="btn btn-success btn-sm " href="view.php?id=<?php echo $value->id;?>">View</a>
                              <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php  }elseif( Session::get("roleid") == '2'){ ?>
                                <a class="btn btn-success btn-sm
                                    <?php if ($value->roleid == '1') {
                                      echo "disabled";
                                    } ?>
                                " href="profile.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm
                                    <?php if ($value->roleid == '1') {
                                      echo "disabled";
                                    } ?>
                                " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php }elseif(Session::get("id") == $value->id  && Session::get("roleid") == '3'){ ?>
                                <a class="btn btn-success btn-sm " href="view.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                            <?php }else{ ?>
                                <a class="btn btn-success btn-sm
                                    <?php if ($value->roleid == '1') {
                                        echo "disabled";
                                    } ?>
                                " href="profile.php?id=<?php echo $value->id;?>">View</a>
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