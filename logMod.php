<?php
    include 'inc/header.php';
    Session::CheckLogin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $userLog = $users->userLoginAuthoticationMod($_POST);
    }
    if (isset($userLog)) {
        echo $userLog;
    }
    $logout = Session::get('logout');
    if (isset($logout)) {
        echo $logout;
    }
?>
<div class="card ">
    <div class="card-header">
        <h3 class='text-center' style="margin:0"><i class="fas fa-sign-in-alt mr-2"></i>Aceesso moderatori</h3>
    </div>
    <div class="card-body">
        <div style="width:450px; margin:0px auto">
            <form class="" action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <input type="checkbox" onclick="showPass()"> Mostra password</input>
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-success">Accedi</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showPass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
    </script>
</div>

<?php
    include 'inc/footer.php';
?>