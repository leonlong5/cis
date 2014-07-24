//add a new FAQ , filter it then send the ajax request
$("#add").click(function(){
  var tit = $('#title').val();
  var mes = $('#message').val();
  if(tit == "" || mes == ""){
    $("#status").html("Please fill out all the information!");
    return false;
  }
  $.ajax({
      type: "POST",
      url: 'insert.php',
      data:{tit:tit, mes:mes},
      success: function(data){
        $('#title').val('');
        $('#message').val('');
        location.reload();
    }
  });
});

//empty the input
$('#title,#message').focus(function(){
  $('#status').html("");
});

//delete an existed FAQ
$(".del").click(function(){
  var qid = $(this).val();
  console.log(qid);
  $.ajax({
    type: "POST",
    url: "delete.php",
    data:{qid:qid},
    success: function(data){
      location.reload();
    }
  });
});