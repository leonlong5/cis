<?php 
  $db_conx = mysqli_connect("matrix.cs.fiu.edu:33061","bi","bi","cis");


if(mysqli_connect_error()){
	echo mysqli_connect_error();
	exit();
}

?>