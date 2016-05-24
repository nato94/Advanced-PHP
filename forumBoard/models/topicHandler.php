<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploadTopic
 *
 * @author Nato
 */
class topicHandler {
    //put your code here
    
    
    function AddTopic($topic, $created){
        
        $connection = new db();
        
        $db = $connection->dbconnect();
        
        $query = "INSERT INTO topics (subject, created) VALUES (:subject, :created)";
    
            try { 
                $stmt = $db->prepare($query);
                $stmt->bindValue(':subject', $topic);
                $stmt->bindValue(':created', $created);	
		$stmt->execute();
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }
                //echo $query;
    
    return $db->exec($query);
        
    }//end function add topic
    
    function getAllTopics(){
        
        $connection = new db();
        
        $db = $connection->dbconnect();
        
        $query = "SELECT * FROM topics;";

                $stmt = $db->prepare($query);
		
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
        
    }//end function get all topics
    
    
    
    
}
