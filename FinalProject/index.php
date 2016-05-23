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
        <h1 class="page-header">Welcome to Dank MEME's!</h1>
        
        <?php
       //initialize classes and variables to use
        $util = new util(); 
        $login = new login();
         $count = 1;
         $photo_id = array();
         $folder = './uploads';
         $values = filter_input_array(INPUT_POST);
                
         //if the user id is set then insert it into the variable
                if(isset($_SESSION['userid'])){
                    $user_id = $_SESSION['userid'];
                }
include('./SuccessMessage.html.php');
include('./ErrorMessage.html.php');
        

        //add new instance of the DirectoryIterator class in order to get extensions and test to see which file is which and address accordingly
        $directory = new DirectoryIterator($folder);

       
        ?>

        
        
        <?php foreach ($directory as $file) :?>  
        
        <?php
        //code to display the memes found in the database 
        
                    $fileName = $file->getFilename();
                    $fileSize = $file->getSize();
                    $fileDate = date("l F j, Y, g:i a", $file->getMTime());
                    $filePath = $file->getPathname();
                    $memeText = $login->getMemeText($fileName);
                    
                   
                    
               foreach( $memeText as $key => $results ):    
                   
                    ?>
        
            <?php 
            //set variables to the database values for all the memes
                $fileTopText = $results['topText'];
                $fileBottomText = $results['bottomText']; 
                $photo_id[$count-1] = $results['photo_id'];
                $views = $results['views'];
                $title = $results['title'];


            ?>
        
            <?php if ( is_file($folder . DIRECTORY_SEPARATOR . $file) ) : ?>
                
            <div id="fileDiv">
                <h3><?php echo "Title: "; echo $results['title']; ?></h3>
                <p>uploaded on <?php echo date("l F j, Y, g:i a", $file->getMTime()); ?></p>
                <p>This file is <?php echo $file->getSize(); ?> byte's</p>
                      
                
                <p id="memeTopText">
                    <?php echo $results['topText']; ?>
                </p>
                    <img width="40%" height="40%" src="<?php echo $filePath;  ?>" />
                <p id="memeBottomText">
                    <?php echo $results['bottomText']; ?>
                </p>
                    
                    
                    
            </div> <!-- end file div -->
           
                    
                    
                
               <a href="fileDetails.php?fileName=<?php echo $fileName?>&fileSize=<?php echo $fileSize ?>&fileDate=<?php echo $fileDate ?>&fileTopText=<?php echo $fileTopText ?>&fileBottomText=<?php echo $fileBottomText ?>&views=<?php echo $views ?>&title=<?php echo $title ?>" class="btn btn-default">View File</a>

                <?php $count++; endif;?>
        <?php endforeach; ?>
        <?php endforeach; ?>
               
            <?php    
                $i = rand(0, $count-1);
                
                
                while($login->getMemeOfTheDay($photo_id[$i]) == false){
                    //$photo = $photo_id[$i];
                    
                    $i = rand(0, $count-1);
                }

                //code for the meme of the moment
                $memeOfTheDay = $login->getMemeOfTheDay($photo_id[$i]);
                foreach( $memeOfTheDay as $key => $specialMeme ):?>
               
               <?php 
               //set variables to database data for the meme of the moment
               $specialMemeTitle = $specialMeme['title'];
               $specialMemeName = $specialMeme['filename']; 
               $specialMemeDate = $specialMeme['created'];
               $specialMemeViews = $specialMeme['views'];
               $specialMemeTopText = $specialMeme['topText'];
               $specialMemeBottomText = $specialMeme['bottomText'];
               $specialMemeSize = $file->getSize();
               
               ?>
                        
                 <!-- file div to hold the meme of the moment and the links necessary -->
                 <div id="fileDiv">
                     <h1>Meme Of The Moment!</h1>
                <h3><?php echo "Title: "; echo $specialMemeTitle; ?></h3>
                <p>uploaded on <?php echo $specialMemeDate; ?></p>
                <p>File Size: <?php echo $specialMemeSize; ?> byte's</p>      
                
                <p id="memeTopText">
                    <?php echo $specialMemeTopText; ?>
                </p>
                    <img width="40%" height="40%" src="<?php echo "uploads/$specialMemeName";  ?>" />
                <p id="memeBottomText">
                    <?php echo $specialMemeBottomText; ?>
                </p>
                <a href="fileDetails.php?fileName=<?php echo $specialMemeName?>&fileSize=<?php echo $specialMemeSize ?>&fileDate=<?php echo $specialMemeDate ?>&fileTopText=<?php echo $specialMemeTopText ?>&fileBottomText=<?php echo $specialMemeBottomText ?>&views=<?php echo $specialMemeViews ?>&title=<?php echo $specialMemeTitle ?>" class="btn btn-default">View File</a>
                    
                    
            </div> <!-- end file div -->
            
            <?php endforeach; ?>
                
    
    
    </div>
 
    </body>
</html>