<?php

/*
 * @author Nato
 */
class util {
    //put your code here
    public function isPostRequest() {
       return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
   }
   
   public function isGetRequest() {
       return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
   }
   
    public function redirect($page, array $params = array()) {
        header('Location: ' . $this->createLink($page, $params));
        die();
    }
    
    public function createLink($page, array $params = array()) {        
        return $page . '?' .http_build_query($params);
    }
    
    
}//end class util
