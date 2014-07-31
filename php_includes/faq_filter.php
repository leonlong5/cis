 <?php
 include_once("check_login_status.php");
 include_once("db_conx.php");

 if(isset($_POST["cate"])){
 $cate = $_POST["cate"];

 if($cate=="All"){
    $sql="SELECT * FROM faq";
    $query = mysqli_query($db_conx,$sql);
    echo fetch_data($query);
 }else{
    $sql = "SELECT * FROM faq where lable = '$cate'";
    $query = mysqli_query($db_conx, $sql);
    echo fetch_data($query);
    exit();
  }
}



function fetch_data($query){
  global $user_ok;
      $outputs="";
      while($row = mysqli_fetch_array($query)){
              $output = "";
              $id = $row['id'];
              $title = $row['title'];
              $lable = $row['lable'];
              $content = $row['content'];

              $output .= "<li class='lst'>";
              $output .=  "<h3><img src='img/white/magnifying_glass_16x16.png'/> <span>Q: $title</span> <lable class='lables'>$lable</lable>";
              if($user_ok==true){ $output .= "<button class='del' value='$id'> delete</button>";}
              $output .= "</h3>";
              $output .=  "<p>A: $content</p>";
              $output .= "</li>";
              $outputs.= $output;
    }
    return $outputs;
}
    ?>