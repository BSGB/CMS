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

function loadUsersOnline(){
  $.get('functions.php?onlineusers=result', function(data){
    $('.usersOnline').text(data);
  });
}

setInterval(function(){
  loadUsersOnline();
}, 500);
