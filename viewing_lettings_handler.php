<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Database - Add Property</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>
    <?php
        require 'functions.php';
        auth();
        include_once 'dbconfig.php';
    ?>
    <?php
        if(isset($_POST['add_viewing'])){
        $user_id=$_POST['user_id'];
        $viewing_date=$_POST['viewing_date'];
        $viewing_time=$_POST['viewing_time'];
        $negotiator=$_POST['negotiator'];
        $meeting_place=$_POST['meeting_place'];
        $sales_ID='';
        $type='lettings';
        
        if(!empty($_POST['Address']))
            {
                $insert_viewing_sql = "INSERT INTO viewings VALUES (null, '$user_id','$sales_ID','$viewing_date', '$viewing_time','$negotiator','$meeting_place','','$type')";
                
                // Add a log of this viewing to special_conditions of the applicant
                $special_conditions_extra = $_POST['special_conditions'] . '<br>----------<br>Viewing added: <br>' . "$viewing_date -> $viewing_time"; // old textarea special conditions + new info
                foreach($_POST['Address'] as $row){ // adding also addresses based on checkboxes's ids
                   $address_query=mysqli_query($conn,"SELECT * FROM lettings_properties WHERE user_id=$row");
                   $address=mysqli_fetch_assoc($address_query);
                   $special_conditions_extra .= '<br>'.$address['Address1'].'<br>'.$address['Address2'].'<br>'.$address['Address3'].'<br>----------';
                }
                $update_special_conditions = "UPDATE users SET special_conditions = '$special_conditions_extra' WHERE user_id=".$_GET['book_viewing']."";
                mysqli_query($conn, $update_special_conditions);
                //-------------------
                
        }else{
            echo 'No properties chosen' . mysqli_connect_error() . PHP_EOL;
            
        }
                if(mysqli_query($conn,$insert_viewing_sql)){
                        $viewing_id = mysqli_insert_id($conn);
                        foreach($_POST['Address'] as $address_id){
                        mysqli_query($conn,"INSERT INTO lettings_addresses(viewing_id,lettings_id) VALUES('$viewing_id','$address_id') ");
                }
    ?>
    
    <script type="text/javascript">
        //alert('Data Are Inserted Successfully ');
        window.location.href = 'viewings_database.php';
    </script>
    
    <?php
        }
            exit();
        }
            if(isset($_GET['book_viewing'])){
            $sql_query="SELECT * FROM users WHERE user_id=".$_GET['book_viewing'];
            $result_set=mysqli_query($conn,$sql_query);
            $fetched_row=mysqli_fetch_assoc($result_set);
        }
    ?>
    <body>
        <div class="container" style="width:1000px;" align="center">
            <h1 style="text-align: center;">Book a Viewing</h1>
            <div class="table-responsive" id="lettings_table">
                <table class="table table-bordered">
                    <tr>
                        <div>
                            <form>
                                <a href="lettings_data.php">  Back </a>
                            </form>
                        </div>
                    </tr>
            </div>
        </div>
                    <tr>
                        <td style="text-align: left; background-color: gainsboro;"> 
                            Full Name
                        </td>
                        <td style="text-align: left; background-color: gainsboro;"> 
                            Contact Number 
                        </td>
                        <td style="text-align: left; background-color: gainsboro;"> 
                            Email
                        </td>
                        <td style="text-align: left; background-color: gainsboro;"> 
                           Tenants
                        </td>
                        <td style="text-align: left; background-color: gainsboro;"> 
                            Bedrooms 
                        </td>
                        <td style="text-align: left; background-color: gainsboro;"> 
                            Maximum Budget 
                        </td>
                        <div class = "content">
                    </tr>
                    <tr>
                        <td>
                            <p name="first_name" value="<?php echo $fetched_row['first_name']." ".$fetched_row['last_name']; ?>">
                                <?php 
                                    echo $fetched_row['first_name']." ".$fetched_row['last_name']; 
                                ?>
                            </p>
                        </td>
                        <td>
                            <p name="contact_number" value="<?php echo $fetched_row['contact_number']; ?>" >
                                <?php 
                                    echo $fetched_row['contact_number']; 
                                ?>
                            </p>
                        </td>
                        <td>
                            <p name="email" value="<?php echo $fetched_row['email']; ?>" >
                                <?php 
                                    echo $fetched_row['email']; 
                                ?>
                            </p>
                        </td>
                        <td>
                        <p name="tenants" value="<?php echo $fetched_row['tenants'].' tenant(s)'; ?>" >
                            <?php 
                                echo $fetched_row['tenants'].' tenant(s)'; 
                            ?>
                        </p>
                        </td>
                        <td>
                            <p name="bedrooms" value="<?php echo $fetched_row['bedrooms'].' bedroom(s)'; ?>" >
                                <?php 
                                echo $fetched_row['bedrooms'].' bedroom(s)'; 
                                ?>
                            </p>
                        </td>
                        <td>
                            <p name="budget" value="£<?php echo $fetched_row['maximum_budget']; ?>" >
                                £<?php 
                                    echo $fetched_row['maximum_budget']; 
                                ?>
                            </p>
                        </td>
                        <form action="viewing_lettings_handler.php?book_viewing=<?php echo $_GET['book_viewing']; ?>" method="Post">
                            <div>
                                <td style="display:none">
                                    <input type="text" name="user_id" style="display:none" border="0px" value="<?php echo $_GET['book_viewing'] ?>" >
                                </td>
                            </div>
                    </tr>
                    <tr>
                        <td colspan="6" style="width: 100%;height: 300px;">
                            Notes:
                            <textarea name="special_conditions" type="textarea" width="100%" rows="20" cols="400" style="width: 100%;height: 300px; "value="<?php echo $fetched_row['special_conditions']; ?>"><?php echo $fetched_row['special_conditions'];?></textarea>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <?php
                            if(isset($_POST['search'])){
                                $valueToSearch = $_POST['valuetoSearch'];
                                $query = "SELECT * FROM `lettings_properties` 
                                WHERE (`Address1` LIKE '%".$valueToSearch."%') 
                                OR (`Address2` LIKE '%".$valueToSearch."%')
                                OR (`Address3` LIKE '%".$valueToSearch."%') 
                                OR (`postcode` LIKE '%".$valueToSearch."%')";
                                $search_result = filterTable($query);
                                } else {
                                    $query = "SELECT * FROM `lettings_properties`";
                                    $search_result = filterTable($query);
                                }
                            function filterTable($query){
                                $conn=mysqli_connect('localhost','root','','dbtuts');
                                $filter_Result = mysqli_query($conn,$query);
                                return $filter_Result;
                            }
                        ?>
                    </tr>
                </table>
        <table width="100%">
            <tr>
                <td colspan="4" style="text-align: left; background-color: gainsboro;"><B>Viewing Details</B></td>
            </tr>
            <tr>
                <td style="padding:15">Date:
                    <br>
                    <input type="date" name="viewing_date">
                </td>
                <td>Time:
                    <br>
                    <input type="time" name="viewing_time">
                </td>
                <td>Meeting Place:
                    <br>
                    <label>
                        <input type="radio" name="meeting_place" value="MAO"> MAO 
                    </label>
                    <label>
                        <input type="radio" name="meeting_place" value="MAP"> MAP 
                    </label>
                </td>
                <td>Negotiator:
                    <br>
                    <label><input type="radio" name="negotiator" value="Lee"> Lee </label>
                    <label><input type="radio" name="negotiator" value="Vipin"> Vipin </label>
                    <label><input type="radio" name="negotiator" value="Mark"> Mark </label>
                    <label><input type="radio" name="negotiator" value="Karl"> Karl </label>
            </tr>
            <tr>
                <td style="text-align: left; background-color: gainsboro;">
                    Address
                </td>
                <td style="text-align: left; background-color: gainsboro;">
                    Dwelling Type
                </td>
                <td style="text-align: left; background-color: gainsboro;">
                    Price
                </td>
                <td style="text-align: left; background-color: gainsboro;">
                    Bedrooms
                </td>
            </tr>
            <tr>
                <?php 
                    while($row = mysqli_fetch_array($search_result)):
                ?>
                <td>
                    <?php 
                        echo "<label><input type='checkbox' name='Address[]' value='".$row["user_id"]."' >".$row['Address1']." ".$row['Address2']."".$row['Address3']."</label>";
                    ?>
                </td>
                <td>
                    <?php 
                        echo $row['dwelling_type']; 
                    ?>
                </td>
                <td>
                    <?php 
                        echo "£".$row['price']; 
                    ?>
                </td>
                <td>
                    <?php 
                        echo $row['bedrooms']." bedroom(s)";
                    ?>
                </td>
            </tr>
                <?php 
                    endwhile;
                ?>

            <tr>
                <td>
                    <td colspan="4" class="center" >
                    <input type="submit" name="add_viewing" Value="Submit" style="text-align:center">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html>
