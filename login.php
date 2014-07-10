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
	$sql = "SELECT * FROM user WHERE user_name='$u' AND password='$p' LIMIT 1";
    $query = mysqli_query($conx, $sql);
    $numrows = mysqli_num_rows($query);
	if($numrows > 0){
		return true;
	}
}
if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
	$log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	// Verify the user
	$user_ok = evalLoggedUser($db_conx,$log_username,$log_password);
} else if( isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
    $_SESSION['username'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['user']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);
	$log_username = $_SESSION['username'];
	$log_password = $_SESSION['password'];
	// Verify the user
	$user_ok = evalLoggedUser($db_conx,$log_username,$log_password);
}
// If user is already logged in, header that weenis away

if($user_ok == true){
	header("location: ".$_SESSION["URL"]."?u=".$_SESSION["username"]);
    exit();
}

?><?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["e"])){
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$e = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = mysqli_real_escape_string($db_conx, $_POST['p']);
	// FORM DATA ERROR HANDLING
	if($e == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT * FROM user a,role b,permission c
		where binary a.user_name = '".$e."' and a.password = '".$p."'
		     and a.role_id = b.role_id
		     and b.permission_id = c.permission_id;";
	    $query = mysqli_query($db_conx, $sql);
	    $numcount = mysqli_num_rows($query);
	    if($numcount<1){echo "nouser"; exit();}
	    $arr = array();
	    while ($row=mysqli_fetch_row($query)) {
	    	$user_id = $row[0];
	    	$role_id = $row[2];
        	$username = $row[1];
        	$password = $row[3];
	    	array_push($arr, $row[8]) ;
	    }
	    $temp = geturl($arr[0]);
	    echo $temp."|";
	   	if($p !=$username){
	   		echo "username_incorrect";
	   		exit();
	   	}
		if($p != $password){
			echo "password_is_wrong";
            exit();
		} else {
			$_SESSION['URL']=$temp;
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $user_id;
			$_SESSION['roleid'] = $role_id;
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			$_SESSION['array'] = $arr;
			echo $_SESSION['username'];
		    exit();
		}
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
</style>
</head>
<body>

<div class="container">
	<div class="span12">
		<div>
			  <!-- LOGIN FORM -->
			  <form id="loginform" class="well form-horizontal" onsubmit="return false;">
			  	 <fieldset>
			    <legend>Login</legend>
			    <div>User name:</div>
			    <input type="text" id="user" maxlength="88">
			    <div>Password:</div>
			    <input type="password" id="password" maxlength="100">
			    <br /><br />
			    <button id="loginbtn" class="btn">Login</button> 
			    <p id="status" style="color:#F00"></p>
			    </fieldset>
			  </form>
			  <!-- LOGIN FORM -->
  	    </div>
  	</div>
</div>
</body>
</html>