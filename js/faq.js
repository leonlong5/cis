//add a new FAQ , filter it then send the ajax request
$("#add").click(function(){
  var tit = $('#title').val();
  var mes = $('#message').val();
  var lables = $('#lables').val();
  if(tit == "" || mes == "" || lables == ""){
    $("#status").html("Please fill out all the information!");
    return false;
  }

  //console.log(tit +" "+ mes +" "+ lables);
  $.ajax({
      type: "POST",
      url: 'php_includes/insert.php',
      data:{tit:tit, mes:mes, lables:lables},
      success: function(data){
      	//console.log(data);
        $('#title').val('');
        $('#message').val('');
        $('#lables').val('');
        location.reload();
    }
  });
});

//empty the input
$('#title,#message,#lables').focus(function(){
  $('#status').html("");
});

//delete an existed FAQ
$("#container").on("click",".del",function(){
  var qid = $(this).val();
  console.log(qid);
  $.ajax({
    type: "POST",
    url: "php_includes/delete.php",
    data:{qid:qid},
    success: function(data){
      location.reload();
    }
  });
});

//filter
$("#category").change(function(){
	var cate = $(this).val();
	$.ajax({
		type:"POST",
		url:"php_includes/faq_filter.php",
		data:{cate:cate},
		success: function(data){
			$(".lst").remove();
			$("#container").append(data);
		}
	});
});




















//
// function loadajax(){
//   $.ajax({ 
//     url:'faqtest.php',
//     data:"test=test",
//     type:"post",
//     success:function(data){
//     	var arr = data.split("|");//split the data
//     	if(arr[0]=='OK') {			//check if the admin logged in
//     		var admin = true;
//     	}
//     	var recive = JSON.parse(arr[1]);
//     	//alert(typeof recive);  object
//     	$.each(recive, function(key,valueObj){
// 		    //console.log(key + "/" + valueObj);//type of valueOBJ is String
// 		    var subobj = JSON.parse(valueObj);
// 		    		var main = $('#main');
// 		    		var temp = "";
// 		    	    main.append("<li class='lst'>"); 
// 		    	    if(admin==true) { temp = "<button class='del' value='$id'> delete</button>";}
// 	                main.append("<h3><img src='img/white/magnifying_glass_16x16.png'/> <span class='tit'>"+subobj.que+"</span> <lable class='lables'>"+subobj.lab+"</lable>"+temp); 
// 	                main.append("</h3>"); 
// 	                main.append("<p>"+subobj.ans+"</p>"); 
// 	                main.append("</li>"); 

// 		});
//     	$(".del").css({"border-radius":"5px","background":"#113378","color":"#D5AF18","border-color":"#D5AF18"});
//     	$(".tit").css({"color":"#D5AF18"});
//     }
//   });
// }

// $(function(){
//     setTimeout(loadajax,100);
// });