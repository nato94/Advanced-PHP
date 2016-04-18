<?php

/**
 * A method to check if a Post request has been made.
 *    
 * @return boolean
 * 
 */


function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function addMessage($name, $email, $address, $city, $state, $zip, $birthday) {
    
    $db = dbconnect();
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
    
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM address");
    
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $results;
}

