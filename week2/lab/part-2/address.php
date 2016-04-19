<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of address
 *
 * @author Nato
 */
class address {
    //put your code here
    
    
    function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

    function addMessage($name, $email, $address, $city, $state, $zip, $birthday) {
        
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    
    $query = "INSERT INTO address VALUES (NULL, :name, :email, :address, :city, :state, :zip, :birthday)";
    
            try { 
                $stmt = $db->prepare($query);
		$stmt->bindValue(':name', $name);	
                $stmt->bindValue(':email', $email);
		$stmt->bindValue(':address', $address);
                $stmt->bindValue(':city', $city);
                $stmt->bindValue(':state', $state);
                $stmt->bindValue(':zip', $zip);
                $stmt->bindValue(':birthday', $birthday);
		$rowCount = $stmt->execute();
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }
                
                //echo $query;
               
    
    return $db->exec($query);
}

    function getAllAddress() {
    
    $newConnection = new db();
    
    $db = $newConnection->dbconnect();
    
    $stmt = $db->prepare("SELECT * FROM address");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}//end function get all addresses

       
    
}
