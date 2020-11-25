<?php
	include 'inc/header.php';
	Session::CheckSession();
?>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $register = $users->userRegistrationByAdmin($_POST);
  }

  if (isset($register)) {
    echo $register;
  }
?>
<div class="card">
  <div class="card-header">
    <h3 class='text-center' style="margin:0"><i class="fas fa-user-plus mr-2"></i>Registrazione utente</h3>
  </div>
  <div class="card-body">
    <div style="width:600px; margin:0px auto">
      <form class="" action="" method="post">
          <div class="form-group pt-3">
            <label for="name">Nome</label>
            <input type="text" name="name" placeholder="Nome" class="form-control">
          </div>
          <div class="form-group">
            <label for="name">Cognome</label>
            <input type="text" name="lname" placeholder="Cognome" class="form-control">
          </div>
          <div class="form-group">
            <label for="name">Username</label>
            <input type="test" name="username" placeholder="Username" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" class="form-control">
          </div>
          <div class="form-group">
            <label for="matu">Classe</label>
            <select class="browser-default custom-select" name="matu">
              <option selected>Scegli una classe</option>
              <option value="0">Maturita'</option>
              <option value="1">Non maturità</option>
            </select>
          </div>
          <div class="form-group">
            <label for="matu">Ruolo</label>
            <select class="browser-default custom-select" name="roleid">
              <option selected>Scegli un ruolo</option>
              <option value="1">Amministratore</option>
              <option value="2">Moderatore</option>
              <option value="3">Utente</option>
            </select>
          </div>
          <div class="form-group">
            <label for="matu">Stato</label>
            <select class="browser-default custom-select" name="isActive">
              <option selected>Scegli un ruolo</option>
              <option value="0">Attivo</option>
              <option value="1">Disattivo</option>
            </select>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
            <input type="hidden" name="qta" value="1" class="form-control">
          </div>
          <div class="form-group">
            <input type="checkbox" onclick="showPass()"> Mostra password</input>
          </div>
          <div class="form-group">
            <button type="submit" name="register" class="btn btn-success"><i class="fas fa-check mr-2"></i>Registrati</button>
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