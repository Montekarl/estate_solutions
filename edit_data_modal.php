<?php
require 'functions.php';
auth();


include_once 'dbconfig.php';
if(isset($_GET['edit_id']))
{
    $sql_query="SELECT * FROM users WHERE user_id=".$_GET['edit_id'];
    $result_set=mysqli_query($sql_query);
    $fetched_row=mysqli_fetch_array($conn,$result_set);
}
if(isset($_POST['btn-update']))
{
    // variables for input data
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];
    $email = $_POST['email'];
    $bedrooms = $_POST['bedrooms'];
    $tenants = $_POST['tenants'];
    $furniture = $_POST['furniture'];
    $maximum_budget = $_POST['maximum_budget'];
    $contact_number = $_POST['contact_number'];
    $move_by = $_POST['move_by'];
    $areas = $_POST['areas'];
    $employment_status = $_POST['employment_status'];
    $job_title = $_POST['job_title'];
    $salary = $_POST['salary'];
    $lease = $_POST['lease'];
    $special_conditions = $_POST['special_conditions'];
    $dss = $_POST['dss'];
    $pets = $_POST['pets'];
    $children = $_POST['children'];

    // variables for input data

    // sql query for update data into database
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
    // sql query for update data into database

    // sql query execution function
    if(mysql_query($sql_query))
    {
        ?>

        <script type="text/javascript">
            alert('Data Are Updated Successfully');
            window.location.href = 'index.php';
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
    header("Location: index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN>
            <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <style>
                        .tablestyle {
                        border-style: hidden;
                        }
                   </style>
                <title>Benson and Partners</title>
                <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />

            </head>

            <body>
                

                    <div id="header">
                        <div id="content">
                            <label>Benson and Partners</label>
                        </div>
                    </div>

                    <div id="body">
                        <div id="content">
                            <form method="post">
                                <table class="tablestyle">
                                    <tr>
                                        <td>
                                            Title: 
                                            <input type="text" name="title" placeholder="title" value="<?php echo $fetched_row['title']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            First Name: 
                                            <input type="text" name="first_name" placeholder="First Name" value="<?php echo $fetched_row['first_name']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Last Name: 
                                            <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $fetched_row['last_name']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Contact Number: 
                                            <input type="text" name="contact_number" placeholder="Contact Number" value="<?php echo $fetched_row['contact_number']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Address: 
                                            <input type="text" name="city_name" placeholder="City" value="<?php echo $fetched_row['city_name']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email: 
                                            <input type="text" name="email" placeholder="Email" value="<?php echo $fetched_row['email']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            How Many Bedrooms?
                                            <input type="text" name="bedrooms" value="<?php echo $fetched_row['bedrooms']; ?>"  />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            How Many Tenants?
                                            <input type="text" name="tenants" value="<?php echo $fetched_row['tenants']; ?>"  />
                                    </tr>
                                    <tr>
                                        <td>
                                            How Many Children?
                                            <input type="text" name="children" value="<?php echo $fetched_row['children']; ?>"  />
                                    </tr>

                                    <tr>
                                        <td>
                                            Maximum Budget?
                                            <input type="text" name="maximum_budget" value="<?php echo $fetched_row['maximum_budget']; ?>"  />
                                        </td>
                                    </tr>
										<tr>
                                    <td>
                                        Moving Date
                                        <input type="text" name="move_by" value="<?php echo $fetched_row['move_by']; ?>"  />
                                    </td>
                                </tr>
								<tr>
                                    <td>
                                        Area(s)
                                        <input type="text" name="areas" value="<?php echo $fetched_row['areas']; ?>"  />
                                    </td>
                                </tr>
								<tr>
                                    <td>
                                        Employment Status
                                        <input type="text" name="employment_status" value="<?php echo $fetched_row['employment_status']; ?>"  />
                                    </td>
                                </tr>
								<tr>
                                    <td>
                                        Salary:
                                        <input type="text" name="salary" value="<?php echo $fetched_row['salary']; ?>"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Furniture:
                                        <input type="text" name="furniture" value="<?php echo $fetched_row['furniture']; ?>"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Job Title:
                                        <input type="text" name="job_title" value="<?php echo $fetched_row['job_title']; ?>"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        DSS:
                                        <input type="text" name="dss" value="<?php echo $fetched_row['dss']; ?>"  />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pets:
                                        <input type="text" name="pets" value="<?php echo $fetched_row['pets']; ?>"  />
                                    </td>
                                </tr>
								<tr>
                                    <td>
                                        Staying:
                                        <input type="text" name="lease" value="<?php echo $fetched_row['lease']; ?>"  />
                                    </td>
                                </tr>
								<tr>
                                    <td>
                                        Special Conditions:
                                        <input type="textarea" name="special_conditions" value="<?php echo $fetched_row['special_conditions']; ?>"  />
                                    </td>
                                </tr>
                                    <tr>
                                        <tr>
                                            <td>
                                                <button type="submit" name="btn-update"><strong>UPDATE</strong></button>
                                                <button type="submit" name="btn-cancel"><strong>Cancel</strong></button>
</td>
</tr>
</table>
</form>
</div>
</div>


</body>

</html>