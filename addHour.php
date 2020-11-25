<?php
  include 'inc/header.php';
  Session::CheckSession();

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addMateria'])) {
    $addMateria = $users->addMateria($_POST);
  }

  if (isset($addMateria)) {
    echo $addMateria;
  }

  $msg = Session::get('msg');
  if (isset($msg)) {
    echo $msg;
  }

  Session::set("msg", NULL);
  Session::set("logMsg", NULL);
?>
<?php if (Session::get('roleid') == '15398') {?>
    <div class="card ">
        <div class="card-header">
          <h3 style="margin:0" class='text-center'><i class="fa fa-search mr-2"></i>Aggiungi giornata</h3>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
            <form class="" action="" method="post">
              <div class="form-group pt-3">
                <label for="blocco">Blocco</label>
                <select class="browser-default custom-select" name="blocco">
                  <option selected>Scegli un blocco</option>
                  <option value="88451">A</option>
                  <option value="88452">B</option>
                  <option value="88453">C</option>
                  <option value="88454">D</option>
                </select>
              </div>
              <div class="form-group">
                <label for="blocco">Giorno</label>
                <select class="browser-default custom-select" name="giorno">
                  <option selected>Scegli un giorno</option>
                  <option value="13213">Lunedì</option>
                  <option value="13214">Martedì</option>
                  <option value="13215">Mercoledì</option>
                  <option value="13216">Giovedì</option>
                  <option value="13217">Venerdì</option>
                </select>
              </div>
              <div class="form-group">
                <label for="materia_1">1° Ora</label>
                <select class="browser-default custom-select" name="materia_1">
                  <?php 
                    $allUser = $users->selectBA();
                    if ($allUser) {
                      $i = 0;
                    foreach ($allUser as  $value) {
                      $i++;
                  ?>
                    <option>
                    <?php echo $value->code; ?>
                      
                    </option>
                  <?php }} ?>
                </select>
              </div>
              <!--<div class="form-group">
                <label for="materia_2">2° Ora</label>
                <input type="text" name="materia_2" placeholder="Materia 2" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_3">3° Ora</label>
                <input type="text" name="materia_3" placeholder="Materia 3" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_4">4° Ora</label>
                <input type="text" name="materia_4" placeholder="Materia 4" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_5">5° Ora</label>
                <input type="text" name="materia_5" placeholder="Materia 5" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_6">6° Ora</label>
                <input type="text" name="materia_6" placeholder="Materia 6" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_7">7° Ora</label>
                <input type="text" name="materia_7" placeholder="Materia 7" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_8">8° Ora</label>
                <input type="text" name="materia_8" placeholder="Materia 8" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_9">9° Ora</label>
                <input type="text" name="materia_9" placeholder="Materia 9" class="form-control">
              </div>
              <div class="form-group">
                <label for="materia_10">10° Ora</label>
                <input type="text" name="materia_10" placeholder="Materia 10" class="form-control">
              </div>!-->
              <div class="form-group">
                <label for="matu">Classe</label>
                <select class="browser-default custom-select" name="matu">
                  <option selected value="Scegli una classe">Scegli una classe</option>
                  <option value="48950">Maturita' / Professionale</option>
                  <option value="46592">Non maturita' / Professionale</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" name="addMateria" class="btn btn-success">Aggiungi</button>
              </div>
            </form>
        </div>
    </div>
<?php } ?>
<?php
  include 'inc/footer.php';
?>