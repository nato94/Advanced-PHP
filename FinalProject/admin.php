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
            #fileDiv {
                position: relative;
                left: 300px;
            }
             
        </style>
    </head>
    <body>
        
        <?php
        //call autoload class to load all classes for the page
        require_once './models/autoload.php';
        session_start();
        $login = new login();
        
        
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
        <li class="active"><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <?php endif; ?>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        <?php include('./SuccessMessage.html.php');?>
        <?php include('./ErrorMessage.html.php');?>
        <h1 class="page-header">Administrator Page</h1>
        
        <?php
            echo "user id: "; echo $_SESSION['userid']; echo '<br />';
        ?>
        
        <!-- <input id="logoutBtn" class="btn btn-primary" type="submit" value="logout" name="logout" OnClick="logout.php"/> -->
        
        <ul class="nav nav-pills">
            <li role="presentation" id="logoutBtn"><a href="logout.php">Logout</a></li>
        </ul>
        
        <?php
        
        
        $userMemes = $login->getUserMemes($_SESSION['userid']);
        $folder = './uploads';
        
        //add new instance of the DirectoryIterator class in order to get extensions and test to see which file is which and address accordingly
        $directory = new DirectoryIterator($folder);
         
       
                    //$fileDate = date("l F j, Y, g:i a", $directory->getMTime());
                    $fileExt = $directory->getExtension();
                    $fileSize = $directory->getSize();
                    
             
                   
                    
               foreach($userMemes as $key => $results ):    
                   
                   $title = $results['title'];
                   $fileName = $results['filename'];
                   $fileTopText = $results['topText'];
                   $fileBottomText = $results['bottomText'];
                   $fileDate = $results['created'];
                   $views = $results['views'];
               
                   ?>
        <br/>
         <div id="fileDiv">
                <h3><?php echo "Title: "; echo $results['title']; ?></h3>
                <p>uploaded on <?php echo $fileDate; ?></p>
           
                
                      
               <!-- if the file has the right ext display the user memes --> 
               
                <p id="memeTopText">
                    <?php echo $results['topText']; ?>
                </p>
                    <img width="50%" height="50%" src="<?php echo "uploads/$fileName";  ?>" />
                <p id="memeBottomText">
                    <?php echo $results['bottomText']; ?>
                </p>
                <a href="delete.php?filename=<?php echo $fileName; ?>" class="btn btn-default">Delete File</a> 
                <a href="fileDetails.php?fileName=<?php echo $fileName?>&fileSize=<?php echo $fileSize ?>&fileDate=<?php echo $fileDate ?>&fileTopText=<?php echo $fileTopText ?>&fileBottomText=<?php echo $fileBottomText ?>&views=<?php echo $views ?>&title=<?php echo $title ?>" class="btn btn-default">View File</a>

                    
            </div> <!-- end file div -->
        
               <?php endforeach; ?>
    </body>
</html>