$( document ).ready(function() {
$('#cssmenu').prepend('<div id="menu-button"><span><i class="fa fa-bars"></i></span>&nbspMenu</div>');
$('#cssmenu #menu-button').on('click', function(){
   $('.nav').toggleClass('toggle');
  });
});