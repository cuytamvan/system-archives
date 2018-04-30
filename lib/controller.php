<?php

/**
* Muhammad rizki wahyudi
*/
class controller {
  private $hostname = 'localhost';
  private $username = 'cuytamvan';
  private $password = 'rizkiw@2901_';
  private $database = 'db_sk_ujikom';

  function __construct() {
    $this->koneksi();
  }
  function koneksi(){
    $cn = mysqli_connect($this->hostname,$this->username,$this->password,$this->database) or die('<span style="font-family: sans-serif">Koneksi Bermasalah</span>');
    return $cn;
  }
  function query($sql){
    $cn = $this->koneksi();
    $jalan = mysqli_query($cn, $sql);
    return $jalan;
  }
  function hitungRow($sql){
    $jalan = $this->query($sql);
    return mysqli_num_rows($jalan);
  }
  function login($table, array $field, $primary, $ses){
    $sql = "SELECT * FROM ".$table." where ";
    foreach ($field as $key => $value) {
      $sql .= $key."='".$value."' and ";
    }
    $sql = rtrim($sql, 'and ');
    $cek = $this->hitungRow($sql);
    if ($cek > 0) {
      $_SESSION[$ses] = $primary;
      return true;
    }else{
      return false;
    }
  }
  function getUser($table, $where, $ses){
    $sql = $this->query("SELECT * FROM ".$table." where ".$where."='".$_SESSION[$ses]."'");
    return mysqli_fetch_object($sql);
  }
  function logout($ses, $redirect){
    unset($_SESSION[$ses]);
    header('location: '.$redirect);
  }
  function simpan($table, $field){
    $sql = "INSERT INTO ".$table." SET ";
    foreach ($field as $key => $value) {
      $sql .= $key."='$value', ";
    }
    $sql = rtrim($sql, ', ');
    $jalan = $this->query($sql);
    if (!$jalan) {
      echo mysqli_error($this->koneksi());
    }else{

    return $jalan;
    }
  }
  function ambil($table, $where, $id){
    $sql = $this->query("SELECT * FROM ".$table." where ".$where."='".$id."'");
    return mysqli_fetch_object($sql);
  }
  function ambil1($table){
    $sql = $this->query("SELECT * FROM ".$table);
    return mysqli_fetch_object($sql);
  }
  function hapus($table, $where, $id){
    $sql = $this->query("DELETE FROM ".$table." where ".$where."='".$id."'");
    return $sql;
  }
  function update($table, $field, $where, $id){
    $sql = "UPDATE ".$table." SET ";
    foreach ($field as $key => $value) {
      $sql .= $key."='$value', ";
    }
    $sql = rtrim($sql, ', ');
    $sql .= " WHERE ".$where."='".$id."'";
    $jalan = $this->query($sql);
    return $jalan;
  }
  function tampil($table){
    $sql = $this->query("SELECT * FROM ".$table);
    $tingali = array();
    while ($r = mysqli_fetch_object($sql)) {
      $tingali[] = $r;
    }
    return $tingali;
  }
  function tampilSQL($sql){
    $sql = $this->query($sql);
    $tingali = array();
    while ($r = mysqli_fetch_object($sql)) {
      $tingali[] = $r;
    }
    return $tingali;
  }
  function tampilPCari($table, array $field, $tcari, $sesudah = ''){
    $sql = "SELECT * FROM ".$table." where ";
    foreach ($field as $r) {
      $sql .= $r." like '%".$tcari."%' or ";
    }
    $sql = rtrim($sql, 'or ');
    $sql .= $sesudah;
    $jalan = $this->query($sql);
    while ($r = mysqli_fetch_object($jalan)) {
      $tingali[] = $r;
    }
    return $tingali;
  }
}
