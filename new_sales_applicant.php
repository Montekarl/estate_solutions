<?php

require 'functions.php';
auth();
include_once 'dbconfig.php';

if (!$conn)
{
    die("Connection failed: ". mysqli_connect_error());
}

function mysqlescape($array)
{
    global $connect;
    foreach($array as $item => $value)
    {
        $array[$item] = mysqli_real_escape_string($connect, $value);
    }
    return $array;
}

//Emails from @onthemarket convert into form
if (!empty($_POST['onthemarket']))
{
    preg_match('/Name:(.*?);/', $_POST['onthemarket'], $match);
    $name = $match[1];
    $fname=explode(' ', $name);
    preg_match('/Address:(.*?);/', $_POST['onthemarket'], $address);
    preg_match('/Email:(.*?);/', $_POST['onthemarket'], $email);
    preg_match('/Phone:(.*?);/', $_POST['onthemarket'], $contact_number);
    preg_match('/Comments:(.*?);/', $_POST['onthemarket'], $comments);
}

//Emails from @rightmove convert into form
if(!empty($_POST['rightmove']))
{
    preg_match('/name:(.*?);/', $_POST['rightmove'], $match);
    $name = $match[1];
    $fname=explode(' ', $name);
    preg_match('/Address:(.*?);/', $_POST['rightmove'], $address);
    preg_match('/Email:(.*?);/', $_POST['rightmove'], $email);
    preg_match('/Phone:(.*?);/', $_POST['rightmove'], $contact_number);
    preg_match('/Requirements:(.*?);/', $_POST['rightmove'], $comments);
    preg_match('/PropDescription:(.*?);/', $_POST['rightmove'], $PropDescription);
}

//Emails from @zoopla convert into form (unfinished)
if(!empty($_POST['zoopla']))
{
    preg_match('/Name:	  (.*?)           Telephone:/', $_POST['zoopla'], $match);
    $name = $match[1];
    $fname=explode(' ', $name);
    preg_match('/Address:(.*?)           Telephone:/', $_POST['zoopla'], $address);
    preg_match('/Email:(.*?)Type of enquiry:/', $_POST['zoopla'], $email);
    preg_match('/Telephone:	  (.*?)           Email:/', $_POST['zoopla'], $contact_number);
    preg_match('/Price range:(.*?)per month/', $_POST['zoopla'], $comments);
    preg_match('/Type of property:(.*?)Price range:/', $_POST['zoopla'], $comments);
}

