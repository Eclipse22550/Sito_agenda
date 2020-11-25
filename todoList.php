<?php
    include 'inc/header.php';
    Session::CheckSession();
    $logMsg = Session::get('logMsg');
    if (isset($logMsg)) {
        echo $logMsg;
    }

    if (isset($_GET['id'])) {
        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    }
    
    if (isset($_GET['remove_todo'])) {
        $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_todo']);
        $remove_todo = $users->deleteTodo($remove);
    }
    if (isset($remove_todo)) {
        echo $remove_todo;
    }

    if (isset($_GET['check_evr'])) {
        $check = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['check_evr']);
        $check_evr = $users->CheckEVR($check);
    }
    if (isset($check_evr)) {
        echo $check_evr;
    }

    if (isset($_GET['resync_evr'])) {
        $sync = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['resync_evr']);
        $resync_evr = $users->SyncEVR($sync);
    }
    if (isset($resync_evr)) {
        echo $resync_evr;
    }

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
?>
<?php if(Session::get('matu') == '79108'){ ?>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center" style="margin:0"><i class="fas fa-list mr-2"></i>ToDo-List</h3>
        </div>
        <div class="card-body">
            <table class="table" style="width:100%;">
                <thead>
                    <tr>
                    <th class="text-center text-black">Data</th>
                    <th class="text-center">Ora</th>
                    <th class="text-center">Materia</th>
                    <th class="text-center">Nome evento</th>
                    <th class="text-center">Priorità</th>
                    <th class="text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $allUser = $users->selectToDoData(Session::get("user_code"));
                        if ($allUser) {
                            $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                    ?>
                    <tr class="text-center"
                        <?php if ($value->checking == '1') {
                            echo "style='text-decoration:line-through; background:#778899;color:#fff' ";
                        } ?>
                    >
                        <td class="text-center"><?php echo $value->idate; ?></td>
                        <td class="text-center"><?php echo $value->hour; ?></td>
                        <td class="text-center"><?php echo $value->tag; ?></td>
                        <td class="text-center"><?php echo $value->ename; ?></td>
                        <td>
                            <?php if ($value->prio == '79111') { ?>
                                <span class="badge badge-lg badge-danger text-white">Test semestrale</span>
                            <?php } ?>
                            <?php if ($value->prio == '79112') { ?>
                                <span class="badge badge-lg badge-warning text-white">Test</span>
                            <?php } ?>
                            <?php if ($value->prio == '79113') { ?>
                                <span class="badge badge-lg badge-success text-white">Compito ++</span>
                            <?php } ?>
                            <?php if ($value->prio == '79114') { ?>
                                <span class="badge badge-lg badge-info text-white">Compito</span>
                            <?php } ?>
                            <?php if ($value->prio == '79115') { ?>
                                <span class="badge badge-lg badge-primary text-white">Esterna</span>
                            <?php } ?>
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm" href="modifyTD.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>Dettagli</a>
                            <?php if($value->checking == '0'){ ?>
                                <a class="btn btn-secondary btn-sm text-white" href="?check_evr=<?php echo $value->id; ?>"><i class="fas fa-check"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="?remove_todo=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            <?php }else{?>
                                <a class="btn btn-secondary btn-sm text-white" href="?resync_evr=<?php echo $value->id; ?>"><i class="fas fa-sync"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="?remove_todo=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                    <th colspan="6" class="text-center"><h3>Nessuna voce presente</h3></th>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>
<?php if(Session::get('matu') == '79109'){ ?>
    <div class="card">
        <div class="card-header">
            <h3 class="text-center" style="margin:0"><i class="fas fa-list mr-2"></i>ToDo-List</h3>
        </div>
        <div class="card-body">
            <table class="table" style="width:100%;">
                <thead>
                    <tr>
                    <th class="text-center text-black">Data</th>
                    <th class="text-center">Ora</th>
                    <th class="text-center">Materia</th>
                    <th class="text-center">Nome evento</th>
                    <th class="text-center">Priorità</th>
                    <th class="text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $allUser = $users->selectToNDoData(Session::get("user_code"));
                        if ($allUser) {
                            $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                    ?>
                    <tr class="text-center"
                        <?php if ($value->checking == '1') {
                            echo "style='text-decoration:line-through; background:#778899;color:#fff' ";
                        } ?>
                    >
                        <td class="text-center"><?php echo $value->idate; ?></td>
                        <td class="text-center"><?php echo $value->hour; ?></td>
                        <td class="text-center"><?php echo $value->tag; ?></td>
                        <td class="text-center"><?php echo $value->ename; ?></td>
                        <td>
                            <?php if ($value->prio == '79111') { ?>
                                <span class="badge badge-lg badge-danger text-white">Test semestrale</span>
                            <?php } ?>
                            <?php if ($value->prio == '79112') { ?>
                                <span class="badge badge-lg badge-warning text-white">Test</span>
                            <?php } ?>
                            <?php if ($value->prio == '79113') { ?>
                                <span class="badge badge-lg badge-success text-white">Compito ++</span>
                            <?php } ?>
                            <?php if ($value->prio == '79114') { ?>
                                <span class="badge badge-lg badge-info text-white">Compito</span>
                            <?php } ?>
                            <?php if ($value->prio == '79115') { ?>
                                <span class="badge badge-lg badge-primary text-white">Esterna</span>
                            <?php } ?>
                        </td>
                        <td>
                        <a class="btn btn-success btn-sm" href="modifyTD.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>Dettagli</a>
                            <?php if($value->checking == '0'){ ?>
                                <a class="btn btn-secondary btn-sm text-white" href="?check_evr=<?php echo $value->id; ?>"><i class="fas fa-check"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="?remove_todo=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            <?php }else{?>
                                <a class="btn btn-secondary btn-sm text-white" href="?resync_evr=<?php echo $value->id; ?>"><i class="fas fa-sync"></i></a>
                                <a class="btn btn-danger btn-sm text-white" href="?remove_todo=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                    <th colspan="6" class="text-center"><h3>Nessuna voce presente</h3></th>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>
<?php 
    include 'inc/footer.php';
?>