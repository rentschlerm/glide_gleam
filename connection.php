<?php

    $database= new mysqli("localhost","root","","carwash");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>