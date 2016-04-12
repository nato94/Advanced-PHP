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
        require_once 'functions/until.php';
        
        
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $birthday = filter_input(INPUT_POST, 'birthday');
        
       
        
        //$pattern = '^\d{5}([\-]?\d{4})?$';
        
        $addresses = getAllAddress();
        
        if (isset($_POST['submit'])) {
            
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $address= $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $birthday = $_POST['birthday'];
            //if( empty($name) ) {
                //$message = 'Sorry Name is Empty';
            //}
            //else if ( empty($email) ) {
                //$message = 'Sorry Email is Empty';
            //} 
            
             // code to validate email and zip code
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Valid Email";
        }
        else {
            echo "Invalid email, please try again";
        }
        
        //if (preg_match($pattern, $zip) === 1) {
          //  echo "Zip Code is Valid";
        //}
        
            if (addAddress($name, $email, $address, $city, $state, $zip, $birthday) ) {
                $message = 'Address Added';
            }
            else {
                $message = 'There was an error! Check your input and try again.';
            }
            
        }//end if PostRequest
        
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
       Zip: <input name="zip" value="<?php echo $zip; ?>" /> <br />
       Birthday: <input type="date" name="birthday" value="<?php echo $birthday; ?>" /> <br />
       <input type="submit" value="submit" name="submit" class="btn btn-primary" />
    </form>
    </div>

        
    </body>
</html>

