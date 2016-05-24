<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of postHandler
 *
 * @author Nato
 */
class postHandler {
    //put your code here
    
    function getAllPosts(){
        
        $connection = new db();
        
        $db = $connection->dbconnect();
        
        $query = "SELECT * FROM posts;";
        
                $stmt = $db->prepare($query);
                
                $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
        
    }//end function signup
    
}
