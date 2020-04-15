<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
function auth(){
    if(!isset($_SESSION['user_id'])){
        header('location:login.php');
        exit();
    }
}