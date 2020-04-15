<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Feedback</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <?php 
        include 'dbconfig.php';
        $feedback_id=$_GET['feedback_id'];
        
        $statement=$pdo->prepare("SELECT * FROM viewings WHERE viewing_id=?");
        $statement->execute([$feedback_id]);
        $fetched_row = $statement->fetch();

        /* $sql_query="SELECT * FROM viewings WHERE viewing_id ='$feedback_id'";
        $result_set=mysqli_query($conn,$sql_query);
        $fetched_row=mysqli_fetch_assoc($result_set);*/

        $feedback=$_POST["feedback"];
        
        if(isset($_POST['add_feedback'])){
            $result=$pdo->prepare("UPDATE viewings SET feedback = ? WHERE viewing_id = ?");
            $success=$result->execute([$feedback,$feedback_id]);
            //$sql = "UPDATE viewings SET feedback = '$feedback' WHERE viewing_id ='$feedback_id'";
            if ($success){
            //  if (mysqli_query($conn, $sql)) {
                ?>
                <script type="text/javascript">
                    window.location.href = 'viewings_database.php';
                </script>
                <?php
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
       }  
       

    ?>
    <body>
        
        <form action="viewing_feedback_handler_lettings.php?feedback_id=<?=$_GET['feedback_id']?>" method="Post">
            <div class="container" style="width:1000px;" align="center">
                <h1 style="text-align: center;">Leave Feedback</h1>
                <div class="table-responsive" id="lettings_table">
                    <table class="table table-bordered">
                        <textarea name="feedback" width="100%" rows="20" cols="400" style="width: 100%;height: 300px;"><?php echo $fetched_row['feedback'];?></textarea>
                        <tr>
                            <td style="text-align:center; ">
                                <button type="submit" name="add_feedback"><strong>Submit</strong></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>    
        </form>
                    
    </body>
</html>

<?php 
        /*examples
        $statement=$pdo->prepare("INSERT * FROM viewings WHERE viewing_id=?");
        $statement->execute([$feedback_id]);
        
        $statement=$pdo->prepare("DELETE FROM viewings WHERE viewing_id=?");
        $statement->execute([$feedback_id]);
        
        $statement=$pdo->prepare("SELECT * FROM viewings WHERE viewing_id=?");
        $statement->execute([$feedback_id]);
        $fetched_row = $statement->fetch();*/

?>
