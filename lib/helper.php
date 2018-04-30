<?php
function asset($url = ''){
  $base_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
  $base_url .= $url;
  return $base_url;
}
function url($ke = ''){
  $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
  $base_url .= $ke;
  return $base_url;
}
function antiI($text){
  return stripcslashes(strip_tags(htmlspecialchars($text, ENT_QUOTES)));
}
function hpost($post){
  if (isset($_POST[$post])) {
    return $_POST[$post];
  }else{
    return '';
  }
}
function hget($get){
  if (isset($_GET[$get])) {
    return $_GET[$get];
  }else{
    return '';
  }
}
function getExt($filename){
  $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  return $ext;
}
function gantiKata($a, array $b){
  foreach ($b as $key => $value) {
    $a = str_replace($key, $value, $a);
  }
  return $a;
}
function gantiKata1($a, array $b){
  foreach ($b as $key => $value) {
    $a = str_replace($value, $key, $a);
  }
  return $a;
}
function randCuy($leng = 10){
  $str  = '1234567890';
  $len  = strlen($str) - 1;
  $kode = '';
  for($i = 0; $i < $leng; $i++){
    $start = rand(0, $len);
    $kode .= substr($str, $start, 1);
  }
  return $kode;
}
function waktu1($text){
  return date('M d, Y', strtotime($text));
}
function tambah0($text, $len = 2){
  $fill = str_pad($text, $len, "0", STR_PAD_LEFT);
  return $fill;
}
function showError($err = '404'){
  include 'inc/error/'.$err.'.php';
}
function alert($value, $redirect){
  cuySession::flash('alert', $value);
  echo "<script>document.location.href='".asset($redirect)."'</script>";
}

// untuk keamanan
function getUrl(){
  $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  return $url;
}
function getIp(){
  return $_SERVER['REMOTE_ADDR'];
}
function computerName(){
  return gethostbyaddr(getIp());
}