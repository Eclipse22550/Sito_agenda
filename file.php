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

    if (isset($_GET['id'])) {
        $userid = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['up_img'])) {
        $up_img = $users->UploadFile($_POST);
    }

    if (isset($up_img)) {
        echo $up_img;
    }

    Session::set("msg", NULL);
    Session::set("logMsg", NULL);
?>
<?php if(Session::get('matu') == '1'){ ?>
    <div class="alert">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg">Questo è un messaggio di attenzione</span>                 <!-- MAX 34 parole (12px) !-->
        <span class="close-btn">
            <span class="fas fa-times"></span>
        </span>
    </div>
    <div class="card" id="princiale_file">
        <div class="card-header">
            <button onclick="addFile()" class="btn btn-primary"><i class="fas fa-upload mr-2"></i>Carica file</button>
            <button onclick="ShowShare()" class="btn btn-secondary"><i class="fas fa-share-alt mr-2"></i>Condivisi con me</button>
            <button onclick="ShowShareWith()" class="btn btn-secondary"><i class="fas fa-share mr-2"></i>Condivisi da me</button>
        </div>
        <div class="card-body">
            <h4>Oggi (<?php echo date("d-m-Y") ?>)</h4>
            <div class="d-l-1">
                <br>
                <div class="row">
                    <?php
                        include('./config/counter.php');
                        $stmt = $mysqli->prepare("SELECT * from upload WHERE NOT matu = 0 and load_at = CURRENT_DATE ORDER BY load_at,date ASC LIMIT 4");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()):
                    ?>
                        <?php if($result >= '1'){ ?>
                            <div class="col-sm-3">
                                <div class="card <?php if($row['vis'] == '1'){
                                                    echo 'border-primary';
                                                }
                                                ?> 
                                                <?php if($row['vis'] == '2'){
                                                    echo 'border-danger';
                                                }
                                                ?>
                                mb-3" style="max-width: 18rem;">
                                <div class="card-header"><strong><i><u>Nome file:</u></i></strong> <?= $row['title'] ?></div>
                                    <div class="card-body text-primary">
                                        <h5 class="card-title text-center">
                                            <?php if($row['format'] == 'docx'){
                                                echo "<img src='./assets/img/word.jpg' width='100px' height='100px'></img>";
                                            }?> 
                                            <?php if($row['format'] == 'xls'){
                                                echo "<img src='./assets/img/excel.png' width='100px' height='100px'></img>";
                                            }?> 
                                            <?php if($row['format'] == 'pptx'){
                                                echo "<img src='./assets/img/pw.png' width='100px' height='100px'></img>";
                                            }?> 
                                            <?php if($row['format'] == 'accs'){
                                                echo "<img src='./assets/img/acs.png' width='100px' height='100px'></img>";
                                            }?> 
                                            <?php if($row['format'] == 'pdf'){
                                                echo "<img src='./assets/img/ads.png' width='100px' height='100px'></img>";
                                            }?> 
                                            <?php if($row['format'] == 'pro'){
                                                echo "<img src='./assets/img/pro.png' width='100px' height='100px'></img>";
                                            }?>
                                        </h5>
                                        <hr></hr>
                                        <p class="card-text">
                                            <button data-toggle="modal" data-target="#details" class="btn btn-success float-right align-bottom"><i class="fas fa-ellipsis-v"></i></button>
                                                <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class='text-center' style="margin:0"><i class="fas fa-folder-open mr-2"></i>Dettagli file</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="opt">
                                                                <a href="<?php echo readfile($docs); ?>" class="btn btn-success mr-2"><i class="fas fa-folder-open mr-2"></i>Apri</a>
                                                                <button onclick="share()" class="btn btn-primary mr-2" id="nshare"><i class="fas fa-share mr-2"></i>Condividi</button>
                                                                <button onclick="shareN()" class="btn btn-danger mr-2 nshare" id="sharet"><i class="fas fa-share mr-2"></i>Condividi</button>
                                                                <hr></hr>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php
    		                                                        $getUinfo = $users->getFileDetails();
    		                                                        if ($getUinfo) {
                                                                ?>
                                                                    <div class="deta" class="deta">
                                                                        <div style="width:100%; margin:0px auto">
			                                                                <form class="" action="" method="POST">
                                                                                <div class="form-group">
                                                                                    <label for="title">Nome file</label>
                                                                                    <input type="text" readonly="true" name="title" value="<?php echo $getUinfo->title; ?>" class="form-control">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="title">Nome file caricato</label>
                                                                                    <input type="text" readonly="true" name="title" value="<?php echo $getUinfo->docs; ?>" class="form-control">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="share-ban" id="share">
                                                                    <h3>Condividi</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <button class="btn btn-danger float-right align-bottom mr-2" id="delete"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-info float-right align-bottom mr-2"><i class="fas fa-download"></i></button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <h3>Vuoto!!!</h3>
                        <?php } ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <h4>Tutti i file</h4>
            <div class="d-l-1">
                <br>
                <div class="row">
                    <?php
                        $stmt = $mysqli->prepare("SELECT * from upload WHERE NOT matu = 0");
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()):
                    ?>
                        <div class="col-sm-3">
                            <div class="card <?php if($row['vis'] == '1'){
                                                echo 'border-primary';
                                            }
                                            ?> 
                                            <?php if($row['vis'] == '2'){
                                                echo 'border-danger';
                                            }
                                            ?>
                            mb-3" style="max-width: 18rem;">
                            <div class="card-header"><strong><i><u>Nome file:</u></i></strong> <?= $row['title'] ?></div>
                                <div class="card-body text-primary">
                                    <h5 class="card-title text-center">
                                        <?php if($row['format'] == 'docx'){
                                        echo "<img src='./assets/img/word.jpg' width='100px' height='100px'></img>";
                                        }?> 
                                        <?php if($row['format'] == 'xls'){
                                            echo "<img src='./assets/img/excel.png' width='100px' height='100px'></img>";
                                        }?> 
                                        <?php if($row['format'] == 'pptx'){
                                            echo "<img src='./assets/img/pw.png' width='100px' height='100px'></img>";
                                        }?> 
                                        <?php if($row['format'] == 'accs'){
                                            echo "<img src='./assets/img/acs.png' width='100px' height='100px'></img>";
                                        }?> 
                                        <?php if($row['format'] == 'pdf'){
                                            echo "<img src='./assets/img/ads.png' width='100px' height='100px'></img>";
                                        }?> 
                                        <?php if($row['format'] == 'pro'){
                                            echo "<img src='./assets/img/pro.png' width='100px' height='100px'></img>";
                                        }?>
                                    </h5>
                                    <hr></hr>
                                    <p class="card-text">
                                        <button data-toggle="modal" data-target="#details" class="btn btn-success float-right align-bottom"><i class="fas fa-folder-open"></i></button>
                                            <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class='text-center' style="margin:0"><i class="fas fa-folder-open mr-2"></i>Dettagli file</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div style="width:100%; margin:0px auto">
                                                                <form class="" action="" method="post">

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <button class="btn btn-danger float-right align-bottom mr-2"><i class="fas fa-trash"></i></button>
                                     </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card addFile" id="addFile">
        <div class="card-header">
            <h3 class='text-center' style="margin:0">
                <i class="fas fa-upload mr-2"></i>Carica nuovo file
                <button onclick="NullFile()" class="btn btn-danger float-right">Annulla</button>
            </h3>
        </div>
        <div class="card-body">
            <form action="" class="" name="addForm" method="post" enctype="multipart/form-data">
                <div style="width:600px; margin:0px auto">
                    <div class="form-group">
                        <label for="title">Nome documento</label>
                        <input type="text" name="title" onchange="readURL(this);" id="title" placeholder="Nome documento" class="form-control">
                        <input type="hidden" name="matu" value="<?php echo Session::get("matu") ?>" class="form-control">
                        <input type="hidden" name="id_writter" value="<?php echo Session::get("id") ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="format">Formato</label>
                        <select class="browser-default custom-select" name="format">
                            <option selected>Scegli un formato</option>
                            <option value="docx">Word</option>
                            <option value="xls">Excel</option>
                            <option value="pptx">Powerpoint</option>
                            <option value="accs">Access</option>
                            <option value="pdf">PDF</option>
                            <option value="pro">Programmazione</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vis">Visibilità</label>
                        <select class="browser-default custom-select" name="vis">
                            <option selected>Scegli uno stato</option>
                            <option value="1">Pubblico</option>
                            <option value="2">Privato</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" onclick="showPassLL()"> Avanzate</input>
                        <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class='text-center' style="margin:0"><i class="fas fa-folder-open mr-2"></i>Dettagli file</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="opt">
                                        <a href="<?php echo readfile($docs); ?>" class="btn btn-success mr-2"><i class="fas fa-folder-open mr-2"></i>Apri</a>
                                        <button onclick="share()" class="btn btn-primary mr-2" id="nshare"><i class="fas fa-share mr-2"></i>Condividi</button>
                                        <button onclick="shareN()" class="btn btn-danger mr-2 nshare" id="sharet"><i class="fas fa-share mr-2"></i>Condividi</button>
                                        <hr></hr>
                                    </div>
                                    <div class="modal-body">
                                        <?php
    		                                $getUinfo = $users->getFileDetails();
    		                                if ($getUinfo) {
                                        ?>
                                            <div class="deta" class="deta">
                                                <div style="width:100%; margin:0px auto">
			                                        <form class="" action="" method="POST">
                                                        <div class="form-group">
                                                            <label for="title">Nome file</label>
                                                            <input type="text" readonly="true" name="title" value="<?php echo $getUinfo->title; ?>" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="title">Nome file caricato</label>
                                                            <input type="text" readonly="true" name="title" value="<?php echo $getUinfo->docs; ?>" class="form-control">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="share-ban" id="share">
                                            <h3>Condividi</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input name="file" id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Scegli un file</label>
                        <div class="input-group-append">
                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Carica file</small></label>
                        </div>
                    </div>
                    <div class="form-group pass-file" id="pass_file">
                        <label for="title" id="security">Nome documento</label>
                        <input type="text" name="title" onchange="readURL(this);" id="title" placeholder="Nome documento" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="up_img" class="btn btn-success"><i class="fas fa-check mr-2"></i>Carica</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card share" id="sharenj">
        <div class="card-header">
            <button onclick="addFile()" class="btn btn-primary"><i class="fas fa-upload mr-2"></i>Carica file</button>
            <button onclick="ShowPrinc()" class="btn btn-secondary"><i class="fas fa-share-alt mr-2"></i>Home</button>
            <button onclick="ShowSharePrinc()" class="btn btn-secondary"><i class="fas fa-share mr-2"></i>Condivisi da me</button>
        </div>
        <div class="card-body">
            <h3>Sezione dei file condivisi con me</h3>
        </div>
    </div>
    <div class="card shareME" id="shareMe">
        <div class="card-header">
            <button onclick="addFile()" class="btn btn-primary"><i class="fas fa-upload mr-2"></i>Carica file</button>
            <button onclick="HomeGO()" class="btn btn-secondary"><i class="fas fa-home mr-2"></i>Home</button>
            <button onclick="ShowShare()" class="btn btn-secondary"><i class="fas fa-share-alt mr-2"></i>Condivisi con me</button>
        </div> 
        <div class="card-body">
            <h4>Oggi (<?php echo date("d-m-Y") ?>)</h4>
            <div class="d-l-1">

            </div>
        </div>              
    </div>
<?php } ?>
<?php
    include 'inc/footer.php';
?>