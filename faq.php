<!Doctype html>
<html ng-app="app">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CIS FIU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="frequent asked question">
    <meta name="author" content="Long Wang">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_faq.css">
    <link rel="stylesheet" type="text/css" href="css/media_query_faq.css">
    <link href="css/xeditable.css" rel="stylesheet">


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
          
          
          
          <div class="extra col">
            <h2>Frequent Asked Questions</h2>
            <div ng-controller="TextareaCtrl">
              <a href="#" editable-textarea="user.desc" e-rows="7" e-cols="40">
                <pre style="color:white;">{{ user.desc || 'no description' }}</pre>
              </a>
            </div>
            
          </div>

          
          <br style="clear:both">
        </div>
      </div>

<?php include_once("footer.php");?>
    
<!-- put js at the end of the document -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
<script src="js/xeditable.js"></script>

<script type="text/javascript">
        var app = angular.module("app", ["xeditable"]);
        app.controller('TextareaCtrl', function($scope) {
          $scope.user = {
            desc: 'Title \ndescription!'
          };
        });
</script>
    </body>
</html>