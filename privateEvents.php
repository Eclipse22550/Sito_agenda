<?php
	include 'inc/header.php';
    Session::CheckSession();

	if (isset($_GET['check_vmr'])) {
        $check = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['check_vmr']);
        $check_vmr = $users->CheckVMR($check);
    }
    if (isset($check_vmr)) {
        echo $check_vmr;
    }

    if (isset($_GET['resync_vmr'])) {
        $sync = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['resync_vmr']);
        $resync_vmr = $users->SyncVMR($sync);
    }
    if (isset($resync_vmr)) {
        echo $resync_vmr;
	}
	
	if (isset($_GET['remove_events'])) {
		$remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_events']);
		$remove_events = $users->deleteEventsPrivById($remove);
	}
	
	if (isset($remove_events)) {
		echo $remove_events;
	}

	if (isset($_GET['remove_tips'])) {
		$remove = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['remove_tips']);
		$remove_tips = $users->deleteTipsPrivById($remove);
	}
	
	if (isset($remove_events)) {
		echo $remove_events;
	}

	$logMsg = Session::get('logMsg');
    if (isset($logMsg)) {
        echo $logMsg;
    }

    $msg = Session::get('msg');
    if (isset($msg)) {
        echo $msg;
    }
?>
<?php if(Session::get('matu') == '0'){ ?>
	<div class="card">
			<div class="card-header">
				<h3 class="text-center" style="margin:0"><i class="fas fa-calendar-times mr-2"></i>Gestione elementi privati</h3>
			</div>
			<div class="card-body">
				<div class="card-body">
					<div class="card bg-info">
						<div class="card-header card-lg">
							<strong>Eventi</strong>
						</div>
						<div class="card-body">
							<table class="table" style="width:100%;">
								<thead>
									<tr>
									<th class="text-center text-black">Data</th>
									<th class="text-center">Ora scolastica</th>
									<th class="text-center">Nome evento</th>
									<th class="text-center">Classe</th>
									<th class="text-center">Priorità</th>
									<th class="text-center">Azioni</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$allUser = $users->selectAllPrivateData(Session::get("id"));
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
										<td class="text-center"><?php echo $value->hschool; ?></td>
										<td class="text-center"><?php echo $value->ename; ?></td>
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
												<span class="badge badge-lg badge-primary text-white">Esterna</span>
											<?php } ?>
										</td>
										<td>
											<a class="btn btn-success btn-sm" href="modifyEvents.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>Dettagli</a>
											<?php if($value->checking == '0'){ ?>
                                				<a class="btn btn-secondary btn-sm text-white" href="?check_vmr=<?php echo $value->id; ?>"><i class="fas fa-check"></i></a>
												<a class="btn btn-danger btn-sm text-white" href="?remove_events=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            				<?php }else{?>
                            				    <a class="btn btn-secondary btn-sm text-white" href="?resync_vmr=<?php echo $value->id; ?>"><i class="fas fa-sync"></i></a>
                            				    <a class="btn btn-danger btn-sm text-white" href="?remove_events=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            				<?php } ?>
										</td>
									</tr>
									<?php }}else{ ?>
									<th colspan="6" class="text-center"><h3>Nessun evento prossimamente</h3></th>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="card bg-success">
						<div class="card-header card-lg">
							<strong>Tipi</strong>
						</div>
						<div class="card-body">
							<table class="table" style="width:100%">
								<thead>
									<tr>
										<th class="text-center text-black">Nome tag</th>
										<th class="text-center text-black">Classe</th>
										<th width='25%' class="text-center">Azioni</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$allUser = $users->selectAllPrivateTipsData(Session::get("id"));
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
											<a class="btn btn-info btn-sm" href="viewTips.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>Dettagli</a>
											<a class="btn btn-danger btn-sm text-white" href="?remove_tips=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
										</td>
									</tr>
									<?php }}else{ ?>
										<th colspan="3" class="text-center"><h3>Nessun tipo creato</h3></th>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</div>
<?php } ?>
<?php if(Session::get('matu') == '1'){ ?>
	<div class="card">
			<div class="card-header">
				<h3 class="text-center" style="margin:0"><i class="fas fa-calendar-times mr-2"></i>Gestione elementi privati</h3>
			</div>
			<div class="card-body">
				<div class="card-body">
					<div class="card bg-info">
						<div class="card-header card-lg">
							<strong>Eventi</strong>
						</div>
						<div class="card-body">
							<table class="table" style="width:100%;">
								<thead>
									<tr>
									<th class="text-center text-black">Data</th>
									<th class="text-center">Ora scolastica</th>
									<th class="text-center">Nome evento</th>
									<th class="text-center">Classe</th>
									<th class="text-center">Priorità</th>
									<th class="text-center">Azioni</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$allUser = $users->selectAllPrNivateData(Session::get("id"));
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
										<td class="text-center"><?php echo $value->hschool; ?></td>
										<td class="text-center"><?php echo $value->ename; ?></td>
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
												<span class="badge badge-lg badge-primary text-white">Esterna</span>
											<?php } ?>
										</td>
										<td>
											<a class="btn btn-success btn-sm" href="modifyEvents.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>Dettagli</a>
											<?php if($value->checking == '0'){ ?>
                                				<a class="btn btn-secondary btn-sm text-white" href="?check_vmr=<?php echo $value->id; ?>"><i class="fas fa-check"></i></a>
												<a class="btn btn-danger btn-sm text-white" href="?remove_events=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            				<?php }else{?>
                            				    <a class="btn btn-secondary btn-sm text-white" href="?resync_vmr=<?php echo $value->id; ?>"><i class="fas fa-sync"></i></a>
                            				    <a class="btn btn-danger btn-sm text-white" href="?remove_events=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
                            				<?php } ?>
										</td>
									</tr>
									<?php }}else{ ?>
									<th colspan="6" class="text-center"><h3>Nessun evento prossimamente</h3></th>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="card bg-success">
						<div class="card-header card-lg">
							<strong>Tipi</strong>
						</div>
						<div class="card-body">
							<table class="table" style="width:100%">
								<thead>
									<tr>
										<th class="text-center text-black">Nome tag</th>
										<th class="text-center text-black">Classe</th>
										<th width='25%' class="text-center">Azioni</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$allUser = $users->selectAllPrNivateTipsData(Session::get("id"));
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
											<?php if($value->matu == '1'){ ?>
												<span class="badge badge-lg badge-primary">Non maturità</span>
											<?php } ?>
											<?php if($value->matu == '2'){ ?>
												<span class="badge badge-lg badge-primary">Professionale</span>
											<?php } ?>
										</td>
										<td>
											<a class="btn btn-info btn-sm" href="viewTips.php?id=<?php echo $value->id; ?>"><i class="fas fa-edit mr-2"></i>Dettagli</a>
											<a class="btn btn-danger btn-sm text-white" href="?remove_tips=<?php echo $value->id; ?>"><i class="fas fa-minus"></i></a>
										</td>
									</tr>
									<?php }}else{ ?>
										<th colspan="3" class="text-center"><h3>Nessun tipo creato</h3></th>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
	</div>
<?php } ?>
<?php
    include 'inc/footer.php';
?>