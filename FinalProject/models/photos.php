<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class photos {
    //put your code here
    
    function AddPhoto($user_id, $fileName, $title){
        
    $connection = new db();
        
    $db = $connection->dbconnect();
        
    $stmt = $db->prepare("INSERT INTO photos set user_id = :user_id, filename = :filename, title = :title, created = now()");

                $binds = array(
                    ":user_id" => $user_id,
                    ":filename" => $fileName,
                    ":title" => $title
                );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                return true;
            }
            else{
                return false;
            }
        
    }//end function add photo*/
    
    function getAllPhotos(){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("SELECT * FROM photos");

    
    $results = array();
    
       if($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
    
    //echo $userid;
    return $results;
    }//end getAllPhotos
    

    
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
 
    }//end get user memes
    
    
    function getMemeOfTheDay(){
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("SELECT * FROM photos");
        
    $memeOfTheDay = array();
    
       if($stmt->execute() && $stmt->rowCount() > 0) {
           $memeOfTheDay = $stmt->fetchAll(PDO::FETCH_ASSOC);
           $max = $stmt->rowCount() - 1;
           $rand = rand(0, $max);
           $momentMeme = $memeOfTheDay[$rand];
           return $momentMeme;
           
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
}
