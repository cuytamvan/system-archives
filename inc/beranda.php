<div class="row center-align" style="margin-top: 30px;">
<div class="col s12 m11 offset-m1">
  <h4 class="left-align f-g-b blue-text">Selamat Datang <span class="deep-orange-text text-lighten-2"><?=$user->fullname?></span></h4>
</div>
<?php
  if ($user->level == 'pegawai') {
    $sudahDibaca = $run->hitungRow("SELECT * FROM detail_disposition where reply_at='$user->username' and status = 1");
    $blomDibaca = $run->hitungRow("SELECT * FROM detail_disposition where reply_at='$user->username' and status = 0");
?>
<div class="col s12 m6 l3 offset-l1">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">reply_all</i>
    <p>Anda memiliki : <?=$sudahDibaca?> disposisi yang sudah di baca</p>
  </div>
</div>
<div class="col s12 m6 l3">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">view_list</i>
    <p>Anda memiliki : <?=$blomDibaca?> disposisi yang belum di baca</p>
  </div>
</div>
<?php
  }elseif($user->level == 'manager' || $user->level == 'seketaris'){
    $masuk = $run->hitungRow("SELECT * FROM mail where jenis='masuk' and status=1");
    $keluar = $run->hitungRow("SELECT * FROM mail where jenis='keluar' and status=1");
?>
<div class="col s12 m6 l3 offset-l1">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">local_post_office</i>
    <p>Anda memiliki : <?=$masuk?> surat masuk</p>
  </div>
</div>
<div class="col s12 m6 l3">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">drafts</i>
    <p>Anda memiliki : <?=$keluar?> surat keluar</p>
  </div>
</div>
<?php
  }elseif($user->level == 'admin'){
    $semuaUser = $run->hitungRow("SELECT * FROM user");
    $admin = $run->hitungRow("SELECT * FROM user where level='admin'");
    $pegawai = $run->hitungRow("SELECT * FROM user where level='pegawai'");
    $manager = $run->hitungRow("SELECT * FROM user where level='manager'");
    $seketaris = $run->hitungRow("SELECT * FROM user where level='seketaris'");
?>
<div class="col s12 m6 l3">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">people</i>
    <p>Semua User : <?=$semuaUser?></p>
  </div>
</div>
<div class="col s12 m6 l3">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">person</i>
    <p>Admin : <?=$admin?></p>
  </div>
</div>
<div class="col s12 m6 l3">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">person</i>
    <p>Pegawai : <?=$pegawai?></p>
  </div>
</div>
<div class="col s12 m6 l3">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">person</i>
    <p>Manager : <?=$manager?></p>
  </div>
</div>
<div class="col s12 m12 l4 offset-l4">
  <div class="card" style="padding: 10px;">
    <i class="material-icons grey-text text-darken-3 center-align" style="font-size: 60px; width: 100%;">person</i>
    <p>Seketaris : <?=$seketaris?></p>
  </div>
</div>
<?php } ?>
</div>