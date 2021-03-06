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
  if (isset($_GET['remove'])) {
    $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove']);
    $removeUser = $users->deleteUserById($remove);
  }
  if (isset($removeUser)) {
    echo $removeUser;
  }
  if (isset($_GET['deactive'])) {
    $deactive = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['deactive']);
    $deactiveId = $users->userDeactiveByAdmin($deactive);
  }
  if (isset($deactiveId)) {
    echo $deactiveId;
  }
  if (isset($_GET['active'])) {
    $active = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['active']);
    $activeId = $users->userActiveByAdmin($active);
  }
  if (isset($activeId)) {
    echo $activeId;
  }
?>
<div class="card">
    <div class="card-header">
      <h3 style="margin:0">
            <span class="badge badge-lg badge-primary text-white"><i class="fas fa-users mr-2"></i>
            :
            <?php
              require('./config/counter.php');
              
              $sql = "SELECT * FROM admin";
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

              $sql1 = "SELECT isActive FROM admin WHERE isActive";
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
              $a = $rows_count_value;
              $b = $rows_count_value1;
              $c = ($a - $b);
              $d = 'Tutti';

              if($b >0){
                echo $c;
              }else{
                echo $d;
              }
            ?>  
          </span>
          <a href="admin_admin_list.php" class="btn btn-warning float-right"><i class="fas fa-sync"></i></a>
      </h3>
    </div>
    <div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th  class="text-center">#</th>
                <th  class="text-center">Nome</th>
                <th  class="text-center">Username</th>
                <th  class="text-center">Email</th>
                <th  class="text-center">Sato</th>
                <th  class="text-center">Ruolo</th>
                <th  class="text-center">Modificato il...</th>
                <th  width='25%' class="text-center">Azioni</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $allUser = $users->selectAllUserAdminData();
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
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->username; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td>
                            <?php if ($value->isActive == '0') { ?>
                              <span class="badge badge-lg badge-info text-white">Actived</span>
                            <?php }else{ ?>
                              <span class="badge badge-lg badge-danger text-white">Disactived</span>
                            <?php } ?>
                        </td>
                        <td><?php echo $value->roleid ?></td>
                        <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->updated_at;  ?></span></td>
                        <td>
                            <?php if ( Session::get("roleid") == '1') {?>
                                <a class="btn btn-success btn-sm" href="view.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                                <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                    <?php if (Session::get("id") == $value->id) {
                                      echo "disabled";
                                    } ?>
                                btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>
                            <?php if ($value->isActive == '0') {  ?>
                                <a onclick="return confirm('Sei sicuro di disattivarlo?')" class="btn btn-warning
                                    <?php if (Session::get("id") == $value->id) {
                                      echo "disabled";
                                    } ?>
                                btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                            <?php } elseif($value->isActive == '1'){?>
                                <a onclick="return confirm('Sei sicuro di attivarlo?')" class="btn btn-secondary
                                    <?php if (Session::get("id") == $value->id) {
                                      echo "disabled";
                                    } ?>
                                btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
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