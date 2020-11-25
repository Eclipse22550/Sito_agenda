<?php
    include 'inc/head.php';
    Session::Check4Role();
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

<?php
    include 'inc/footer.php';
?>