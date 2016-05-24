
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
        <li><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
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
          
          $util = new util();
          
          if($util->isPostRequest()){
             $values = filter_input_array(INPUT_POST); 
              $message = $values['message'];
              $email = $values['email'];
              $subject = $values['subject'];
            $util->mailMeme($message, $email, $subject);
          }
          ?>
        
         <h1>Mail Meme</h1>
            <form action="#" method="POST"> 
                <div class="form-group">
                <label for="email">Email:</label>
                    <input type="text" name="email" placeholder="Enter Email Here" /> <br />
                </div>
                <div class="form-group">
                <label for="subject">Subject:</label>
                    <input type="text" name="subject" placeholder="Enter Subject Here" /> <br />
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <input type="text" name="message" placeholder="Enter Message Here" /> <br />
                </div>
               <input id="loginBtn" type="submit" value="Send Email" class="btn btn-primary" />
            </form>
        

        </div> <!-- end container div  -->
        
        <br />
        <br />
        
    </body>
</html>
