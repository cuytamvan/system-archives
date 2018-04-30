<?php
  define('g_folder', DIRECTORY_SEPARATOR);
  require __DIR__.g_folder.'lib'.g_folder.'init.php';
  $run = new controller;
  if (!isset($_SESSION[userLogin])) {
    header('location: '. url('login'));
  }
  $user = $run->getUser('user','username',userLogin);
  if ($user->jk == 'l') {
    $photo = asset('asset/img/user1.png');
  }else{
    $photo = asset('asset/img/user2.png');
  }
  if (isset($_GET['logout'])) {
    cuySession::flash('login','Berhasil logout');
    $run->logout(userLogin, url('login'));
  }
  $menu = hget('menu');
  if ($user->password == 'abc123') {
    if ($menu != 'gantip') {
      header('location: '.url('dashboard?menu=gantip'));
    }
  }
  $bg = '';
  switch ($menu) {
    case 'beranda':
      $inc = 'inc/beranda.php';
      $bg = 'grey lighten-5';
    break;
    case 'user' :
      $inc = 'inc/user.php';
    break;
    case 'gantip' :
      $inc = 'inc/ganti_password.php';
    break;
    case 'surat' :
      $inc = 'inc/surat.php';
    break;
    case 'lihat_surat' :
      $inc = 'inc/lihat_surat.php';
      $bg = 'grey lighten-5';
    break;
    case 'disposisi' :
      $inc = 'inc/disposisi.php';
      $bg = 'grey lighten-5';
    break;
    case 'laporan' :
      $inc = 'inc/laporan.php';
      $bg = 'grey lighten-5';
    break;
    default:
      $inc = 'inc/beranda.php';
      $bg = 'grey lighten-5';
    break;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pt. Kepoin | Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/materialize.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/icon/icon.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/plugin/dataTable/css/jquery.dataTables.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/animate.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/css/style.css')?>">
  <link rel="icon" type="image/png" href="<?=asset('asset/logo.png')?>">
  <?php if ($menu == 'lihat_surat' && isset($_GET['detail'])) { ?>
  <link rel="stylesheet" type="text/css" href="<?=asset('asset/plugin/ckeditor/samples/css/samples.css')?>">
  <?php } ?>
</head>
<body class="<?=$bg?>">

  <ul class="side-nav dashboard fixed" id="menu">
    <li>
      <div class="userView f-g-b">
        <img src="<?=asset('asset/img/tumb_back-1.jpg')?>" class="background">
        <img src="<?=$photo?>" class="circle white">
        <span class="name white-text"><?=$user->level?></span>
        <span class="email white-text"><?=$user->fullname?></span>
        <a href="javascript:void(0)" class="dropdown-button menu white-text" data-activates="pilihan"><i class="material-icons">arrow_drop_down</i></a>
        <ul class="dropdown-content" id="pilihan">
          <li><a href="?logout">Logout</a></li>
        </ul>
      </div>
    </li>
    <li><a href="?menu=beranda" class="waves-effect"><i class="material-icons">dashboard</i>Beranda</a></li>
    <?php if ($user->level == 'admin') { ?>
    <li><a href="?menu=user" class="waves-effect"><i class="material-icons">people</i>User</a></li>
    <?php }else if($user->level == 'seketaris'){ ?>
    <li><a href="?menu=surat" class="waves-effect"><i class="material-icons">local_post_office</i>surat</a></li>
    <?php }else if($user->level == 'manager'){ ?>
    <li><a href="?menu=lihat_surat" class="waves-effect"><i class="material-icons">local_post_office</i>surat</a></li>
    <li><a href="?menu=laporan" class="waves-effect"><i class="material-icons">view_list</i>Laporan</a></li>
    <?php }else if($user->level == 'pegawai'){ ?>
    <li><a href="?menu=disposisi" class="waves-effect"><i class="material-icons">view_list</i>Disposisi <span id="disposisi"></span></a></li>
    <?php } ?>
  </ul>
  <main>
    <nav class="blue accent-2">
      <a href="#!" class="button-collapse" data-activates="menu"><i class="material-icons">menu</i></a>
      <a href="#!" class="brand-logo f-g-l">Pt. Kepoin</a>
    </nav>
    <?php include $inc; ?>
  </main>

  <script src="<?=asset('asset/js/jquery.min.js')?>"></script>
  <script src="<?=asset('asset/js/materialize.min.js')?>"></script>
  <script src="<?=asset('asset/plugin/dataTable/js/jquery.dataTables.min.js')?>"></script>
  <!-- <script src="<?=asset('asset/plugin/dataTable/dataTables.material.min.js')?>"></script> -->
  <script src="<?=asset('asset/js/dashboard.js')?>"></script>

  <?php if ($cekLogin = cuySession::getFlash('login')) { ?>
    <script>Materialize.toast('<?=$cekLogin?>', 4000, 'z-depth-0')</script>
  <?php } ?>

  <?php if ($alert = cuySession::getFlash('alert')) { ?>
    <script>Materialize.toast('<?=$alert?>', 4000, 'z-depth-0')</script>
  <?php } ?>


  <?php if ($user->level == 'pegawai') { ?>
  <script>
    $(document).ready(function() {
      $('#disposisi').load('<?=asset('ajax/cek_notif.php')?>');
    });
    setInterval(function(){
      $('#disposisi').load('<?=asset('ajax/cek_notif.php')?>');
    }, 5000)
  </script>
  <?php } ?>

  <?php if ($menu == 'lihat_surat' && isset($_GET['detail'])) { ?>
  <script src="<?=asset('asset/plugin/ckeditor/ckeditor.js')?>"></script>
  <script src="<?=asset('asset/plugin/ckeditor/samples/js/sample.js')?>"></script>
  <script> initSample(); </script>
  <?php } ?>
</body>
</html>
