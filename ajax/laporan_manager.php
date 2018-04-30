<?php
  define('g_folder', DIRECTORY_SEPARATOR);
  require __DIR__.g_folder.'..'.g_folder.'lib'.g_folder.'init.php';
  $run = new controller;
  if (!isset($_SESSION[userLogin])) {
    header('location: '. url('login'));
  }
  $user = $run->getUser('user','username',userLogin);

  $tahun = date('Y');
  $bulan = date('m');
  
  $masuk  = array();
  $keluar = array();
  for($i = 1; $i <= 12; $i++){
    $bulan_count = $tahun.'-'.tambah0($i).'-';
    if ($i > $bulan) {
      $masuk[]  = '<i>Belum&nbsp;ada</i>';
      $keluar[] = '<i>Belum&nbsp;ada</i>';
    }else{
      $masuk[]  = $run->hitungRow("SELECT * FROM mail where time like '$bulan_count%' and jenis='masuk' and status=1");
      $keluar[] = $run->hitungRow("SELECT * FROM mail where time like '$bulan_count%' and jenis='keluar' and status=1");
    }
  }
  if (isset($_GET['export'])) {
    header('Content-type: application/xls');
    header('Content-Disposition: attachment; filename=laporan_suratkeluarmasuk('.date('YmdHis').').xls');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <link rel="icon" type="image/png" href="<?=asset('../asset/logo.png')?>">
  <style>
    *{
      box-sizing: border-box; 
      font-family: 'Times New Roman', serif;
      /*font-family: sans-serif;*/
    }
    .content{
      width: 800px;
      border-collapse: collapse;
    }
    @media screen and (max-width: 800px){
      .content{
        width: 100%;
      }
    }
    .content .logo{
      width: 100%;
    }
    .content td{
      vertical-align: top;
    }
    .nama-perusahaan,
    .alamat-perusahaan{
      /*font-family: sans-serif;*/
      margin: 0;
      padding: 0;
      color: #333;
      padding-left: 20px;
      font-weight: normal;
    }
    .nama-perusahaan{
      padding-top: 5px;
    }
    .judul{
      text-align: center;
      color: #333;
    }
    p{color: #333;}
    .p-cuy{
      text-indent: 20px;
      font-size: 16px;
    }
    .table-cuy{
      width: 100%;
      border-collapse: collapse;
    }
    .table-cuy th{
      background-color: #f0f0f0;
    }
    .table-cuy th,
    .table-cuy td{
      padding: 4px 2px;
      border: thin solid #ddd;
      font-family: sans-serif;
      font-weight: normal;
      font-size: 13px;
      text-align: center;
    }
    .table-cuy td:first-child{
      text-align: center;
    }
    h1,h2,h3,h4,h5,h6{
      font-weight: normal;
    }
  </style>
</head>
<body>
  <table class="content" align="center">
    <?php if (!isset($_GET['export'])) { ?>
    <tr>
      <td width="9%">
        <img src="<?=asset('../asset/logo.png')?>" class="logo">
      </td>
      <td width="91%">
        <h1 class="nama-perusahaan">Pt.Kepoin</h1>
        <p class="alamat-perusahaan">Cimande Nangoh Citra Rt. 05 / 01 Desa Lemah Duhur Kec. Caringin Kab. Bogor</p>
      </td>
    </tr>
    <?php }else{ ?>
    <tr>
      <td colspan="2">
        <h1 class="nama-perusahaan">Pt.Kepoin</h1>
        <p class="alamat-perusahaan">Cimande Nangoh Citra Rt. 05 / 01 Desa Lemah Duhur Kec. Caringin Kab. Bogor</p>
      </td>
    </tr>
    <?php } ?>
    <?php if (!isset($_GET['export'])) { ?>
    <tr>
      <td colspan="2"><hr></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2">
        <h2 class="judul">Laporan Surat Masuk/Keluar 2018</h2>
        <?php if (!isset($_GET['export'])) { ?>
        <p>Dengan Hormat,</p>
        <p class="p-cuy">Berdasarkan data yang diperoleh oleh system, data surat masuk dan surat keluar pada tahun 2018 dari januari sampai desember adalah sebagai berikut.</p>
        <?php } ?>
        <table class="table-cuy">
          <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Jenis</th>
            <th colspan="12">Bulan</th>
          </tr>
          <tr>
            <?php
              foreach ($blnKata as $key => $value) {
                echo "<th>".$key."</th> \n";
              }
            ?>
          </tr>
          <tr>
            <td>1</td>
            <td>Surat&nbsp;Masuk</td>
            <?php
              foreach ($masuk as $r) {
                echo "<td>".$r."</td> \n";
              }
            ?>
          </tr>
          <tr>
            <td>2</td>
            <td>Surat&nbsp;Keluar</td>
            <?php
              foreach ($keluar as $r) {
                echo "<td>".$r."</td> \n";
              }
            ?>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
