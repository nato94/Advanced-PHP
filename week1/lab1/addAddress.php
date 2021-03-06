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
            <li><a href="addAddress.php">Add an Address</a></li>
            </div>
        </nav>
        <br />
        <br />
        <br />
   
    <h1>Add an Address!</h1>
        <?php
        
        require_once 'functions/dbconnect.php';
        require_once 'functions/util.php';
        
        
        //validation for zip code
        $zipregex = "/^([0-9]{5})(-[0-9]{4})?$/i";
        //validation for fullname
        $regex = '/^[A-Z0-9 _]*$/'; 
        
        $message;
        
        $name = filter_input(INPUT_POST, 'fullname');
        $email = filter_input(INPUT_POST, 'email');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $birthday = filter_input(INPUT_POST, 'birthday');
        
         
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
            if(empty($name)){
                echo "You didn't enter a name!";
                $validation = "False";
            }
            else if(preg_match($regex, $name)){
                
            }
            else{
                echo "invalid name!";
            }

            if(empty($email)){
                echo "You didn't enter a email!";
                $validation = "False";
            }
            else if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
            }
            else{
                echo "invalid email please try again!";
            }

            if(empty($address)){
                echo "You didn't enter a address!";
                $validation = "False";
            }
            else if(preg_match($regex, $address)){
                
            }
            else{
                echo "Invalid address!";
            }

            if(empty($city)){
                echo "You didn't enter a city!";
                $validation = "False";
            }
            else if(preg_match($regex, $city)){
                
            }
            else {
                echo "invalid city!";
            }

            if(empty($state)){
                echo "you didn't enter a state!";
                $validation = "False";
            }
            else if(preg_match($regex, $state)){
                
            }
            else{
                echo "invalid state!";
            }
            
            if(empty($zip)){
                echo "you didn't enter a zip!";
                $validation = "False";
            }
            else if(preg_match($zipregex, $zip)){
                
            }
            else {
                echo "Invalid zip!";
            }
            
            if(empty($birthday)){
                echo "you didn't enter birthday!";
                $validation = "False";
            }
        }//end of variable validation
        
        
        // if the values are set then check if zip is valid and email is valid
            if(isset($_POST['submit']) && $validation != "False"){
                try {
                    addAddress($name, $email, $address, $city, $state, $zip, $birthday); 
                    echo 'Address Added';
                }
                catch(PDOException $e){
                    echo 'There was an error please check your code.';
                }
            }//end validation if
        ?>
        
        
        <!-- code to input address into database and display message based on success -->
        
      <?php if ( isset($message) ) : ?>
        <p class="bg-success"><?php echo $message; ?></p>
      <?php endif; ?>
        
    <div class="container">
    <h1>Add Address</h1>
    <form action="addAddress.php" method="post">   
       Full Name: <input name="fullname" value="<?php echo $name; ?>" /> <br />
       Email: <input name="email" value="<?php echo $email; ?>" /> <br />
       Address: <input name="address" value="<?php echo $address; ?>" /> <br />
       City: <input name="city" value="<?php echo $city; ?>" /> <br />
       State: <input name="state" value="<?php echo $state; ?>" /> <br />
       Zip: <input name="zip" value="<?php echo $zip;?>" /> <br />
       Birthday: <input type="date" name="birthday" value="<?php echo $birthday; ?>" /> <br />
       <input type="submit" value="submit" name="submit" class="btn btn-primary" />
    </form>
    </div>

        
    </body>
</html>

