<?php
  include 'inc/header.php';
  Session::CheckSession();

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adding_class'])) {
    $adding_class = $users->addClass($_POST);
  }

  if (isset($adding_class)) {
    echo $adding_class;
  }
?>
<?php if (Session::get('roleid') == '1') {?>
    <div class="card ">
        <div class="card-header">
          <h3 style="margin:0" class='text-center'><i class="fas fa-plus mr-2"></i>Aggiungi aula</h3>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
            <form class="" action="" method="post">
                <div class="form-group">
                  <label for="aula">Aula</label>
                  <input type="text" name="aula" placeholder="Numero aula" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="adding_class" class="btn btn-success"><i class="fas fa-check mr-2"></i>Aggiungi</button>
                </div>
            </form>
          </div>
        </div>
    </div>
<?php } ?>
<?php
  include 'inc/footer.php';
?>