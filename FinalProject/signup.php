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
    </head>
    <body>
        
        <?php
        //call autoload class to load all classes for the page
        require_once './models/autoload.php';
        session_start();
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
        <!-- if the login session is set and equals to true then display the link for the administrator -->
        <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true): ?>
        <li class="active"><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <li role="presentation" id="logoutBtn"><a href="logout.php">Logout</a></li>
        <li><a href="uploadPage.php">Upload<span class="sr-only">(current)</span></a></li>
        <?php endif; ?>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        <div class="container">
        <h1 class="page-header">Sign-Up Page</h1>
        
        
        <?php
       
        
       $signUp = new signupFunction();
       
       $util = new util();
       
       $database = new db();
       $login = new login();
       
       $database->dbconnect();
       $values = filter_input_array(INPUT_POST);
        
       $email = $values['email'];
       $password = $values['password'];
        
        if ($util->isPostRequest()) {
            
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $created = date("Y-m-d H:i:s");
            
        }//end if PostRequest
      
       
       
            
        if($util->isPostRequest() && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //feedback for email validation
            echo "Valid Email <br />";
            //if statement to check user availability
            if($signUp->UserValidation($email) == true){
                try  {
                    $signUp->AddUser($email, $hash, $created);
                    echo "User Added <br />";
                }
                catch(PDOException $e) {
                    echo 'There was an error! Check your input and try again. <br />';
                }
            }//end user validation
            else{
                echo "I'm sorry this user already exits!";
            }
            
        }//end if email filter
           
       
        
       ?>
        
        
    <h1>Sign-up</h1>
    <form action="signup.php" method="POST">   
       Email: <input name="email" placeholder="Email@myemail.com" value="<?php echo $email; ?>" /> <br />
       Password: <input name="password" placeholder="Password1" /> <br />
       <input type="submit" value="Sign-up" name="signup" class="btn btn-primary" />
    </form>
    </div>

 
    </div><!-- end of container div -->
    </body>
</html>