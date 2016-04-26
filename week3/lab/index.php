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
        <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="signup.php">Sign-up<span class="sr-only">(current)</span></a></li>
        <!-- if the login session is set and equals to true then display the link for the administrator -->
        <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == "True"): ?>
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
        <h1 class="page-header">Home Page</h1>
        
        <?php
        
        $util = new util();        
        $login = new login();   
        $database = new db();
        //setup database connection
        $database->dbconnect();
        
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        if ($util->isPostRequest()) {
            
        $email = $_POST['email'];
        $password = $_POST['password'];
        //$hash = password_hash($password, PASSWORD_DEFAULT);
            
            
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            echo "Valid Email. <br />";
            
            if($login->LoginUser($email, $password)==true) {
                session_start();
                $_SESSION['logged-in'] = "True";
                echo "logged in. <br />";
                $util->redirect("admin.php");
            }
            else {
                echo "couldn't log in. <br />";
            }
        }//end email validation
        
        else {
            echo "Invalid email, please try again";
        }
       
            //if ($login)  {
              //  $message = 'Address Added';
            //}
            //else {
              //  $message = 'There was an error! Check your input and try again.';
            //}
            
        }//end if PostRequest
        

        
       ?>
   
    <h1>Login</h1>
    <form action="index.php" method="post">   
       Email: <input name="email" placeholder="Email@myemail.com" value="<?php echo $email; ?>" /> <br />
       Password: <input name="password" placeholder="password1" /> <br />
       <input id="loginBtn" type="Submit" value="Submit" name="submit" class="btn btn-primary" />
    </form>
    </div>
 
    </body>
</html>