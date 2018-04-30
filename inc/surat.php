<?php
  $table    = 'mail';
  $redirect = '?menu=surat';
  $where    = 'id';
  if (!isset($_GET['detail'])) {
  $pacuan = $run->ambil1("mail where time like '".date('Y-m-')."%' order by mail_code desc");
  if (is_null($pacuan)) {
    $kode = 0;
  }else{
    $kode = (int) substr($pacuan->mail_code, 0, 3);
  }
  $kode++;
  if ($kode > 999) {
    $kode = 1;
  }
  $kode1 = str_pad($kode, 3, '0',STR_PAD_LEFT);
  $hasil_kode = $kode1.'/kepoin/'.gantiKata1(date('m'), $blnRomawi).'/'.date('Y');

  if (isset($_POST['simpan'])) {
    $file = $_FILES['file'];
    $kode_surat = 'srt'.randCuy(7);
    $field = array(
      'id'           => $kode_surat,
      'time'         => date('Y-m-d H:i:s'),
      'mail_code'    => $hasil_kode,
      'mail_date'    => antiI(hpost('mail_date')),
      'mail_from'    => antiI(hpost('mail_from')),
      'mail_to'      => antiI(hpost('mail_to')),
      'mail_subject' => antiI(hpost('subject')),
      'description'  => antiI(hpost('description')),
      'id_type'      => antiI(hpost('id_type')),
      'jenis'        => antiI(hpost('jenis')),
      'status'       => 1,
      'username'     => $user->username,
    );
    if (!empty($file)) {
      $flag = 0;
      $lenFile = count($file['name']);
      if ($lenFile > 1) {
        $index = 0;
        foreach ($file['name'] as $r) {
          $ext = getExt($r);
          if (in_array($ext, $extSurat)) {
            if ($file['size'][$index] > 60000000) {
              $flag = 0;
              break;
            }else{
              $flag = 1;
            }
          }else{
            $flag = 0;
            break;
          }
          $index++;
        }
      }else{
        $ext = getExt($file['name'][0]);
        if (in_array($ext, $extSurat)) {
          if ($file['size'][0] > 60000000) {
            $flag = 0;
          }else{
            $flag = 1;
          }
        }else{
          $flag = 0;
        }
      }
      if ($flag == 1) {
        $simpan = $run->simpan($table, $field);
        if ($simpan) {
          $lenFile = count($file['name']);
          if ($lenFile > 1) {
            $index = 0;
            foreach ($file['name'] as $r) {
              $ext = getExt($r);
                $new_name   = 'file-'.randCuy().'.'.$ext;
                $field_file = array(
                  'id_mail'   => $kode_surat,
                  'nama_file' => $new_name,
                );
                move_uploaded_file($file['tmp_name'][$index], 'asset/file/surat/'.$new_name);
                $run->simpan('file_upload',$field_file);
              $index++;
            }
          }else{
            $ext = getExt($file['name'][0]);
            if (in_array($ext, $extSurat)) {
              $new_name   = 'file-'.randCuy().'.'.$ext;
              $field_file = array(
                'id_mail'   => $kode_surat,
                'nama_file' => $new_name,
              );
              move_uploaded_file($file['tmp_name'][0], 'asset/file/surat/'.$new_name);
              $run->simpan('file_upload',$field_file);
            }
          }
          alert('Berhasil di simpan', 'dashboard'.$redirect);
        }else{
          alert('Gagal di simpan', 'dashboard'.$redirect);
        }
      }else{
        alert('Ada Masalah Dengan File yang anda upload', 'dashboard'.$redirect);
      }
    }else{
      alert('File Harus Ada', 'dashboard'.$redirect);
    }
  }
  if (isset($_GET['hapuspermanen'])) {
    $id = antiI(hget('id'));
    $file = $run->tampil("file_upload where id_mail='$id'");
    foreach ($file as $r) {
      unlink('asset/file/surat/'.$r->nama_file);
    }
    if ($run->hapus($table, $where, $id)) {
      $run->hapus('file_upload', 'id_mail', $id);
      alert('Data dihapus permanen', 'dashboard'.$redirect);
    }else{
      alert('Gagal di hapus', 'dashboard'.$redirect);
    }
  }
  if (isset($_GET['hapus'])) {
    $id = antiI(hget('id'));
    if ($run->update($table, ['status' => 0], 'id', $id)) {
      alert('Berhasil di hapus', 'dashboard'.$redirect);
    }else{
      alert('Gagal di hapus', 'dashboard'.$redirect);
    }
  }
?>
<form method="post" enctype="multipart/form-data">
  <div class="row" style="margin-top: 10px;">
    <div class="col s12 l11">
      <h4 class="f-g-m blue-text">Kelola <span class="deep-orange-text text-lighten-1">Surat</span></h4>
      <div class="col s12 m4 ">
        <?php
          $ke       = 'Pt.Kepoin';
          $attrke   = 'readonly';
          $dari     = '';
          $attrdari = '';
          $jns[0]   = '';
          $jns[1]   = '';
          if (isset($_POST['jenis'])) {
            if ($_POST['jenis'] == 'keluar') {
              $jns[0]   = '';
              $jns[1]   = 'selected';

              $dari     = 'Pt.Kepoin';
              $attrdari = 'readonly';
              $ke       = '';
              $attrke   = '';
            }else{
              $jns[0]   = 'selected';
              $jns[1]   = '';
              $dari     = '';
              $attrdari = '';
              $ke       = 'Pt.Kepoin';
              $attrke   = 'readonly';
            }
          }else{
            $dari     = '';
            $attrdari = '';
            $ke       = 'Pt.Kepoin';
            $attrke   = 'readonly';
          }
        ?>
        <div class="input-field">
          <select name="jenis" id="jenis" onchange="submit()">
            <option value="masuk" <?=$jns[0]?>>Masuk</option>
            <option value="keluar" <?=$jns[1]?>>Keluar</option>
          </select>
          <label for="jenis">Jenis</label>
        </div>
        <div class="input-field">
          <input type="text" name="mail_code" id="mail_code" maxlength="50" required value="<?=$hasil_kode?>">
          <label for="mail_code">Kode surat</label>
        </div>
        <div class="input-field">
          <input type="text" name="mail_from" id="mail_from" maxlength="50" required value="<?=$dari?>" <?=$attrdari?>>
          <label for="mail_from">Dari</label>
        </div>
        <div class="input-field">
          <input type="text" name="mail_to" id="mail_to" maxlength="50" required value="<?=$ke?>" <?=$attrke?>>
          <label for="mail_to">Ke</label>
        </div>
        
      </div>
      <div class="col s12 m4">
        <div class="input-field">
          <input type="text" name="mail_date" id="mail_date" class="datepicker" maxlength="50" required>
          <label for="mail_date">Tanggal Surat</label>
        </div>
        <div class="input-field">
          <input type="text" name="subject" id="subject" maxlength="50" required>
          <label for="subject">Subject</label>
        </div>
        <div class="input-field">
          <select name="id_type" id="id_type">
            <?php
              $tipe = $run->tampil('mail_type');
              foreach ($tipe as $r) {
            ?>
            <option value="<?=$r->id?>"><?=$r->type?></option>
            <?php } ?>
          </select>
          <label for="id_type">Tipe</label>
        </div>
        <div class="input-field">
          <textarea name="description" id="description" class="materialize-textarea"></textarea>
          <label for="description">Deskripsi</label>
        </div>
      </div>
      <div class="col s12 m4">
        <label>Masukan File</label>
        <div class="input-field file-field">
          <div class="btn blue lighten-2 z-depth-0">
            <span>File</span>
            <input type="file" name="file[]" multiple>
          </div>
          <div class="file-path-wrapper">
            <input type="text" class="file-path validate">
          </div>
          <p style="font-size: 12px; margin: 0px; padding: 0px; margin-top: -10px;" class="grey-text text-darken-1">
            File yang di bolehkan :
            <?php
              $ex = '';
              foreach ($extSurat as $r) {
                $ex .= $r.', ';
              }
              $ex = rtrim($ex, ', ');
              echo $ex;
            ?>. Selain file tersebut yang di upload, maka file tidak di upload. Maximum upload 6mb
          </p>
        </div>
      </div>
    </div>
    <div class="col s12 l12">
      <?php if (isset($_GET['edit'])) { ?>
      <button name="update" type="submit" class="btn blue lighten-2 z-depth-0">Update</button>
      <a href="<?=$redirect?>" class="btn blue lighten-2 z-depth-0">Batal edit</a>
      <?php }else{ ?>
      <button name="simpan" type="submit" class="btn blue lighten-2 z-depth-0">Simpan</button>
      <?php } ?>
    </div>
  </div>
</form>
<div class="row">
  <div class="col s12 m11">
    <style>
      .table-ajib th,
      .table-ajib td{
        font-size: 12px;
      }
    </style>
    <table class="striped pake-data-table table-ajib">
      <thead>
        <tr>
          <th>No</th>
          <th>Waktu</th>
          <th>Kode&nbsp;Surat</th>
          <th>Tanggal&nbsp;Surat</th>
          <th>Dari</th>
          <th>Ke</th>
          <th>Subject</th>
          <th width="25%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $a = $run->tampil($table." where status = 1 order by time desc");
          if (!empty($a)) {
            $no = 1;
            foreach ($a as $r) {
        ?>
        <tr>
          <td><?=$no?></td>
          <td><?=date('M d, Y', strtotime($r->time))?></td>
          <td><?=$r->mail_code?></td>
          <td><?=date('M d, Y', strtotime($r->mail_date))?></td>
          <td><?=$r->mail_from?></td>
          <td><?=$r->mail_to?></td>
          <td><?=$r->mail_subject?></td>
          <td>
            <a href="<?=$redirect?>&detail&id=<?=$r->id?>" class="btn z-depth-0 blue lighten-1">Detail</a>
            <a href="<?=$redirect?>&hapus&id=<?=$r->id?>" class="btn z-depth-0 red lighten-1" onclick="return confirm('Hapus Data tersebut?')">Hapus</a>
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
<?php
  }else{
    $id = antiI(hget('id'));
    $cokot = $run->ambil('qw_'.$table,$where, $id);
      if (!empty($cokot)) {
?>
<div class="row" style="margin-top: 10px;">
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
      .pake-border-bottom:not(:last-child){
        border-bottom: thin solid #ddd;
      }
    </style>
    <div class="card f-g-l">
      <h4 class="f-g-m blue-text">Detail <span class="deep-orange-text text-lighten-1">Surat</span></h4>
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
      <!-- <a href="#!" class="btn btn-custom z-depth-0">Download semua file</a><br><br> -->
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
<?php
    }else{
      showError();
    }
  }
?>