$(document).ready(function() {
  $('.button-collapse').sideNav({
    menuWidth: 250,
  });
  $('.dropdown-button').dropdown({
    constrain_width: false,
    hover          : true,
    alignment      : 'right'
  });
  $('.datepicker').pickadate({
    format: 'yyyy-mm-dd'
  });
  $('.pake-data-table').DataTable();
  $('select').material_select();
  $('.cari-data').keyup(function() {
    var value, p, valText;
    filter = $(this).val().toUpperCase();
    p       = document.getElementsByClassName('cari-orang');
    for(var i = 0; i < p.length; i++){
      valText = p[i].getElementsByTagName('label')[0];
      if (valText) {
        if (valText.innerHTML.toUpperCase().indexOf(filter) >= 0) {
          p[i].style.display = '';
        }else{
          p[i].style.display = 'none';
        }
      }
    }
  });
});