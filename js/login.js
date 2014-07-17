$('#loginbtn').click(function(){
	var username = $('#user').val();
	var password = $('#password').val();
	
	//validation
	if(username == "" || password == ""){
		$('#status').text("Please fill out all the information!");
		return false;
	}
	$.ajax({
		type: "POST",
		url: 'login.php',
		data:{user:username, pass:password},
		datatype:"json",
		success: function(data){
			console.log(data);
			if(data=="nouser"){
				$('#status').html("username or password is not correct, Please try again!")
			}else{
				$("#status").html("Hi "+data+",Log in successfully, thank you.");
			}
		}
	});
});

$('#user,#password').focus(function(){
	$('#status').html("");
});


