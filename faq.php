<?php 
include_once("php_includes/check_login_status.php");

$form = "<label for='title'> Title:</label><br />
        <input id='title' type='text' size='100'/> <br />
        <label> Lable:</label><br />
         <select id='lables'>
                <option>General</option>
                <option>Admissions</option>
                <option>Ph.D</option>
                <option>Master</option>
                <option>Other</option>
          </select></br>
        <label for='message'> Content:</label><br />
        <textarea id='message' rows='7' cols='100'></textarea> <br />
        <button id='add'>Add</button>";

?>

<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CIS FIU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="frequent asked question">
    <meta name="author" content="Long Wang">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_faq.css">


  </head>

  <body>
    <?php include_once("nav.php");?>

      <div class="wrap">      
        <div class="content">
          <div class="main col">
            <h2>Summary</h2>
            <p>
              At here you can find the most frequently asked questions by students, check it when you have questions. We will keep updating the questions, if you have any question or suggessions, please contact us!
            </p>
          </div>
          
          <?php
          //**************FAQ display here
            class faq {
              public $que ="";
              public $lab = "";
              public $ans = "";
            }
            $arr = array();

            $sql = "SELECT * FROM faq";
            $query = mysqli_query($db_conx, $sql);
            $outputs ="";
            while($row = mysqli_fetch_array($query)){
              $output = "";
              $id = $row['id'];
              $title = $row['title'];
              $lable = $row['lable'];
              $content = $row['content'];
              
              $e = new faq();
              $e->que = $title;
              $e->lab = $lable;
              $e->ans = $content;
              array_push($arr, json_encode($e));

              $output .= "<li class='lst'>";
              $output .=  "<h3><img src='img/white/magnifying_glass_16x16.png'/> <span>Q: $title</span> <lable class='lables'>$lable</lable>";
              if($user_ok==true){ $output .= "<button class='del' value='$id'> delete</button>";}
              $output .= "</h3>";
              $output .=  "<p>A: $content</p>";
              $output .= "</li>";
              $outputs.= $output;
            }
          //**************FAQ display here
          ?>
          
          <div class="extra col">
            <h2>Frequent Asked Questions</h2>
            Category
            <select id="category">
                <option>All</option>
                <option>General</option>
                <option>Admissions</option>
                <option>Ph.D</option>
                <option>Master</option>
                <option>Other</option>
            </select>
            <div id="container">
            <?php echo $outputs;?>
            </div>
            <hr>
            
            <?php 
            if($user_ok == true){
            echo "<h2>Add new  FAQ blow.</h2>";
            echo $form;
            }
            ?>
            <p id='status'></p>
          </div>

          
          <br style="clear:both">
        </div>
      </div>

<?php include_once("footer.php");?>
    
<!-- put js at the end of the document -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/faq.js"></script>
    </body>
</html>