<?php
    include 'inc/header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $register = $users->userRegistration($_POST);
    }

    if (isset($register)) {
        echo $register;
    }
?>
<div class="card">
    <div class="card-header">
      <h3 class='text-center' style="margin:0"><i class="fas fa-sign-in-alt mr-2"></i>Registrati</h3>
    </div>
    <div class="card-body">
        <div style="width:600px; margin:0px auto">
        <form class="" action="" method="post">
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="lname">Cognome</label>
              <input type="text" name="lname" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <select class="browser-default custom-select" name="matu">
                    <option value="Scegli una classe">Scegli una classe</option>
                    <option value="48950">Maturità</option>
                    <option value="46592">Non maturità</option>
                </select>
            </div>
            <div class="form-group">
                <select class="browser-default custom-select" name="roleid">
                    <option value="Scegli un ruolo">Scegli un ruolo</option>
                    <option value="15398">Amministratore</option>
                    <option value="89187">Moderatore / Docente</option>
                    <option value="64039">Utente</option>
                </select>
            </div>
            <div class="form-group">
              <button type="submit" name="register" class="btn btn-success"><i class="fas fa-check mr-2"></i>Registrati</button>
            </div>
        </form>
      </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>