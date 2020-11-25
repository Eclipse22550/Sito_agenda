<?php
	include 'inc/header.php';
    Session::CheckSession();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adding_Mat'])) {
        $adding_Mat = $users->addMat($_POST);
    }
    
    if (isset($adding_Mat)) {
      echo $adding_Mat;
    }
?>
<?php if (Session::get('roleid') == '1'){?>
    <div class="card ">
        <div class="card-header">
            <h3 class="text-center">Aggiungi una materia</h3>
        </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
            <form class="" action="" method="post">
                <div class="form-group">
                    <label for="mat">Materia</label>
                    <input type="text" name="mat" placeholder="Materia" class="form-control">
                </div>
                <div class="form-group">
                  <button type="submit" name="adding_Mat" class="btn btn-success">Aggiungi</button>
                </div>
            </form>
          </div>
        </div>
    </div>
<?php } ?>
<?php if (Session::get('roleid') == '2'){?>

<?php } ?>
<?php if (Session::get('roleid') == '3'){?>

<?php } ?>
<?php
    include 'inc/footer.php';
?>