<?php

/**
 * Description of login
 *
 * @author Nato
 */
class login {
    //put your code here
    

     function LoginUser($email, $password){       
        $connection = new db();       
        $db = $connection->dbconnect();
        $query = "SELECT * FROM users WHERE email = :email";
    
            try { 
                $stmt = $db->prepare($query);
                $stmt->bindValue(':email', $email);
                //$stmt->bindValue(':password', $password);
                //$rowcount = $stmt->execute();
                //$user = $stmt->fetch(PDO::FETCH_ASSOC);
                //echo $rowCount['password'];
                //echo $user['password'];
		}

		catch (PDOException $e) {
			exit('sql sucks');
                }      
                 
        if($stmt->execute() && $stmt->rowCount() > 0){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userPassword = $user['password'];
            var_dump($userPassword);
            return password_verify($password, $userPassword);      
        }
        else{
            //return $db->exec($query);
            return false;
        }
        
    }//end function login
    
}//end login class
