<?php
  $table = 'desposition';
  $redirect = '?menu=disposisi';
  if (!isset($_GET['baca'])) {
?>
<div class="row" style="margin-top: 10px;">
  <div class="col s12 m11">
    <div class="card" style="padding: 10px 20px;">
      <h4 class="f-g-m blue-text tt-c">Lihat <span class="deep-orange-text text-lighten-1">Surat</span></h4>
      <table class="pake-data-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Waktu</th>
            <th>Notification</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $a = $run->tampil("qw_detail_disposisi where reply_at = '$user->username' order by id desc");
            if (!empty($a)) {
              $no = 1;
              foreach ($a as $r) {
                if ($r->status > 0) {
                  $background = '';
                }else{
                  $background = 'grey lighten-3';
                }
          ?>
          <tr class="<?=$background?>">
            <td><?=$no?></td>
            <td><?=date('M d, Y', strtotime($r->time))?></td>
            <td>
              <?php if ($r->notification == 'p') { ?>
              <span class="notif blue lighten-2 white-text">Penting</span>
              <?php }elseif($r->notification == 'b'){ ?>
              <span class="notif deep-orange lighten-2 white-text">Biasa</span>
              <?php }elseif($r->notification == 'r'){ ?>
              <span class="notif red lighten-1 white-text">rahasia</span>
              <?php } ?>
            </td>
            <td>
              <a href="<?=$redirect?>&baca&id=<?=$r->id_disposisi?>" class="btn z-depth-0 blue lighten-1">Baca</a>
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
    $cokot = $run->ambil('qw_disposisi','id',$id);
    if (!empty($cokot)) {
      $run->query("UPDATE detail_disposition set status = 1 where reply_at='$user->username' and id_disposisi='$id'");
      $surat = $run->ambil('qw_mail','id',$cokot->id_mail);
?>
<div class="row pake-border-bottom" style="margin-top: 10px;">
  <div class="col s12 m6 l6 offset-l1">
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
      .pake-border-bottom:not(:last-child){
        border-bottom: thin solid #ddd;
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
          <td>notification</td>
          <td>:</td>
          <td>
            <?php if ($cokot->notification == 'p') { ?>
            <span class="notif blue lighten-2 white-text">Penting</span>
            <?php }elseif($cokot->notification == 'b'){ ?>
            <span class="notif deep-orange lighten-2 white-text">Biasa</span>
            <?php }elseif($cokot->notification == 'r'){ ?>
            <span class="notif red lighten-1 white-text">rahasia</span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td>Pendisposisi</td>
          <td>:</td>
          <td><?=$cokot->fullname?> (<?=$cokot->username?>)</td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td><?=htmlspecialchars_decode($cokot->description)?></td>
        </tr>
      </table>
      <a href="<?=$redirect?>" class="btn blue lighten-1" style="margin-top: 20px;">Kembali</a>
    </div>
  </div>
</div>
<div class="row" style="margin-top: 10px;">
  <div class="col s12 m6 l6 offset-l1">
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
      .pake-border-bottom:not(:last-child){
        border-bottom: thin solid #ddd;
      }
    </style>
    <div class="card f-g-l" style="padding-bottom: 30px;">
      <h4 class="f-g-m blue-text tt-c">Detail <span class="deep-orange-text text-lighten-1">Surat</span></h4>
      <table class="table-cuy">
        <tr>
          <td>Waktu</td>
          <td>:</td>
          <td><?=waktu1($surat->time)?></td>
        </tr>
        <tr>
          <td>Kode Surat</td>
          <td>:</td>
          <td><?=$surat->mail_code?></td>
        </tr>
        <tr>
          <td>Tanggal Surat</td>
          <td>:</td>
          <td><?=$surat->mail_date?></td>
        </tr>
        <tr>
          <td>Dari</td>
          <td>:</td>
          <td><?=$surat->mail_from?></td>
        </tr>
        <tr>
          <td>Ke</td>
          <td>:</td>
          <td><?=$surat->mail_to?></td>
        </tr>
        <tr>
          <td>Subject</td>
          <td>:</td>
          <td><?=$surat->mail_subject?></td>
        </tr>
        <tr>
          <td>Tipe</td>
          <td>:</td>
          <td><?=$surat->type?></td>
        </tr>
        <tr>
          <td>Jenis</td>
          <td>:</td>
          <td class="tt-c"><?=$surat->jenis?></td>
        </tr>
        <tr>
          <td>Penginput</td>
          <td>:</td>
          <td><?=$surat->fullname?> (<?=$surat->username?>)</td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td>"<?=$surat->description?>"</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="col s12 m6 l5">
    <div class="card f-g-l">
      <h4 class="f-g-m blue-text">File</h4>
      <?php
        $b = $run->tampil("file_upload where id_mail='$surat->id'");
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
<?php
    }else{
      showError();
    }
  }
?>