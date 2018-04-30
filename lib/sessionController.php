<?php
class cuySession{
  public static function setSes($nama, $value){
    $_SESSION[sha1($nama)] = $value;
  }
  public static function unsetSes($nama){
    unset($_SESSION[sha1($nama)]);
  }
  public static function cekSes($nama){
    if (isset($_SESSION[sha1($nama)])) {
      return true;
    }else{
      return false;
    }
  }
  public static function getSes($nama){
    if (isset($_SESSION[sha1($nama)])) {
      return $_SESSION[sha1($nama)];
    }else{
      return false;
    }
  }
  public static function flash($nama, $value, $waktu = 1){
    $ses = array($value, time() + $waktu );
    self::setSes($nama, $ses);
  }
  public static function getFlash($nama){
    if ($ses = self::getSes($nama)) {
      if (is_array($ses)) {
        if (time() > $ses[1]) {
          self::unsetSes($nama);
          return false;
        }else{
          return $ses[0];
        }
      }else{
        return false;
      }
    }
  }
}