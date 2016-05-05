<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <meta charset="UTF-8">
        <title>Assignment 1 - Add an Address</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <style>
            nav li {
                list-style-type: none;
            }
        </style>
    </head>
    <body>
        
        
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
            <li><a href="index.php">Home</a></li>
            <li><a href="addAddress1.php">Add an Address</a></li>
            </div>
        </nav>
        <br />
        <br />
        <br />
   
    <h1>Add an Address!</h1>
        <?php
        //includes and requires for classes and messages
         require_once './models/autoload.php';
         include('./SuccessMessage.html.php'); 
         include('./ErrorMessage.html.php');
         
       $NewAddress = new address(); 
       $database = new db();      
       $database->dbconnect();
       $validate = new validation();
       $util = new util();
       
       /*validation for fullname*/
        $regex = '/^[A-Z0-9 _]*$/';
        /*validation for zip code*/
        $zipregex = "/^([0-9]{5})(-[0-9]{4})?$/i";
        
        
        $name = filter_input(INPUT_POST, 'fullname');
        $email = filter_input(INPUT_POST, 'email');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $birthday = filter_input(INPUT_POST, 'birthday');
        
        $message;
        
         
        //set the values to the variables
        if (isset($_POST['submit'])) {
            //validation for name
            $validation = " ";
            
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $address= $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $birthday = $_POST['birthday'];
           
        } //end of if ISSET POST statement for variable validation before processing 
                 // code to validate email and zip code
                //if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //echo "Valid Email <br />"  
        
        if (isset($_POST['submit'])){
            if(!$validate->notEmpty($name)){
                 $ErrorMessage[] = "You didn't enter your name!";
            }
            
            //validation for email
            if($validate->ValidEmail($email)){
                
            }
            else{
                $ErrorMessage[] = "You didn't enter a valid email!";
            }
            
            //validation for address
            if(!$validate->notEmpty($address)){
                $ErrorMessage[] = "You didn't enter an address!";
            }
            
            //validation for city
            if(!$validate->notEmpty($city)){
               $ErrorMessage[] = "You didn't enter a city!";
            }
            
            //validation for state
            if(!$validate->notEmpty($state)){
                $ErrorMessage[] = "You didn't enter a state!";
            }
            
            //validation for zip code
            if($validate->ValidZip($zip, $zipregex)){
                
            }
            else {
                $ErrorMessage[] = "Invalid zip code!";
            }
            
            //validation to check if birthday is empty
            if($validate->ValidBirthday($birthday)){
                
            }
            else {
                $ErrorMessage[] = "You Forgot to enter a Birthday!";
            }
            
        }//end of variable validation
        
        
        // if the values are set then check if zip is valid and email is valid
            if(isset($_POST['submit']) && !isset($ErrorMessage)){
                try {
                    $NewAddress->addAddress($name, $email, $address, $city, $state, $zip, $birthday); 
                    $SuccessMessage = 'Address Added';
                }
                catch(PDOException $e){
                    $ErrorMessage[] = 'There was an error please check your code.';
                }
            }//end validation if
        ?>
        
        
        <!-- code to input address into database and display message based on success -->
        
        
         <?php  
         include('./SuccessMessage.html.php'); 
         include('./ErrorMessage.html.php');
         ?>
        
    <div class="container">
    <h1>Add Address</h1>
    <form action="addAddress1.php" method="post">   
       Full Name: <input name="fullname" value="<?php echo $name; ?>" /> <br />
       Email: <input name="email" value="<?php echo $email; ?>" /> <br />
       Address: <input name="address" value="<?php echo $address; ?>" /> <br />
       City: <input name="city" value="<?php echo $city; ?>" /> <br />
       State: <input name="state" value="<?php echo $state; ?>" /> <br />
       Zip: <input name="zip" value="<?php echo $zip; ?>" /> <br />
       Birthday: <input type="date" name="birthday" value="<?php echo $birthday; ?>" /> <br />
       <input type="submit" value="submit" name="submit" class="btn btn-primary" />
    </form>
    </div>

        
    </body>
</html>

