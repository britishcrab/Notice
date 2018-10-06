jQuery( function($) {
  $('tbody tr[data-href]').click( function() {
      window.location = $(this).attr('data-href');
  }).find('a').hover( function() {
      $(this).parents('tr').unbind('click');
  }, function() {
      $(this).parents('tr').click( function() {
          window.location = $(this).attr('data-href');
      });
  });

  $("tbody tr").hover(
  function(){
    $(this).css("background","red")
  },function(){
    $(this).css("background","")
  });
});
