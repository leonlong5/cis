
<?php
// AJAX CALLS 

include_once("php_includes/db_conx.php");
if(isset($_POST["tit"]) && isset($_POST["mes"])){
  // GATHER THE POSTED DATA INTO LOCAL VARIABLES
  $tit = $_POST['tit'];
  $mes = $_POST['mes'];
  // FORM DATA ERROR HANDLING
  if($tit == "" || $mes == ""){
    echo "login_failed";
    exit();
  } else {
    $sql = "INSERT INTO faq (title, content) VALUES('$tit', '$mes')";
    $query = mysqli_query($db_conx, $sql);
    echo $mes;
    exit();
    
  }
  exit();
}
?>