
<?php
require 'functions.php';

// move this into functions
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
    
    $init_result = mysqli_query($conn, "SELECT * FROM sales_applicant WHERE id IN ($user_ids)");
    while($row=mysqli_fetch_assoc($init_result)){
        $new_conditions = $row['special_conditions'] .= $special_conditions;
        $new_conditions = filter($new_conditions);
        mysqli_query($conn, "UPDATE sales_applicant SET special_conditions = '$new_conditions' WHERE id='".$row['id']."'");
        
    }
    unset($_SESSION['user_ids']);
}

  
    
    ?>
    <form action="?" method="post">
        <input type="hidden" name="function" value="1">
<textarea width="100%" rows="20" cols="40" name="special_conditions"
placeholder="These condition will be added on top of your notes" style="width: 100%;height: 300px;">

------------
</textarea>
        <button type="submit" name="btn-update" onclick="redirect()">
           Update
        </button>
    </form>
    
    <script>
    if(isset($_POST['btn-update']))
    {
        header("Location: sales_data.php");
    }
    </script>