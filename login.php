<?php
session_start();
include_once("php_includes/db_conx.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start(), be careful.
// Initialize some vars
$user_ok = false;
$log_username = "";
$log_password = "";
// User Verify function
function evalLoggedUser($conx,$u,$p){
	$sql = "SELECT * FROM user WHERE username='$u' AND password='$p' LIMIT 1";
    $query = mysqli_query($conx, $sql);
    $numrows = mysqli_num_rows($query);
	if($numrows > 0){
		return true;
	}
}
if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
	$log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	// Verify the user
	$user_ok = evalLoggedUser($db_conx,$log_username,$log_password);
} 
// If user is already logged in, header that weenis away

if($user_ok == true){
	header("location: http://matrix.cs.fiu.edu/cis/index.php");
    exit();
}

?><?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["user"]) && isset($_POST["pass"])){
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$e = $_POST['user'];
	$p = $_POST['pass'];
	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT * FROM user where username = '".$e."' and password = '".$p."'";
	    $query = mysqli_query($db_conx, $sql);
	    $numcount = mysqli_num_rows($query);
	    if($numcount<1){echo "nouser"; exit();}
	    while ($row=mysqli_fetch_row($query)) {
        	$username = $row[0];
        	$password = $row[1];
	    }
	    
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			echo $_SESSION['username'];
		    exit();
		
	}
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Log In</title>
<style type="text/css">
    body
    {
    background-image:url('img/bg.jpg');
    }
    .loginform{
    	width: 80%;
    	margin: 20px auto;
    }
    #loginbtn{
    	width: 80px;
    	height: 30px;
    }
</style>
</head>
<body>
<div class="container">
		<div class="loginform">
			  <!-- LOGIN FORM -->
			  <form id="loginform" onsubmit="return false;">
			  	 <fieldset>
			    <legend>LOGIN</legend>
			    <label  for="user">UserName:</label >
			    <input type="text" id="user" maxlength="88">
			    <br />
			    <label  for="password">Password:</label >
			    <input type="password" id="password" maxlength="100">
			    <br />
			    <button id="loginbtn" type="submit">Login</button> 
			    <a href="index.php">back</a>
			    <p id="status" style="color:#F00"></p>
			    
			    </fieldset>
			  </form>
			  <!-- LOGIN FORM -->
  	    </div>
</div>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>