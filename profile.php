<?php
	include 'inc/header.php';
	Session::CheckSession();
?>
<?php
	if (isset($_GET['id'])) {
	  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
	  $updateUser = $users->updateUserByIdInfo($userid, $_POST);
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updated'])) {
		$updateUser = $users->updateUsereByIdInfo($userid, $_POST);
	  }
	if (isset($updateUser)) {
	  echo $updateUser;
	}
?>
<div class="card ">
   	<div class="card-header">
		<h3><span class="float-right"> <a href="<?php
			if(isset($_SERVER['HTTP_REFERER']))
			echo $_SERVER['HTTP_REFERER'];
		?>" class="btn btn-primary">Indietro</a> </h3>
    </div>
    <div class="card-body">
    	<?php
    		$getUinfo = $users->getUserInfoById($userid);
    		if ($getUinfo) {
		?>
		<div style="width:600px; margin:0px auto">
			<form class="" action="" method="POST">
            	<div class="form-group">
            		<label for="name">Nome</label>
            		<input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="username">Username</label>
            		<input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="email">Email</label>
            		<input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
            	</div>
              	<?php if (Session::get("roleid") == '1') { ?>
              		<div class="form-group
              			<?php if (Session::get("roleid") == '1' && Session::get("id") == $getUinfo->id) {
                			echo "d-none";
              			} ?>
              		">
                	<div class="form-group">
                		<label for="sel1">Grado utente</label>
                		<select class="form-control" name="roleid" id="roleid">
                			<?php
                	    		if($getUinfo->roleid == '1'){?>
                	      			<option value="1" selected='selected'>Amministratore</option>
                	      			<option value="2">Moderatore</option>
                	      			<option value="3">Utente</option>
                	    	<?php }elseif($getUinfo->roleid == '2'){?>
                	      		<option value="1">Amministratore</option>
                	      		<option value="2" selected='selected'>Moderatore</option>
                	      		<option value="3">Utente</option>
                	    	<?php }elseif($getUinfo->roleid == '3'){?>
                	      		<option value="1">Amministratore</option>
                	      		<option value="2">Moderatore</option>
                	      		<option value="3" selected='selected'>Utente</option>
                	    	<?php } ?>
                	  	</select>
                	</div>
				</div>
          	<?php }else{?>
            	<input type="hidden" name="roleid" value="<?php echo $getUinfo->roleid; ?>">
          	<?php } ?>
            	<?php if (Session::get("id") == $getUinfo->id) {?>
            	<div class="form-group">
            		<button type="submit" name="update" class="btn btn-success">Aggiorna</button>
            		<a class="btn btn-primary" href="changepass.php?id=<?php echo $getUinfo->id;?>">Cambia password</a>
            	</div>
            <?php } elseif(Session::get("roleid") == '1') {?>
            	<div class="form-group">
            		<button type="submit" name="update" class="btn btn-success">Aggiorna</button>
            	</div>
			<?php }else{ ?>
                <div class="form-group">
                	<a class="btn btn-primary" href="user_login.php">Ok</a>
                </div>
            <?php } ?>
        </form>
    </div>
    <?php }else{
      header('Location:user_login.php');
    } ?>
</div>

<?php
	include 'inc/footer.php';
?>