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
            return false;
        }
    }//end get user id
    
    
}//end login class
