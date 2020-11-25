<?php
    include 'inc/head.php';
    Session::Check4InRole();
    Session::CheckAdmin();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login4'])) {
        $user4Log = $users->userLogin4Authotication($_POST);
    }
    if (isset($user4Log)) {
        echo $user4Log;
    }

    $logout = Session::get('logout');
    if (isset($logout)) {
        echo $logout;
    }
?>
<div class="outer">
    <div class="wrapper">
        <div class="title">Super Admin</div>
        <form action="" 
            class="login-form show" 
            method="POST" 
            name="login"
            id="login"
            autocomplete="on">
            <div class="field">
                <input type="email" name="email">
                <label>Email</label>
            </div>
            <div class="field">
                <input type="password" name="password">
                <label>Password</label>
            </div>
            <div class="field">
                <button type="submit" class="4role">Accedi</button>
            </div>
        </form>
        <form action="" 
            class="login-form hide" 
            method="POST" 
            name="code"
            id="code"
            autocomplete="on">
            <div class="field">
                <input type="email" name="code">
                <label>Email</label>
            </div>
            <div class="field">
                <button type="submit" name="">Verifica</button>
            </div>
        </form>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>