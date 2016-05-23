<?php

/**
 * Description of login
 *
 * @author Nato
 */

include('./SuccessMessage.html.php');
include('./ErrorMessage.html.php');

class login {
    //put your code here
    
    

         
     function LoginUser($email, $password){       
        $connection = new db();       
        $db = $connection->dbconnect();
        $query = "SELECT * FROM users WHERE email = :email";
    
                $stmt = $db->prepare($query);
                $stmt->bindValue(':email', $email);
		

        if($stmt->execute() && $stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userPassword = $user['password'];
            //var_dump($userPassword);
            return password_verify($password, $userPassword);      
        }
        else{
            //return $db->exec($query);
            return false;
        }
        
    }//end function login
    
    function get_user_id($values){
        
       $connection = new db();       
        $db = $connection->dbconnect();
        
        $stmt = $db->prepare("SELECT user_id FROM users WHERE email = :email ");

        $stmt->bindValue(':email', $values['email']);
       
        if($stmt->execute() && $stmt->rowCount() > 0 ){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $user['user_id'];
            return $userid;
            
        }
        else{
            $ErrorMessage[] = "Couldn't find user ID";
        }
        return false; 
    }//end get user id
    
    function getMemeText($fileName){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("SELECT * FROM photos WHERE filename = :fileName");
    
        $stmt->bindValue(":fileName", $fileName);
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
        
    }//end get meme text
    
    function getUserMemes($userid){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("SELECT * FROM photos WHERE user_id = :userid");

        $stmt->bindValue(":userid", $userid);
    
    $results = array();
    
       if($stmt->execute() && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
    else{
        $ErrorMessage[]= "Couldn't find user memes!";
    }
    
    //echo $userid;
    return $results;
    
        
    }//end get meme text
    
    function getAllPhotoID(){
        
        $newConnection = new db();
    
        $db = $newConnection->dbconnect();
    
        $stmt = $db->prepare("SELECT * [except user_id, filename, title, topText, bottomText, views, created] FROM photos");
        
        $photo_id = array();
    
       if($stmt->execute() && $stmt->rowCount() > 0) {
            $photo_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
    
    return $photo_id;
    }
    
    function getMemeOfTheDay($photo_id){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("SELECT * FROM photos WHERE photo_id = :photo_id");

        $stmt->bindValue(":photo_id", $photo_id);
        
    $memeOfTheDay = array();
    
       if($stmt->execute() && $stmt->rowCount() > 0) {
           $memeOfTheDay = $stmt->fetchAll(PDO::FETCH_ASSOC);
           return $memeOfTheDay;
       }
    
    return false;
    
        
    }//end get memeOfTheDay
    
    function updateViews($views, $fileName){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("UPDATE photos SET views = :views WHERE filename = :filename");
    //increment views
    $views++;
    
        $stmt->bindValue(":views", $views);
        $stmt->bindValue(":filename", $fileName);

    return $stmt->execute();
    
        
    }//end get memeOfTheDay
    
    
    
    
    
    
}//end login class
