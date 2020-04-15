<?php
require 'functions.php';

function filter($str) {
    global $conn;
    
    $str = htmlspecialchars($str);
    $str = mysqli_real_escape_string($conn, $str);
    return $str;
}

auth();
require 'dbconfig.php';
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

// check if we selected users from prev page
if (!empty($_POST['functionality'])) {
    $_SESSION['user_ids'] = $_POST['functionality'];
}
$user_ids_ar = !empty($_SESSION['user_ids']) ? $_SESSION['user_ids'] : false;
if (!$user_ids_ar) {
    die('no user ids');
}
if (!empty($_POST['function'])) {
    $special_conditions = !empty($_POST['special_conditions']) ? $_POST['special_conditions'] : false; 
    $user_ids = join(',', $user_ids_ar);
    
    $init_result = mysqli_query($conn, "SELECT * FROM users WHERE user_id IN ($user_ids)");
    while($row=mysqli_fetch_assoc($init_result)){
        $new_conditions = $row['special_conditions'] .= $special_conditions;
        $new_conditions = filter($new_conditions);
        mysqli_query($conn, "UPDATE users SET special_conditions = '$new_conditions' WHERE user_id='".$row['user_id']."'");
        //echo $row['user_id']. ' - ' . $new_conditions . '<br>';
    }
    unset($_SESSION['user_ids']);
}
    if(isset($_POST['functionality_option']) && $_POST['functionality_option'] == 'add_to_notes') { ?>
    
    <form action="\lettings_data.php" method="post">
        <input type="hidden" name="function" value="1">
        <textarea width="100%" rows="20" cols="40" name="special_conditions" placeholder="These condition will be added on top of your notes" style="width: 100%;height: 300px;"></textarea>
        <button type="submit" name="submit_update">
           Update
        </button>
    </form>
    <?php } elseif(isset($_POST['functionality_option']) && $_POST['functionality_option'] == 'delete'){?>
        <form action="/lettings_data.php" method="post">
            Are you sure you want to delete these applicant?<br>
            <?php
                foreach($user_ids_ar as $ID){
                    $delete_result = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$ID);
                     while($row=mysqli_fetch_assoc($delete_result)){
                        echo $row['first_name'].' ' .$row['last_name'].' -> looking for  ' .$row['bedrooms'].' bedroom for £' .$row['maximum_budget']."<br>";
                     }
                }
            ?>
            <button type="submit" name="submit_delete" >
                Delete
            </button>
        
            <?php
                if(isset($_POST["submit_delete"]))
                    {
                    echo "<script type='text/javascript'>alert(\"DELETED\");</script>";
                }
            ?>
        </form>
    ?>
    <?php
        $user_ids_ar = !empty($_SESSION['user_ids']) ? $_SESSION['user_ids'] : false;
        if (!$user_ids_ar) 
        {
            die('no user ids');
        }
        
        if (!empty($_POST['function'])) 
        {
            $special_conditions = !empty($_POST['special_conditions']) ? $_POST['special_conditions'] : false; 
            $user_ids = join(',', $user_ids_ar);
            $init_result = mysqli_query($conn, "SELECT * FROM users WHERE user_id IN ($user_ids)");
            while($row=mysqli_fetch_assoc($init_result))
            {
                echo $row['user_id'];
            }

            unset($_SESSION['user_ids']);
        }
    }elseif(isset($_POST['functionality_option']) && $_POST['functionality_option'] == 'email'){
        $init_result = mysqli_query($conn, "SELECT * FROM users WHERE user_id IN ($user_ids)");
        while($row=mysqli_fetch_assoc($init_result)){
            echo $row['user_id'];
        }
    }elseif(isset($_POST['functionality_option']) && $_POST['functionality_option'] == 'text'){
        $init_result = mysqli_query($conn, "SELECT * FROM users WHERE user_id IN ($user_ids)");
        while($row=mysqli_fetch_assoc($init_result)){
            echo $row['user_id'];
    }
    }?>