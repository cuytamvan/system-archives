<?php
  $table    = 'user';
  $redirect = '?menu=user';
  $where    = 'username';
  if (isset($_POST['simpan'])) {
    $field = array(
      'username' => antiI(hpost('username')),
      'password' => 'abc123',
      'fullname' => antiI(hpost('fullname')),
      'level'    => antiI(hpost('level')),
      'jk'       => antiI(hpost('jk')),
      'no_hp'    => antiI(hpost('no_hp')),
      'email'    => antiI(hpost('email')),
    );
    if ($run->simpan($table, $field)) {
      echo "<script>alert('Berhasil di simpan'); document.location.href='".$redirect."'</script>";
    }else{
      echo "<script>alert('Gagal di simpan'); document.location.href='".$redirect."'</script>";
    }
  }
  $op[0] = '';
  $op[1] = '';
  $op[2] = '';
  $op[3] = '';

  $jk[0] = '';
  $jk[1] = '';

  if (isset($_GET['edit'])) {
    $id = antiI(hget('us'));
    $edit = $run->ambil($table, $where, $id);
    if ($edit->level == 'admin') {
      $op[0] = 'selected';
    }else if($edit->level == 'seketaris'){
      $op[2] = 'selected';
    }else if($edit->level == 'manager'){
      $op[1] = 'selected';
    }else if($edit->level == 'pegawai'){
      $op[3] = 'selected';
    }

    if ($user->jk == 'l') {
      $jk[0] = 'checked';
    }else{
      $jk[1] = 'checked';
    }
  }
  if (isset($_POST['update'])) {
    $field = array(
      'fullname' => antiI(hpost('fullname')),
      'level'    => antiI(hpost('level')),
      'jk'       => antiI(hpost('jk')),
      'no_hp'    => antiI(hpost('no_hp')),
      'email'    => antiI(hpost('email')),
    );
    $id = antiI(hget('us'));
    if ($run->update($table, $field, $where, $id)) {
      echo "<script>alert('Berhasil di edit'); document.location.href='".$redirect."'</script>";
    }else{
      echo "<script>alert('Gagal di edit'); document.location.href='".$redirect."'</script>";
    }
  }
  if (isset($_GET['hapus'])) {
    $id = antiI(hget('us'));
    if ($run->hapus($table, $where, $id)) {
      echo "<script>alert('Berhasil di hapus'); document.location.href='".$redirect."'</script>";
    }else{
      echo "<script>alert('Gagal di hapus'); document.location.href='".$redirect."'</script>";
    }
  }
?>
<form method="post">
  <div class="row" style="margin-top: 10px;">
    <div class="col s12 l11">
      <h4 class="f-g-m blue-text">Kelola <span class="deep-orange-text text-lighten-1">User</span></h4>
      <div class="col s12 m4 ">
        <div class="input-field">
          <input type="text" name="username" id="username" maxlength="50" required value="<?php if(isset($_GET['edit'])){echo $edit->username;} ?>" <?php if(isset($_GET['edit'])){echo 'disabled';} ?>>
          <label for="username">Username</label>
        </div>
        <div class="input-field">
          <input type="text" name="fullname" id="fullname" maxlength="50" required value="<?php if(isset($_GET['edit'])){echo $edit->fullname;} ?>">
          <label for="fullname">Fullname</label>
        </div>
        <div class="input-field">
          <select name="level" id="level">
            <option value="admin" <?=$op[0]?>>Admin</option>
            <option value="manager" <?=$op[1]?>>Manager</option>
            <option value="seketaris" <?=$op[2]?>>seketaris</option>
            <option value="pegawai" <?=$op[3]?>>Pegawai</option>
          </select>
          <label for="level">Level</label>
        </div>
      </div>
      <div class="col s12 m4">
        <label>Jenis Kelamin</label>
        <p>
          <input type="radio" value="l" name="jk" id="laki" required <?=$jk[0]?>>
          <label for="laki">Laki - laki</label>
        </p>
        <p>
          <input type="radio" value="p" name="jk" id="perempuan" required <?=$jk[1]?>>
          <label for="perempuan">Perempuan</label>
        </p>
        <div class="input-field">
          <input type="text" name="no_hp" id="no_hp" maxlength="15" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?php if(isset($_GET['edit'])){echo $edit->no_hp;} ?>">
          <label for="no_hp">No Hp</label>
        </div>
        <div class="input-field">
          <input type="email" name="email" id="email" maxlength="50" value="<?php if(isset($_GET['edit'])){echo $edit->email;} ?>">
          <label for="email">Email</label>
        </div>
      </div>
    </div>
    <div class="col s12 l12">
      <?php if (isset($_GET['edit'])) { ?>
      <button name="update" type="submit" class="btn blue lighten-2">Update</button>
      <a href="<?=$redirect?>" class="btn blue lighten-2">Batal edit</a>
      <?php }else{ ?>
      <button name="simpan" type="submit" class="btn blue lighten-2">Simpan</button>
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
          <th>Username</th>
          <th>Fullname</th>
          <th>Level</th>
          <th>Jenis&nbsp;Kelamin</th>
          <th>No&nbsp;Hp</th>
          <th>Email</th>
          <th width="25%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $a = $run->tampil($table." order by fullname asc");
          if (!is_null($a)) {
            $no = 1;
            foreach ($a as $r) {
              if ($r->jk == 'l') {
                $jk = 'Laki - laki';
              }else{
                $jk = 'Perempuan';
              }
        ?>
        <tr>
          <td><?=$no?></td>
          <td><?=$r->username?></td>
          <td><?=$r->fullname?></td>
          <td><?=$r->level?></td>
          <td><?=$jk?></td>
          <td><?=$r->no_hp?></td>
          <td><?=$r->email?></td>
          <td>
            <?php if ($user->username != $r->username) { ?>
            <a href="<?=$redirect?>&edit&us=<?=$r->username?>" class="btn z-depth-0 deep-orange lighten-1">Edit</a>
            <a href="<?=$redirect?>&hapus&us=<?=$r->username?>" class="btn z-depth-0 red lighten-1" onclick="return confirm('Hapus Data tersebut?')">Hapus</a>
            <?php }else{ echo '<i>User sedang di pakai</i>';} ?>
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