<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 4</title>
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

        class Filehandler {
             
            

            function upLoad($keyName) {


                // Undefined | Multiple Files | $_FILES Corruption Attack
                // If this request falls under any of them, treat it invalid.
                if (!isset($_FILES[$keyName]['error']) || is_array($_FILES[$keyName]['error'])) {
                    throw new RuntimeException('Invalid parameters.');
                }

                // Check $_FILES['upfile']['error'] value.
                switch ($_FILES[$keyName]['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('No file sent.');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Exceeded filesize limit.');
                    default:
                        throw new RuntimeException('Unknown errors.');
                }

                // You should also check filesize here. 
                if ($_FILES[$keyName]['size'] > 20000000) {
                    throw new RuntimeException('Exceeded filesize limit.');
                }

                // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
                // Check MIME Type by yourself.
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $validExts = array(
                    //'txt' => 'text/plain',
                    //'html' => 'text/html',
                    //'pdf' => 'application/pdf',
                    //'doc' => 'application/msword',
                    //'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    //'xls' => 'application/vnd.ms-excel',
                    //'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif'
                );
                $ext = array_search($finfo->file($_FILES[$keyName]['tmp_name']), $validExts, true);

                if (false === $ext) {
                    throw new RuntimeException('Invalid file format.');
                }

                // You should name it uniquely.
                // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
                // On this example, obtain safe unique name from its binary data.

                $salt = uniqid(mt_rand(), true);
                $fileName = 'img_' . sha1($salt . sha1_file($_FILES[$keyName]['tmp_name']));
                $location = sprintf('./uploads/%s.%s', $fileName, $ext);

                if (!is_dir('./uploads')) {
                    mkdir('./uploads');
                }

                if (!move_uploaded_file($_FILES[$keyName]['tmp_name'], $location)) {
                    throw new RuntimeException('Failed to move uploaded file.');
                }

                return $fileName . '.' . $ext;
            }//end upLoad
            
           function AddPhoto($user_id, $fileName, $title, $topText, $bottomText, $views, $created){
        
            $connection = new db();
        
            $db = $connection->dbconnect();
        
            $query = "INSERT INTO photos (user_id, filename, title, topText, bottomText, views, created) VALUES (:user_id, :filename, :title, :topText, :bottomText, :views, :created)";
    
            try { 
                $stmt = $db->prepare($query);
                $stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':filename', $fileName);	
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':topText', $topText);
                $stmt->bindValue(':bottomText', $bottomText);
                $stmt->bindValue(':views', $views);
                $stmt->bindValue(':created', $created);
		$rowCount = $stmt->execute();
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }
                //echo $query;
    
                return $db->exec($query);
        
            }//end function add photo*/
            
            
            
         }//end filehandler class


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