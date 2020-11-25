<?php
include 'lib/Database.php';
include_once 'lib/Session.php';
class Users{
  private $db;
  public function __construct(){
    $this->db = new Database();
  }
   public function formatDate($date){
      $strtime = strtotime($date);
    return date('Y-m-d H:i:s', $strtime);
  }
  public function checkExistEmailDoc($email){
   $sql = "SELECT email from docenti WHERE email = :email";
   $stmt = $this->db->pdo->prepare($sql);
   $stmt->bindValue(':email', $email);
    $stmt->execute();
   if ($stmt->rowCount()> 0) {
     return true;
   }else{
     return false;
   }
  }
  public function checkPlus($active,$userid){
    $sql = "SELECT * from plus WHERE id_events = :id_events and id_plus = :id_plus";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id_events', $active);
    $stmt->bindValue(':id_plus', $userid);
    $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
   }
  public function checkExistEmailMAdmin($email){
    $sql = "SELECT email from admin WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
   }
  public function checkExistMat($mat){
    $sql = "SELECT mat from materie WHERE mat = :mat";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':mat', $mat);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function checkExistSig($sig) {
    $sql = "SELECT sig from sigle WHERE sig = :sig";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':sig', $sig);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function checkExistVal($email){
    $sql = "SELECT email from login WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function checkExistEmail($email){
    $sql = "SELECT email from login WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function checkExistTips($title,$vis,$matu){
    $sql = "SELECT title,vis,matu from tips WHERE title = :title and vis = :vis and matu = :matu";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':vis', $vis);
    $stmt->bindValue(':matu', $matu);
    $stmt->execute();
    if ($stmt->rowCount()> 0) {
        return true;
    }else{
        return false;
    }
  }
  public function checkExistEmailSAdmin($email){
    $sql = "SELECT email from admin WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function checkExistEmailSSAdmin($username){
    $sql = "SELECT username from admin WHERE username = :username";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function checkExistEmailMod($email){
    $sql = "SELECT email from login WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }
  public function user4Registration($data){
    $name = $data['name'];
    $lname = $data['lname'];
    $username = $data['username'];
    $email = $data['email'];
    $roleid = $data['roleid'];
    $isActive = $data['isActive'];
    $password = $data['password'];
    $checkEmail = $this->checkExistEmailMAdmin($email);
    if ($name == "" || $lname == "" || $username == "" || $email == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Please, User Registration field must not be Empty !</div>';
      return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Username is too short, at least 3 Characters !</div>';
      return $msg;
    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Password almeno 6 caratteri !</div>';
      return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> La tua password deve contenere almeno un numero !</div>';
      return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> La tua password deve contenere almeno 1 numero !</div>';
      return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> indirizzo email non valido !</div>';
      return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Email esistente !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO admin(name, lname, username, email, password, isActive, roleid) VALUES(:name, :lname, :username, :email, :password, :isActive, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':lname', $lname);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':isActive', $isActive);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, ti sei registrato con successo !</div>';
          echo "<script>location.href='login4Role.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function addEvent($data){
    $events_code = rand(100000, 1000000);
    $tag = $data['tag'];
    $idate = $data['idate'];
    $hour = $data['hour'];
    $ename = $data['ename'];
    $descr = $data['descr'];
    $prio = $data['prio'];
    $vis = $data['vis'];
    $matu = $data['matu'];
    if ($tag == "Scegli un tag" || $idate == "" || $hour == "Scegli un ora" || $ename == ""|| $descr == "" || $prio == "Scegli una priorita"|| $vis == "Scegli uno stato" || $matu == "Scegli una classe") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }elseif (strlen($ename) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Nome evento troppo corto, almeno 3 caratteri !</div>';
      return $msg;
    }else{
        $sql = "INSERT INTO events(events_code, tag, idate, hour, ename, descr, prio, vis, matu, checking, writter_code) 
                VALUES(:events_code, :tag, :idate, :hour, :ename, :descr, :prio, :vis, :matu, :checking, :writter_code)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':events_code', $events_code);
        $stmt->bindValue(':tag', $tag);
        $stmt->bindValue(':idate', $idate);
        $stmt->bindValue(':hour', $hour);
        $stmt->bindValue(':ename', $ename);
        $stmt->bindValue(':descr', $descr);
        $stmt->bindValue(':prio', $prio);
        $stmt->bindValue(':vis', $vis);
        $stmt->bindValue(':matu', $matu);
        $stmt->bindValue(':checking', 0);
        $stmt->bindValue(':writter_code', Session::get("user_code"));
        $result = $stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Evento inserito !</div>';
            echo "<script>location.href='agenda.php';</script>";
          return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Errore !</strong> Qualcosa è andato storto !</div>';
            echo "<script>location.href='index.php';</script>";
          return $msg;
        }
    }
  }
  public function userRegDoc($data){
    $name = $data['name'];
    $lname = $data['lname'];
    $sig = $data['sig'];
    $email = $data['email'];
    $lmoodle = $data['lmoodle'];
    $matu = $data['matu'];
    $checkEmail = $this->checkExistEmailDoc($email);
    if ($name == "" || $lname == "" || $sig == "" || $email == "" || $matu == "Scegli una classe") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Compilare i campi !</div>';
      return $msg;
    }elseif (strlen($sig) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Sigla non valida !</div>';
      return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> indirizzo email non valido !</div>';
      return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Email esistente !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO docenti(name, lname, sig, email, matu, lmoodle) VALUES(:name, :lname, :sig, :email, :matu, :lmoodle)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':lname', $lname);
      $stmt->bindValue(':sig', $sig);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':lmoodle', $lmoodle);
      $result0 = $stmt->execute();
      if ($result0){
        $sql = "INSERT INTO sigle(sig) VALUES(:sig)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':sig', $sig);
        $result1 = $stmt->execute();
        if ($result1) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Docente registrato !</div>';
            echo "<script>location.href='regDoc.php';</script>";
          return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Errore !</strong> Qualcosa è andato storto !</div>';
          return $msg;
        }
      }
    }
  }
  public function getDayInfoById($blocco,$giorno){
    $sql = "SELECT * from bloccoa WHERE blocco = :blocco and giorno = :giorno";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':blocco', $blocco);
    $stmt->bindValue(':giorno', $giorno);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getID($userid){
    $sql = "SELECT * FROM login WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getIDAt($userid){
    $sql = "SELECT * FROM admin WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getModID($userid){
    $sql = "SELECT * FROM moderatori WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getAdID($userid){
    $sql = "SELECT * FROM admin WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getprivateAdId($userid){
    $sql = "SELECT id from admin WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getprivateModId(){
    $sql = "SELECT e.id_writter,m.id FROM events e,moderatori m WHERE m.id = e.id_writter";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function SearchMateria($data){
    $blocco = $data['blocco'];
    $giorno = $data['giorno'];
    if ($blocco == "Scegli un blocco" || $giorno == "Scegli un giorno" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }else{
      $sql = "SELECT * from bloccoa WHERE blocco = :blocco and giorno = :giorno";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':blocco', $blocco);
      $stmt->bindValue(':giorno', $giorno);
      $result = $stmt->execute();
      if ($result) {

      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function addMateria($data){
    $block_code = rand(1000, 10000);
    $blocco = $data['blocco'];
    $giorno = $data['giorno'];
    $materia_1 = $data['materia_1'];
    $matu = $data['matu'];
    if ($blocco == "" || $giorno == "" || $materia_1 == "" || $matu == "Scegli una classe") {
      $msg = 'Compilare i campi !';
      return $msg;
    }else{
      $sql2 = "INSERT INTO block
              (block_code, blocco, giorno, materia_1, matu, user_code) 
              VALUES(:block_code, :blocco, :giorno, :materia_1, :matu, :user_code)";
      $stmt = $this->db->pdo->prepare($sql2);
      $stmt->bindValue(':block_code', $block_code);
      $stmt->bindValue(':blocco', $blocco);
      $stmt->bindValue(':giorno', $giorno);
      $stmt->bindValue(':materia_1', $materia_1);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':user_code', Session::get("user_code"));
      $result = $stmt->execute();
      if ($result) {
        $msg = 'Inserito !';
        return $msg;
      }else{
        $msg = 'Qualcosa è andato storto !';
        return $msg;
      }
    }
  }
  public function addOr($data){
    $da = $data['da'];
    $a = $data['a'];
    if ($da == "" || $a == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO lezioni(da, a) VALUES(:da, :a)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':da', $da);
      $stmt->bindValue(':a', $a);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, giornata aggiunta !</div>';
          echo "<script>location.href='Hour.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function addOss($data){
    $id_writter = $data['id_writter'];
    $blocco = $data['blocco'];
    $sig_doc = $data['sig_doc'];
    $materia = $data['materia'];
    $data = $data['data'];
    $text = $data['text'];
    if ($blocco == "" || $sig_doc == "" ||$materia == "" || $data == "" || $text == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO oss(blocco, sig_doc, materia, data, text,id_writter) VALUES(:blocco, :sig_doc, :materia, :data, :text,:id_writter)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':blocco', $blocco);
      $stmt->bindValue(':sig_doc', $sig_doc);
      $stmt->bindValue(':materia', $materia);
      $stmt->bindValue(':data', $data);
      $stmt->bindValue(':text', $text);
      $stmt->bindValue(':id_writter', $id_writter);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, giornata aggiunta !</div>';
          echo "<script>location.href='index.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function addMat($data){
    $mat = $data['mat'];
    $checkMat = $this->checkExistMat($mat);
    if ($mat == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }elseif ($checkMat == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Materia esistente !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO materie(mat) VALUES(:mat)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':mat', $mat);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, giornata aggiunta !</div>';
          echo "<script>location.href='index.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function addClass($data){
    $aula = $data['aula'];
    if ($aula == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO aule(aula) VALUES(:aula)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':aula', $aula);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, giornata aggiunta !</div>';
          echo "<script>location.href='Hour.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  } 
  public function addTips($data){
    $code_tips = rand(100000, 1000000);
    $title = $data['title'];
    $vis = $data['vis'];
    $matu = $data['matu'];
    $checkTips = $this->checkExistTips($title,$matu,$vis);
    if ($title == "" || $vis == "Scegli uno stato" || $matu == "Scegli una classe") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }elseif ($checkTips == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Tipo già esistente !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO tips(code_tips, title, vis, matu, writter_code) 
              VALUES(:code_tips, :title, :vis, :matu, :writter_code)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':code_tips', $code_tips);
      $stmt->bindValue(':title', $title);
      $stmt->bindValue(':vis', $vis);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':writter_code', Session::get("user_code"));
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Tipo aggiunto !</div>';
          echo "<script>location.href='./redirect/agenda.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function userRegistration($data){
    $user_code = rand(10000, 1000000);
    $name = $data['name'];
    $lname = $data['lname'];
    $email = $data['email'];
    $username = $data['username'];
    $password = $data['password'];
    $matu = $data['matu'];
    $roleid = $data['roleid'];
    $checkEmail = $this->checkExistEmail($email);
    if ($name == "" || $lname == "" || $username == "" || $email == "" || $password == "" || $matu == "Scegli una classe" || $roleid == "Scegli un ruolo") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Completare i campi !</div>';
      return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Username troppo corto minimo 3 caratteri !</div>';
      return $msg;
    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Password almeno 6 caratteri !</div>';
      return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> La tua password deve contenere almeno un numero !</div>';
      return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> La tua password deve contenere almeno 1 numero !</div>';
      return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Indirizzo email non valido !</div>';
      return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Email già esistente !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO 
              login(user_code, name, lname, email, username, password, roleid, isActive, matu, qta) 
              VALUES (:user_code, :name, :lname, :email, :username, :password, :roleid, :isActive, :matu, :qta)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':user_code', $user_code);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':lname', $lname);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', hash("SHA512", $password));
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':isActive', 79165);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':qta', 79173);
      $result = $stmt->execute();
      if($result){
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, ti sei registrato con successo !</div>';
          echo "<script>location.href='login.php';</script>";
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Errore !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function UploadFile($data){
    $title = $data['title'];
    $matu = $data['matu'];
    $format = $data['format'];
    $vis = $data['vis'];
    $id_writter = $data['id_writter'];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
    $uploads_dir = './uploads/document';
    move_uploaded_file($tname, $uploads_dir.'/'.$pname);
    $sql = "INSERT into upload(title,dir,docs,matu,vis,id_writter,format) VALUES('$title','$uploads_dir','$pname','$matu','$vis','$id_writter','$format')";
    $stmt = $this->db->pdo->prepare($sql);
    $result = $stmt->execute();
    if($result){ 
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Wow, ti sei registrato con successo !</div>';
        echo "<script>location.href='file.php';</script>";
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Qualcosa è andato storto !</div>';
      return $msg;
    }
  }
  public function addNewUserByAdmin($data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $roleid = $data['roleid'];
    $password = $data['password'];
    $checkEmail = $this->checkExistEmail($email);
    if ($name == "" || $username == "" || $email == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> I campi di input non devono essere vuoti !</div>';
      return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Il nome utente è troppo corto, almeno 3 caratteri !</div>';
      return $msg;
    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Password almeno 6 caratteri !</div>';
      return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Your Password Must Contain At Least 1 Number !</div>';
      return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> La tua password deve contenere almeno 1 numero !</div>';
      return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> indirizzo email non valido !</div>';
      return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> L email esiste già, prova un altra e-mail ...!</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO login(name, username, email, password, roleid) VALUES(:name, :username, :email, :password, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='index.php';</script>";
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, ti sei registrato con successo !</div>';
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function addNewUsereByAdmin($data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $roleid = $data['roleid'];
    $password = $data['password'];
    $checkEmail = $this->checkExistEmail($email);
    if ($name == "" || $username == "" || $email == "" || $password == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> I campi di input non devono essere vuoti !</div>';
        return $msg;
    }elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> Il nome utente è troppo corto, almeno 3 caratteri !</div>';
        return $msg;
    }elseif(strlen($password) < 5) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> Password almeno 6 caratteri !</div>';
        return $msg;
    }elseif(!preg_match("#[0-9]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> Your Password Must Contain At Least 1 Number !</div>';
        return $msg;
    }elseif(!preg_match("#[a-z]+#",$password)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> La tua password deve contenere almeno 1 numero !</div>';
        return $msg;
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> indirizzo email non valido !</div>';
        return $msg;
    }elseif ($checkEmail == TRUE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Errore !</strong> L email esiste già, prova un altra e-mail ...!</div>';
        return $msg;
    }else{
      $sql = "INSERT INTO login(name, username, email, password, roleid) VALUES(:name, :username, :email, :password, :roleid)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':password', SHA1($password));
      $stmt->bindValue(':roleid', $roleid);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Wow, ti sei registrato con successo !</div>';
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Qualcosa è andato storto !</div>';
        return $msg;
      }
    }
  }
  public function selectAllOssData(){
    $sql = "SELECT * FROM oss ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllComitoData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio  = 79104 
            and       vis   = 79106 
            and not   matu  = 79109
            and       idate >= CURRENT_DATE 
            ORDER BY  idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllNComitoData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio  = 79104 
            and       vis   = 79106 
            and not   matu  = 79108
            and       idate >= CURRENT_DATE 
            ORDER BY  idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllComitoValData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio  = 79103
            and       vis   = 79106  
            and not   matu  = 79109 
            and       idate >= CURRENT_DATE 
            ORDER BY  idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllNComitoValData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio      = 79103 
            and       vis       = 79106 
            and not   matu      = 79108 
            and       idate     >= CURRENT_DATE 
            ORDER BY  idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllTestData(){
    $sql = "SELECT    *
            FROM      events 
            WHERE     prio  = 79102 
            and       vis   = 79106 
            and NOT   matu  = 79109 
            and       idate >= CURRENT_DATE 
            ORDER BY  idate 
            ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllTestNData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio  = 79102 
            and       vis   = 79106 
            and not   matu  = 79108
            and       idate >= CURRENT_DATE 
            ORDER BY  idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllCountData(){
    $sql = "SELECT * FROM events WHERE vis = 1 and not matu = 1 and idate >= CURRENT_DATE ORDER BY idate ASC LIMIT 5";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllNCountData(){
    $sql = "SELECT * FROM events WHERE vis = 1 and not matu = 0 and idate >= CURRENT_DATE ORDER BY idate ASC LIMIT 5";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateUtData(){
    $sql = "SELECT l.id, e.* FROM events e,login l WHERE l.id = e.id_writter and e.vis = 'Privato' ORDER BY e.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllTestSemData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio  = 79101
            and       vis   = 79106 
            and not   matu  = 79109
            and       idate >= CURRENT_DATE 
            ORDER BY idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllTestNSemData(){
    $sql = "SELECT    * 
            FROM      events 
            WHERE     prio  = 79101
            and       vis   = 79106 
            and not   matu  = 79108 
            and       idate >= CURRENT_DATE 
            ORDER BY  idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllTipsData(){
    $sql = "SELECT * FROM tips WHERE vis = 1 and matu = 1 ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllTipsNData(){
    $sql = "SELECT * FROM tips WHERE vis = 1 and matu = 0 ORDER BY id DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllEventsData(){
    $sql = "SELECT * FROM events WHERE vis = 1 and not matu = 1 ORDER BY idate DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllNEventsData(){
    $sql = "SELECT * FROM events WHERE vis = 1 and not matu = 0 ORDER BY idate DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllEventsNData(){
    $sql = "SELECT * FROM events WHERE vis = 1 and not matu = 0 ORDER BY idate DESC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllUserLoginData(){
    $sql = "SELECT * FROM login WHERE qta = 0 ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllEventsTOTData(){
    $sql = "SELECT * FROM events ORDER BY idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllBlockData(){
    $sql = "SELECT * FROM bloccoa ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllAuleData(){
    $sql = "SELECT * FROM aule ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllUserAdminData() {
    $sql = "SELECT * FROM admin ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectActivationData() {
    $sql = "SELECT * FROM login WHERE qta = 1 ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllDocentiData() {
    $sql = "SELECT * FROM docenti ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllAdminUserData() {
    $sql = "SELECT * FROM login ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllUserModeratoriData(){
    $sql = "SELECT * FROM moderatori ORDER BY id ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function userLoginAutho($username, $password){
    $password = hash("SHA512", $password);
    $sql = "SELECT * 
            FROM login 
            WHERE username = :username 
            and password = :password 
            LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function userLoginAuthoAt($id){
    $password = SHA1($password);
    $sql = "SELECT * FROM login WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function userValidateEmail($email, $password){
    $password = SHA1($password);
    $sql = "SELECT * FROM login WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function userLoginSAuthoAdmin($email, $password){
    $password = SHA1($password);
    $sql = "SELECT * FROM admin WHERE email = :email and password = :password LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function CheckActiveUser($username){
    $sql = "SELECT * FROM login 
            WHERE username = :username 
            and isActive = :isActive 
            and qta = :qta 
            LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':isActive', 79118);
    $stmt->bindValue(':qta', 79173);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function CreateSessionLogin($cookie_userid,$cookie_name,$cookie_hash){
    $sql = "INSERT INTO sessions(sessions_userid,sessions_name,sessions_hash) VALUES(:sessions_userid,:sessions_name,:sessions_hash)";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':sessions_userid', hash("SHA512",$cookie_userid));
    $stmt->bindValue(':sessions_name', hash("SHA512",$cookie_name));
    $stmt->bindValue(':sessions_hash', hash("SHA512",$cookie_hash));
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Wow, ti sei registrato con successo !</div>';
        echo "<script>location.href='index.php';</script>";
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Qualcosa è andato storto !</div>';
      return $msg;
    }
  }
  public function DeleteSessionLogin($cookie_userid,$cookie_name,$cookie_hash){
    $sql = "DELETE FROM sessions WHERE sessions_userid = :sessions_userid and sessions_name = :sessions_name and sessions_hash = :sessions_hash";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':sessions_userid', hash("SHA512",$cookie_userid));
    $stmt->bindValue(':sessions_name', hash("SHA512",$cookie_name));
    $stmt->bindValue(':sessions_hash', hash("SHA512",$cookie_hash));
    $result = $stmt->execute();
    if ($result) {
      Session::destroy();
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Qualcosa è andato storto !</div>';
      return $msg;
    }
  }
  public function CheckUserValidate($email,$password){
    $password = SHA1($password);
    $sql = "SELECT * FROM login WHERE email = :email and password = :password and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function CheckActivationValidate($email,$password){
    $password = SHA1($password);
    $sql = "SELECT * FROM activate WHERE email = :email and password = :password";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function CheckActiveUserSAdmin($email){
    $sql = "SELECT * FROM admin WHERE email = :email and isActive = :isActive LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':isActive', 1);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
  }
  public function userActiveAdminByAdmin() {
    $sql = "UPDATE admin SET
    isActive=:isActive
    WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
     if ($result) {
       echo "<script>location.href='admin_login_list.php';</script>";
       Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Success !</strong> Utente attivato correttamente !</div>');
     }else{
       echo "<script>location.href='admin_login_list.php';</script>";
       Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Error !</strong> Dati non attivati !</div>');
     }
  }
  public function userActiveAdminLoginByAdmin() {
    $sql = "UPDATE login SET
    isActive=:isActive
    WHERE id = :id";

    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
     if ($result) {
       echo "<script>location.href='admin_login_list.php';</script>";
       Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Success !</strong> Utente attivato correttamente !</div>');
     }else{
       echo "<script>location.href='admin_login_list.php';</script>";
       Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
       <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       <strong>Error !</strong> Dati non attivati !</div>');
     }
  }
  public function validateEmail($data) {
    $email = $data['email'];
    $password = $data['password'];
    $checkEmail = $this->checkExistVal($email);
    if ($email == "" || $password == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Email o password non essere vuoti !</div>';
      return $msg;
    }elseif ($checkEmail == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Nessun riscontro email !</div>';
      return $msg;
    }else{
      $chkActive = $this->CheckUserValidate($email,$password);
      $chkPresent = $this->CheckActivationValidate($email,$password);
      if ($chkActive == FALSE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Utente già attivo !</div>';
        return $msg;
      }elseif ($chkPresent == TRUE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Richiesta già inviata !</div>';
        return $msg;
      }else{
        $sql = "INSERT INTO activate(email, password) VALUES(:email, :password)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', SHA1($password));
        $result = $stmt->execute();
        if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success !</strong> Attivazione avvenuta con successo !</div>';
            echo "<script>location.href='login.php';</script>";
          return $msg;
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error !</strong> Qualcosa è andato storto !</div>';
          return $msg;
        }
      }
    }
  }
  public function userLoginAuthotication($data){
    $username = $data['username'];
    $password = $data['password'];
    $logResult = $this->userLoginAutho($username,$password);
    $chkActive = $this->CheckActiveUser($username);
    if ($username == "" || $password == "") {
      $msg = 'Compilare i campi di input';
      return $msg;
    }else if($logResult == FALSE){
      $msg = 'Username o password errati !';
      return $msg;
    }else{
        if ($chkActive == TRUE) {
          $msg = 'Il tuo account è disattivato!';
          return $msg;
        }elseif ($logResult) {
          Session::init();
          Session::set('login', TRUE);
          Session::set('user_code', $logResult->user_code);
          Session::set('roleid', $logResult->roleid);
          Session::set('matu', $logResult->matu);
          Session::set('username', $logResult->username);
          Session::set('password', $logResult->password);
          Session::set('logMsg', 'Hai effettuato il login con successo!');
            echo "<script>location.href='index.php';</script>";
        }else{
          $msg = 'Qualcosa non va!';
          return $msg;
        }
    }
  }
  public function userLogin4Authotication($data) {
    $email = $data['email'];
    $password = $data['password'];
    $checkEmail = $this->checkExistEmailSAdmin($email);
    if ($email == "" || $password == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Email o password non essere vuoti !</div>';
      return $msg;
    }elseif ($checkEmail == FALSE) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Nessun riscontro email !</div>';
      return $msg;
    }else{
      $logResult = $this->userLoginSAuthoAdmin($email, $password);
      $chkActive = $this->CheckActiveUserSAdmin($email);
      if ($chkActive == TRUE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Siamo spiacenti, il tuo account è disattivato !</div>';
        return $msg;
      }elseif ($logResult) {
        Session::init();
        Session::set('4login', TRUE);
        Session::set('id', $logResult->id);
        Session::set('roleid', $logResult->roleid);
        Session::set('name', $logResult->name);
        Session::set('lname', $logResult->lname);
        Session::set('email', $logResult->email);
        Session::set('username', $logResult->username);
        Session::set('logMsg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Accesso eseguito correttamente !</div>');
        echo "<script>location.href='indexRole4.php';</script>";
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Email, username o password non corrispondenti!</div>';
        return $msg;
        }
      }
  }
  public function getUserInfoById($user_code){
    $sql = "SELECT * FROM login WHERE user_code = :user_code LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':user_code', $user_code);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getUserControlInfoById($userid){
    $sql = "SELECT * FROM login WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getFileDetails(){
    $sql = "SELECT * FROM upload";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getPRIVATE($userid){
    $sql = "SELECT count(id) FROM events where vis = 2 and not matu = 0 and id_writter = 2";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getDocInfoById($userid){
    $sql = "SELECT * FROM docenti WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getUsererInfoById($userid){
    $sql = "SELECT * FROM admin WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getMatInfoById($events_code){
    $sql = "SELECT  * 
            FROM    events 
            WHERE   events_code = :events_code 
            LIMIT   1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':events_code', $events_code);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getTipInfoById($userid){
    $sql = "SELECT * FROM tips WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getShareEventsInfoById($userid){
    $sql = "SELECT * FROM events WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getShareInfoById($userid){
    $sql = "SELECT * FROM events WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getIDById($userid){
    $sql = "SELECT * FROM login WHERE id = :id LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function getOssById($userid){
    $sql = "SELECT e.*,l.* FROM events e,login l WHERE e.id = e.ename LIMIT 1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result) {
      return $result;
    }else{
      return false;
    }
  }
  public function selectAllPrivateData($userid){
    $sql = "SELECT l.id,e.* from login l,events e WHERE l.id = (
      SELECT id from login WHERE id = :id
    ) and e.id_writter = l.id and e.vis = 2 and not e.matu = 1 ORDER BY e.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectTips2($userid){
    $sql = "SELECT t.*,l.id from tips t,login l WHERE l.id = (SELECT id from login WHERE id = :id) and t.id_writter = l.id and not t.matu = 0 and t.vis = 2";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectTips2M($userid){
    $sql = "SELECT t.*,l.id from tips t,login l WHERE l.id = (SELECT id from login WHERE id = :id) and t.id_writter = l.id and not t.matu = 1 and t.vis = 2";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectTips1($userid){
    $sql = "SELECT * from tips WHERE not matu = 46592 and vis = 45618";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function selectBA(){
    $sql = "SELECT    * 
            FROM      coder 
            WHERE     mix = 'Moduli'
            ORDER BY  name ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TranslateVieWEvents($tag, $ename){
    $sql = "SELECT  e.tag,e.ename, t.title, t.code_tips
            FROM    events e, tips t
            WHERE   e.tag = :tag
            AND     e.ename = :ename
            AND     e.tag = t.code_tips
            LIMIT   1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':tag', $tag);
    $stmt->bindValue(':ename', $ename);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TranslateModel($code){
    $sql = "SELECT  code, name
            FROM    coder
            WHERE   code = :code";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':code', $code);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TranslateModuliEvents($code){
    $sql = "SELECT  code, name
            FROM    coder
            WHERE   code  = :code";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':code', $code);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TranslatePriOEvents($prio, $ename){
    $sql = "SELECT  e.prio,e.ename,c.name
            FROM    events e, coder c
            WHERE   e.prio = :prio
            AND     e.ename = :ename
            AND     c.code = e.prio
            LIMIT   1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':prio', $prio);
    $stmt->bindValue(':ename', $ename);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TranslateViSEvents($vis, $ename){
    $sql = "SELECT  e.vis,e.ename,c.name
            FROM    events e, coder c
            WHERE   e.vis = :vis
            AND     e.ename = :ename
            AND     c.code = e.vis
            LIMIT   1";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':vis', $vis);
    $stmt->bindValue(':ename', $ename);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TransMatuProf($user_code){
    $sql = "SELECT  c.code, c.name, l.matu, l.user_code 
            from    coder c, login l 
            WHERE   l.user_code = :user_code
            AND     l.matu = c.code";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':user_code', $user_code);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function TransRoleIDProf($user_code){
    $sql = "SELECT  c.code, c.name, l.matu, l.user_code 
            from    coder c, login l 
            WHERE   l.user_code = :user_code
            AND     l.roleid = c.code";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':user_code', $user_code);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectTips1M($userid){
    $sql = "SELECT code_tips, title, matu, vis from tips WHERE not matu = 48950 and vis = 45618";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':user_code', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectToDoData($userid){
    $sql = "SELECT l.id,p.* from login l, plus p WHERE l.id = (
      SELECT id from login WHERE id = :id
    ) and p.id_plus = l.id and not p.matu = 1 ORDER BY p.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectToNDoData($userid){
    $sql = "SELECT l.id,p.* from login l, plus p WHERE l.id = (
      SELECT id from login WHERE id = :id
    ) and p.id_plus = l.id and not p.matu = 0 ORDER BY p.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectNNDoData($userid){
    $sql = "SELECT DISTINCT l.id,id_plus from login l, plus p WHERE l.id = ( SELECT id from login WHERE id = 2) and p.id_plus = l.id and not p.matu = 0 and p.checking = 0 ORDER BY p.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectMNDoData($userid){
    $sql = "SELECT l.id,count(id_plus),id_plus 
    from login l, plus p 
    WHERE l.id = ( SELECT id from login WHERE id = :id) and p.id_plus = l.id and not p.matu = 1 and p.checking = 0
    ORDER BY p.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrNivateData($userid){
    $sql = "SELECT l.id,e.* from login l,events e WHERE l.id = (
      SELECT id from login WHERE id = :id
    ) and e.id_writter = l.id and e.vis = 2 and not e.matu = 0 ORDER BY e.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateModData($userid){
    $sql = "SELECT l.id,e.* from login l,events e WHERE l.id = (
      SELECT id from login WHERE id = :id
    ) and e.id_writter = l.id and e.vis = 'Privato' ORDER BY e.idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateTipsData($userid){
    $sql = "SELECT l.id,t.* from login l,tips t WHERE l.id = (SELECT id from login WHERE id = :id) and t.id_writter = l.id and t.vis = 2 and not t.matu = 1 ORDER BY t.title ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrNivateTipsData($userid){
    $sql = "SELECT l.id,t.* from login l,tips t WHERE l.id = (SELECT id from login WHERE id = :id) and t.id_writter = l.id and t.vis = 2 and not t.matu = 0 ORDER BY t.title ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateInputTipsData($id){
    $sql = "SELECT l.id,t.* from login l,tips t WHERE l.id = (SELECT id from login WHERE id = :id) and t.id_writter = l.id and t.vis = 'Privato'";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateInputEventData($userid){
    $sql = "SELECT l.id,e.* from login l,events e WHERE l.id = (SELECT id from login WHERE id = :id) and e.id_writter = l.id ORDER BY idate ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateTipEventData($userid){
    $sql = "SELECT l.id,t.* from login l,tips t WHERE l.id = (SELECT id from login WHERE id = :id) and t.id_writter = l.id ORDER BY t.title ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function selectAllPrivateOssData($userid){
    $sql = "SELECT l.id,o.* from login l,oss o WHERE l.id = (SELECT id from login WHERE id = :id) and o.id_writter = l.id ORDER BY data ASC";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $userid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function updateUserByIdInfo($user_code, $data){
    $name = $data['name'];
    $lname = $data['lname'];
    $username = $data['username'];
    $email = $data['email'];
    $matu = $data['matu'];
    $roleid = $data['roleid'];
    if ($name == "" || $lname == "" || $username == ""|| $email == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> I campi di input non devono essere vuoti !</div>';
      return $msg;
      }elseif (strlen($username) < 3) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Username troppo corti, almeno 3 caratteri !</div>';
        return $msg;
      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Indirizzo email non valido !</div>';
      return $msg;
    }else{
      $sql3 = "UPDATE login SET
              name            = :name,
              lname           = :lname,
              username        = :username,
              email           = :email,
              matu            = :matu,
              roleid          = :roleid
              WHERE user_code = :user_code";
      $stmt= $this->db->pdo->prepare($sql3);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':lname', $lname);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':roleid', $roleid);
      $stmt->bindValue(':user_code', $user_code);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Dati aggiornati. !</div>');
      }else{
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non inseriti!</div>');
      }
    }
  }
  public function updateEventsByIdInfo($events_code, $data){
      $tag = $data['tag'];
      $idate = $data['idate'];
      $hour = $data['hour'];
      $ename = $data['ename'];
      $descr = $data['descr'];
      $prio = $data['prio'];
      $vis = $data['vis'];
      $id_writter = $data['id_writter'];
      if ($tag == "Scegli un tag" || $idate == "" || $hour == "" || $ename == "" || $descr == "" || $prio == "" || $vis == "") {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Compilare i campi !</div>';
        return $msg;
        }else{
        $sql = "UPDATE events SET
          tag = :tag,
          idate = :idate,
          hour = :hour,
          ename = :ename,
          descr = :descr,
          prio = :prio,
          vis = :vis,
          id_writter = :id_writter
          WHERE events_code = :events_code";
          $stmt= $this->db->pdo->prepare($sql);
          $stmt->bindValue(':tag', $tag);
          $stmt->bindValue(':idate', $idate);
          $stmt->bindValue(':hour', $hschool);
          $stmt->bindValue(':ename', $ename);
          $stmt->bindValue(':descr', $descr);
          $stmt->bindValue(':prio', $prio);
          $stmt->bindValue(':vis', $vis);
          $stmt->bindValue(':id_writter', $id_writter);
          $stmt->bindValue(':events_code', $events_code);
        $result = $stmt->execute();
        if ($result) {
          echo "<script>location.href='agenda.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Dati aggiornati. !</div>');
        }else{
          Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Dati non inseriti!</div>');
        }
      }
  }
  public function updateTipsByIdInfo($userid, $data){
    $title = $data['title'];
    $matu = $data['matu'];
    $vis = $data['vis'];
    $id_writter = $data['id_writter'];
    if ($title == "" || $matu == "" || $vis == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Compilare i campi !</div>';
      return $msg;
      }else{
      $sql = "UPDATE tips SET
        title = :title,
        matu = :matu,
        vis = :vis,
        id_writter = :id_writter
        WHERE id = :id";
        $stmt= $this->db->pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':matu', $matu);
        $stmt->bindValue(':vis', $vis);
        $stmt->bindValue(':id_writter', $id_writter);
        $stmt->bindValue(':id', $userid);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='./redirect/viewT.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Dati aggiornati. !</div>');
      }else{
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non inseriti!</div>');
      }
    }
  }
  public function updateUsereByIdInfo($userid, $data){
    $name = $data['name'];
    $lname = $data['lname'];
    $username = $data['username'];
    $password = $data['password'];
    $email = $data['email'];
    $matu = $data['matu'];
    $roleid = $data['roleid'];
    $isActive = $data['isActive'];
    if ($name == "" || $lname == "" || $username == "" || $password == "" || $email == "" || $matu == "" || $roleid == "" || $isActive == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> I campi di input non devono essere vuoti !</div>';
      return $msg;
      }elseif (strlen($username) < 3) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Username troppo corto, minimo 3 caratteri !</div>';
        return $msg;
      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Indirizzo email non valido !</div>';
      return $msg;
    }else{
      $sql = "UPDATE login SET
        name = :name,
        lname = :lname,
        username = :username,
        password = SHA1(:password),
        email = :email,
        matu = :matu,
        roleid = :roleid,
        isActive = :isActive
        WHERE id = :id";
        $stmt= $this->db->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':lname', $lname);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':matu', $matu);
        $stmt->bindValue(':roleid', $roleid);
        $stmt->bindValue(':isActive', $isActive);
        $stmt->bindValue(':id', $userid);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='activateControl.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Informationi utente aggiornate !</div>');
      }else{
        echo "<script>location.href='activateControl.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non inseriti correttamente !</div>');
      }
    }
  }
  public function updateDocByIdInfo($userid, $data){
    $name = $data['name'];
    $lname = $data['lname'];
    $sigla = $data['sigla'];
    $email = $data['email'];
    $lteams = $data['lteams'];
    $lmoodle = $data['lmoodle'];
    if ($name == "" || $lname == ""|| $sigla == "" || $email == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> I campi di input non devono essere vuoti !</div>';
      return $msg;
      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Indirizzo email non valido !</div>';
      return $msg;
    }else{
      $sql = "UPDATE docenti SET
        name = :name,
        lname = :lname,
        sigla = :sigla,
        email = :email,
        lteams = :lteams,
        lmoodle = :lmoodle
        WHERE id = :id";
        $stmt= $this->db->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':lname', $lname);
        $stmt->bindValue(':sigla', $sigla);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':lteams', $lteams);
        $stmt->bindValue(':lmoodle', $lmoodle);
        $stmt->bindValue(':id', $userid);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='docenti.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Informazioni docente aggiornate !</div>');
      }else{
        echo "<script>location.href='docenti.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non inseriti correttamente !</div>');
      }
    }
  }
  public function updateUsererByIdInfo($userid, $data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $roleid = $data['roleid'];
    if ($name == "" || $username == ""|| $email == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> I campi di input non devono essere vuoti !</div>';
      return $msg;
      }elseif (strlen($username) < 3) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Username troppo corto, minimo 3 caratteri !</div>';
        return $msg;
      }elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Indirizzo email non valido !</div>';
      return $msg;
    }else{
      $sql = "UPDATE admin SET
        name = :name,
        username = :username,
        email = :email,
        roleid = :roleid
        WHERE id = :id";
        $stmt= $this->db->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':roleid', $roleid);
        $stmt->bindValue(':id', $userid);
      $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Wow, Informazioni utente aggiornate !</div>');
      }else{
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non inseriti correttamente !</div>');
      }
    }
  }
  public function deleteUserById($remove){
    $sql = "DELETE FROM admin WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteActById($remove){
    $sql = "DELETE FROM login WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteModById($remove){
    $sql = "DELETE FROM moderatori WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteLoginById($remove){
      $sql = "DELETE FROM login WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $remove);
      $result = $stmt->execute();
      if ($result) {
        $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Utente rimosso correttamente !</div>';
        return $msg;
      }else{
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> Dati non rimossi correttamente !</div>';
        return $msg;
      }
  }
  public function deleteTodo($remove){
    $sql = "DELETE FROM plus WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='todoList.php';</script>";
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Promemoria rimosso !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteEventsAdById($remove){
    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Evento rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deletePrivateTipsById($remove_tips){
    $sql = "DELETE FROM tips WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove_tips);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Tipo rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteRemoveEventById($remove){
    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Tipo rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteTipsById($remove){
    $sql = "DELETE FROM tips WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Tipo rimosso correttamente !</div>';
        echo "<script>location.href='./redirect/agenda.php';</script>";
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteEventsById($remove){
    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Tipo rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteEventsPrivById($remove){
    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Tipo rimosso correttamente !</div>';
        echo "<script>location.href='privateEvents.php';</script>";
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteTipsPrivById($remove){
    $sql = "DELETE FROM tips WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result = $stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Tipo rimosso correttamente !</div>';
        
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteUserModeratoriById($remove){
    $sql = "DELETE FROM moderatori WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result =$stmt->execute();
    if ($result2) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function deleteUserAdminById($remove){
    $sql = "DELETE FROM login WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
      $result =$stmt->execute();
      if ($result){
        $sql1 = "DELETE FROM register WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql1);
        $stmt->bindValue(':id', $remove);
        $result1 = $stmt->execute();
        if($result1){
          $sql2 = "DELETE FROM search WHERE id = :id";
          $stmt = $this->db->pdo->prepare($sql2);
          $stmt->bindValue(':id', $remove);
          $result2 = $stmt->execute();
          if ($result2) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success !</strong> Utente rimosso correttamente !</div>';
            return $msg;
          }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error !</strong> Dati non rimossi correttamente !</div>';
            return $msg;
          }
        }
      }
  }
  public function deleteUserAdminLoginById($remove){
    $sql = "DELETE FROM login WHERE id = :id ";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $remove);
    $result =$stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente rimosso correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non rimossi correttamente !</div>';
      return $msg;
    }
  }
  public function ModDeactiveByAdmin($deactive){
    $sql = "UPDATE moderatori SET
    isActive=:isActive
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='admin_moderatori_list.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Utente disattivato correttamente !</div>');
    }else{
      echo "<script>location.href='admin_moderatori_list.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function LoginDeactiveByAdmin($deactive){
    $sql = "UPDATE login SET
    isActive=:isActive
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='admin_login_list.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Utente disattivato correttamente !</div>');
    }else{
      echo "<script>location.href='admin_login_list.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function userDeactiveModeratoriByAdmin($deactive){
    $sql = "UPDATE moderatori SET
    isActive=:isActive
    WHERE id = :id";
    
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 1);
    $stmt->bindValue(':id', $deactive);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='login.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Utente disattivato correttamente !</div>');
    }else{
      echo "<script>location.href='login.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function userDeactiveAdminByAdmin($deactive){
    $sql = "UPDATE login SET
     isActive=:isActive
     WHERE id = :id";
     $stmt = $this->db->pdo->prepare($sql);
     $stmt->bindValue(':isActive', 1);
     $stmt->bindValue(':id', $deactive);
     $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='login.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente disattivato correttamente !</div>');
      }else{
        echo "<script>location.href='login.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function userDeactiveAdminLoginByAdmin($deactive){
    $sql = "UPDATE login SET
     isActive=:isActive
     WHERE id = :id";
     $stmt = $this->db->pdo->prepare($sql);
     $stmt->bindValue(':isActive', 1);
     $stmt->bindValue(':id', $deactive);
     $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='login.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente disattivato correttamente !</div>');
      }else{
        echo "<script>location.href='login.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function usereDeactiveByAdmin($deactive){
    $sql = "UPDATE admin SET
     isActive=:isActive
     WHERE id = :id";
     $stmt = $this->db->pdo->prepare($sql);
     $stmt->bindValue(':isActive', 1);
     $stmt->bindValue(':id', $deactive);
     $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='admin.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente disattivato correttamente !</div>');
      }else{
        echo "<script>location.href='admin.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function userClearByAdmin(){
    $sql = "DELETE * FROM login";
    $stmt = $this->db->pdo->prepare($sql);
    $result = $stmt->result->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> DB svuotato correttamente !</div>';
      return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Operazione non completata !</div>';
      return $msg;
    }
  }
  public function userActivation($active){
    $sql = "UPDATE login SET qta = 0,isActive = 0 WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':id', $active);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='activateControl.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Utente attivato correttamente !</div>');
    }else{
      echo "<script>location.href='activateControl.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function userActiveByAdmin($active){
    $sql = "UPDATE admin SET
    isActive=:isActive
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='admin_admin_list.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Utente attivato correttamente !</div>');
    }else{
      echo "<script>location.href='admin_admin_list.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function ModActiveByAdmin($active){
    $sql = "UPDATE moderatori SET
    isActive=:isActive
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':isActive', 0);
    $stmt->bindValue(':id', $active);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='admin_moderatori_list.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Utente attivato correttamente !</div>');
    }else{
      echo "<script>location.href='admin_moderatori_list.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function LoginActiveByAdmin($active){
      $sql = "UPDATE login SET
      isActive=:isActive
      WHERE id = :id";

      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':isActive', 0);
      $stmt->bindValue(':id', $active);
      $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='admin_login_list.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente attivato correttamente !</div>');
      }else{
        echo "<script>location.href='admin_login_list.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function CheckEVR($check){
      $sql = "UPDATE plus SET
      checking = :checking
      WHERE id = :id";

      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':checking', 1);
      $stmt->bindValue(':id', $check);
      $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='todoList.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Obbiettivo raggiunto !</div>');
      }else{
        echo "<script>location.href='todoList.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function CheckVMR($check){
    $sql = "UPDATE events SET
    checking = :checking
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':checking', 1);
    $stmt->bindValue(':id', $check);
    $result =   $stmt->execute();
    if ($result) {
      echo "<script>location.href='privateEvents.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Obbiettivo raggiunto !</div>');
    }else{
      echo "<script>location.href='privateEvents.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function SyncEVR($sync){
    $sql = "UPDATE plus SET
    checking = :checking
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':checking', 0);
    $stmt->bindValue(':id', $sync);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='todoList.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Obbiettivo raggiunto !</div>');
    }else{
      echo "<script>location.href='todoList.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function SyncVMR($sync){
    $sql = "UPDATE events SET
    checking = :checking
    WHERE id = :id";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':checking', 0);
    $stmt->bindValue(':id', $sync);
    $result = $stmt->execute();
    if ($result) {
      echo "<script>location.href='privateEvents.php';</script>";
      Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Success !</strong> Obbiettivo ristabilito !</div>');
    }else{
      echo "<script>location.href='privateEvents.php';</script>";
      Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Error !</strong> Dati non attivati !</div>');
    }
  }
  public function Check_ev($active,$tag,$idate,$hschool,$ename,$descr,$prio,$vis,$matu,$userid,$checking,$id_writter){
    $checkExist = $this->checkPlus($active,$userid);
    if($checkExist == TRUE){
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Evento già salvato !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO plus(id_events,tag,idate,hschool,ename,descr,prio,vis,matu,id_plus,checking,id_writter)VALUES(:id_events,:tag,:idate,:hschool,:ename,:descr,:prio,:vis,:matu,:id_plus,:checking,:id_writter)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id_events', $active);
      $stmt->bindValue(':tag', $tag);
      $stmt->bindValue(':idate', $idate);
      $stmt->bindValue(':hschool', $hschool);
      $stmt->bindValue(':ename', $ename);
      $stmt->bindValue(':descr', $descr);
      $stmt->bindValue(':prio', $prio);
      $stmt->bindValue(':vis', $vis);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':id_plus', $userid);
      $stmt->bindValue(':checking', $checking);
      $stmt->bindValue(':id_writter', $id_writter);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='./redirect/compito.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente attivato correttamente !</div>');
      }else{
        echo "<script>location.href='./redirect/compito.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
    }
  }
  public function Check_evt($active,$tag,$idate,$hour,$ename,$descr,$prio,$vis,$matu,$userid,$checking,$id_writter){
    $checkExist = $this->checkPlus($active,$userid);
    if($checkExist == TRUE){
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Errore !</strong> Evento già salvato !</div>';
      return $msg;
    }else{
      $sql = "INSERT INTO plus(events_code,tag,idate,hour,ename,descr,prio,vis,matu,user_code,checking,id_writter)
              VALUES(:events_code,:tag,:idate,:hour,:ename,:descr,:prio,:vis,:matu,:user_code,:checking,:id_writter)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':events_code', $active);
      $stmt->bindValue(':tag', $tag);
      $stmt->bindValue(':idate', $idate);
      $stmt->bindValue(':hour', $hour);
      $stmt->bindValue(':ename', $ename);
      $stmt->bindValue(':descr', $descr);
      $stmt->bindValue(':prio', $prio);
      $stmt->bindValue(':vis', $vis);
      $stmt->bindValue(':matu', $matu);
      $stmt->bindValue(':user_code', $user_code);
      $stmt->bindValue(':checking', $checking);
      $stmt->bindValue(':id_writter', $id_writter);
      $result = $stmt->execute();
      if ($result) {
        echo "<script>location.href='./redirect/test.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente attivato correttamente !</div>');
      }else{
        echo "<script>location.href='./redirect/test.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
    }
  }
  public function userActiveModeratoriByAdmin($active){
    $sql = "UPDATE moderatori SET
     isActive=:isActive
     WHERE id = :id";
     $stmt = $this->db->pdo->prepare($sql);
     $stmt->bindValue(':isActive', 0);
     $stmt->bindValue(':id', $active);
     $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='login.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente attivato correttamente !</div>');
      }else{
        echo "<script>location.href='login.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function usereActiveByAdmin($active){
    $sql = "UPDATE admin SET
     isActive=:isActive
     WHERE id = :id";
     $stmt = $this->db->pdo->prepare($sql);
     $stmt->bindValue(':isActive', 0);
     $stmt->bindValue(':id', $active);
     $result =   $stmt->execute();
      if ($result) {
        echo "<script>location.href='admin.php';</script>";
        Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
        <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success !</strong> Utente attivato correttamente !</div>');
      }else{
        echo "<script>location.href='index.php';</script>";
        Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Dati non attivati !</div>');
      }
  }
  public function CheckOldPassword($user_code, $old_pass){
    $old_pass = hash("SHA512", $old_pass);
    $sql = "SELECT password FROM login WHERE password = :password AND user_code =:user_code";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':password', $old_pass);
    $stmt->bindValue(':user_code', $user_code);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      return true;
    }else{
      return false;
    }
  }
  public  function changePasswordBysingelUserId($user_code, $data){
    $old_pass = $data['old_password'];
    $new_pass = $data['new_password'];
    if ($old_pass == "" || $new_pass == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> Il campo password non deve essere vuoto !</div>';
      return $msg;
    }elseif (strlen($new_pass) < 6) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error !</strong> La nuova password deve contenere almeno 6 caratteri !</div>';
      return $msg;
    }
    $oldPass = $this->CheckOldPassword($user_code, $old_pass);
      if ($oldPass == FALSE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error !</strong> La vecchia password non corrisponde !</div>';
        return $msg;
      }else{
         $new_pass = hash("SHA512", $new_pass);
         $sql = "UPDATE login SET
        password=:password
        WHERE user_code = :user_code";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':password', $new_pass);
        $stmt->bindValue(':user_code', $user_code);
        $result = $stmt->execute();
        if ($result) {
          echo "<script>location.href='index.php';</script>";
          Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Success !</strong> Password aggiornata con successo !</div>');
        }else{
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error !</strong> Oops, qualcosa è andato storto !</div>';
          return $msg;
        }
      }  
  }
}
?>