if(isset($_POST['btn-save']))
{
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : false;
    $firstname = isset($_POST['firstname']) ? mysqli_real_escape_string($conn, $_POST['firstname']) : false;
    $lastname = isset($_POST['lastname']) ? mysqli_real_escape_string($conn, $_POST['lastname']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : false;
    $contact_number = isset($_POST['contact_number']) ? mysqli_real_escape_string($conn, $_POST['contact_number']) : false;
    $address = isset($_POST['address']) ? mysqli_real_escape_string($conn, $_POST['address']) : false;
    $bedrooms = isset($_POST['bedrooms']) ? mysqli_real_escape_string($conn, $_POST['bedrooms']) : false;
    $maximum_budget = isset($_POST['maximum_budget']) ? mysqli_real_escape_string($conn, $_POST['maximum_budget']) : false;
    $mortgage_status = isset($_POST['mortgage_status']) ? mysqli_real_escape_string($conn, $_POST['mortgage_status']) : false;
    $buyer_position = isset($_POST['buyer_position']) ? mysqlescape($_POST['buyer_position']) : false;
    $tenure = isset($_POST['tenure']) ? mysqlescape($_POST['tenure']) : false;
    $areas = isset($_POST['areas']) ? mysqlescape($_POST['areas']) : false;
    $ibuyer_position = is_array($buyer_position) ? implode(", ",$buyer_position) : false;
    $itenure = is_array($tenure) ? implode(", ",$tenure): false;
    $iareas = is_array($areas) ? implode(", ",$areas): false;
    $special_conditions = isset($_POST['special_conditions']) ? mysqli_real_escape_string($conn, $_POST['special_conditions']) : false;

    $sql_query = "INSERT INTO sales_applicant(title,firstname,lastname,email,contact_number,
    address,bedrooms,maximum_budget,mortgage_status,
    buyer_position,tenure,areas,special_conditions) 
    VALUES('$title','$firstname','$lastname','$email','$contact_number','$address',
    '$bedrooms','$maximum_budget','$mortgage_status','$ibuyer_position','$itenure',
    '$iareas','$special_conditions')";

    if(mysqli_query($conn,$sql_query))
    {
        ?>
        <script type="text/javascript">
        alert('Data Is Inserted Successfully ');
        window.location.href = 'sales_data.php';
        </script>
        <?php
    }
    else
    {
        die(mysqli_error($conn)); //this var is in dbconfig.php
        ?>
        <script type="text/javascript">
        alert('Error occured while inserting your data');
        </script>
        <?php
    }
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Database - Add Applicant</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>
    <body>
        
        <div id="header">
        <div id="content">
            <label>Add New Sales Applicant</label>
        </div>
        </div>
        
        <div id="body">
            <div id="content">            
                <form method="post">
                    <?php 
                        include "header.php";
                    ?>
                    <div class ="container" style="width:900px; text-align:center">
                        <div class="table-responsive">
                            <div class="search-table-outter wrapper">
                    <table>
                        
                    <tr>
                        <td><a href="sales_data.php">Back to Sales Applicants</a></td>
                    </tr>
                    
                    <form action="?" method="POST"> 
                        <input type="text" name="onthemarket" placeholder="onthemarket + rightmove" size="50px" />
                        <input type="submit" value="extract" /><br>
                        <input type="text" name="zoopla" placeholder="zoopla" size="50px" />
                        <input type="submit" value="extract" /><br>
                    </form>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col" colspan="3" style="background-color:firebrick;">
                                <h4 style="color:gold">
                                    Personal Details
                                </h4>
                            </th>
                        </tr>
                        
                        <tr>
                            <?php 
                                //Logic for cases of more than 1 name or if last name is not specified
                                $title = $first_name = $last_name = false; 
                                
                                if(!empty($fname))
                                {
                                    $name_size = sizeof($fname);
                                    if ($name_size == 1) 
                                    {
                                        $first_name = $fname[0];
                                    }
                                    elseif ($name_size == 2) 
                                    {
                                        $first_name = $fname[0];
                                        $last_name = $fname[1];
                                    }
                                    elseif ($name_size == 3) 
                                    {
                                        $title = $fname[0];
                                        $first_name = $fname[1];
                                        $last_name = $fname[2];
                                    }
                                    elseif ($name_size == 4) 
                                    {
                                        $title = $fname[0];
                                        $first_name = $fname[1]." ".$fname[2];
                                        $last_name = $fname[3];
                                    }
                                    elseif ($name_size == 5) 
                                    {
                                        $title = $fname[0];
                                        $first_name = $fname[1]." ".$fname[2]." ".$fname[3];
                                        $last_name = $fname[4];
                                    }
                                    elseif ($name_size == 6) 
                                    {
                                        $title = $fname[0];
                                        $first_name = $fname[1]." ".$fname[2]." ".$fname[3]." ".$fname[4];
                                        $last_name = $fname[5];
                                    }
                                    elseif ($name_size == 7) 
                                    {
                                        $title = $fname[0];
                                        $first_name = $fname[1]." ".$fname[2]." ".$fname[3]." ".$fname[4]." ".$fname[5];
                                        $last_name = $fname[6];
                                    }
                                }
                            ?>

                            <td>
                                Title:<br/><input name="title" class="form-control" value="<?php echo $title; ?>"/>
                            </td>

                            <td>
                                First Name:<br/><input name="firstname" class="form-control" value="<?php echo $first_name; ?>"/>
                            </td>

                            <td>
                                Last Name:<br/><input name="lastname" class="form-control" value="<?php echo $last_name; ?>"/>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <?php
                                if(!empty($email))
                                {
                                    echo "Email: <input type='text' name='email' class='form-control' value='$email[1]'/><br>";
                                }
                                else
                                {
                                    echo "Email: <input type='text' name='email' class='form-control'/><br>";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if(!empty($contact_number))
                                {
                                    echo "Contact Number: <input type='text' name='contact_number' class='form-control' value='$contact_number[1]'/><br>";
                                }
                                else
                                {
                                    echo "Contact Number: <input type='text' name='contact_number' class='form-control' /><br>";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                if(!empty($contact_number))
                                {
                                    echo "Address: <input type='text' name='address' class='form-control' value='$address[1]'/><br>";
                                }
                                else
                                {
                                    echo "Address: <input type='text' name='address' class='form-control' /><br>";
                                }
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                Minimum Bedrooms:<br/>
                                <select name="bedrooms" class="form-control"/>
                                    <option></option>
                                    <option value="studio">Studio</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </td>
                            
                            <td>
                                Maximum Budget: <br/>
                                <select name="maximum_budget" class="form-control"/>
                                    <option></option>
                                    <option>50,000</option>
                                    <option>60,000</option>
                                    <option>70,000</option>
                                    <option>80,000</option>
                                    <option>90,000</option>
                                    <option>100,000</option>
                                    <option>110,000</option>
                                    <option>120,000</option>
                                    <option>130,000</option>
                                    <option>140,000</option>
                                    <option>150,000</option>
                                    <option>160,000</option>
                                    <option>170,000</option>
                                    <option>175,000</option>
                                    <option>180,000</option>
                                    <option>190,000</option>
                                    <option>200,000</option>
                                    <option>210,000</option>
                                    <option>220,000</option>
                                    <option>230,000</option>
                                    <option>240,000</option>
                                    <option>250,000</option>
                                    <option>260,000</option>
                                    <option>270,000</option>
                                    <option>280,000</option>
                                    <option>290,000</option>
                                    <option>300,000</option>
                                    <option>325,000</option>
                                    <option>350,000</option>
                                    <option>375,000</option>
                                    <option>400,000</option>
                                    <option>425,000</option>
                                    <option>450,000</option>
                                    <option>475,000</option>
                                    <option>500,000</option>
                                    <option>550,000</option>
                                    <option>600,000</option>
                                    <option>650,000</option>
                                    <option>700,000</option>
                                    <option>800,000</option>
                                    <option>900,000</option>
                                    <option>1,000,000</option>
                                    <option>1,250,000</option>
                                    <option>1,500,000</option>
                                    <option>1,750,000</option>
                                    <option>2,000,000</option>
                                    <option>2,500,000</option>
                                    <option>3,000,000</option>
                                    <option>4,000,000</option>
                                    <option>5,000,000</option>
                                    <option>7,500,000</option>
                                    <option>10,000,000</option>
                                    <option>20,000,000</option>
                                    <option>No Max</option>
                                </select>
                            </td>

                            <td>
                                Mortgage Status: <br/>
                                <select name="mortgage_status" id="mortgage_status" class="form-control">
                                    <option></option>
                                    <option value="Seeking Mortgage">Not Required</option>
                                    <option value="Seeking Mortgage">Seeking Mortgage</option>
                                    <option value="Help to Buy">Help to Buy</option>
                                    <option value="Shared Ownership">Shared Ownership</option>
                                    <option value="Mortgage Agreed">Mortgage Agreed</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="col" colspan="3" style="background-color:firebrick;">
                                <h4 style="color:gold">
                                    Buyers Position and Tenure
                                </h4>
                            </th>
                        </tr>

                        <tr>
                            <td>
                                <label><input type="checkbox" name="buyer_position[]" value="First Time Buyer">First Time Buyer</label><br>
                                <label><input type="checkbox" name="buyer_position[]" value="Not In Chain">Not in Chain</label><br>
                                <label><input type="checkbox" name="buyer_position[]" value="In Chain">In Chain</label><br>
                            </td>

                            <td>
                                <label><input type="checkbox" name="buyer_position[]" value="Property Marketed">Property Marketed</label><br>
                                <label><input type="checkbox" name="buyer_position[]" value="Cash Buyer">Cash Buyer</label><br>
                                <label><input type="checkbox" name="buyer_position[]" value="Under Offer">Under Offer</label><br>
                            </td>

                            <td>
                                <label><input type="checkbox" name="tenure[]" value="Leasehold">Leasehold</label><br>
                                <label><input type="checkbox" name="tenure[]" value="Share of Freehold">Share Of Freehold</label><br>
                                <label><input type="checkbox" name="tenure[]" value="Freehold">Freehold</label><br>
                            </td>
                        </tr>

                        <tr>
                            <th scope="col" colspan="3" style="background-color:firebrick;">
                                <h4 style="color:gold">
                                    Area(s):
                                </h4>
                            </th>
                        </tr>
                        
                        <tr>
                            <td>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Anerley"> 
                                    Addington
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Anerley"> 
                                    Anerley
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Beckenham"> 
                                    Beckenham
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Beddington"> 
                                    Beddington
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Bromley"> 
                                    Bromley
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Catford"> 
                                    Catford
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Chipstead"> 
                                    Chipstead
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Croydon"> 
                                    Croydon
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Crystal Palace"> 
                                    Crystal Palace
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="East Croydon"> 
                                    East Croydon
                                </label>
                                <br>
                            </td>

                            <td>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Forest Hill"> 
                                        Forest Hill
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Mitcham"> 
                                        Mitcham
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Norbury"> 
                                    Norbury
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Penge"> 
                                    Penge
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Purley"> 
                                    Purley
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Sanderstead"> 
                                    Sanderstead
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Selhurst"> 
                                    Selhurst
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="South Croydon"> 
                                    South Croydon
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="South Norwood"> 
                                    South Norwood
                                </label>
                                    <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Streatham"> 
                                    Streatham
                                </label>
                                    <br>
                            </td>

                            <td>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Sutton"> 
                                    Sutton
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Sydenham"> 
                                    Sydenham
                                </label>
                                <br>
                                <label>
                                <input type="checkbox" name="areas[]" value="Thornton Heath"> 
                                Thornton Heath
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Tooting"> 
                                    Tooting
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Upper Norwood"> 
                                    Upper Norwood
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="West Croydon"> 
                                    West Croydon
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="West Wickham"> 
                                    West Wickham
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="Addiscombe"> 
                                    Addiscombe
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" name="areas[]" value="other"> 
                                    Other
                                </label>
                                <br>
                            </td>
                        </tr>
                        
                        <tr>
                            <th colspan="3" style="background-color:firebrick;"> 
                                <h4 style="color:gold">    
                                    Special Conditions:
                                </h4>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <?php 
                                    if(!empty($comments)){
                                    echo "<textarea width='100%' rows='20' cols='40' id='special_conditions' name='special_conditions' placeholder='Special Conditions' class='form-control' style='width: 100%;height: 300px;'>Comments: $comments[1]</textarea>";
                                    } else {
                                    echo "<textarea width='100%' rows='20' cols='40' id='special_conditions' name='special_conditions' placeholder='Special Conditions' class='form-control' style='width: 100%;height: 300px;'></textarea>";
                                    }
                                ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <div style="text-align:center">
                                <th colspan="3" >
                                    <button type="submit" name="btn-save" class="form-control" style="background-color: goldenrod;">
                                        <strong style="color:indigo">
                                            SAVE
                                        </strong>
                                    </button>
                                </th>
                            </div>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <?php mysqli_close($conn); ?>
    </body>
</html>

