<?php
  include 'inc/header.php';
  Session::CheckSession();

  $cookie_userid = hash("SHA512", Session::get("user_code"));
  $cookie_name = hash("SHA512", Session::get("username"));
  $cookie_hash = hash("SHA512", Session::get("password"));
  setcookie($cookie_name, $cookie_hash, time() + (86400 * 30), "/");

  $logMsg = Session::get('logMsg');

  if (isset($logMsg)) {
    echo $logMsg;
  }
  
  if (isset($_GET['acept'])) {
    $cookie_userid;
    $cookie_name;
    $acept = $users->CreateSessionLogin($cookie_userid,$cookie_name,$cookie_hash);
  }

  $msg = Session::get('msg');
  if (isset($msg)) {
    echo $msg;
  }

  Session::set("msg", NULL);
  Session::set("logMsg", NULL);

  if (isset($_GET['decline'])){
    $cookie_userid;
    $cookie_name;
    $cookie_hash;
    $decline = $users->DeleteSessionLogin($cookie_userid,$cookie_name,$cookie_hash);
  }
?>
<?php if(!isset($_COOKIE[$cookie_userid])){?>
    <div class="card">
      <?php if(Session::get('roleid') == '79111'){ ?>  
        <div class="card-header">
          <div class="form-check" id="exampleCheck1">
            <input type="checkbox" onclick="show_admin()" class="form-check-input">
            <label class="form-check-label">Mostra pannello admin</label>
          </div>
          <div class="form-check" id="exampleCheck3">
            <input type="checkbox" onclick="show_user()" class="form-check-input">
            <label class="form-check-label">Mostra pannello utente</label>
          </div>
        </div>
        <div id="admin" style="display:none">
          <div class="card-body pr-2 pl-2"> 
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h3 style="margin:0"><i class="fas fa-database mr-2"></i>Blocco</h3> 
                  </div>
                  <div class="card-body">
                    <h3>
                      <span class="badge badge-lg badge-primary">
                        <i class="fas fa-database mr-2"></i>:
                        <?php
                          require('./config/counter.php');

                          $sql = "SELECT * FROM bloccoa";
                          $mysqliStatus = $mysqli->query($sql);
                          $rows_count_value = mysqli_num_rows($mysqliStatus);
                          echo $rows_count_value; 
                          $mysqli->close();	
                        ?>
                      </span>
                    </h3>
                    <p class="card-text">Database con i blocchi settimanali.</p>
                    <a href="admin_block_list.php" class="btn btn-primary float-right">Mostra i risultati</a>
                  </div>
                </div> 
              </div>
            </div> 
            <div class="row mt-4">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h3 style="margin:0"><i class="fas fa-database mr-2"></i>Aule</h3> 
                  </div>
                  <div class="card-body">
                    <h3>
                      <span class="badge badge-lg badge-primary">
                        <i class="fas fa-database mr-2"></i>:
                        <?php
                          require('./config/counter.php');

                          $sql = "SELECT * FROM aule";
                          $mysqliStatus = $mysqli->query($sql);
                          $rows_count_value = mysqli_num_rows($mysqliStatus);
                          echo $rows_count_value; 
                          $mysqli->close();	
                        ?>
                      </span>
                    </h3>
                    <p class="card-text">Database con le aule.</p>
                    <a href="admin_aule_list.php" class="btn btn-primary float-right">Mostra i risultati</a>
                  </div>
                </div> 
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h3 style="margin:0"><i class="fas fa-database mr-2"></i>Docenti</h3> 
                  </div>
                  <div class="card-body">
                    <h3>
                      <span class="badge badge-lg badge-primary">
                        <i class="fas fa-database mr-2"></i>:
                        <?php
                          require('./config/counter.php');

                          $sql = "SELECT * FROM docenti";
                          $mysqliStatus = $mysqli->query($sql);
                          $rows_count_value = mysqli_num_rows($mysqliStatus);
                          echo $rows_count_value; 
                          $mysqli->close();	
                        ?>
                      </span>
                    </h3>
                    <p class="card-text">Database con i dati dei docenti.</p>
                    <a href="admin_docenti_list.php" class="btn btn-primary float-right">Mostra i risultati</a>
                  </div>
                </div> 
              </div>
            </div> 
          </div>
        </div>
        <div id="user" style="display:none">
          <div class="card">
            <div class="card-body pr-2 pl-2">
            <div class="card bg-info">
              <div class="card-header card-lg">
                <strong>Prossimamente</strong>
              </div>
              <div class="card-body">
                <?php if(Session::get('matu') == '0'){ ?>
                  <table class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-center text-black">Data</th>
                        <th class="text-center">Nome evento</th>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Priorità</th>
                        <th class="text-center">Giorni mancanti</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $allUser = $users->selectAllCountData();
                        if ($allUser) {
                          $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;
                      ?>
                        <tr class="text-center"
                          <?php if (Session::get("user_code") == $value->id) {
                            echo "style='background:#d9edf7' ";
                          } ?>
                        >
                          <td class="text-center"><?php echo $value->idate ?></td>
                          <td class="text-center"><?php echo $value->ename ?></td>
                          <td class="text-center"><?php echo $value->tag ?></td>
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
                          <td class="text-center"><?php
                            //$today = time();
                            //
                            //$event = mktime($idate);
                            //
                            //$countdown = round(($event - $today)/86400);
                            //
                            //echo "$countdown";
                          ?></td>
                        </tr>
                      <?php }}else{ ?>
                        <th colspan="6" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                      <?php } ?>
                    </tbody>
                  </table>
                <?php } ?>
                <?php if(Session::get('matu') == '46592'){ ?>
                  <table class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-center text-black">Data</th>
                        <th class="text-center">Nome evento</th>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Priorità</th>
                        <th class="text-center">Giorni mancanti</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $allUser = $users->selectAllNCountData();
                        if ($allUser) {
                          $i = 0;
                        foreach ($allUser as  $value) {
                          $i++;
                      ?>
                        <tr class="text-center"
                          <?php if (Session::get("user_code") == $value->id) {
                            echo "style='background:#d9edf7' ";
                          } ?>
                        >
                          <td class="text-center"><?php echo $value->idate ?></td>
                          <td class="text-center"><?php echo $value->ename ?></td>
                          <td class="text-center"><?php echo $value->tag ?></td>
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
                          <td class="text-center"><?php
                            //$today = time();
                            //
                            //$event = mktime($idate);
                            //
                            //$countdown = round(($event - $today)/86400);
                            //
                            //echo "$countdown";
                          ?></td>
                        </tr>
                      <?php }}else{ ?>
                        <th colspan="6" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                      <?php } ?>
                    </tbody>
                  </table>
                <?php } ?>
              </div>
            </div>
            <br>
            <div class="card bg-danger">
              <div class="card-header card-lg">
                <strong>Notifiche</strong>
              </div>
              <div class="card-body">
                <table class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center text-black">Blocco</th>
                      <th class="text-center">Materia</th>
                      <th class="text-center">Docente</th>
                      <th class="text-center">Data</th>
                      <th class="text-center">Contenuto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $allUser = $users->selectAllOssData();
                      if ($allUser) {
                        $i = 0;
                      foreach ($allUser as  $value) {
                        $i++;
                    ?>
                      <tr class="text-center"
                        <?php if (Session::get("user_code") == $value->id) {
                          echo "style='background:#d9edf7' ";
                        } ?>
                      >
                        <td class="text-center"><?php echo $value->blocco; ?></td>
                        <td class="text-center"><?php echo $value->materia; ?></td>
                        <td class="text-center"><?php echo $value->sig_doc; ?></td>
                        <td class="text-center"><?php echo $value->data; ?></td>
                        <td class="text-center"><?php echo $value->text; ?></td>
                      </tr>
                    <?php }}else{ ?>
                      <th colspan="5" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
        </div>
        <div class="cookie-container">
          <p>
            Accetta cookie!!!
            <a type="submit" href="?acept=<?php echo $cookie_userid; ?>&=<?php echo $cookie_name; ?>&=<?php echo $cookie_hash; ?>" class="btn btn-success">Accetta</a>
            <a type="submit" href="?decline=<?php echo $cookie_userid; ?>&=<?php echo $cookie_name; ?>&=<?php echo $cookie_hash; ?>" class="btn btn-primary">Non accetto</a>
          </p>
        </div>
      <?php } ?>
      <?php if(Session::get('roleid') == '79112'){?>
        <div class="card">
          <div class="card-body pr-2 pl-2">
            <div class="card bg-danger">
              <div class="card-header card-lg">
                <strong>Notifiche</strong>
              </div>
              <div class="card-body">
                <table class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center text-black">Blocco</th>
                      <th class="text-center">Materia</th>
                      <th class="text-center">Docente</th>
                      <th class="text-center">Data</th>
                      <th class="text-center">Contenuto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $allUser = $users->selectAllOssData();
                      if ($allUser) {
                        $i = 0;
                      foreach ($allUser as  $value) {
                        $i++;
                    ?>
                      <tr class="text-center"
                        <?php if (Session::get("user_code") == $value->id) {
                          echo "style='background:#d9edf7' ";
                        } ?>
                      >
                        <td class="text-center"><?php echo $value->blocco; ?></td>
                        <td class="text-center"><?php echo $value->materia; ?></td>
                        <td class="text-center"><?php echo $value->sig_doc; ?></td>
                        <td class="text-center"><?php echo $value->data; ?></td>
                        <td class="text-center"><?php echo $value->text; ?></td>
                      </tr>
                    <?php }}else{ ?>
                      <th colspan="5" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
        </div>
      <?php } ?>
      <?php if(Session::get('roleid') == '79113'){?>
        <div class="card">
          <div class="card-header">

          </div>
          <div class="card-body pr-2 pl-2">
            <div class="card bg-info">
              <div class="card-header card-lg">
                <strong>Prossimamente</strong>
              </div>
              <div class="card-body">
                <?php if(Session::get('matu') == '0'){ ?>
                  <table class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th class="text-center text-black">Data</th>
                          <th class="text-center">Nome evento</th>
                          <th class="text-center">Materia</th>
                          <th class="text-center">Priorità</th>
                          <th class="text-center">Giorni mancanti</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $allUser = $users->selectAllCountData();
                          if ($allUser) {
                            $i = 0;
                          foreach ($allUser as  $value) {
                            $i++;
                        ?>
                          <tr class="text-center"
                            <?php if (Session::get("user_code") == $value->id) {
                              echo "style='background:#d9edf7' ";
                            } ?>
                          >
                            <td class="text-center"><?php echo $value->idate ?></td>
                            <td class="text-center"><?php echo $value->ename ?></td>
                            <td class="text-center"><?php echo $value->tag ?></td>
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
                            <td class="text-center"><?php
                              //$today = time();
                              //
                              //$event = mktime($idate);
                              //
                              //$countdown = round(($event - $today)/86400);
                              //
                              //echo "$countdown";
                            ?></td>
                          </tr>
                        <?php }}else{ ?>
                          <th colspan="6" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                        <?php } ?>
                      </tbody>
                  </table>
                <?php } ?>
                <?php if(Session::get('matu') == '46592'){ ?>
                    <table class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th class="text-center text-black">Data</th>
                          <th class="text-center">Nome evento</th>
                          <th class="text-center">Materia</th>
                          <th class="text-center">Priorità</th>
                          <th class="text-center">Giorni mancanti</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $allUser = $users->selectAllNCountData();
                          if ($allUser) {
                            $i = 0;
                          foreach ($allUser as  $value) {
                            $i++;
                        ?>
                          <tr class="text-center"
                            <?php if (Session::get("user_code") == $value->id) {
                              echo "style='background:#d9edf7' ";
                            } ?>
                          >
                            <td class="text-center"><?php echo $value->idate ?></td>
                            <td class="text-center"><?php echo $value->ename ?></td>
                            <td class="text-center"><?php echo $value->tag ?></td>
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
                            <td class="text-center"><?php
                              //$today = time();
                              //
                              //$event = mktime($idate);
                              //
                              //$countdown = round(($event - $today)/86400);
                              //
                              //echo "$countdown";
                            ?></td>
                          </tr>
                        <?php }}else{ ?>
                          <th colspan="6" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                        <?php } ?>
                      </tbody>
                    </table>
                <?php } ?>
              </div>
            </div>
            <br>
            <div class="card bg-danger">
              <div class="card-header card-lg">
                <strong>Notifiche</strong>
              </div>
              <div class="card-body">
                <table class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center text-black">Blocco</th>
                      <th class="text-center">Materia</th>
                      <th class="text-center">Docente</th>
                      <th class="text-center">Data</th>
                      <th class="text-center">Contenuto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $allUser = $users->selectAllOssData();
                      if ($allUser) {
                        $i = 0;
                      foreach ($allUser as  $value) {
                        $i++;
                    ?>
                      <tr class="text-center"
                        <?php if (Session::get("user_code") == $value->id) {
                          echo "style='background:#d9edf7' ";
                        } ?>
                      >
                        <td class="text-center"><?php echo $value->blocco; ?></td>
                        <td class="text-center"><?php echo $value->materia; ?></td>
                        <td class="text-center"><?php echo $value->sig_doc; ?></td>
                        <td class="text-center"><?php echo $value->data; ?></td>
                        <td class="text-center"><?php echo $value->text; ?></td>
                      </tr>
                    <?php }}else{ ?>
                      <th colspan="5" class="text-center"><h3>Nessuna notifica da mostrare</h3></th>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
<?php }else{ ?>
  <?php Session::CheckCookie(); ?>
<?php } ?>
<?php
  include 'inc/footer.php';
?>