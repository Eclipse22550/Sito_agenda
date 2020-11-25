<?php
class Session{
  public static function init(){
    if (version_compare(phpversion(), '7.2.33', '<')) {
      if (session_id() == '') {
        session_start();
        //Session::CreateCookie();
      }
    }else{
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
    }
  }
  public static function set($key, $val){
    $_SESSION[$key] = $val;
  }
  public static function get($key){
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }else{
      return false;
    }
  }
  public static function destroy(){
    session_destroy();
    session_unset();
    header('Location:login.php');
  }
  public static function destroyA(){
    session_destroy();
    session_unset();
    header('Location:login.php');
  }
  public static function CheckSession(){
    if (self::get('login') == FALSE) {
      session_destroy();
      header('Location:login.php');
    }
  }
  public static function CheckAdmin(){
    if (self::get('login') == FALSE){
      header('Location:loginAdmin.php');
    }
  }
  public static function IDNOT(){
    session_destroy();
    session_unset();
    header('Location:./error/notId.php');
  }
  public static function Check4Role(){
    if(self::get('4login') == FALSE){
      session_destroy();
      header('Location:login4Role.php');
    }
  }
  public static function CheckCookie(){
    if(self::get('login') == TRUE){
      session_destroy();
      session_unset();
      header('Location:login.php');
    }
  }
  public static function CheckREG(){
    if(self::get('login') == TRUE){
      header('Location:./error/404.html');
    }
  }
  public static function Check4InRole(){
    if(self::get('4login') == TRUE){
      session_destroy();
      header('Location: indexRole4.php');
    }
  }
  public static function CheckLogin(){
    if (self::get("login") == TRUE) {
      header('Location:index.php');
    }
  }
}