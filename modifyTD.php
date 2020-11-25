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

    if (isset($_GET['id'])) {
        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_events'])) {
		$update_events = $users->updateEventsByIdInfo($userid, $_POST);
	}
	if (isset($update_events)) {
	  echo $update_events;
	}

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
?>
<div class="card">
    <div class="card-header">
    
    </div>
    <div class="card-body">
    
    </div>
</div>
<?php
    include 'inc/footer.php';
?>