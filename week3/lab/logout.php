<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//destroy the session and redirect the user to the login page
         session_start();
         session_destroy();
         $_SESSION['logged-in'] = "False";
         include './models/autoload.php' ;
           
         $util = new Util();
         
         $util->redirect('index.php');
