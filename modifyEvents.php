<?php
    include 'inc/header.php';
    Session::CheckSession();
    $logMsg = Session::get('logMsg');
    if (isset($logMsg)) {
        echo $logMsg;
    }
    $msg = Session::get('msg');
    if (isset($msg)) {
        echo $msg;
    }

    if (isset($_GET['id'])) {
        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_events'])) {
		$update_events = $users->updateEventsByIdInfo($userid, $_POST);
	}
	if (isset($update_events)) {
	  echo $update_events;
	}

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
?>
	<div class="card">
		<div class="card-header">
            <h3 class="text-center" style="margin:0"><i class="fas fa-edit mr-2"></i>Modifica evento<span class="float-right"> <a href="<?php
				if(isset($_SERVER['HTTP_REFERER']))
				echo $_SERVER['HTTP_REFERER'];
			?>" class="btn btn-primary">Indietro</a></h3>
        </div>
        <div class="card-body">
        <div style="width:600px; margin:0px auto">
            <?php 
                $getUinfo = $users->getMatInfoById($userid);
                if ($getUinfo){
            ?>
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <select class="browser-default custom-select" name="tag">
                            <option selected><?php echo $getUinfo->tag; ?></option>
                            <?php
                                include('./config/counter.php');
                                $stmt = $mysqli->prepare("SELECT title from tips");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                            ?>
                                <option>
                                <?= $row['title'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idate">Data</label>
                        <input type="date" name="idate" value="<?php echo $getUinfo->idate; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hschool">Ora scolastica da consegnare</label>
                        <input type="hour" name="hschool" placeholder="Ora" class="form-control" value="<?php echo $getUinfo->hschool; ?>">
                    </div>
                    <div class="form-group">
                        <label for="ename">Nome evento</label>
                        <input type="ename" id="ename" name="ename" value="<?php echo $getUinfo->ename; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descr">Descrizione evento</label>
                        <textarea type="text" name="descr" class="md-textarea form-control" rows="6"><?php echo $getUinfo->descr; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prio">Priorità</label>
                        <?php if($getUinfo->prio == '1'){ ?>
                            <select class="browser-default custom-select" name="prio">
                                <option selected value="1">Test semestrale</option>
                                <option value="2">Test</option>
                                <option value="3">Compito / compito con valutazione</option>
                                <option value="4">Compito</option>
                                <option value="5">Priorità esterna</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->prio == '2'){ ?>
                            <select class="browser-default custom-select" name="prio">
                                <option selected value="2">Test</option>
                                <option value="1">Test semestrale</option>
                                <option value="3">Compito / compito con valutazione</option>
                                <option value="4">Compito</option>
                                <option value="5">Priorità esterna</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->prio == '3'){ ?>
                            <select class="browser-default custom-select" name="prio">
                                <option selected value="3">Compito / compito con valutazione</option>
                                <option value="1">Test semestrale</option>
                                <option value="2">Test</option>
                                <option value="4">Compito</option>
                                <option value="5">Priorità esterna</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->prio == '4'){ ?>
                            <select class="browser-default custom-select" name="prio">
                                <option selected value="4">Compito</option>
                                <option value="1">Test semestrale</option>
                                <option value="2">Test</option>
                                <option value="3">Compito / compito con valutazione</option>
                                <option value="5">Priorità esterna</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->prio == '5'){ ?>
                            <select class="browser-default custom-select" name="prio">
                                <option selected value="5">Priorità esterna</option>
                                <option value="1">Test semestrale</option>
                                <option value="2">Test</option>
                                <option value="3">Compito / compito con valutazione</option>
                                <option value="4">Compito</option>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="matu">Classe</label>
                        <?php if($getUinfo->matu == '0'){ ?>
                            <select class="browser-default custom-select" name="vis">
                                <option selected value="0">Maturità</option>
                                <option value="1">Non maturità</option>
                                <option value="2">Professionale</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->matu == '1'){ ?>
                            <select class="browser-default custom-select" name="vis">
                                <option selected value="1">Non maturità</option>
                                <option value="0">Maturità</option>
                                <option value="2">Professionale</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->matu == '2'){ ?>
                            <select class="browser-default custom-select" name="vis">
                                <option selected value="2">Professionale</option>
                                <option value="0">Maturità</option>
                                <option value="1">Non maturità</option>
                            </select>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="vis">Visibilità</label>
                        <?php if($getUinfo->vis == '1'){ ?>
                            <select class="browser-default custom-select" name="vis">
                                <option selected value="1">Pubblico</option>
                                <option value="2">Privato</option>
                            </select>
                        <?php } ?>
                        <?php if($getUinfo->vis == '2'){ ?>
                            <select class="browser-default custom-select" name="vis">
                                <option selected value="2">Privato</option>
                                <option value="1">Pubblico</option>
                            </select>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="id_writter" value="<?php echo Session::get('id'); ?>" >
                    <div class="form-group">
                        <button type="submit" name="update_events" class="btn btn-success"><i class="fas fa-check mr-2"></i>Aggiorna evento</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>  
<?php
    include 'inc/footer.php';
?>