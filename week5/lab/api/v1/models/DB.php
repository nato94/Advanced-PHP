<?php

class DB {
    //class that holds functions to get, set db configs and connect to the db
    protected $db = null;
    protected $dbConfig = array(); // this will allow you to set variables
    
    public function __construct($dbConfig) {
        $this->setDbConfig($dbConfig); //will set the database
    }
    
    protected function getDbConfig() {
        return $this->dbConfig;
    }

    protected function setDbConfig($dbConfig) {
        $this->dbConfig = $dbConfig;// setting the dbConfig values to the dbconfig array
    }
         
    public function getDB() { 
        if ( null != $this->db ) {
            return $this->db;//checking if the db value is null
        }
        try {
            $config = $this->getDbConfig();//getting the values in array
            $this->db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);//getting the pass user and dns from config
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//Enables or disables emulation of prepared statements
        } catch (Exception $ex) {          
           $this->closeDB();
           throw new Exception($ex->getMessage());// setting catch 
        }
        return $this->db; //returns the connection        
    }
    
     public function closeDB() {        
        $this->db = null;//closing the db        
    }
    
    
}
