<?php

$host = "localhost";
$user = "root";
$password = "";
$datbase = "dbtuts";
$conn=mysqli_connect($host,$user,$password);
mysqli_select_db($conn,$datbase);
/*
$host = "192.168.0.100";
$user = "montechr_user";
$password = "j,WMhy=F+g=p";
$datbase = "montechr_dbtuts";
$conn=mysqli_connect($host,$user,$password);
mysqli_select_db($conn,$datbase);*/

try {
    $pdo = new PDO("mysql:host=$host;dbname=$datbase", $user, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    
    
    

?>
