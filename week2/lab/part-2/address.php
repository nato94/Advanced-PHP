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
                $stmt = $newConnection->dbconnect()->prepare($query);
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
                
                if (isset($_POST['submit'])) {
            
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $address= $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $birthday = $_POST['birthday'];
            //if( empty($name) ) {
                //$message = 'Sorry Name is Empty';
            //}
            //else if ( empty($email) ) {
                //$message = 'Sorry Email is Empty';
            //} 
            
             // code to validate email and zip code
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Valid Email";
        }
        else {
            echo "Invalid email, please try again";
        }
        
        //if (preg_match($pattern, $zip) === 1) {
          //  echo "Zip Code is Valid";
        //}
        
            if (addAddress($name, $email, $address, $city, $state, $zip, $birthday) ) {
                $message = 'Address Added';
            }
            else {
                $message = 'There was an error! Check your input and try again.';
            }
            
        }//end if PostRequest
    
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
