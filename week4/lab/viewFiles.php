<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 4</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
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
        <li class="active"><a href="viewFiles.php">View Files<span class="sr-only">(current)</span></a></li>
        <li><span class="sr-only">(current)</span></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        <br />
        <br />
        
        <div class="container">
        <h1 class="page-header">View Files</h1>
        
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        // put your code here
        //DIRECTORY_SEPARATOR 

        $folder = './uploads';
        
        //add new instance of the DirectoryIterator class in order to get extensions and test to see which file is which and address accordingly
        $directory = new DirectoryIterator($folder);
        
        // $match = [];
        
        $count = 1;
        session_start();
         
        //var_dump($directory);
        ?>

        
        <?php foreach ($directory as $file) :?>  
        <?php
                    $fileName = $file->getFilename();
                    $fileSize = $file->getSize();
                    $fileDate = date("l F j, Y, g:i a", $file->getMTime());
                    $fileExt = $file->getExtension();
                    $filePath = $file->getPathname();
                    
                    ?>
        
            <?php if ( is_file($folder . DIRECTORY_SEPARATOR . $file) ) : ?>
                <?php if ($fileExt == 'jpg' || $fileExt == 'png' || $fileExt == 'gif' || $fileExt == 'txt' || $fileExt == 'pdf' || $fileExt == 'doc' || $fileExt =='docx' || $fileExt == 'xls' ||  $fileExt == 'xlsx' ||  $fileExt == 'html') : ?>
                <h3><?php echo "File #: $count $file"; ?></h3>
                <p>uploaded on <?php echo date("l F j, Y, g:i a", $file->getMTime()); ?></p>
                <p>This file is <?php echo $file->getSize(); ?> byte's</p>
            <div id="fileDiv">
                        
                    <?php if($fileExt == "jpg" ): ?>
                    <img width="40%" height="40%" src="<?php echo $filePath;  ?>" />
                <?php endif;?>
                
                <?php if($fileExt == "txt" ): ?>    
                   <?php $text = file_get_contents($filePath);?>
                    <textarea rows="4" cols="50"><?php echo $text;?></textarea>
                 <?php endif;?>
                
                <?php if($fileExt == "pdf" ): ?>
                    <iframe width='60%' height='100%' src='<?php echo $filePath;  ?>' frameborder='0' allowfullscreen></iframe>
                <?php endif; ?><br>
                
                <?php if($fileExt == 'doc' || $fileExt =='docx' || $fileExt == 'xls' ||  $fileExt == 'xlsx' ||  $fileExt == 'html'): ?>
                    <a href="<?php echo $filePath ?>">click to download</a>
                <?php endif; ?><br>
                    
            </div> <!-- end file div -->
                    
                    
                <a href="delete.php?filename=<?php echo $file->getFilename(); ?>" class="btn btn-default">Delete File</a> 
                <a href="fileDetails.php?fileName=<?php echo $fileName?>&fileSize=<?php echo $fileSize ?>&fileDate=<?php echo $fileDate ?>&fileExt=<?php echo $fileExt ?>" class="btn btn-default">View File</a>
                <?php $count++; endif;?>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </body>
</html>