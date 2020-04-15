<?php

require 'functions.php';
auth();
include_once 'dbconfig.php';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
$query = $_GET['query'];
$min_length = 3;
if(strlen($query) >= $min_length){
    $query = htmlspecialchars($query);
    $query = mysqli_real_escape_string($query);
    $raw_results = mysqli_query("SELECT * FROM users
            WHERE (`first_name` LIKE '%".$query."%') OR (`last_name` LIKE '%".$query."%')") or die(mysql_error());
    if(mysqli_num_rows($raw_results) > 0){
        while($results = mysqli_fetch_array($conn,$raw_results)){
            echo
                "<li>".$results['first_name']." ".$results['last_name']."</li>".
                "<li>"."Contact Phone: ".$results['contact_number']."</li>".
                "<li>"."Email: ".$results['email']."</li>".
                "<li>".$results['bedrooms']." bedroom(s)"."</li>".
                "<li>".$results['tenants']." adult(s) & ".$results['children']." kid(s)"."</li>".
                "<li>"."Areas of Interest: ".$results['areas']."</li>".
                "<li>"."Income a year: ".$results['salary']."</li>";
        }
    }
    else{
        echo "No results";
    }
}
else{
    echo "Minimum length is ".$min_length;
}
?>
</body>
</html>