<?php

require 'functions.php';
auth();

include_once 'dbconfig.php';

function forceHTTPS(){
        $httpsURL = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if( count( $_POST )>0 )
        die( 'Page should be accessed with HTTPS, but a POST Submission has been sent here. Adjust the form to point to '.$httpsURL );
        if( !isset( $_SERVER['HTTPS'] ) || $_SERVER['HTTPS']!=='on' ){
        if( !headers_sent() ){
            header( "Status: 301 Moved Permanently" );
            header( "Location: $httpsURL" );
            exit();
        }else{
            die( '<script type="javascript">document.location.href="'.$httpsURL.'";</script>' );
        }
        }
    }

forceHTTPS();

if(!isset($_SESSION['user_id'])){
    echo "Password incorrect";
    header('location:login.php');
    exit();
}

if (isset($_POST["get_data"])) {
    $id = $_POST["id"];
    $sql = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($sql);
    $row = mysqli_fetch_array($conn,$result);
    echo json_encode($row);
    exit();
}

if(isset($_GET['delete_id']))
{
    $sql_query="DELETE FROM users WHERE user_id=".$_GET['delete_id'];
    mysqli_query($sql_query);
    header("Location: $_SERVER[PHP_SELF]");
}

?>
<!DOCTYPE html >
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>Database</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
        
        <script type="text/javascript">
            function book_viewing(id) {
                window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
            }
        </script>

        <script type="text/javascript">
            function edt_id(id) {
                window.location.href = 'edit_data.php?edit_id=' + id;
            }

            function property_match(id){
                window.location.href= 'property_matcher_lettings.php?property_match=' + id;
            }

            function delete_id(id) {
                if (confirm('Three step confirmation required to prevent accidental deletion')) {
                    if(confirm('Please confirm twice')){
                        if(confirm('Please confirm thrice')){
                    window.location.href = 'index.php?delete_id=' + id;
                        }
                    }
                }
            }
            function book_viewing(id){
                window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
            }

        </script>
    </head>
    <body>
    <?php
/*session_start();*/
include "header.php";
    /*include 'functions.php';
    auth();
    echo $_SESSION['user_id'];*/ ?>

    <div id="body">
        <div id="content">

<?php mysqli_close($conn); ?>
</body>
</html>