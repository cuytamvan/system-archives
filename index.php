<?php
  define('g_folder', DIRECTORY_SEPARATOR);
  require __DIR__.g_folder.'lib'.g_folder.'init.php';
  $run = new controller;
  if (isset($_POST['login'])) {
    $username = antiI(hpost('username'));
    $password = antiI(hpost('password'));
    $field = array(
      'username' => $username,
      'password' => $password,
    );
    if ($run->login('user',$field, $username, userLogin)) {
      cuySession::flash('login','Berhasil login');
      header('location: '.url('dashboard'));
    }else{
      cuySession::flash('login','Username atau password salah');
      header('location: '.url('login'));
    }
  }
  if (isset($_SESSION[userLogin])) {
    header('location: '. url('dashboard'));
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kepoin | Login</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/materialize.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/icon/icon.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/style.css')?>">
  <link rel="icon" type="image/png" href="<?=asset('asset/logo.png')?>">
</head>
<body>
  <div class="pake-background"></div>
  <div class="row">
    <div class="col s12 m6 offset-m3 l4 offset-l4">
      <form method="post">
        <div class="card login f-g-b">
          <h4 class="judul">Login <span class="blue-text text-lighten-1">PT.Kepoin</span></h4>
          <div class="input-field" style="margin-top: 30px;">
            <input type="text" id="username" name="username" autocomplete="off" autofocus>
            <label for="username">Username</label>
          </div>
          <div class="input-field">
            <input type="password" id="password" name="password">
            <label for="password">Password</label>
          </div>
          <div>
            <button class="btn blue lighten-1" name="login">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="<?=asset('asset/js/jquery.min.js')?>"></script>
  <script src="<?=asset('asset/js/materialize.min.js')?>"></script>
  <?php if ($cekLogin = cuySession::getFlash('login')) { ?>
    <script>Materialize.toast('<?=$cekLogin?>', 4000, 'z-depth-0')</script>
  <?php } ?>
</body>
</html>
