<?php
	include 'inc/header.php';
    Session::CheckSession();
?>
<?php
    if (isset($_GET['user_code'])) {
        $user_code = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['user_code']);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updater'])) {
		$updateUser = $users->updateUserByIdInfo($user_code, $_POST);
	}
	if (isset($updateUser)) {
	  echo $updateUser;
	}
?>
<div class="card">
	<div class="card-header">
		<h3 class="text-center" style="margin: 0"><i class="fab fa-500px mr-2"></i>Profilo<span class="float-right"> <a href="<?php
			if(isset($_SERVER['HTTP_REFERER']))
			echo $_SERVER['HTTP_REFERER'];
		?>" class="btn btn-primary">Indietro</a> </h3>
	</div>
	<div class="card-body">
		<?php
			$getUinfo = $users->getUserInfoById(Session::get("user_code"));
			if ($getUinfo){
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
						<label for="email">Email</label>
						<input type="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="matu">Classe</label>
						<?php 
							$allUser = $users->TransMatuProf($getUinfo->user_code);
							if ($allUser) {
								$i = 0;
							foreach ($allUser as  $is) {
								$i++;
						?>
							<input type="text" name="matu" readonly value="<?php echo $is->name; ?>" class="form-control">
						<?php }} ?>
					</div>
					<div class="form-group">
						<label for="roleid">Ruolo</label>
						<?php 
							$allUser = $users->TransRoleIDProf($getUinfo->user_code);
							if ($allUser) {
								$i = 0;
							foreach ($allUser as  $is) {
								$i++;
						?>
							<input type="text" name="roleid" readonly value="<?php echo $is->name; ?>" class="form-control">
						<?php }} ?>
					</div>
					<?php if (Session::get("user_code") == $getUinfo->user_code) {?>
						<div class="form-group">
							<button type="submit" id="update_profile" name="updater" class="btn btn-success">Aggiorna</button>
							<a class="btn btn-primary" href="myChangepass.php?id=<?php echo $getUinfo->user_code;?>">Cambia password</a>
						</div>
					<?php }else{ ?>
						<div class="form-group">
							<a class="btn btn-primary" href="index.php">Ok</a>
						</div>
					<?php } ?>
				</form>
			</div>
		<?php } ?>
	</div>
</div>
<?php
  include 'inc/footer.php';
?>