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
        

?>
<!Doctype html>
<html>
    <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Final Project</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- call the main css file that has all the style -->
        <link rel="stylesheet" href="css/main.css">
        
        <style>
            
            
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
        <!-- if the login session is set and equals to true then display the link for the administrator -->
        <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true): ?>
        <li class="active"><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <li><a href="uploadPage.php">Upload<span class="sr-only">(current)</span></a></li>
        <li role="presentation" id="logoutBtn"><a href="logout.php">Logout</a></li>
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
            include ('./SuccessMessage.html.php');
          
          $photos = new photos();
          $photos->updateViews($views, $fileName);
          ?>
        
        
            <div id="fileDiv">
                <h3>Title: <?php echo $title;?></h3>
                <p>uploaded on <?php echo $fileDate; ?></p>
                <p>This file is <?php echo $fileSize; ?> byte's</p>
                <p>Views: <?php echo $views; ?></p>
        
                    <img width="100%" height="100%" src="<?php echo "uploads/$fileName";  ?>" />
            
            </div> <!-- end file div -->
            <a id="dltButton" href="delete.php?filename=<?php echo $fileName; ?>" class="btn btn-default">Delete File</a>
            <a href="mail.php" class="btn btn-default">Email Meme</a>
            <a
                href="http://twitter.com/share?text=The%20Dankest%20of%20Memes&url=http://localhost/Assignment1/FinalProject/index.php"
                target="_blank"
                title="Click to post to Twitter"><img src="./CSS/tweet_button.jpg">
                </a>
            
        </div> <!-- end container div  -->
        
        <br />
        <br />
        
    </body>
</html>

