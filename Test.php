<?php
    include 'inc/header.php';
    Session::CheckSession();
    $logMsg = Session::get('logMsg');
    if (isset($logMsg)) {
        echo $logMsg;
    }

    if (isset($_GET['user_code'])) {
        $user_code = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['user_code']);
	}

    if (isset($_GET['check_ev'])) {
        $active = $_GET['check_ev'];
        $tag = $_GET['tag'];
        $idate = $_GET['idate'];
        $hour = $_GET['hour'];
        $ename = $_GET['ename'];
        $descr = $_GET['descr'];
        $prio = $_GET['prio'];
        $vis = $_GET['vis'];
        $matu = $_GET['matu'];
        $user_code = $_GET['user_code'];
        $checking = $_GET['checking'];
        $writter_code = $_GET['writter_code'];
        $check_ev = $users->Check_evt($active,$tag,$idate,$hour,$ename,$descr,$prio,$vis,$matu,$user_code,$checking,$writter_code);
    }

    if (isset($check_ev)) {
        echo $check_ev;
    }

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
?>
<?php if(Session::get('matu') == '79108'){ ?>
    <div class="card">
        <div class="card-header">
            <h3 class='text-center' style="margin:0"><i class="fas fa-graduation-cap mr-2"></i>Test</h3>
        </div>
        <div class="card-body pr-2 pl-2">
            <div class="card bg-info">
            <div class="card-header card-lg">
                <strong>Test</strong>
            </div>
            <div class="card-body">
                <table class="table" style="width:100%;">
                    <thead>
                        <tr>
                        <th class="text-center text-black">Data</th>
                        <th class="text-center">Ora scolastica</th>
                        <th class="text-center">Nome evento</th>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $allUser = $users->selectAllTestData();
                        if ($allUser) {
                            $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                        ?>
                        <tr class="text-center"
                            <?php if (Session::get("id") == $value->events_code) {
                            echo "style='background:#d9edf7' ";
                            } ?>
                        >
                            <td class="text-center"><?php echo $value->idate; ?></td>
                            <td class="text-center"><?php echo $value->hour; ?></td>
                            <td class="text-center"><?php echo $value->ename; ?></td>
                            <td class="text-center"><?php echo $value->tag; ?></td>
                            <td>
                                <a class="btn btn-success btn-sm" href="viewEvents.php?events=<?php echo $value->events_code;?>"><i class="fas fa-info mr-2"></i>Dettagli</a>
                                <a class="btn btn-secondary btn-sm text-white" href="?check_ev=<?php echo $value->events_code; ?>&tag=<?php echo $value->tag; ?>&idate=<?php echo $value->idate; ?>&hschool=<?php echo $value->hour; ?>&ename=<?php echo $value->ename; ?>&descr=<?php echo $value->descr; ?>&prio=<?php echo $value->prio; ?>&vis=<?php echo $value->vis; ?>&matu=<?php echo $value->matu; ?>&user_code=<?php echo Session::get("user_code"); ?>&checking=<?php echo $value->checking; ?>&writter_code=<?php echo $value->writter_code; ?>"><i class="fas fa-list"></i></a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                        <th colspan="6" class="text-center"><h3>Nessun test prossimamente</h3></th>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <br>
            <div class="card bg-danger">
            <div class="card-header card-lg">
                <strong>Test semestrali</strong>
            </div>
            <div class="card-body">
            <table class="table" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center text-black">Data</th>
                            <th class="text-center">Ora scolastica</th>
                            <th class="text-center">Nome evento</th>
                            <th class="text-center">Materia</th>
                            <th class="text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $allUser = $users->selectAllTestSemData();
                        if ($allUser) {
                            $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                        ?>
                        <tr class="text-center"
                            <?php if (Session::get("id") == $value->events_code) {
                            echo "style='background:#d9edf7' ";
                            } ?>
                        >
                            <td class="text-center"><?php echo $value->idate; ?></td>
                            <td class="text-center"><?php echo $value->hour; ?></td>
                            <td class="text-center"><?php echo $value->ename; ?></td>
                            <td class="text-center"><?php echo $value->tag; ?></td>
                            <td>
                                <a class="btn btn-success btn-sm" href="viewEvents.php?events=<?php echo $value->events_code;?>"><i class="fas fa-info mr-2"></i>Dettagli</a>
                                <a class="btn btn-secondary btn-sm text-white" href="?check_ev=<?php echo $value->events_code; ?>&tag=<?php echo $value->tag; ?>&idate=<?php echo $value->idate; ?>&hschool=<?php echo $value->hour; ?>&ename=<?php echo $value->ename; ?>&descr=<?php echo $value->descr; ?>&prio=<?php echo $value->prio; ?>&vis=<?php echo $value->vis; ?>&matu=<?php echo $value->matu; ?>&id=<?php echo Session::get("id"); ?>&checking=<?php echo $value->checking; ?>&id_writter=<?php echo $value->id_writter; ?>"><i class="fas fa-list"></i></a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                        <th colspan="6" class="text-center"><h3>Nessun test prossimamente</h3></th>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if(Session::get('matu') == '79109'){ ?>
    <div class="card">
        <div class="card-header">
            <h3 class='text-center' style="margin:0"><i class="fas fa-graduation-cap mr-2"></i>Test</h3>
        </div>
        <div class="card-body pr-2 pl-2">
            <div class="card bg-info">
            <div class="card-header card-lg">
                <strong>Test</strong>
            </div>
            <div class="card-body">
                <table class="table" style="width:100%;">
                    <thead>
                        <tr>
                        <th class="text-center text-black">Data</th>
                        <th class="text-center">Ora scolastica</th>
                        <th class="text-center">Nome evento</th>
                        <th class="text-center">Materia</th>
                        <th class="text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $allUser = $users->selectAllTestNData();
                        if ($allUser) {
                            $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                        ?>
                        <tr class="text-center"
                            <?php if (Session::get("id") == $value->id) {
                            echo "style='background:#d9edf7' ";
                            } ?>
                        >
                            <td class="text-center"><?php echo $value->idate; ?></td>
                            <td class="text-center"><?php echo $value->hour; ?></td>
                            <td class="text-center"><?php echo $value->ename; ?></td>
                            <td class="text-center"><?php echo $value->tag; ?></td>
                            <td>
                                <a class="btn btn-success btn-sm" href="viewEvents.php?id=<?php echo $value->id;?>"><i class="fas fa-info mr-2"></i>Dettagli</a>
                                <a class="btn btn-secondary btn-sm text-white" href="?check_ev=<?php echo $value->id; ?>&tag=<?php echo $value->tag; ?>&idate=<?php echo $value->idate; ?>&hschool=<?php echo $value->hour; ?>&ename=<?php echo $value->ename; ?>&descr=<?php echo $value->descr; ?>&prio=<?php echo $value->prio; ?>&vis=<?php echo $value->vis; ?>&matu=<?php echo $value->matu; ?>&id=<?php echo Session::get("id"); ?>&checking=<?php echo $value->checking; ?>&id_writter=<?php echo $value->id_writter; ?>"><i class="fas fa-list"></i></a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                        <th colspan="6" class="text-center"><h3>Nessun test prossimamente</h3></th>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <br>
            <div class="card bg-danger">
            <div class="card-header card-lg">
                <strong>Test semestrali</strong>
            </div>
            <div class="card-body">
            <table class="table" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center text-black">Data</th>
                            <th class="text-center">Ora scolastica</th>
                            <th class="text-center">Nome evento</th>
                            <th class="text-center">Materia</th>
                            <th class="text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $allUser = $users->selectAllTestNSemData();
                        if ($allUser) {
                            $i = 0;
                        foreach ($allUser as  $value) {
                            $i++;
                        ?>
                        <tr class="text-center"
                            <?php if (Session::get("id") == $value->id) {
                            echo "style='background:#d9edf7' ";
                            } ?>
                        >
                            <td class="text-center"><?php echo $value->idate; ?></td>
                            <td class="text-center"><?php echo $value->hour; ?></td>
                            <td class="text-center"><?php echo $value->ename; ?></td>
                            <td class="text-center"><?php echo $value->tag; ?></td>
                            <td>
                                <a class="btn btn-success btn-sm" href="viewEvents.php?id=<?php echo $value->id;?>"><i class="fas fa-info mr-2"></i>Dettagli</a>
                                <a class="btn btn-secondary btn-sm text-white" href="?check_ev=<?php echo $value->id; ?>&tag=<?php echo $value->tag; ?>&idate=<?php echo $value->idate; ?>&hschool=<?php echo $value->hour; ?>&ename=<?php echo $value->ename; ?>&descr=<?php echo $value->descr; ?>&prio=<?php echo $value->prio; ?>&vis=<?php echo $value->vis; ?>&matu=<?php echo $value->matu; ?>&id=<?php echo Session::get("id"); ?>&checking=<?php echo $value->checking; ?>&id_writter=<?php echo $value->id_writter; ?>"><i class="fas fa-list"></i></a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                        <th colspan="6" class="text-center"><h3>Nessun test prossimamente</h3></th>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php 
    include 'inc/footer.php';
?>