<?php
    include 'inc/header.php';
    Session::CheckSession();
?>
<?php
    if (isset($_GET['user_code'])) {
      $user_code = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['user_code']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changepass'])) {
      $changePass = $users->changePasswordBysingelUserId($user_code, $_POST);
    }
    if (isset( $changePass)) {
      echo  $changePass;
    }
?>
    <div class="card ">
        <div class="card-header">
            <h3 class="text-center" style="margin:0"><i class="fas fa-key mr-2"></i>Cambia la tua password<span class="float-right"> <a href="<?php
		    	if(isset($_SERVER['HTTP_REFERER']))
		    	echo $_SERVER['HTTP_REFERER'];
		    ?>" class="btn btn-primary">Indietro</a> </h3>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <form class="" action="" method="POST">
                    <div class="form-group">
                      <label for="old_password">Vecchia password</label>
                      <input type="password" name="old_password"  class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="new_password">Nuova password</label>
                      <input type="password" name="new_password"  class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="changepass" class="btn btn-success"><i class="fas fa-check mr-2"></i>Cambia password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
  include 'inc/footer.php';
?>