// Initialize Materialize Scripts
$(document).ready(function(){
  $('.sidenav').sidenav();

  // Fix for the footer
  if (document.location.pathname != '/') {
    var currPage = document.location.pathname.match(/[^\/]+$/)[0];
  } else {
    $('footer').attr('class', 'footerlogin');
  }

  switch (currPage) {
    case 'index':
    case 'index.php':
      $('footer').attr('class', 'footerlogin');
      break;
  }
});
