<?php

require 'functions.php';
auth();

include_once 'dbconfig.php';
if(isset($_GET['sales_client']))
{
    $sql_query="SELECT * FROM sales_applicant WHERE id=".$_GET['sales_client'];
    $result_set=mysqli_query($conn,$sql_query);
    $fetched_row=mysqli_fetch_assoc($result_set);
}
if(isset($_POST['btn-update']))
{
    // variables for input data
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn,$_POST['title']):false;
    $firstname = isset($_POST['firstname']) ? mysqli_real_escape_string($conn,$_POST['firstname']):false;
    $lastname = isset($_POST['lastname']) ? mysqli_real_escape_string($conn,$_POST['lastname']):false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn,$_POST['email']):false;
    $contact_number = isset($_POST['contact_number']) ? mysqli_real_escape_string($conn,$_POST['contact_number']):false;
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn,$_POST['address']):false;
    $bedrooms = isset($_POST['bedrooms']) ? mysqli_real_escape_string($conn,$_POST['bedrooms']):false;
    $maximum_budget = isset($_POST['maximum_budget']) ? mysqli_real_escape_string($conn,$_POST['maximum_budget']):false;
    $mortgage_status = isset($_POST['mortgage_status']) ? mysqli_real_escape_string($conn,$_POST['mortgage_status']):false;
    $buyer_position = isset($_POST['buyer_position']) ? mysqli_real_escape_string($conn,$_POST['buyer_position']):false;
    $tenure = isset($_POST['tenure']) ? mysqli_real_escape_string($conn,$_POST['tenure']):false;
    $areas = isset($_POST['areas']) ? mysqli_real_escape_string($conn,$_POST['areas']):false;
    $special_conditions = isset($_POST['special_conditions']) ? mysqli_real_escape_string($conn,$_POST['special_conditions']):false;
   
    $sql_query = "UPDATE sales_applicant SET 
    title='$title',
    firstname='$firstname',
    lastname='$lastname',
    email='$email',
    contact_number='$contact_number',
    address = '$address',
    bedrooms = '$bedrooms',
    maximum_budget = '$maximum_budget',
    mortgage_status = '$mortgage_status',
    buyer_position = '$buyer_position',
    tenure = '$tenure',
    areas = '$areas',
    special_conditions = '$special_conditions'
    WHERE id=".$_GET['sales_client'];
    // sql query for update data into database

    // sql query execution function
    if(mysqli_query($conn,$sql_query))
    {
        ?>

        <script type="text/javascript">
            window.location.href = 'sales_data.php';
        </script>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
            alert('error occured while updating data');
        </script>
        <?php
    }
    // sql query execution function
}
if(isset($_POST['btn-cancel']))
{
    header("Location: sales_data.php");
}
?>
<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
                <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>

            <body>
                    <div id="header">
                        <div id="content">
                            <label>Benson and Partners</label>
                        </div>
                    </div>
                
                            <form method="post">
                                <div class ="container" style="width:600px;" align="center">
                                <div class="table-responsive">
                                <table class="table table-bordered">
                               
                                    <tr>
                                        <td>
                                            Title:
                                            <input type="text" name="title" class="form-control" value="<?php echo $fetched_row['title']; ?>"  />
                                        </td>
                                   
                                        <td>
                                            First Name:
                                            <input type="text" name="firstname" class="form-control" value="<?php echo $fetched_row['firstname']; ?>"  />
                                        </td>
                                    
                                        <td>
                                            Last Name:
                                            <input type="text" name="lastname" class="form-control" value="<?php echo $fetched_row['lastname']; ?>"  />
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                           Email:
                                            <input type="text" name="email" class="form-control" value="<?php echo $fetched_row['email']; ?>"  />
                                        </td>
                                    
                                        <td>
                                            Conctact Number:
                                            <input type="text" name="contact_number" class="form-control" value="<?php echo $fetched_row['contact_number']; ?>"  />
                                        </td>
                                   
                                        <td>
                                           Address:
                                            <input type="text" name="address" class="form-control" value="<?php echo $fetched_row['address']; ?>"  />
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                           Bedrooms:
                                            <input type="text" name="bedrooms" class="form-control" value="<?php echo $fetched_row['bedrooms']; ?>"  />
                                        </td>
                                    
                                        <td>
                                           Maximum Budget:
                                            <input type="text" name="maximum_budget" class="form-control" value="<?php echo $fetched_row['maximum_budget']; ?>"  />
                                        </td>
                                    
                                        <td>
                                           Mortgage Status
                                            <input type="text" name="mortgage_status" class="form-control" value="<?php echo $fetched_row['mortgage_status']; ?>"  />
                                        </td>
                                    </tr>
                                      <tr>
                                        <td>
                                            Buyers' Position:
                                            <input type="text" name="buyer_position" class="form-control" value="<?php echo $fetched_row['buyer_position']; ?>"  />
                                        </td>
                                    
                                        <td>
                                           Tenure:
                                            <input type="text" name="tenure" class="form-control" value="<?php echo $fetched_row['tenure']; ?>"  />
                                        </td>
                                    
                                        <td>
                                            Areas:
                                            <input type="text" name="areas" class="form-control" value="<?php echo $fetched_row['areas']; ?>"  />
                                        </td>
                                    </tr >
                                    <tr >
                                        <td colspan="3">
                                            Special Conditions:<br>
                                            <textarea cols="40" rows="30" class="form-control" name="special_conditions" value="<?php echo $fetched_row['special_conditions']; ?>"  /><?php echo $fetched_row['special_conditions']; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                            <td colspan="3">
                                                <button type="submit" name="btn-update" class="form-control"><strong>UPDATE</strong></button>
                                                <button type="submit" name="btn-cancel" class="form-control"><strong>Cancel</strong></button>
                                            </td>
                                    </tr>

                                 </table>
                             </form>
                         </div>
                     </div>
                     
                <?php mysqli_close($conn); ?>
                
               
             </body>
     </html>