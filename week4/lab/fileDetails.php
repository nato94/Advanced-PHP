<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
        $folder = './uploads';
        //add new instance of the DirectoryIterator class in order to get extensions and test to see which file is which and address accordingly
        $directory = new DirectoryIterator($folder);
        
        $fileName = filter_input(INPUT_GET, 'fileName');
        $fileSize = filter_input(INPUT_GET, 'fileSize');
        $fileDate = filter_input(INPUT_GET, 'fileDate');
        $fileExt = filter_input(INPUT_GET, 'fileExt');
        $ErrorMessage = [];
        
//if the file is empty then remove the file
if (!is_file($folder . DIRECTORY_SEPARATOR . $fileName)){
    $ErrorMessage[] = "File Not Found!";
}

?>
<!Doctype html>
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
        
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Assignment 4</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="viewFiles.php">View Files<span class="sr-only">(current)</span></a></li>
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
          ?>
        
        <p>Filename: <?php echo "./uploads/$fileName";?></p>
        <p>uploaded on <?php echo $fileDate; ?></p>
        <p>This file is <?php echo $fileSize; ?> byte's</p>
            <div id="fileDiv">
                        
                <?php if($fileExt == 'jpg' || $fileExt == 'png' || $fileExt == 'gif'): ?>
                    <img src="<?php echo "./uploads/$fileName";  ?>" width='50%' height='50%' />
                <?php endif;?>
                    
                
                <?php if($fileExt == "txt"): ?>    
                    <?php $text = file_get_contents("./uploads/$fileName");?>
                    <textarea rows="4" cols="50"><?php echo $text;?></textarea>
                 <?php endif;?>
                    
                
                <?php if($fileExt == "pdf"): ?>
                  <iframe src='<?php echo "./uploads/$fileName"; ?>' width='100%' height='700' frameborder='4' allowfullscreen></iframe>
                <?php endif; ?><br>
                
                <?php if($fileExt == 'doc' || $fileExt =='docx' || $fileExt == 'xls' ||  $fileExt == 'xlsx' ||  $fileExt == 'html'): ?>
                    <object src="'+<?php echo "./uploads/$fileName" ?>+'"><embed src="'+<?php "./uploads/$fileName" ?>+'"></embed></object>
                <?php endif; ?><br>
                  
            
            </div> <!-- end file div -->
            
        </div> <!-- end container div  -->
        
    </body>
</html>

