<?php
	include 'inc/header.php';
    Session::CheckSession();

    if (isset($_GET['id'])) {
        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    }

    if (isset($_GET['remove'])) {
        $remove_tips = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_tips']);
        $remove_tips = $users->deletePrivateTipsById($remove_tips);
    }
    if (isset($remove_tips)) {
      echo $remove_tips;
    }

    if (isset($_GET['remove_event'])) {
        $remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_event']);
        $remove_event = $users->deleteRemoveEventById($remove);
    }
    if (isset($remove_event)) {
      echo $remove_event;
    }
?>
<?php if (Session::get('roleid') == '1'){?>
	<div class="card">
		<div class="card-header">
			<h3 class="text-center" style="margin:0"><i class="fas fa-keyboard mr-2 mr-2"></i>Gestione dati di input</h3>
		</div>
        <div class="card-body">
            <div style="display:inline-block; margin-left:18%" class="form-check" id="exampleCheck1">
                <input type="checkbox" onclick="show_events()" class="form-check-input">
                <label class="form-check-label">Mostra eventi</label>
            </div>
            <div style="display:inline-block; margin-left:18%" class="form-check" id="exampleCheck2">
                <input type="checkbox" onclick="show_tips()" class="form-check-input">
                <label class="form-check-label">Mostra tipi</label>
            </div>
            <div style="display:inline-block; margin-left:18%"  class="form-check" id="exampleCheck3">
                <input type="checkbox" onclick="show_oss()" class="form-check-input">
                <label class="form-check-label">Mostra osservazioni</label>
            </div>
            <br>
            <div style="display:none" class="card bg-info" id="events">
                <div class="card-header card-lg">
                	<strong>Eventi</strong>
                </div>
                <div class="card-body">
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center text-black">Data</th>
                                <th class="text-center text-black">Ora scolastica</th>
                                <th class="text-center">Nome evento</th>
                                <th class="text-center">Visibilità</th>
                                <th class="text-center" width="25%">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $allUser = $users->selectAllPrivateInputEventData(Session::get("id"));
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
                                <td class="text-center"><?php echo $value->hschool; ?></td>
                                <td class="text-center"><?php echo $value->ename; ?></td>
                                <td>
                                    <?php if($value->vis == '1'){ ?>
                                      <span class="badge badge-lg badge-success text-white">Pubblico</span>
                                    <?php } ?>
                                    <?php if($value->vis == '2'){ ?>
                                      <span class="badge badge-lg badge-warning text-white">Privato</span>
                                    <?php } ?>
                                </td>
                                <td></td>
                            </tr>
                            <?php }}else{ ?>
                                <th colspan="5" class="text-center"><h3>Nessun evento creato</h3></th>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="display:none" class="card bg-success" id="tips">
                <div class="card-header card-lg">
                	<strong>Tipi</strong>
                </div>
                <div class="card-body">
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center text-black">Nome tag</th>
                                <th class="text-center text-black">Classe</th>
                                <th class="text-center text-black">Visibilità</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $allUser = $users->selectAllPrivateTipEventData(Session::get("id"));
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
                                <td class="text-center"><?php echo $value->title; ?></td>
                                <td>
									<?php if($value->matu == '0'){ ?>
										<span class="badge badge-lg badge-primary">Maturità</span>
									<?php } ?>
									<?php if($value->matu == '1'){ ?>
										<span class="badge badge-lg badge-primary">Non maturità</span>
									<?php } ?>
									<?php if($value->matu == '2'){ ?>
										<span class="badge badge-lg badge-primary">Professionale</span>
									<?php } ?>
							    </td>
                                <td>
                                    <?php if($value->vis == '1'){ ?>
                                      <span class="badge badge-lg badge-warning text-white">Pubblico</span>
                                    <?php } ?>
                                    <?php if($value->vis == '2'){ ?>
                                      <span class="badge badge-lg badge-danger text-white">Privato</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php }}else{ ?>
                                <th colspan="2" class="text-center"><h3>Nessun tipo creato</h3></th>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="display:none" class="card bg-danger" id="oss">
                <div class="card-header card-lg">
                	<strong>Osservazioni</strong>
                </div>
                <div class="card-body">
                    <table class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center text-black">Blocco</th>
                                <th class="text-center">Materia</th>
                                <th class="text-center">Docente</th>
                                <th class="text-center">Data</th>
                                <th class="text-center">Contenuto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $allUser = $users->selectAllPrivateOssData(Session::get("id"));
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
                                <td class="text-center"><?php echo $value->blocco; ?></td>
                                <td class="text-center"><?php echo $value->materia; ?></td>
                                <td class="text-center"><?php echo $value->sig_doc; ?></td>
                                <td class="text-center"><?php echo $value->data; ?></td>
                                <td class="text-center"><?php echo $value->text; ?></td>
                            </tr>
                            <?php }}else{ ?>
                                <th colspan="5" class="text-center"><h3>Nessun tipo creato</h3></th>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
<?php } ?>
<script>
  function show_events(){
    element = document.querySelector('#events');
    element.style.display = 'block';
    element = document.querySelector('#tips');
    element.style.display = 'none';
    element = document.querySelector('#oss');
    element.style.display = 'none';
  }
  function show_tips(){
    element = document.querySelector('#events');
    element.style.display = 'none';
    element = document.querySelector('#oss');
    element.style.display = 'none';
    element = document.querySelector('#tips');
    element.style.display = 'block';
  }
  function show_oss(){
    element = document.querySelector('#events');
    element.style.display = 'none';
    element = document.querySelector('#tips');
    element.style.display = 'none';
    element = document.querySelector('#oss');
    element.style.display = 'block';
  }
</script>
<?php
    include 'inc/footer.php';
?>