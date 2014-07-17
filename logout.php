<?php
session_start();
// Set Session data to an empty array
$_SESSION = array();
// Destroy the session variables
session_destroy();
// Double check to see if their sessions exists
if(isset($_SESSION['username'])){
	echo "Error:_Logout_Failed";
} else {
	header("location:index.php");
	exit();
} 
?>