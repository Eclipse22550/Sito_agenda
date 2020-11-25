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
?>
<?php
date_default_timezone_set('Europe/Rome');

if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    $ym = date('Y-m');
}

$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

$today = date('Y-m-j', time());

$html_title = date('Y / m', $timestamp);

$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
$day_count = date('t', $timestamp);
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 7, date('Y', $timestamp)));
$weeks = array();
$week = '';
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {
    $date = $ym . '-' . $day;
    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    }else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';
    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        
        $week = '';
    }
}
?>
<div class="card">
    <div class="card-header">
        <button data-toggle="modal" data-target="#newEvent" class="btn btn-primary"><i class="far fa-calendar-plus mr-2"></i>Nuovo evento</button>
            <div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adding_event'])) {
                            $adding_event = $users->addEvent($_POST);
                        }

                        if (isset($_GET['id'])) {
                            $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
                        }

                        if (isset($adding_event)) {
                            echo $adding_event;
                        }
                    ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class='text-center' style="margin:0"><i class="far fa-calendar-plus mr-2"></i>Aggiungi evento</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="width:100%; margin:0px auto">
                            <form class="" action="" method="POST">
                                <input type="hidden" name="id_writter" value="<?php echo Session::get("id"); ?>" class="form-control">
                                <div class="form-group">
                                    <!--<label for=""><input type="checkbox" onclick="showTP()" ondblclick="showTPP()"> Tag privati</input></label>!-->
                                    <?php if(Session::get('matu') == '0'){?>
                                        <select id="s_p_1" style="display:block"  class="browser-default custom-select" name="tag">
                                            <option selected>Scegli un tag</option>
                                            <?php 
										        $allUser = $users->selectTips1M(Session::get("id"));
										        if ($allUser) {
										        	$i = 0;
										        foreach ($allUser as  $value) {
										        	$i++;
									        ?>
                                                <option>
                                                    <?php echo $value->title; ?>
                                                </option>
                                            <?php }} ?>
                                        </select>
                                        <!--<select id="s_p_2" style="display:none" class="browser-default custom-select" name="tag">
                                            <option selected>Scegli un tag</option>
                                            <?php 
										        //$allUser = $users->selectTips2M(Session::get("id"));
										        //if ($allUser) {
										        //	$i = 0;
										        //foreach ($allUser as  $value) {
										        //	$i++;
									        ?>
                                                <option>
                                                    <?php //echo $value->title; ?>
                                                </option>
                                            <?php //}} ?>
                                        </select>!-->
                                    <?php } ?>
                                    <?php if(Session::get('matu') == '1'){?>
                                        <select id="s_p_1" style="display:block"  class="browser-default custom-select" name="tag">
                                            <option selected>Scegli un tag</option>
                                            <?php 
										        $allUser = $users->selectTips1(Session::get("id"));
										        if ($allUser) {
										        	$i = 0;
										        foreach ($allUser as  $value) {
										        	$i++;
									        ?>
                                                <option>
                                                    <?php echo $value->title; ?>
                                                </option>
                                            <?php }} ?>
                                        </select>
                                        <!--<select id="s_p_2" style="display:none" class="browser-default custom-select" name="tag">
                                            <option selected>Scegli un tag</option>
                                            <?php 
										        //$allUser = $users->selectTips2(Session::get("id"));
										        //if ($allUser) {
										        //	$i = 0;
										        //foreach ($allUser as  $value) {
										        //	$i++;
									        ?>
                                                <option>
                                                    <?php //echo $value->title; ?>
                                                </option>
                                            <?php //}} ?>
                                        </select>!-->
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label for="idate">Data d'inizio</label>
                                    <input type="date" name="idate" placeholder="Data d'inizio" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="hschool">Ora (Da - A)</label><p><input type="checkbox" onclick="hideHR()" ondblclick="showHR()"> Tutto il giorno</input>
                                    <input type="hour" id="hr_i" name="hschool" placeholder="Ora" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ename">Nome</label>
                                    <input type="text" name="ename" placeholder="Nome evento" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="descr">Descrizione</label>
                                    <textarea type="text" name="descr" placeholder="Descrizione evento" class="md-textarea form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="prio">Priorità</label>
                                    <select class="browser-default custom-select" name="prio">
                                        <option selected>Scegli una priorità</option>
                                        <option value="1">Test semestrale</option>
                                        <option value="2">Test</option>
                                        <option value="3">Compito / compito con valutazione</option>
                                        <option value="4">Compito</option>
                                        <option value="5">Priorita' esterna</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vis">Visibilità</label>
                                    <select class="browser-default custom-select" name="vis">
                                        <option selected>Scegli uno stato</option>
                                        <option value="1">Pubblico</option>
                                        <?php if(Session::get('roleid') == '1'){ ?>
                                            <option value="2">Privato</option>
                                        <?php } ?>
                                        <?php if(Session::get('roleid') == '2'){ ?>
                                            <option value="2">Privato</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="matu">Classe</label>
                                    <select class="browser-default custom-select" name="matu">
                                        <option selected>Scegli una classe</option>
                                        <?php if(Session::get('matu') == '0'){ ?>
                                            <option value="0">Maturita'</option>
                                            <option value="2">Professionale</option>
                                        <?php } ?>
                                        <?php if(Session::get('matu') == '1'){ ?>
                                            <option value="1">Non maturità</option>
                                            <option value="2">Professionale</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <input type="hidden" value="0" name="checking">
                                <div class="form-group">
                                    <button type="submit" name="adding_event" class="btn btn-success"><i class="far fa-calendar-plus mr-2"></i>Crea evento</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <button data-toggle="modal" data-target="#newTips" class="btn btn-success"><i class="fas fa-globe mr-2"></i>Nuovo tipo</button>
            <div class="modal fade" id="newTips" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adding_tips'])) {
                        $adding_tips = $users->addTips($_POST);
                    }

                    if (isset($_GET['id'])) {
                        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
                    }

                    if (isset($adding_tips)) {
                        echo $adding_tips;
                    }
                ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class='text-center' style="margin:0"><i class="fas fa-globe mr-2"></i>Aggiungi tipo</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div style="width:100%; margin:0px auto">
                            <form class="" action="" method="post">
                                <input type="hidden" name="id_writter" value="<?php echo Session::get("id"); ?>" class="form-control">
                                <div class="form-group">
                                    <label for="tag">Tag esistenti</label>
                                    <?php if(Session::get('matu') == '1'){ ?>
                                        <select class="browser-default custom-select">
                                            <option selected>Tipi già esistenti</option>
                                            <?php
                                                include('./config/counter.php');
                                                $stmt = $mysqli->prepare("SELECT title from tips WHERE vis = 1 and not matu = 0");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                                <option>
                                                <?= $row['title'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    <?php } ?>
                                    <?php if(Session::get('matu') == '0'){ ?>
                                        <select class="browser-default custom-select">
                                            <option selected>Tipi già esistenti</option>
                                            <?php
                                                include('./config/counter.php');
                                                $stmt = $mysqli->prepare("SELECT title from tips WHERE vis = 1 and not matu = 1");
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                while($row = $result->fetch_assoc()):
                                            ?>
                                                <option>
                                                <?= $row['title'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                  <label for="aula">Nome tipo</label>
                                  <input type="text" name="title" placeholder="Nome tipo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="vis">Visibilità</label>
                                    <select class="browser-default custom-select" name="vis">
                                        <option selected>Scegli uno stato</option>
                                        <?php if(Session::get('roleid') == '1'){ ?>
                                            <option value="1">Pubblico</option>
                                        <?php } ?>
                                        <?php if(Session::get('roleid') == '2'){ ?>
                                            <option value="1">Pubblico</option>
                                        <?php } ?>
                                        <option value="2">Privato</option>
                                    </select>
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
                                  <button type="submit" name="adding_tips" class="btn btn-success">Aggiungi</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <button data-toggle="modal" data-target="#ModifyEventModal" class="btn btn-info"><i class="fas fa-edit mr-2"></i>Modifica eventi</button>
            <div class="modal fade bd-example-modal-lg" id="ModifyEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="text-center" style="margin:0" class="text-center"><i class="fas fa-edit mr-2"></i>Modifica eventi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php if(Session::get('matu') == '0'){?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">Nome evento</th>
                                            <th  class="text-center">Materia</th>
                                            <th  class="text-center">Data</th>
                                            <th  class="text-center">Priorità</th>
                                            <th  width='25%' class="text-center">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allUser = $users->selectAllEventsData();
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
                                                    <td><?php echo $value->ename; ?></td>
                                                    <td><?php echo $value->tag; ?></td>
                                                    <td><?php echo $value->idate; ?></td>
                                                    <td>
                                                        <?php if ($value->prio == '1') { ?>
                                                            <span class="badge badge-lg badge-danger text-white">Test semestrale</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '2') { ?>
                                                          <span class="badge badge-lg badge-warning text-white">Test</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '3') { ?>
                                                          <span class="badge badge-lg badge-success text-white">Compito ++</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '4') { ?>
                                                          <span class="badge badge-lg badge-info text-white">Compito</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '5') { ?>
                                                          <span class="badge badge-lg badge-info text-white">Esterna</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm " href="modifyEvents.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>MODIFICA</a>
                                                    </td>
                                                </tr>
                                                <?php }}else{ ?>
                                                    <th colspan="6" class="text-center"><h3 style="margin:0">Nessun evento esistente!</h3></th>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php }else{ ?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">Nome evento</th>
                                            <th  class="text-center">Materia</th>
                                            <th  class="text-center">Data</th>
                                            <th  class="text-center">Priorità</th>
                                            <th  width='25%' class="text-center">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allUser = $users->selectAllEventsNData();
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
                                                    <td><?php echo $value->ename; ?></td>
                                                    <td><?php echo $value->tag; ?></td>
                                                    <td><?php echo $value->idate; ?></td>
                                                    <td>
                                                        <?php if ($value->prio == '1') { ?>
                                                            <span class="badge badge-lg badge-danger text-white">Test semestrale</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '2') { ?>
                                                          <span class="badge badge-lg badge-warning text-white">Test</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '3') { ?>
                                                          <span class="badge badge-lg badge-success text-white">Compito ++</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '4') { ?>
                                                          <span class="badge badge-lg badge-info text-white">Compito</span>
                                                        <?php } ?>
                                                        <?php if ($value->prio == '5') { ?>
                                                          <span class="badge badge-lg badge-info text-white">Esterna</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm " href="modifyEvents.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>MODIFICA</a>
                                                    </td>
                                                </tr>
                                                <?php }}else{ ?>
                                                    <th colspan="6" class="text-center"><h3 style="margin:0">Nessun evento esistente!</h3></th>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            </div>
        <?php if(Session::get('roleid') == '1'){ ?>
            <button data-toggle="modal" data-target="#deleteTipsModal" class="btn btn-warning text-white"><i class="fas fa-eraser mr-2"></i>Cancella tipo</button>
                <div class="modal fade bd-example-modal-lg" id="deleteTipsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php
                        if (isset($_GET['remove_tips'])) {
                            $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_tips']);
                            $remove_tips = $users->deleteTipsById($remove);
                        }
                        if (isset($remove_tips)) {
                            echo $remove_tips;
                        }
                    ?>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 style="margin:0" class="text-center"><i class="fas fa-trash mr-2"></i>Cancella tipi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php if(Session::get('matu') == '1'){?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">Nome tipo</th>
                                            <th  width='25%' class="text-center">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allUser = $users->selectAllTipsData();
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
                                                    <td><?php echo $value->title; ?></td>
                                                    <td>
                                                        <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                                            <?php if (Session::get("id") == $value->id) {
                                                            echo "remove_tips";
                                                            } ?>
                                                        btn-sm " href="?remove_tips=<?php echo $value->id; ?>"><i class="fas fa-trash mr-2"></i>ELIMINA</a>
                                                    </td>
                                                </tr>
                                                <?php }}else{ ?>
                                                    <th colspan="5" class="text-center"><h3 style="margin:0">Nessun tipo esistente!</h3></th>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <?php if(Session::get('matu') == '0'){ ?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">Nome tipo</th>
                                            <th  width='25%' class="text-center">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allUser = $users->selectAllTipsNData();
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
                                                    <td><?php echo $value->title; ?></td>
                                                    <td>
                                                        <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                                            <?php if (Session::get("id") == $value->id) {
                                                            echo "remove_tips";
                                                            } ?>
                                                        btn-sm " href="?remove_tips=<?php echo $value->id; ?>"><i class="fas fa-trash mr-2"></i>ELIMINA</a>
                                                    </td>
                                                </tr>
                                                <?php }}else{ ?>
                                                    <th colspan="5" class="text-center"><h3 style="margin:0">Nessun tipo esistente!</h3></th>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <button data-toggle="modal" data-target="#deleteEventModal" class="btn btn-danger"><i class="fas fa-eraser mr-2"></i>Elimina eventi</button>
                <div class="modal fade bd-example-modal-lg" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php
                        if (isset($_GET['remove_events'])) {
                            $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_events']);
                            $remove_events = $users->deleteEventsById($remove);
                        }
                        if (isset($remove_events)) {
                            echo $remove_events;
                        }
                    ?>
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 style="margin:0" class="text-center"><i class="fas fa-trash mr-2"></i>Cancella eventi</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php if(Session::get('matu') == '0'){ ?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">Nome evento</th>
                                            <th  class="text-center">Materia</th>
                                            <th  class="text-center">Data</th>
                                            <th  class="text-center">Priorità</th>
                                            <th  width='25%' class="text-center">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allUser = $users->selectAllEventsData();
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
                                                    <td><?php echo $value->ename; ?></td>
                                                    <td><?php echo $value->tag; ?></td>
                                                    <td><?php echo $value->idate; ?></td>
                                                    <td><?php echo $value->prio; ?></td>
                                                    <td>
                                                        <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                                            <?php if (Session::get("id") == $value->id) {
                                                            echo "remove_tips";
                                                            } ?>
                                                        btn-sm " href="?remove_events=<?php echo $value->id;?>?id= <?php echo Session::get("id"); ?>"><i class="fas fa-trash mr-2"></i>ELIMINA</a>
                                                    </td>
                                                </tr>
                                                <?php }}else{ ?>
                                                    <th colspan="6" class="text-center"><h3 style="margin:0">Nessun evento esistente!</h3></th>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                                <?php if(Session::get('matu') == '1'){ ?>
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th  class="text-center">Nome evento</th>
                                            <th  class="text-center">Materia</th>
                                            <th  class="text-center">Data</th>
                                            <th  class="text-center">Priorità</th>
                                            <th  width='25%' class="text-center">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $allUser = $users->selectAllNEventsData();
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
                                                    <td><?php echo $value->ename; ?></td>
                                                    <td><?php echo $value->tag; ?></td>
                                                    <td><?php echo $value->idate; ?></td>
                                                    <td><?php echo $value->prio; ?></td>
                                                    <td>
                                                        <a onclick="return confirm('Sei sicuro di eliminarlo?')" class="btn btn-danger
                                                            <?php if (Session::get("id") == $value->id) {
                                                            echo "remove_tips";
                                                            } ?>
                                                        btn-sm " href="?remove_events=<?php echo $value->id;?>?id= <?php echo Session::get("id"); ?>"><i class="fas fa-trash mr-2"></i>ELIMINA</a>
                                                    </td>
                                                </tr>
                                                <?php }}else{ ?>
                                                    <th colspan="6" class="text-center"><h3 style="margin:0">Nessun evento esistente!</h3></th>
                                                <?php } ?>
                                                </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php } ?>
    </div>
    <div class="card-body pr-2 pl-2">
        <div class="cal" style="margin:0">
            <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <a><?php echo $html_title; ?></i> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
            <table class="table table-bordered">
                <tr class="tr-agenda">
                    <th class="day-agenda">Lunedì</th>
                    <th class="day-agenda">Martedì</th>
                    <th class="day-agenda">Mercoledì</th>
                    <th class="day-agenda">Giovedi</th>
                    <th class="day-agenda">Venerdi</th>
                    <th class="day-agenda">Sabato</th>
                    <th class="day-agenda">Domenica</th>
                </tr>
                <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
            </table>
        </div>
    </div>
    <script>
        function showTP(){
          element = document.querySelector('#s_p_1');
          element.style.display = 'none';
          element = document.querySelector('#s_p_2');
          element.style.display = 'block';
        }
        function showTPP(){
          element = document.querySelector('#s_p_1');
          element.style.display = 'block';
          element = document.querySelector('#s_p_2');
          element.style.display = 'none';
        }
        function hideHR(){
          element = document.querySelector('#hr_i');
          element.style.display = 'none';
        }
        function showHR(){
          element = document.querySelector('#hr_i');
          element.style.display = 'block';
        }
    </script>
</div>
<?php 
    include 'inc/footer.php';
?>