
<?php

    $database= new mysqli("localhost","root","","carwash", 3307);
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>