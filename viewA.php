<?php
	include 'inc/head.php';
	Session::CheckSession();
?>
<?php
	if (isset($_GET['id'])) {
	  $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updateUser = $users->updateUsereByIdInfo($userid, $_POST);
	  }
	if (isset($updateUser)) {
	  echo $updateUser;
	}
?>
<div class="card ">
   	<div class="card-header">
        <h3 class="text-center" style="margin:0"><i class="fas fa-user mr-2"></i>Dettagli utente
		<span class="float-right"> <a href="<?php 
			if(isset($_SERVER['HTTP_REFERER']))
			echo $_SERVER['HTTP_REFERER'];
		?>" class="btn btn-primary">Inidetro</a> </h3>
    </div>
    <div class="card-body">
    	<?php
    		$getUinfo = $users->getUserControlInfoById($userid);
    		if ($getUinfo) {
		?>
		<div style="width:600px; margin:0px auto">
			<form class="" action="" method="POST">
            	<div class="form-group">
            		<label for="name">Nome</label>
            		<input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
            	</div>
				<div class="form-group">
            		<label for="lname">Cognome</label>
            		<input type="text" name="lname" value="<?php echo $getUinfo->lname; ?>" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="username">Username</label>
            		<input type="text" name="username" value="<?php echo $getUinfo->username; ?>" class="form-control">
				</div>
				<div class="form-group">
            		<label for="password">Password</label>
            		<input type="text" name="password" readonly="true" value="<?php echo $getUinfo->password; ?>" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="email">Email</label>
            		<input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
            	</div>
				<div id="mat_s" class="form-group">
            		<label for="matu">Classe</label>
					<?php if($getUinfo->matu == '0'){ ?>
						<select class="browser-default custom-select" name="matu">
            			  <option selected value="0">Maturità</option>
            			  <option value="1">Non maturità</option>
            			</select>
					<?php } ?>
					<?php if($getUinfo->matu == '1'){ ?>
						<select class="browser-default custom-select" name="matu">
							<option value="0">Maturità</option>
            			  	<option selected value="1">Non maturità</option>
            			</select>
					<?php } ?>
          		</div>
          		<div class="form-group">
          		  <label for="roleid">Ruolo</label>
					<?php if($getUinfo->roleid == '1'){ ?>
						<select class="browser-default custom-select" name="roleid">
          		    		<option selected value="1">Amministratore</option>
          		    		<option value="2">Moderatore</option>
          		    		<option value="3">Utente</option>
						</select>
					<?php } ?>
					<?php if($getUinfo->roleid == '2'){ ?>
						<select class="browser-default custom-select" name="roleid">
							<option value="1">Amministratore</option>
          		    		<option selected value="2">Moderatore</option>
          		    		<option value="3">Utente</option>
						</select>
					<?php } ?>
					<?php if($getUinfo->roleid == '3'){ ?>
						<select class="browser-default custom-select" name="roleid">
							<option value="1">Amministratore</option>
          		    		<option value="2">Moderatore</option>
          		    		<option selected value="3">Utente</option>
						</select>
					<?php } ?>
				</div>
          		<div class="form-group">
          		  <label for="isActive">Stato</label>
					<?php if($getUinfo->isActive == '0'){ ?>
						<select class="browser-default custom-select" name="isActive">
          		    		<option selected value="0">Attivo</option>
          		    		<option value="1">Disattivo</option>
						</select>
					<?php } ?>
					<?php if($getUinfo->isActive == '1'){ ?>
						<select class="browser-default custom-select" name="isActive">
							<option value="0">Attivo</option>
          		    		<option selected value="1">Disattivo</option>
						</select>
					<?php } ?>
          		</div>
                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-success text-white"><i class="fas fa-check mr-2"></i>Aggiorna</button>
                </div>
        	</form>
		</div>
	</div>
    <?php }else{
      header('Location:index.php');
    } ?>
</div>
<?php
	include 'inc/footer.php';
?>