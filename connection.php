<?php

    $conn= new mysqli('localhost','root','','login');

    if($conn->connect_error){

        die('Connection Failed : '.$conn->connect_error);

    }
    
?>