<?php
  include 'inc/header.php';
  Session::CheckSession();
?>
<div class="card">
    <div class="card-body pr-2 pl-2">
      <?php if(Session::get('matu') == '79108'){?>
          <?php
              include('./config/counter.php');
              $stmt = $mysqli->prepare("SELECT * 
                                        from docenti 
                                        where not matu = 0 
                                        ORDER BY lname ASC");
              $stmt->execute();
              $result = $stmt->get_result();
              while($row = $result->fetch_assoc()):
          ?>
            <div class="list-group">
              <a href="detailsDoc.php?id=<?php echo $row['id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">
                    <?= $row['lname'] ?> <?= $row['name'] ?>
                  </h5>
                  <small>
                    <?= $row['sig'] ?>
                  </small>
                </div>
                <p class="mb-1"></p>
                <small>
                    <?= $row['email'] ?>
                </small>
              </a>
            </div>
            <p>
          <?php endwhile; ?>
      <?php } ?>
      <?php if(Session::get('matu') == '79109'){?>
          <?php
              include('./config/counter.php');
              $stmt = $mysqli->prepare("SELECT * from docenti ORDER BY lname ASC");
              $stmt->execute();
              $result = $stmt->get_result();
              while($row = $result->fetch_assoc()):
          ?>
            <div class="list-group">
              <a href="detailsDoc.php?id=<?php echo $row['id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">
                    <?= $row['lname'] ?> <?= $row['name'] ?>
                  </h5>
                  <small>
                    <?= $row['sig'] ?>
                  </small>
                </div>
                <p class="mb-1"></p>
                <small>
                    <?= $row['email'] ?>
                </small>
              </a>
            </div>
            <p>
          <?php endwhile; ?>
      <?php } ?>
    </div>
</div>
<?php 
    include 'inc/footer.php';
?>