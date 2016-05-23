<!DOCTYPE html>
<html>
    <head>
        <title>Final Project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    </head>
    <body>
        <?php
        /*
         * make sure php_fileinfo.dll extension is enable in php.ini
         */
       //code to get the varaibles needed for the upload of the meme pic 
        require_once './models/autoload.php';
        $values = filter_input_array(INPUT_POST);
        $util = new util();
        session_start();
        
            if($util->isPostRequest()){
                //if the post is set then get the variables
                //$login->get_user_id($values);
  
                $topText = $values["topText"];
                $bottomText = $values["bottomText"];
                $title = $values['memeTitle'];
                $user_id = $_SESSION['userid'];
                $views = 0;
                $created = date("Y-m-d H:i:s");
            }//end get request*/

        $filehandler = new Filehandler();

        try {
            $fileName = $filehandler->upLoad("file");
            $filehandler->AddPhoto($user_id, $fileName, $title, $topText, $bottomText, $views, $created);

        } catch (RuntimeException $e) {
            $error = $e->getMessage();
        }
        
        
   
        ?>
        

        <?php if ( isset($fileName) ) : ?>
            <h2><?php echo $fileName; ?> is uploaded successfully.</h2>
        <?php else: ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
            <a href="index.php" >Go Back Home</a>
            <!-- <a href="viewFiles.php" >View Files</a> -->
    </body>
</html>