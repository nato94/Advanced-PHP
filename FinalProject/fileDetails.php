<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
require_once './models/autoload.php';
session_start();
        $folder = './uploads';
        //add new instance of the DirectoryIterator class in order to get extensions and test to see which file is which and address accordingly
        $directory = new DirectoryIterator($folder);
        
        $fileName = filter_input(INPUT_GET, 'fileName');
        $fileSize = filter_input(INPUT_GET, 'fileSize');
        $fileDate = filter_input(INPUT_GET, 'fileDate');
        $fileTopText = filter_input(INPUT_GET, 'fileTopText');
        $fileBottomText = filter_input(INPUT_GET, 'fileBottomText');
        $views = filter_input(INPUT_GET, 'views');
        $title = filter_input(INPUT_GET, 'title');
        $ErrorMessage = [];
        
        
//if the file is empty then remove the file
if (!is_file($folder . DIRECTORY_SEPARATOR . $fileName)){
    $ErrorMessage[] = "File Not Found!";
}

?>
<!Doctype html>
<html>
    <head>
         <meta charset="UTF-8">
        <title>Final Project</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- call the main css file that has all the style -->
        <link rel="stylesheet" href="css/main.css">
        
        <style>
            
            
            
            #memeTopText {
    position: relative;
    left: 400px;
    top: 50px;
    color: white;
    font-size: 20px;
}

#memeBottomText {
    position: relative;
    bottom: 50px;
    left: 400px;
    color: white;
    font-size: 20px;
}
            
        </style>
    </head>
    <body>
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Dank MEME's</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="sign-in.php">Sign-in<span class="sr-only">(current)</span></a></li>
        <li><a href="signup.php">Sign-up<span class="sr-only">(current)</span></a></li>
        <li><a href="uploadPage.php">Upload<span class="sr-only">(current)</span></a></li>
        <!-- if the login session is set and equals to true then display the link for the administrator -->
        <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true): ?>
        <li><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <?php endif; ?>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        
        <div class="container">
        <h1 class="page-header">View Details</h1>
        
          <?php include('./ErrorMessage.html.php'); 
          
          $login = new login();
          $login->updateViews($views, $fileName);
          ?>
        
        
            <div id="fileDiv">
                <h3>Title: <?php echo $title;?></h3>
                <p>uploaded on <?php echo $fileDate; ?></p>
                <p>This file is <?php echo $fileSize; ?> byte's</p>
                <p>Views: <?php echo $views; ?></p>
        
                        
                  <p id="memeTopText">
                    <?php echo $fileTopText; ?>
                </p>
                    <img width="100%" height="100%" src="<?php echo "uploads/$fileName";  ?>" />
                <p id="memeBottomText">
                    <?php echo $fileBottomText; ?>
                </p>
            
            </div> <!-- end file div -->
            
        </div> <!-- end container div  -->
        
    </body>
</html>

