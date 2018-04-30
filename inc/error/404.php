<?php
  if (isset($redirect)) {
    $kembali = $redirect;
  }else{
    $kembali = asset('dashboard');
  }
?>
<div class="row" style="margin-top: 30px;">
  <div class="col s12 m8 offset-m2 l6 offset-l3">
    <div class="card" style="padding: 10px; border: thin solid #ddd;">
      <h4 class="f-g-b">Halaman Tidak di Temukan</h4>
      <p>Alamat yang anda cari tidak ada, kembali ke halaman beranda <a href="<?=$kembali?>">Kembali</a></p>
    </div>
  </div>
</div>