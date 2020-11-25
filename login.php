<?php
    include 'inc/header.php';
    Session::CheckLogin();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $userLog = $users->userLoginAuthotication($_POST);
    }

    if (isset($userLog)) {
        echo $userLog;
    }

    $logout = Session::get('logout');
    if (isset($logout)) {
        echo $logout;
    }

?>
<!-- Warning Popup
<div class="alert hide">
    <span class="fas fa-exclamation-circle"></span>
    <span class="msg"></span>
    <span class="close-btn">
        <span class="fas fa-times"></span>
    </span>
</div> !-->
<div class="card">
    <div class="card-header">
      <h3 class='text-center' style="margin:0"><i class="fas fa-sign-in-alt mr-2"></i>Login</h3>
    </div>
    <div class="card-body">
        <div style="width:600px; margin:0px auto">
        <form class="" action="" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="login" class="btn btn-success"><i class="fas fa-check mr-2"></i>Accedi</button>
            </div>
        </form>
      </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>