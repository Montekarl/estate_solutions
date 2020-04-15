<?php
    require 'functions.php';
    auth();
    include 'dbconfig.php';
    if(isset($_GET['edit_id']))
        {
            $sql_query="SELECT * FROM users WHERE user_id=".$_GET['edit_id'];
            $result_set=mysqli_query($conn,$sql_query);
            $fetched_row=mysqli_fetch_assoc($result_set);
        }
        if(isset($_POST['btn-update']))
        {
            $title = isset($_POST['title']) ? mysqli_real_escape_string($conn,$_POST['title']):false;
            $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn,$_POST['first_name']):false;
            $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn,$_POST['last_name']):false;
            $city_name = isset($_POST['city_name']) ? mysqli_real_escape_string($conn,$_POST['city_name']):false;
            $email = isset($_POST['email']) ? mysqli_real_escape_string($conn,$_POST['email']):false;
            $bedrooms = isset($_POST['bedrooms']) ? mysqli_real_escape_string($conn,$_POST['bedrooms']):false;
            $tenants = isset($_POST['tenants']) ? mysqli_real_escape_string($conn,$_POST['tenants']):false;
            $furniture = isset($_POST['furniture']) ? mysqli_real_escape_string($conn,$_POST['furniture']):false;
            $maximum_budget = isset($_POST['maximum_budget']) ? mysqli_real_escape_string($conn,$_POST['maximum_budget']):false;
            $contact_number = isset($_POST['contact_number']) ? mysqli_real_escape_string($conn,$_POST['contact_number']):false;
            $move_by = isset($_POST['move_by']) ? mysqli_real_escape_string($conn,$_POST['move_by']):false;
            $areas = isset($_POST['areas']) ? mysqli_real_escape_string($conn,$_POST['areas']):false;
            $employment_status = isset($_POST['employment_status']) ? mysqli_real_escape_string($conn,$_POST['employment_status']):false;
            $job_title = isset($_POST['job_title']) ? mysqli_real_escape_string($conn,$_POST['job_title']):false;
            $salary = isset($_POST['salary']) ? mysqli_real_escape_string($conn,$_POST['salary']):false;
            $lease = isset($_POST['lease']) ? mysqli_real_escape_string($conn,$_POST['lease']):false;
            $special_conditions = isset($_POST['special_conditions']) ? mysqli_real_escape_string($conn,$_POST['special_conditions']):false;
            $dss = isset($_POST['dss']) ? mysqli_real_escape_string($conn,$_POST['dss']):false;
            $pets = isset($_POST['pets']) ? mysqli_real_escape_string($conn,$_POST['pets']):false;
            $children = isset($_POST['children']) ? mysqli_real_escape_string($conn,$_POST['children']):false;

            $sql_query = "UPDATE users SET 
            title='$title', 
            first_name='$first_name', 
            last_name='$last_name',
            city_name='$city_name',
            email='$email',
            bedrooms='$bedrooms',
            tenants='$tenants',
            furniture='$furniture',
            maximum_budget='$maximum_budget',
            contact_number='$contact_number', 
            move_by = '$move_by', 
            areas = '$areas', 
            employment_status = '$employment_status', 
            job_title = '$job_title',
            salary = '$salary',
            lease = '$lease', 
            special_conditions = '$special_conditions',
            dss='$dss',
            pets='$pets',
            children='$children'
            WHERE user_id=".$_GET['edit_id'];

    if(mysqli_query($conn,$sql_query))
    {
?>
    <script type="text/javascript">
      
        window.location.href = 'lettings_data.php';
    </script>
<?php
    } else {
        die(mysqli_error($connect));
?>
    <script type="text/javascript">
        alert('error occured while inserting your data');
    </script>

<?php
            }
        }
    if(isset($_POST['btn-cancel']))
    {
        header("Location: lettings_data.php");
    }
?>

