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
<div class="card">
    <div class="card-header">
      <h3 style="margin:0">
            <span class="badge badge-lg badge-primary text-white"><i class="fas fa-list mr-2"></i>
            :
            <?php
              require('./config/counter.php');
              
              $sql = "SELECT * FROM bloccoa";
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
            <a href="admin_block_list.php" class="btn btn-warning float-right"><i class="fas fa-sync"></i></a>
      </h3>
    </div>
    <div class="card-body pr-2 pl-2">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th  class="text-center">#</th>
                <th  class="text-center">Blocco</th>
                <th  class="text-center">Giorno</th>
                <th  class="text-center">1° Ora</th>
                <th  class="text-center">2° Ora</th>
                <th  class="text-center">3° Ora</th>
                <th  class="text-center">4° Ora</th>
                <th  class="text-center">5° Ora</th>
                <th  width='15%' class="text-center">Azioni</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $allUser = $users->selectAllBlockData();
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
                        <td><?php echo $value->blocco; ?></td>
                        <td><?php echo $value->giorno; ?></td>
                        <td><?php echo $value->materia_1; ?></td>
                        <td><?php echo $value->materia_2; ?></td>
                        <td><?php echo $value->materia_3 ?></td>
                        <td><?php echo $value->materia_4 ?></td>
                        <td><?php echo $value->materia_5 ?></td>
                        <td>
                            <?php if ( Session::get("roleid") == '1') {?>
                                <a class="btn btn-success btn-sm" href="view.php?id=<?php echo $value->id;?>">View</a>
                                <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
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