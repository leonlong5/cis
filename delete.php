
<?php
// AJAX CALLS 

include_once("php_includes/db_conx.php");
if(isset($_POST["qid"])){
  // GATHER THE POSTED DATA INTO LOCAL VARIABLES
  $qid = $_POST['qid'];
  //excute the delete query
    $sql = "DELETE FROM faq WHERE id='$qid'";
    $query = mysqli_query($db_conx, $sql);
    echo "Delete successfully";
   
  exit();
}
?>