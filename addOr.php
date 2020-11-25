<?php
  include 'inc/header.php';
  Session::CheckSession();

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adding_or'])) {
    $adding_or = $users->addOr($_POST);
  }

  if (isset($adding_or)) {
    echo $adding_or;
  }
?>
<?php if (Session::get('roleid') == '1') {?>
    <div class="card ">
        <div class="card-header">
          <h3 class='text-center'><i class="fa fa"></i>Aggiungi orario lezione</h3>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
            <form class="" action="" method="post">
                <div class="form-group">
                  <label for="da">Da</label>
                  <input type="text" name="da" class="form-control">
                </div>
                <div class="form-group">
                  <label for="a">A</label>
                  <input type="text" name="a" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="adding_or" class="btn btn-success">Aggiungi</button>
                </div>
            </form>
          </div>
        </div>
    </div>
<?php } ?>
<?php
  include 'inc/footer.php';
?>