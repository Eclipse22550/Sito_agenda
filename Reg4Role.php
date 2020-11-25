<?php
  include 'inc/header.php';
  Session::CheckREG();

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_4'])) {
    $register_4 = $users->user4Registration($_POST);
  }

  if (isset($register_4)) {
    echo $register_4;
  }
?>
<div class="card ">
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
                  <label for="password">Password</label>
                  <input type="password" name="password" placeholder="Password" class="form-control">
                  <input type="hidden" name="roleid" value="4" class="form-control">
                  <input type="hidden" name="isActive" value="1" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="register_4" class="btn btn-success">Registrati</button>
                </div>
            </form>
          </div>
        </div>
      </div>
<?php
  include 'inc/footer.php';
?>
