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
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$updateUser = $users->updateUsereByIdInfo($userid, $_POST);
	  }
	if (isset($updateUser)) {
	  echo $updateUser;
	}
?>
<div class="card ">
   	<div class="card-header">
        <h3>
		<span class="float-right"> <a href="<?php 
			if(isset($_SERVER['HTTP_REFERER']))
			echo $_SERVER['HTTP_REFERER'];
		?>" class="btn btn-primary">Inidetro</a> </h3>
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
            		<input type="text" name="name" readonly="true" value="<?php echo $getUinfo->name; ?>" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="username">Username</label>
            		<input type="text" name="username" readonly="true" value="<?php echo $getUinfo->username; ?>" class="form-control">
            	</div>
            	<div class="form-group">
            		<label for="email">Email</label>
            		<input type="email" id="email" readonly="true" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
            	</div>
                <div class="form-group">
                    <a href="<?php 
			            if(isset($_SERVER['HTTP_REFERER']))
			            echo $_SERVER['HTTP_REFERER'];
		            ?>" class="btn btn-primary"><i class="fas fa-check mr-2"></i>OK</a>
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