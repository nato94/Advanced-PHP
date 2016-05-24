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
        
    </head>
    <body>
        
        <?php
         session_start();
        //call autoload class to load all classes for the page
        require_once './models/autoload.php';
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
        <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="sign-in.php">Sign-in<span class="sr-only">(current)</span></a></li>
        <li><a href="signup.php">Sign-up<span class="sr-only">(current)</span></a></li>
        <!-- if the login session is set and equals to true then display the link for the administrator -->
        <?php if(isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true): ?>
        <li><a href="admin.php">Administrator<span class="sr-only">(current)</span></a></li>
        <li><a href="uploadPage2.php">Upload<span class="sr-only">(current)</span></a></li>
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
        <h1 class="page-header">Welcome to Dank MEME's!</h1>

        
        <?php
        
       //initialize classes and variables to use
        $util = new util(); 
        $login = new login();
        $photos = new photos();
         $count = 1;
         $photo_id = array();
         $values = filter_input_array(INPUT_POST);
                
         //if the user id is set then insert it into the variable
                if(isset($_SESSION['userid'])){
                    $user_id = $_SESSION['userid'];
                }

        
        ?>

        
        <!-- php code for getting the meme of the moment -->
            <?php 
            
            $directory = new DirectoryIterator("./uploads");
                $specialMeme = $photos->getMemeOfTheDay();
        
               //set variables to database data for the meme of the moment
               $specialMemeTitle = $specialMeme['title'];
               $specialMemeName = $specialMeme['filename']; 
               $specialMemeDate = $specialMeme['created'];
               $specialMemeViews = $specialMeme['views'];
               $specialMemeSize = $directory->getSize();
               
               ?>
                 
        <?php if(isset($specialMemeName)): ?>
           
       
                 <!-- file div to hold the meme of the moment and the links necessary -->
                 <div id="fileDiv">
                     <h1>Meme Of The Moment!</h1>
                <h3><?php echo "Title: "; echo $specialMemeTitle; ?></h3>
                <p>uploaded on <?php echo $specialMemeDate; ?></p>
                <p>File Size: <?php echo $specialMemeSize; ?> byte's</p>      
                
                    <img width="40%" height="40%" src="<?php echo "uploads/$specialMemeName";  ?>" />

            </div> <!-- end file div -->
            
             <a href="fileDetails.php?fileName=<?php echo $specialMemeName?>&fileSize=<?php echo $specialMemeSize ?>&fileDate=<?php echo $specialMemeDate ?>&fileTopText=<?php echo $specialMemeTopText ?>&fileBottomText=<?php echo $specialMemeBottomText ?>&views=<?php echo $specialMemeViews ?>&title=<?php echo $specialMemeTitle ?>" class="btn btn-default">View File</a>
             <a href="mail.php" class="btn btn-default">Email Meme</a>
             <a
                href="http://twitter.com/share?text=The%20Dankest%20of%20Memes&url=http://localhost/Assignment1/FinalProject/index.php"
                target="_blank"
                title="Click to post to Twitter"><img src="./CSS/tweet_button.jpg">
                </a>
             
            <?php  
            else:
                $ErrorMessage[] = "No Meme's found!";
            endif;
            ?>
            
            
        <?php
        //code to display the memes found in the database 
                    $memeText = $photos->getAllPhotos();
         
               foreach( $memeText as $key => $results ):    
                   
                    ?>
        
            <?php 
            //set variables to the database values for all the memes
            
                $fileName = $results['filename'];
                $fileDate = $results['created'];
                $fileSize = $directory->getSize();
                $views = $results['views'];
                $title = $results['title'];

            ?>
       
            <div id="fileDiv">
                <h3><?php echo "Title: "; echo $title; ?></h3>
                <p>uploaded on <?php echo $fileDate; ?></p>
                <p>This file is <?php echo $fileSize; ?> byte's</p>
                      
                
                    <img width="40%" height="40%" src="<?php echo  "uploads/$fileName";  ?>" />
                    
                    
            </div> <!-- end file div -->
                
               <a href="fileDetails.php?fileName=<?php echo $fileName?>&fileSize=<?php echo $fileSize ?>&fileDate=<?php echo $fileDate ?>&fileTopText=<?php echo $fileTopText ?>&fileBottomText=<?php echo $fileBottomText ?>&views=<?php echo $views ?>&title=<?php echo $title ?>" class="btn btn-default">View File</a>
               <a href="mail.php" class="btn btn-default">Email Meme</a>
               <a
                href="http://twitter.com/share?text=The%20Dankest%20of%20Memes&url=http://localhost/Assignment1/FinalProject/index.php"
                target="_blank"
                title="Click to post to Twitter"><img src="./CSS/tweet_button.jpg">
                </a>
               
                <?php $count++;?>
        <?php endforeach; 

               include('./SuccessMessage.html.php');
               include('./ErrorMessage.html.php');
                
               ?>
            
                
    
    
    </div>
 
    </body>
</html>