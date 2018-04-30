<?php

?>
<div class="container" style="margin-top: 20px; width: 84%;">
  <button class="btn blue print-laporan" type="button" onclick="printCuy('laporan_manager')">Print</button>
  <a href="<?=asset('ajax/laporan_manager.php?export')?>" class="btn blue">Export Excel</a>
  <iframe src="<?=asset('ajax/laporan_manager.php')?>" name="laporan_manager" class="iframe-cuy"></iframe>
  <script>
    function printCuy(name){
      var frame = window.frames[name];
      frame.focus();
      frame.print();
    }
  </script>
</div>