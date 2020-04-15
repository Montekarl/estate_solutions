<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <?php/*
        if ($_SERVER['HTTPS'] != "on") {
        $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        header("Location: $url");
        exit;
    }*/
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: 1px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<?php
    session_start();
    include_once("dbconfig.php");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_SESSION['user_id'])){
        header('location:index.php');
        exit();
    }
    $username=isset($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : false;
    $password=isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : false;
    $passwordhashed = hash('sha512',$password);
    if ($username&&$password) {
        $query=mysqli_query($conn,"SELECT * FROM login_users WHERE username='$username' AND password='$passwordhashed'");
        $user=mysqli_fetch_assoc($query);
        if ($user) {
            $_SESSION['user_id']=$user['id'];
            header('location:index.php');
            exit();
        } else {
           
             if (mysqli_connect_errno())
                {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
        }
    }
?>



<form action="login.php" method="post">

    <div class="imgcontainer" >
        <img src="logo.png" alt="Avatar" style="width:350px;height:100px">
    </div>

    <div class="container" style="text-align:center">
       
        <input type="text" placeholder="Enter Username" name="username" style="width:250px" required><br>
      
        <input type="password" placeholder="Enter Password" name="password" style="width:250px" required><br>

        <button type="submit" style="width:150px">Login</button>

    </div>

    
</form>

<?php
mysqli_close($conn);
?>

</body>
</html>
