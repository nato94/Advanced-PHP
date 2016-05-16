<?php

class CorpResource extends DB implements IRestModel {
   
    function __construct() {
        //calls new instance of the util class
        $util = new Util();
        //sets the db configs based on the configs made in the util class
        $this->setDbConfig($util->getDBConfig());              
    }
    
    //function to get single corp by id
    public function getCorp($id) {
        $stmt = $this->getDb()->prepare("SELECT * FROM corps where id = :id");
        $binds = array(
            ":id" => $id
        );

        $results = array(); 
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        return $results;
                
    }
    
    //function to get all the corps in the database
    public function getAllCorps() {
        $stmt = $this->getDb()->prepare("SELECT * FROM corps");
        $results = array();      
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    //function to add a new corp to the database
    public function post($serverData) {
        /* note you should validate before adding to the data base */
        $stmt = $this->getDb()->prepare("INSERT INTO corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location");
        
        $binds = array(
            ":corp" => $serverData['corp'],
            ":incorp_dt" => $serverData['incorp_dt'],
            ":email" => $serverData['email'],
            ":owner" => $serverData['owner'],
            ":phone" => $serverData['phone'],
            ":location" => $serverData['location']
        );

        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            return true;
        } 
        return false;
    }
    
    //public function to update a corp by id 
    public function update($id,$serverData) {
        $stmt = $this->getDb()->prepare("UPDATE corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, owner = :owner, phone = :phone, location = :location WHERE id = :id");
        $binds = array(
            ":id"=>$id,
            ":corp" => $serverData['corp'],
            ":incorp_dt" => $serverData['incorp_dt'],
            ":email" => $serverData['email'],
            ":owner" => $serverData['owner'],
            ":phone" => $serverData['phone'],
            ":location" => $serverData['location']
        );
        $results = array();
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
           $results = $stmt->rowCount();
        }
        
        return $results; 
    }
    
    //function to delete a corp by id
    public function delete($id) {
        $stmt = $this->getDb()->prepare("DELETE FROM corps WHERE id = :id");
        $binds = array(
            ":id" => $id
        );
        $results = array();
        
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
           $results = $stmt->rowCount();
        }
        
        return $results;  
    }
    
}