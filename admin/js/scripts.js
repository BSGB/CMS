$(window).load(function(){
  $('#load-screen').fadeOut('slow', function(){
    $(this).remove();
  });
});

$(document).ready(function() {
  $('#selectAllBoxes').click(function(){
    if(this.checked){
      $('.checkBoxes').each(function(){
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function(){
        this.checked = false;
      });
    }
  });
});
