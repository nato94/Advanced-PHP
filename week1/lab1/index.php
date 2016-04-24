<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <meta charset="UTF-8">
        <title>Assignment 1</title>
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
   
   
    
        <?php
        
        require_once 'functions/dbconnect.php';
        require_once 'functions/util.php';
        
        
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $address = filter_input(INPUT_POST, 'address');
        $city = filter_input(INPUT_POST, 'city');
        $state = filter_input(INPUT_POST, 'state');
        $zip = filter_input(INPUT_POST, 'zip');
        $birthday = filter_input(INPUT_POST, 'birthday');
        
        $addresses = getAllAddress();
        ?>
        
    
        <!-- code to display all addresses in the database -->
        
<?php if ( count($addresses) > 0 ) : ?>
<h1 class="info">Addresses</h1>
<ul class="nav nav-pills nav-stacked">
<?php foreach( $addresses as $key => $values ) : ?>
    <li role="presentation" class="disabled"><a href="#">Address # <?php echo $key + 1 ?> </a><li>
    <li role="presentation" class="disabled"><a href="#">Full Name: <?php echo $values['fullname']; ?> </a><li>
    <li role="presentation" class="disabled"><a href="#">Email: <?php echo $values['email']; ?></a> <li>
    <li role="presentation" class="disabled"><a href="#">Address: <?php echo $values['addressline1']; ?></a> </li>
    <li role="presentation" class="disabled"><a href="#">City: <?php echo $values['city']; ?></a> </li>
    <li role="presentation" class="disabled"><a href="#"> State: <?php echo $values['state']; ?> </a></li>
    <li role="presentation" class="disabled"><a href="#"> Zip: <?php echo $values['zip']; ?></a> </li>
    <li role="presentation" class="disabled"> <a href="#">Birthday: <?php echo $values['birthday']; ?> </a></li>
    <br />
<?php endforeach; ?>
</ul>
<?php endif; ?>
        
    </body>
</html>
