<?php
    include 'inc/header.php';
    Session::CheckSession   ();

    if (isset($_GET['id'])) {
        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_doc'])) {
        $updateDoc = $users->updateDocByIdInfo($userid, $_POST);
    }
    if (isset($updateDoc)) {
      echo $updateDoc;
    }
?>
<?php if (Session::get('roleid') == '1'){ ?>
    <div class="card">
        <div class="card-header">
            <h3><span class="float-right"> <a href="<?php
                if(isset($_SERVER['HTTP_REFERER']))
                echo $_SERVER['HTTP_REFERER'];
            ?>" class="btn btn-primary">Indietro</a> </h3>
        </div>
        <div class="card-body">
            <?php
                $getUinfo = $users->getDocInfoById($userid);
                if ($getUinfo){
            ?>
                <div style="width:600px; margin:0px auto">
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" value="<?php echo $getUinfo->name; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="llname">Cognome</label>
                        <input type="text" name="lname" value="<?php echo $getUinfo->lname; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="materia">Sigla</label>
                        <select class="browser-default custom-select" name="sigla">
                            <option selected><?php echo $getUinfo->sig; ?></option>
                            <?php
                                include('./config/counter.php');
                                $stmt = $mysqli->prepare("SELECT sig from docenti");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                            ?>
                                <option>
                                    <?= $row['sig'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lmoodle">Link Moodle</label>
                        <input type="text" name="lmoodle" value="<?php echo $getUinfo->lmoodle; ?>" class="form-control">
                    </div>
                    <?php if (Session::get('roleid') == '1') {?>
                        <div class="form-group">
                            <button type="submit" name="update_doc" class="btn btn-success">Aggiorna</button>
                            <a type="submit" href="mailto:<?php echo $getUinfo->email; ?>" class="btn btn-danger">Scrivi una email</a>
                            <a class="btn btn-primary" href="docenti.php">Ok</a>
                        </div>
                    <?php }else{ ?>
                        <div class="form-group">
                            <a type="submit" href="mailto:<?php echo $getUinfo->email; ?>" class="btn btn-danger">Scrivi una email</a>
                            <a class="btn btn-primary" href="docenti.php">Ok</a>
                        </div>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
    </div>
<?php }else{?>
    <div class="card">
        <div class="card-header">
            <h3><span class="float-right"> <a href="<?php
                if(isset($_SERVER['HTTP_REFERER']))
                echo $_SERVER['HTTP_REFERER'];
            ?>" class="btn btn-primary">Indietro</a> </h3>
        </div>
        <div class="card-body">
            <?php
                $getUinfo = $users->getDocInfoById($userid);
                if ($getUinfo){
            ?>
                <div style="width:600px; margin:0px auto">
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" readonly value="<?php echo $getUinfo->name; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="llname">Cognome</label>
                        <input type="text" name="lname" readonly value="<?php echo $getUinfo->lname; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="materia">Sigla</label>
                        <select class="browser-default custom-select" name="sigla" readonly>
                            <option selected readonly><?php echo $getUinfo->sigla; ?></option>
                            <?php
                                include('./config/counter.php');
                                $stmt = $mysqli->prepare("SELECT sig from sigle");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                            ?>
                                <option readonly>
                                    <?= $row['sig'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" readonly name="email" value="<?php echo $getUinfo->email; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lteams">Link Teams</label>
                        <input type="text" name="lteams" readonly value="<?php echo $getUinfo->lteams; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lmoodle">Link Moodle</label>
                        <input type="text" name="lmoodle" readonly value="<?php echo $getUinfo->lmoodle; ?>" class="form-control">
                    </div>
                    <?php if (Session::get('roleid') == '1') {?>
                        <div class="form-group">
                            <button type="submit" name="update_doc" class="btn btn-success">Aggiorna</button>
                            <a type="submit" href="mailto:<?php echo $getUinfo->email; ?>" class="btn btn-danger">Scrivi una email</a>
                            <a class="btn btn-primary" href="docenti.php">Ok</a>
                        </div>
                    <?php }else{ ?>
                        <div class="form-group">
                            <a type="submit" href="mailto:<?php echo $getUinfo->email; ?>" class="btn btn-danger">Scrivi una email</a>
                            <a class="btn btn-primary" href="docenti.php">Ok</a>
                        </div>
                    <?php } ?>
                </form>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<?php
    include 'inc/footer.php';
?>