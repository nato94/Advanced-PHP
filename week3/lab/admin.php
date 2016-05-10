<html>
    <head>
         <meta charset="UTF-8">
        <title>Assignment 3</title>
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
        session_start();
        if($_SESSION['logged-in'] != true){
            header("Location: index.php");
            die();
        }
        else{
            $SuccessMessage = "Welcome to the Admin Page!";
            
        }
        
        ?>
        
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Assignment 3</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="signup.php">Sign-up<span class="sr-only">(current)</span></a></li>
        <li class="active"><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        <?php include('./SuccessMessage.html.php');?>
        <h1 class="page-header">Administrator Page</h1>
        
        <?php
        echo "user id: "; echo $_SESSION['userid']; echo '<br />';
       echo "user email: "; echo $_SESSION['email']; echo '<br />';
        ?>
        <!-- <input id="logoutBtn" class="btn btn-primary" type="submit" value="logout" name="logout" OnClick="logout.php"/> -->
        
        <ul class="nav nav-pills">
            <li role="presentation" id="logoutBtn"><a href="logout.php">Logout</a></li>
        </ul>
 
    </body>
</html>