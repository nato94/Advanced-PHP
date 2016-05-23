<?php
require_once './models/autoload.php';
        $folder = './uploads';
        //add new instance of the DirectoryIterator class in order to get extensions and test to see which file is which and address accordingly
        $directory = new DirectoryIterator($folder);
        
        $login = new login();
        
        //$name = $directory->getFilename();
        $path = $directory->getPath();
        
        //$name = $_SESSION['filename'];
        $filename = filter_input(INPUT_GET, 'filename');
        $ErrorMessage = [];
        echo $filename;
        
        
    function deleteMeme($filename){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $query = "DELETE FROM photos WHERE filename = :fileName";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(":fileName", $filename);
    
    $stmt->execute();
    
    return $db->exec($query);
        
    }//end deleteMeme
        
    

//if the file is empty then remove the file
    if(is_file($folder . DIRECTORY_SEPARATOR . $filename)){
        deleteMeme($filename);
        unlink($folder . DIRECTORY_SEPARATOR . $filename);
        $SuccessMessage = "File Succesfully removed!";
    }
else{
    $ErrorMessage[] = "File Doesn't Exist!";
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
          <?php include('./SuccessMessage.html.php'); ?>
          <?php include('./ErrorMessage.html.php'); ?>
        <a href="admin.php" >Back To Admin</a>
        
    </body>
</html>