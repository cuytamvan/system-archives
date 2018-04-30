<?php
  $table = 'mail';
  $where = 'id';
  $redirect = '?menu=lihat_surat';
  if (!isset($_GET['detail'])) {
?>
<div class="row" style="margin-top: 10px;">
  <div class="col s12 m11">
    <div class="card" style="padding: 10px 20px;">
      <h4 class="f-g-m blue-text tt-c">Lihat <span class="deep-orange-text text-lighten-1">Surat</span></h4>
      <table class="pake-data-table table-ajib">
        <thead>
          <tr>
            <th>No</th>
            <th>Waktu</th>
            <th>Jenis</th>
            <th>Kode&nbsp;Surat</th>
            <th>Tanggal&nbsp;Surat</th>
            <th>Dari</th>
            <th>Ke</th>
            <th>Subject</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $a = $run->tampil($table." where status=1 order by time desc");
            if (!empty($a)) {
              $no = 1;
              foreach ($a as $r) {
                if ($r->jenis == 'masuk') {
                  $bg = '';
                }else{
                  $bg = 'grey lighten-4';
                }
          ?>
          <tr class="<?=$bg?>">
            <td><?=$no?></td>
            <td><?=date('M d, Y', strtotime($r->time))?></td>
            <td><?=$r->jenis?></td>
            <td><?=$r->mail_code?></td>
            <td><?=date('M d, Y', strtotime($r->mail_date))?></td>
            <td><?=$r->mail_from?></td>
            <td><?=$r->mail_to?></td>
            <td><?=$r->mail_subject?></td>
            <td>
              <a href="<?=$redirect?>&detail&id=<?=$r->id?>" class="btn z-depth-0 blue lighten-1">Detail</a>
            </td>
          </tr>
          <?php
                $no++;
              }
            }else{
              echo '<tr> <td colspan="8" class="center-align">Tidak ada data</td> </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
  }else{
    $id = antiI(hget('id'));
    $cokot = $run->ambil('qw_'.$table,$where, $id);
    if (!empty($cokot)) {
      if ($cokot->jenis == 'masuk') {
        $style = 'border-bottom: thin solid #ddd;';
      }else{
        $style = '';
      }
?>
<div class="row" style="margin-top: 10px; <?=$style?>">
  <div class="col s12 m6 l6">
    <style>
      .card{
        padding: 10px;
        border: thin solid #ddd;
        float: left;
        width: 100%;
      }
      .table-cuy{
        width: auto;
      }
      .table-cuy td{
        padding: 2px 5px;
        vertical-align: top;
      }
    </style>
    <div class="card f-g-l">
      <h4 class="f-g-m blue-text tt-c">Detail <span class="deep-orange-text text-lighten-1">Surat</span></h4>
      <table class="table-cuy">
        <tr>
          <td>Waktu</td>
          <td>:</td>
          <td><?=waktu1($cokot->time)?></td>
        </tr>
        <tr>
          <td>Kode Surat</td>
          <td>:</td>
          <td><?=$cokot->mail_code?></td>
        </tr>
        <tr>
          <td>Tanggal Surat</td>
          <td>:</td>
          <td><?=$cokot->mail_date?></td>
        </tr>
        <tr>
          <td>Dari</td>
          <td>:</td>
          <td><?=$cokot->mail_from?></td>
        </tr>
        <tr>
          <td>Ke</td>
          <td>:</td>
          <td><?=$cokot->mail_to?></td>
        </tr>
        <tr>
          <td>Subject</td>
          <td>:</td>
          <td><?=$cokot->mail_subject?></td>
        </tr>
        <tr>
          <td>Tipe</td>
          <td>:</td>
          <td><?=$cokot->type?></td>
        </tr>
        <tr>
          <td>Jenis</td>
          <td>:</td>
          <td class="tt-c"><?=$cokot->jenis?></td>
        </tr>
        <tr>
          <td>Penginput</td>
          <td>:</td>
          <td><?=$cokot->fullname?> (<?=$cokot->username?>)</td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td>"<?=$cokot->description?>"</td>
        </tr>
      </table>
      <a href="<?=$redirect?>" class="btn blue lighten-1" style="margin-top: 20px;">Kembali</a>
    </div>
  </div>
  <div class="col s12 m6 l6">
    <div class="card f-g-l">
      <h4 class="f-g-m blue-text">File</h4>
      <?php
        $b = $run->tampil("file_upload where id_mail='$id'");
        foreach ($b as $r) {
          if (in_array(getExt($r->nama_file), $gambar)) {
            if (getExt($r->nama_file) == 'jpg' ||
                getExt($r->nama_file) == 'jpeg') {
              $poto = asset('asset/img/file-jpg.png');
            }else if(getExt($r->nama_file) == 'png'){
              $poto = asset('asset/img/file-png.png');
            }else{
              $poto = asset('asset/img/file-svg.png');
            }
            $text = 'File Berupa Gambar';
          }else{
            if (getExt($r->nama_file) == 'pdf') {
              $poto = asset('asset/img/file-pdf.png');
            }else{
              $poto = asset('asset/img/file-doc.png');
            }
            $text = 'File Berupa Document';
          }
      ?>
      <div class="row f-g-b pake-border-bottom">
        <div class="col s2">
          <img src="<?=$poto?>" class="responsive-img">
        </div>
        <div class="col s10">
          <h6 class="f-g-m deep-orange-text text-accent-2"><?=$text?></h6>
          <p style="font-size: 13px; padding: 0px ;margin:0px;">Click icon untuk mendownload file <a href="<?=asset('asset/file/surat/'.$r->nama_file)?>" class="" download title="download"><i class="material-icons">file_download</i></a></p>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php if ($cokot->jenis == 'masuk') { ?>
<div class="row">
  <?php
    if (isset($_POST['kirim'])) {
      $pegawai = $_POST['reply_at'];
      if (count($pegawai) > 0) {
        $kode = 'dsp'.randCuy(7);
        $field = array(
          'id'           => $kode,
          'description'  => antiI(hpost('deskripsi')),
          'notification' => antiI(hpost('notif')),
          'id_mail'      => $id,
          'username'     => $user->username
        );
        if ($run->simpan('desposition', $field)) {
          foreach ($pegawai as $r) {
            $field_detail = array(
              'id_disposisi' => $kode,
              'reply_at'     => $r,
              'status'       => 0
            );
            $run->simpan('detail_disposition', $field_detail);
          }
          alert('Disposisi berhasil di kirim', 'dashboard'.$redirect);
        }else{
          alert('Disposisi gagal di kirim', 'dashboard'.$redirect);
        }
      }else{
        alert('Pilih Pegawai', 'dashboard'.$redirect.'&detail&id='.$id);
      }
    }
  ?>
  <form method="post">
    <div class="col s12 m6 l6">
      <div class="card f-g-l" style="padding: 20px 30px;">
        <h4 class="f-g-m blue-text tt-c">Disposi<span class="deep-orange-text text-lighten-1">sikan</span></h4>
        <label for="editor">Deskripsi</label>
        <div class="input-field">
          <textarea name="deskripsi" id="editor" class="materialize-textarea" style="min-height: 150px;"></textarea>
        </div>
        <div>
          <label>Notifikasi</label>
          <p>
            <input type="radio" value="p" name="notif" id="p" required>
            <label for="p">Penting</label>
          <br>
            <input type="radio" value="b" name="notif" id="b" required>
            <label for="b">Biasa</label>
          <br>
            <input type="radio" value="r" name="notif" id="r" required>
            <label for="r">Rahasia</label>
          </p>
        </div>
        <div style="margin-top: 10px; max-height: 500px; overflow: auto; border-top: thin solid #ddd; padding-top: 20px;">
          <label>Kirim ke</label>
          <div class="row no-padding-margin">
            <div class="col s12 m11" style="padding-top: 10px;">
              <input type="text" class="input-custom cari-data animated fadeIn" placeholder="Cari Pegawai...">
            </div>
          </div>
          <?php
            $pegawai = $run->tampil("user where level='pegawai'");
            foreach ($pegawai as $r) {
          ?>
          <p class="no-padding-margin cari-orang animated slideInLeft">
            <input type="checkbox" value="<?=$r->username?>" name="reply_at[]" id="<?=$r->username?>">
            <label for="<?=$r->username?>"><?=$r->fullname?> (<?=$r->username?>)</label>
          </p>
          <?php } ?>
        </div>
        <div style="margin-top: 10px;">
          <button type="submit" class="btn blue lighten-1" name="kirim">Kirim</button>
        </div>
      </div>
    </div>
  </form>
  <?php
    $cek = $run->hitungRow("SELECT * FROM desposition where id_mail='$id'");
    if ($cek > 0) {
  ?>
  <div class="col s12 m6 l6">
    <div class="card z-depth-0">
      <h5 class="f-g-m blue-text tt-c">Pernah didis<span class="deep-orange-text text-lighten-1">posisikan ke :</span></h5>
      <?php
        if (isset($_GET['hapus_dis'])) {
          $id_disposisi = antiI(hget('hapus_dis'));
          if ($run->hapus('desposition', 'id',$id_disposisi)) {
            alert('Disposisi berhasil di hapus', 'dashboard'.$redirect.'&detail&id='.$id);
          }else{
            alert('Disposisi gagal di hapus', 'dashboard'.$redirect.'&detail&id='.$id);
          }
        }
        $despasito = $run->tampil("desposition where id_mail='$id'");
        foreach ($despasito as $r) { 
      ?>
      <div class="row pake-border-bottom">
        <div class="col s12 card" style="padding: 10px;">
          <a href="<?=$redirect?>&detail&id=<?=$id?>&hapus_dis=<?=$r->id?>"><i class="material-icons pojok-kanan">close</i></a>
          <table class="table-cuy">
            <tr>
              <td>Waktu</td>
              <td>:</td>
              <td><?=date('M d, Y', strtotime($r->time))?></td>
            </tr>
            <tr>
              <td>Deskripsi</td>
              <td>:</td>
              <style>
                p{
                  padding: 0;
                  margin: 0;
                }
              </style>
              <td><?=htmlspecialchars_decode($r->description)?></td>
            </tr>
            <tr>
              <td>Notif</td>
              <td>:</td>
              <td>
                <?php if ($r->notification == 'p') { ?>
                <span class="notif blue lighten-2 white-text">Penting</span>
                <?php }elseif($r->notification == 'b'){ ?>
                <span class="notif deep-orange lighten-2 white-text">Biasa</span>
                <?php }elseif($r->notification == 'r'){ ?>
                <span class="notif red lighten-1 white-text">rahasia</span>
                <?php } ?>
              </td>
            </tr>
          </table>
          <ol>
            <?php
              if (isset($_GET['hapus_penerima'])) {
                $reply_at = antiI(hget('hapus_penerima'));
                $dis      = antiI(hget('dis'));
                $jalan    = $run->query("DELETE FROM detail_disposition where reply_at='$reply_at' and id_disposisi='$dis'");
                if ($jalan) {
                  alert('Penerima berhasil di hapus', 'dashboard'.$redirect.'&detail&id='.$id);
                }
                
              }
              $getDetail = $run->tampil("qw_detail_disposisi where id_disposisi='$r->id'");
              foreach ($getDetail as $r1) {
                if ($r1->status == 0) {
                  $stat = 'Belum Di baca';
                }else{
                  $stat = '<span class="blue-text text-darken-2">Sudah Di baca</span>';
                }
            ?>
            <li style="font-size: 13px;"><?=$r1->fullname?> / <?=$r1->reply_at?> (<?=$stat?>)
              <?php
                $cekOrang = $run->hitungRow("SELECT * FROM qw_detail_disposisi where id_disposisi='$r->id'");
                if ($cekOrang != 1) {
              ?>
                <a href="<?=$redirect?>&detail&id=<?=$id?>&hapus_penerima=<?=$r1->reply_at?>&dis=<?=$r->id?>" onclick="return confirm('Apakah anda yakin menghapus penerima?')" title="Hapus penerima"><i class="material-icons" style="font-size: 12px!important; transform: translateY(-2px);">close</i></a>
              <?php } ?>
            </li>
            <?php } ?>
          </ol>
        </div>
      </div>
      <?php
        }
      ?>
    </div>
  </div>
</div>
<?php
        }
      }
    }else{
      showError();
    }
  }
?>