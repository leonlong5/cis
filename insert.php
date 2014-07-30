
<?php
// AJAX CALLS 

include_once("php_includes/db_conx.php");
if(isset($_POST["tit"]) && isset($_POST["mes"]) && isset($_POST["lables"])){
  // GATHER THE POSTED DATA INTO LOCAL VARIABLES
  $tit = $_POST['tit'];
  $mes = $_POST['mes'];
  $lables = $_POST["lables"];
  // FORM DATA ERROR HANDLING
  if($tit == "" || $lables == ""){
    echo "process_failed";
    exit();
  } else {
    $sql = "INSERT INTO faq (title, content, lable) VALUES(\"$tit\", \"$mes\", \"$lables\")";
    $query = mysqli_query($db_conx, $sql);
    if(!$query){
    echo trigger_error('Unable to execute query: ' . $sql, E_USER_NOTICE);
    }
    exit();
    
  }
  exit();
}
?>