<html>
    <body>
            <head>
                <title>Edit User</title>
                <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>
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
                            <th colspan="3"> Applicant Name </th>
                        </tr>
                        <tr>
                            <td>
                                Title:
                                <br>
                                <input type="text" name="title" class="form-control" placeholder="title" value="<?php echo $fetched_row['title']; ?>" />
                            </td>
                            <td>
                                First Name:
                                <br>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $fetched_row['first_name']; ?>" />
                            </td>
                            <td>
                                Last Name:
                                <br>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $fetched_row['last_name']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3"> Contact Details </th>
                        </tr>
                        <tr>
                            <td>
                                Contact Number:
                                <br>
                                <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" value="<?php echo $fetched_row['contact_number']; ?>" />
                            </td>
                            <td>
                                Address:
                                <br>
                                <input type="text" name="city_name" class="form-control" placeholder="City" value="<?php echo $fetched_row['city_name']; ?>" />
                            </td>
                            <td>
                                Email:
                                <br>
                                <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $fetched_row['email']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3"> Requirements </th>
                        </tr>
                        <tr>
                            <td>
                                Bedrooms:
                                <br>
                                <input type="text" name="bedrooms" class="form-control" value="<?php echo $fetched_row['bedrooms']; ?>" />
                            </td>
                            <td>
                                How Many Tenants?
                                <br>
                                <input type="text" name="tenants" class="form-control" value="<?php echo $fetched_row['tenants']; ?>" />
                            </td>
                            <td>
                                Maximum Budget?
                                <br>
                                <select name="maximum_budget" class="form-control"/>
                                    <option><?php echo $fetched_row['maximum_budget']; ?></option>
                                    £<option>100 PCM</option>
                                    £<option>150 PCM</option>
                                    £<option>200 PCM</option>
                                    £<option>250 PCM</option>
                                    £<option>300 PCM</option>
                                    £<option>350 PCM</option>
                                    £<option>400 PCM</option>
                                    £<option>450 PCM</option>
                                    £<option>500 PCM</option>
                                    £<option>600 PCM</option>
                                    £<option>650 PCM</option>
                                    £<option>700 PCM</option>
                                    £<option>750 PCM</option>
                                    £<option>800 PCM</option>
                                    £<option>850 PCM</option>
                                    £<option>900 PCM</option>
                                    £<option>950 PCM</option>
                                    £<option>1000 PCM</option>
                                    £<option>1100 PCM</option>
                                    £<option>1200 PCM</option>
                                    £<option>1300 PCM</option>
                                    £<option>1400 PCM</option>
                                    £<option>1750 PCM</option>
                                    £<option>2000 PCM</option>
                                    £<option>2250 PCM</option>
                                    £<option>2500 PCM</option>
                                    £<option>2750 PCM</option>
                                    £<option>3000 PCM</option>
                                    £<option>3500 PCM</option>
                                    £<option>4000 PCM</option>
                                    £<option>4500 PCM</option>
                                    £<option>5000 PCM</option>
                                    £<option>5500 PCM</option>
                                    £<option>6500 PCM</option>
                                    £<option>7000 PCM</option>
                                    £<option>8000 PCM</option>
                                    £<option>9000 PCM</option>
                                    £<option>10000 PCM</option>
                                    £<option>12500 PCM</option>
                                    £<option>15000 PCM</option>
                                    £<option>17500 PCM</option>
                                    £<option>20000 PCM</option>
                                    £<option>22500 PCM</option>
                                    £<option>25000 PCM</option>
                                    £<option>30000 PCM</option>
                                    £<option>40000 PCM</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Moving Date:
                                <br>
                                <input type="date" name="move_by" class="form-control" value="<?php echo $fetched_row['move_by']; ?>" />
                            </td>
                            <td>
                                Area(s)
                                <br>
                                <input type="text" name="areas" class="form-control" value="<?php echo $fetched_row['areas']; ?>" />
                            </td>
                            <td>
                                Furniture:
                                <br>
                                <input type="text" name="furniture" class="form-control" value="<?php echo $fetched_row['furniture']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3"> Employment and Income </th>
                        </tr>
                        <tr>
                            <td>
                                Employment Status:
                                <br>
                                <input type="text" name="employment_status" class="form-control" value="<?php echo $fetched_row['employment_status']; ?>" />
                            </td>
                            <td>
                                Salary:
                                <br>
                                <input type="text" name="salary" class="form-control" value="<?php echo $fetched_row['salary']; ?>" />
                            </td>
                            <td>
                                Job Title:
                                <br>
                                <input type="text" name="job_title" class="form-control" value="<?php echo $fetched_row['job_title']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th colspan="3"> Special </th>
                        </tr>
                        <tr>
                            <td>
                                DSS:
                                <br>
                                <input type="text" name="dss" class="form-control" value="<?php echo $fetched_row['dss']; ?>" />
                            </td>
                            <td>
                                Pets:
                                <br>
                                <input type="text" name="pets" class="form-control" value="<?php echo $fetched_row['pets']; ?>" />
                            </td>
                            <td>
                                How Many Children?
                                <br>
                                <input type="text" name="children" class="form-control" value="<?php echo $fetched_row['children']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Staying:
                                <br>
                                <input type="text" name="lease" class="form-control" value="<?php echo $fetched_row['lease']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h3> Notes:</h3>
                                <textarea cols="80" rows="20" class="form-control" name="special_conditions"><?php echo $fetched_row['special_conditions']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <button type="submit" name="btn-update"><strong>UPDATE</strong></button>
                                <button type="submit" name="btn-cancel"><strong>Cancel</strong></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>

        <?php mysqli_close($conn); ?>
    </body>
</html>