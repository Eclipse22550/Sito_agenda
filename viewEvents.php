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

    if (isset($_GET['events'])) {
        $events_code = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['events']);
    }

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
?>
	<div class="card">
		<div class="card-header">
            <h3 class="text-center" style="margin:0"><i class="fas fa-edit mr-2"></i>Dettagli evento<span class="float-right"> <a href="<?php
				if(isset($_SERVER['HTTP_REFERER']))
				echo $_SERVER['HTTP_REFERER'];
			?>" class="btn btn-primary">Indietro</a></h3>
        </div>
        <div class="card-body">
        <div style="width:600px; margin:0px auto">
            <?php 
                $getUinfo = $users->getMatInfoById($events_code);
                if ($getUinfo){
            ?>
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <?php 
                            $allUser = $users->TranslateVieWEvents($getUinfo->tag, $getUinfo->ename);
                            if ($allUser) {
                                $i = 0;
                            foreach ($allUser as  $is) {
                                $i++;
                        ?>
                            <input type="text" name="tag" readonly value="<?php echo $is->title; ?>" class="form-control">
                        <?php }} ?>
                    </div>
                    <div class="form-group">
                        <label for="idate">Data</label>
                        <input type="date" name="idate" readonly value="<?php echo $getUinfo->idate; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="hschool">Ora scolastica da consegnare</label>
                        <input type="text" name="hschool" readonly value="<?php echo $getUinfo->hour; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ename">Nome evento</label>
                        <input type="ename" id="ename" name="ename" readonly value="<?php echo $getUinfo->ename; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descr">Descrizione evento</label>
                        <textarea type="descr" rows="6" id="descr" name="descr" readonly class="form-control"><?php echo $getUinfo->descr; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="prio">Priorità</label>
                        <?php 
                            $allUser = $users->TranslatePriOEvents($getUinfo->prio, $getUinfo->ename);
                            if ($allUser) {
                                $i = 0;
                            foreach ($allUser as  $value) {
                                $i++;
                        ?>
                            <input type="text" name="prio" readonly value="<?php echo $value->name; ?>" class="form-control">
                        <?php }} ?>
                    </div>
                    <div class="form-group">
                        <label for="vis">Visibilità</label>
                        <?php 
                            $allUser = $users->TranslateViSEvents($getUinfo->vis, $getUinfo->ename);
                            if ($allUser) {
                                $i = 0;
                            foreach ($allUser as  $value) {
                                $i++;
                        ?>
                            <input type="text" name="prio" readonly value="<?php echo $value->name; ?>" class="form-control">
                        <?php }} ?>
                    </div>
                    <div class="form-group">
                    <a href="<?php
				        if(isset($_SERVER['HTTP_REFERER']))
				        echo $_SERVER['HTTP_REFERER'];
			        ?>" class="btn btn-primary"><i class="fas fa-check mr-2"></i>OK</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>  
<?php
    include 'inc/footer.php';
?>