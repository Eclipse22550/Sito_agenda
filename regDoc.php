<?php
  include 'inc/header.php';
  Session::CheckSession();

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addDoc'])) {
    $register = $users->userRegDoc($_POST);
  }

  if (isset($register)) {
    echo $register;
  }
?>
<div class="card ">
   <div class="card-header">
          <h3 style="margin:0" class='text-center'><i class="fas fa-user-plus mr-2"></i>Registrazione docente</h3>
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
                  <label for="sig">Sigla</label>
                  <input type="text" name="sig" placeholder="Sigla" class="form-control">
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
                      <option value="2">Professionale</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="lmoodle">Link Moodle (Opzionale)</label>
                  <input type="lmoodle" name="lmoodle" placeholder="Link Moodle" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="addDoc" class="btn btn-success"><i class="fas fa-check mr-2"></i>Registrati</button>
                </div>
            </form>
          </div>
        </div>
      </div>
<?php
  include 'inc/footer.php';
?>