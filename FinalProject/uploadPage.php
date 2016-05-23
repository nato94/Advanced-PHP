<html>
    <head>
         <meta charset="UTF-8">
        <title>Assignment 4</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <!-- call the main css file that has all the style -->
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        
        <?php
        //call autoload class to load all classes for the page
        require_once './models/autoload.php';
        
        $util = new util();
        
        session_start();
        if($_SESSION['logged-in'] != true){
            header("Location: index.php");
            die();
        }
        else{
            $SuccessMessage = "Welcome to the upload Page!";
        }
        
        
        
        ?>
        
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
        <li class="active"><a href="uploadPage.php">Upload<span class="sr-only">(current)</span></a></li>
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
        
   
    <h1 class="page-header">Upload File</h1>
    
    <form enctype="multipart/form-data" action="upload.php" method="POST">   
        <div class="form-group">
            <label for="file">Picture Upload: </label>
            <input type="file" id="file" name="file" /><br />
        </div>
        
        <div class="form-group">
            <label for="memeTitle">Title: </label>
            <input type="text" class="form-control" id="memeTitle" name="memeTitle" placeholder="Enter The Title Of The Meem Here">
        </div>
        
        <div class="form-group">
            <label for="topText">Top Text: </label>
            <input type="text" class="form-control" id="topText" name="topText" placeholder="Enter Top Text Here">
        </div>
        
        <div class="form-group">
            <label for="bottomText">Bottom Text: </label>
            <input type="text" class="form-control" id="bottomText" name="bottomText" placeholder="Enter Bottom Text Here">
        </div>
       <input id="loginBtn" type="Submit" value="Upload" name="Upload" class="btn btn-primary" />
    </form>
    </div>
 
    </body>
</html>