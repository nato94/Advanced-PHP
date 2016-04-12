<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorMessage
 *
 * @author Nato
 */

class ErrorMessage extends message {
    //put your code here
    protected $MsgArray = array();
    //protected $key = 0;
    
    public function addMessage($key, $msg) {
       $this->MsgArray[$key] = $msg;
       
    }//end addMessage
    
    public function removeMessage($key) {
        unset($this->MsgArray[$key]);
    }//end removeMessage
    
    public function getAllMessages() {
        
        //returns all the messages in the array
        return $this->MsgArray;
    }//end getAllMessages
    
}
