<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validation
 *
 * @author Nato
 */
        /*validation for fullname*/
        $regex = '/^[A-Z0-9 _]*$/';
        /*validation for zip code*/
        $zipregex = "/^([0-9]{5})(-[0-9]{4})?$/i";
        
       
        
class validation {
 
    //validation for email
    public function ValidEmail($email) {
        if(!empty($email) && is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) !== false){
            return $email;
        }
    }    
    
    //validation for zip code
    public function ValidZip($zip, $zipregex) {
            if(!empty($zip) && preg_match($zipregex, $zip)){
                return $zip;
            }
    }
    
    //general validation for variables to make sure they're not empty and have valid characters
     public function notEmpty($var) {
         if(!empty($var)){
            return $var;
         }//end if statement
    }  
    
    //validation for birthday to make sure one has been entered
     public function ValidBirthday($birthday) {
         if(!empty($birthday)){
            return $birthday;
         }
        
    }    
    
     
   
   
}//end class
