<?php
  if (isset($_POST['ganti'])) {
    if (hpost('password_lama') == $user->password) {
      if (hpost('password_baru') == hpost('ketik_ulang')) {
        if ($run->update('user', [
          'password' => antiI(hpost('password_baru'))
        ], 'username', $user->username)) {
          echo "<script>alert('berhasil ganti password'); document.location.href='".asset('dashboard')."'</script>";
        }else{
          echo "<script>alert('gagal ganti password'); document.location.href='".asset('dashboard?menu=gantip')."'</script>";
        }
      }else{
        echo "<script>alert('ketik ulang password harus sama'); document.location.href='".asset('dashboard?menu=gantip')."'</script>";
      }
    }else{
      echo "<script>alert('Password lama harus sama'); document.location.href='".asset('dashboard?menu=gantip')."'</script>";
    }
  }
?>
<div class="row" style="margin-top: 10px;">
  <form method="post">
    <div class="col s12 m11">
      <h4 class="grey-text text-darken-3 f-g-m">Ganti Password</h4>
      <div class="col s12 m6 l4">
        <div class="input-field">
          <input type="password" name="password_lama" id="password_lama">
          <label for="password_lama">Password Lama</label>
        </div>
        <div class="input-field">
          <input type="password" name="password_baru" id="password_baru">
          <label for="password_baru">Password Baru</label>
        </div>
        <div class="input-field">
          <input type="password" name="ketik_ulang" id="ketik_ulang">
          <label for="ketik_ulang">Ketik ulang password</label>
        </div>
        <div>
          <button type="submit" name="ganti" class="btn blue lighten-1">Ganti Password</button>
        </div>
      </div>
    </div>
  </form>
</div>