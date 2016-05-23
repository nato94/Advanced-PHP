<?php

/**
 * Description of login
 *
 * @author Nato
 */
class signupFunction {
    //put your code here
    
    /*
    function signUp($email, $password){
        
        $connection = new db();
        
        $db = $connection->dbconnect();
        
        $query = "INSERT INTO users VALUES (NULL, :email, :password)";
    
            try { 
                $stmt = $db->prepare($query);
                $stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);	
		$rowCount = $stmt->execute();
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }
                
                //echo $query;
    
    return $db->exec($query);
        
    }//end function signup*/
    
     function AddUser($email, $hash, $created){
        
        $connection = new db();
        
        $db = $connection->dbconnect();
        
        $query = "INSERT INTO users (email, password, created) VALUES (:email, :password, :created)";
    
            try { 
                $stmt = $db->prepare($query);
                $stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $hash);	
                $stmt->bindValue(':created', $created);	
		$rowCount = $stmt->execute();
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }
                //echo $query;
    
    return $db->exec($query);
        
    }//end function signup
    
    //function to check if the user is unique in the database and that there are no duplicate users
    function UserValidation($email){
        $connection = new db();
        
        $db = $connection->dbconnect();
        
        $query = "SELECT * FROM users WHERE email = :email";
        
                try { 
                $stmt = $db->prepare($query);
                $stmt->bindValue(':email', $email);
		//$rowCount = $stmt->execute();
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }
                
        if($stmt->execute() && $stmt->rowCount() > 0){
            return false;
        }
        
        return true;    
        
    }//end UserValidation
    
    
    
    
    
}
