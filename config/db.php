<?php

$host = 'localhost';
$username = 'root';
$password =  '';
$db_name = 'blog';

try{
    $conn = mysqli_connect($host, $username, $password, $db_name);
    if(!$conn){
        header('location: views/maintenance.php');
        exit();
    }
}

catch(Exception $ex){
    header('location: views/maintenance.php');
}


