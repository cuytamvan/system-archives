<?php
  define('g_folder', DIRECTORY_SEPARATOR);
  require __DIR__.g_folder.'..'.g_folder.'lib'.g_folder.'init.php';
  $run = new controller;
  if (!isset($_SESSION[userLogin])) {
    header('location: '. url('login'));
  }
  $user = $run->getUser('user','username',userLogin);
  $hitung = $run->hitungRow("SELECT * FROM detail_disposition where reply_at='".$user->username."' and status=0");
  if ($hitung > 0) {
    echo "<span class='badge new blue'>".$hitung."</span>";
  }
