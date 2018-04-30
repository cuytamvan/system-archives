<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

define('lokasi', __DIR__.DIRECTORY_SEPARATOR);
define('userLogin', 'loginUsername');

$blnRomawi = array(
  'I'    => '01',
  'II'   => '02',
  'III'  => '03',
  'VI'   => '04',
  'V'    => '05',
  'VI'   => '06',
  'VII'  => '07',
  'VIII' => '08',
  'IX'   => '09',
  'X'    => '10',
  'XI'   => '11',
  'XII'  => '12',
);
$blnKata = array(
  'Januari'   => '01',
  'Febuari'   => '02',
  'Maret'     => '03',
  'April'     => '04',
  'Mei'       => '05',
  'Juni'      => '06',
  'Juli'      => '07',
  'Agustus'   => '08',
  'September' => '09',
  'Oktober'   => '10',
  'November'  => '11',
  'Desember'  => '12',
);
$extSurat = array('jpg','png','jpeg','svg','pdf','docx','doc');
$gambar   = array('jpg','png','jpeg','svg','bmp','gif');

require lokasi.'helper.php';
require lokasi.'controller.php';
require lokasi.'sessionController.php';