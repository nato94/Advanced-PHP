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
        //require_once './models/autoload.php';
        ?>
        
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Assignment 4</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="viewFiles.php">View Files<span class="sr-only">(current)</span></a></li>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        
        <div class="container">
        <h1 class="page-header">Home Page</h1>
        
   
    <h1>Upload File</h1>
    <form enctype="multipart/form-data" action="upload.php" method="POST">   
        File: <input type="file" name="file" /> <br />
       <input id="loginBtn" type="Submit" value="Upload" name="Upload" class="btn btn-primary" />
    </form>
    </div>
 
    </body>
</html>