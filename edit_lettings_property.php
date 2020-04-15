<?php
require 'functions.php';
auth();
include "dbconfig.php";
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
if(isset($_GET['edit_id'])){
    $sql_query="SELECT * FROM lettings_properties WHERE user_id=".$_GET['edit_id'];
    $result_set=mysqli_query($conn, $sql_query);
    $row=mysqli_fetch_assoc($result_set);
}

if(isset($_POST['btn-update']))
{
    $Address1 = isset($_POST['Address1']) ? mysqli_real_escape_string($conn,$_POST['Address1']) : false;
    $Address2 = isset($_POST['Address2']) ? mysqli_real_escape_string($conn,$_POST['Address2']) : false;
    $Address3 = isset($_POST['Address3']) ? mysqli_real_escape_string($conn,$_POST['Address3']) : false;
    $postcode = isset($_POST['postcode']) ? mysqli_real_escape_string($conn,$_POST['postcode']) : false;
    $property_level = isset($_POST['property_level']) ? mysqli_real_escape_string($conn,$_POST['property_level']) : false;
    $lettings_availability = isset($_POST['lettings_availability']) ? mysqli_real_escape_string($conn,$_POST['lettings_availability']) : false;
    $dwelling_type = isset($_POST['dwelling_type']) ? mysqli_real_escape_string($conn,$_POST['dwelling_type']) : false;
    $key_tag = isset($_POST['key_tag']) ? mysqli_real_escape_string($conn,$_POST['key_tag']) : false;
    $price = isset($_POST['price']) ? mysqli_real_escape_string($conn,$_POST['price']) : false;
    $available_from = isset($_POST['available_from']) ? mysqli_real_escape_string($conn,$_POST['available_from']) : false;
    $bedrooms = isset($_POST['bedrooms']) ? mysqli_real_escape_string($conn,$_POST['bedrooms']) : false;
    $bathrooms = isset($_POST['bathrooms']) ? mysqli_real_escape_string($conn,$_POST['bathrooms']) : false;
    $receptions = isset($_POST['receptions']) ? mysqli_real_escape_string($conn,$_POST['receptions']) : false;
    $borough = isset($_POST['borough']) ? mysqli_real_escape_string($conn,$_POST['borough']) : false;
    $garden = isset($_POST['garden']) ? mysqli_real_escape_string($conn,$_POST['garden']) : false;
    $parking = isset($_POST['parking']) ? mysqli_real_escape_string($conn,$_POST['parking']) : false;
    $access_through = isset($_POST['access_through']) ? mysqli_real_escape_string($conn,$_POST['access_through']) : false;
    $floor_area = isset($_POST['floor_area']) ? mysqli_real_escape_string($conn,$_POST['floor_area']) : false;
    $property_condition = isset($_POST['property_condition']) ? mysqli_real_escape_string($conn,$_POST['property_condition']) : false;
    $heating_type = isset($_POST['feature_1']) ? mysqli_real_escape_string($conn,$_POST['heating_type']) : false;
    $council_tax_band = isset($_POST['council_tax_band']) ? mysqli_real_escape_string($conn,$_POST['council_tax_band']) : false;
    $council_tax_cost = isset($_POST['council_tax_cost']) ? mysqli_real_escape_string($conn,$_POST['council_tax_cost']) : false;
    $feature_1 = isset($_POST['feature_1']) ? mysqli_real_escape_string($conn,$_POST['feature_1']) : false;
    $feature_2 = isset($_POST['feature_2']) ? mysqli_real_escape_string($conn,$_POST['feature_2']) : false;
    $feature_3 = isset($_POST['feature_3']) ? mysqli_real_escape_string($conn,$_POST['feature_3']) : false;
    $feature_4 = isset($_POST['feature_4']) ? mysqli_real_escape_string($conn,$_POST['feature_4']) : false;
    $feature_5 = isset($_POST['feature_5']) ? mysqli_real_escape_string($conn,$_POST['feature_5']) : false;
    $feature_6 = isset($_POST['feature_6']) ? mysqli_real_escape_string($conn,$_POST['feature_6']) : false;
    $feature_7 = isset($_POST['feature_7']) ? mysqli_real_escape_string($conn,$_POST['feature_7']) : false;
    $feature_8 = isset($_POST['feature_8']) ? mysqli_real_escape_string($conn,$_POST['feature_8']) : false;
    $feature_9 = isset($_POST['feature_9']) ? mysqli_real_escape_string($conn,$_POST['feature_9']) : false;
    $feature_10 = isset($_POST['feature_10'])?mysqli_real_escape_string($conn,$_POST['feature_10']):false;
    $landlord_fn = isset($_POST['landlord_fn'])?mysqli_real_escape_string($conn,$_POST['landlord_fn']):false;
    $landlord_ln = isset($_POST['landlord_ln']) ? mysqli_real_escape_string($conn,$_POST['landlord_ln']) : false;
    $landlord_contact = isset($_POST['landlord_contact']) ? mysqli_real_escape_string($conn,$_POST['landlord_contact']) : false;
    $landlord_email = isset($_POST['landlord_email']) ? mysqli_real_escape_string($conn,$_POST['landlord_email']) : false;
    $landlord_address = isset($_POST['landlord_address']) ? mysqli_real_escape_string($conn,$_POST['landlord_address']) : false;
    $parking_details = isset($_POST['parking_details']) ? mysqli_real_escape_string($conn,$_POST['parking_details']) : false;
    $outside_space = isset($_POST['outside_space']) ? mysqli_real_escape_string($conn,$_POST['outside_space']): false;
    $viewing_arrangements_name = isset($_POST['viewing_arrangements_name']) ? mysqli_real_escape_string($conn,$_POST['viewing_arrangements_name']) : false;
    $viewing_arrangements_contact_number = isset($_POST['viewing_arrangements_contact_number']) ? mysqli_real_escape_string($conn,$_POST['viewing_arrangements_contact_number']) : false;
    $viewing_arrangements_email = isset($_POST['viewing_arrangements_email']) ? mysqli_real_escape_string($conn,$_POST['viewing_arrangements_email']) : false;
    $viewing_arrangements_notes = isset($_POST['viewing_arrangements_notes']) ? mysqli_real_escape_string($conn,$_POST['viewing_arrangements_notes']) : false;
    $pets_allowed = isset($_POST['pets_allowed']) ? mysqli_real_escape_string($conn,$_POST['pets_allowed']): false;
    $children_allowed = isset($_POST['children_allowed']) ? mysqli_real_escape_string($conn,$_POST['children_allowed']): false;
    $sharers_allowed = isset($_POST['sharers_allowed']) ? mysqli_real_escape_string($conn, $_POST['sharers_allowed']): false;
    $students_allowed = isset($_POST['students_allowed']) ? mysqli_real_escape_string($conn, $_POST['students_allowed']): false;


    $sql_query = "UPDATE lettings_properties SET
        Address1 = '$Address1',
        Address2 = '$Address2',
        Address3='$Address3',
        postcode='$postcode',
        property_level='$property_level',
        lettings_availability='$lettings_availability',
        dwelling_type='$dwelling_type',
        key_tag='$key_tag',
        price='$price',
        available_from='$available_from',
        bedrooms='$bedrooms',
        bathrooms='$bathrooms',
        receptions='$receptions',
        borough='$borough',
        garden='$garden',
        parking='$parking',
        access_through='$access_through',
        floor_area='$floor_area',
        property_condition='$property_condition',
        heating_type='$heating_type',
        council_tax_band='$council_tax_band',
        council_tax_cost='$council_tax_cost',
        feature_1='$feature_1',
        feature_2='$feature_2',
        feature_3='$feature_3',
        feature_4='$feature_4',
        feature_5='$feature_5',
        feature_6='$feature_6',
        feature_7='$feature_7',
        feature_8='$feature_8',
        feature_9='$feature_9',
        feature_10='$feature_10',
        landlord_fn='$landlord_fn',
        landlord_ln='$landlord_ln',
        landlord_contact='$landlord_contact',
        landlord_email='$landlord_email',
        landlord_address='$landlord_address',
        parking_details='$parking_details',
        outside_space='$outside_space',
        viewing_arrangements_name='$viewing_arrangements_name',
        viewing_arrangements_contact_number='$viewing_arrangements_contact_number',
        viewing_arrangements_email='$viewing_arrangements_email',
        viewing_arrangements_notes='$viewing_arrangements_notes',
        pets_allowed='$pets_allowed',
        children_allowed='$children_allowed',
        sharers_allowed='$sharers_allowed',
        students_allowed='$students_allowed'
        WHERE user_id=".$_GET['edit_id'];
    
    
    if(mysqli_query($conn,$sql_query))
    {
    ?>
        <script type="text/javascript">
            alert('Data Are Inserted Successfully ');
            window.location.href = 'property_lettings_data.php';
        </script>
    <?php
    }
    else
    {

        die(mysqli_error($connect));
        ?>
       <script type="text/javascript">
        alert('error occured while inserting your data');
        </script>
        <?php
    }
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Database - Add Property</title>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php include "header.php";?>

<div id="header" style="text-align: center">
    <div id="content">
        <label>Add New Lettings Property</label>
    </div>
</div>
<form method="post">
    <div class ="container" style="width:1400px;" align="center">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4"> Location </th>
                </tr>
                <tr>
                    <td colspan="3" >
                        Address Line 1: <br>
                        <input style="margin-top: 12px; margin-bottom: 6px" type="text" name="Address1" class="form-control" value="<?php echo $row['Address1']; ?>" />
                        Address Line 2: <br>
                        <input style="margin-top: 3px; margin-bottom: 6px" type="text" name="Address2" class="form-control" value="<?php echo $row['Address2']; ?>" />
                        Address Line 3: <br>
                        <input style="margin-top: 3px; margin-bottom: 6px" type="text" name="Address3" class="form-control" value="<?php echo $row['Address3']; ?>" />
                        Postcode: <br>
                        <input style="margin-top: 3px; margin-bottom: 6px" type="text" name="postcode"  class="form-control" value="<?php echo $row['postcode']; ?>" />
                    </td>

                    <td> <h4>Status: </h4><br>
                            <input name="lettings_availability" type="text" value="<?php echo $row['lettings_availability']; ?>">
                            <button type="sumbit" name="btn-update">
                            <strong>
                                Update
                            </strong>
                        </button>
                        <br>
                        Key Tag: <br>
                        <input name="key_tag" type="text" id="key_tag" value="<?php echo $row['key_tag']; ?>">
                    </td>
                </tr>

                <tr>
                    <th colspan="4">Property Information</th>
                </tr>
                <tr>
                    <td>Level & Dwelling Type: <br>
                        <input type="text" class="form-control" name="property_level" value="<?php echo $row['property_level']; ?>">
                    </td>

                    <td>Dwelling Type: <br>
                        <input type="text" class="form-control" name= "dwelling_type" value="<?php echo $row['dwelling_type']; ?>">
                    </td>

                    <td>Price:<br>
                        <input type="text" name="price" placeholder="£" class="form-control" value="<?php echo $row['price']; ?>"/>
                    </td>
                    <td>
                        Available From:
                        <input type="date" name="available_from" class="form-control" value="<?php echo $row['available_from']; ?>">
                    </td>
                </tr>

                <tr>
                    <td >Bedrooms:<br>
                        <input type="text" name="bedrooms" placeholder="£" class="form-control" value="<?php echo $row['bedrooms']; ?>"/>
                    </td>

                    <td>Bathrooms:<br>
                        <input type="text" name="bathrooms" placeholder="£" class="form-control" value="<?php echo $row['bathrooms']; ?>"/>
                    </td>

                    <td>Reception Rooms: <br>
                        <input type="text" name="receptions" placeholder="£" class="form-control" value="<?php echo $row['receptions']; ?>"/>
                    </td>

                    <td>Local Borough: <br>
                        <input type="text" name="borough" placeholder="£" class="form-control" value="<?php echo $row['borough']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Outside Space: <br>
                        <input type="text" name="garden" placeholder="£" class="form-control" value="<?php echo $row['garden']; ?>"/>
                    </td>

                    <td>Parking: <br>
                        <input type="text" name="parking" placeholder="£" class="form-control" value="<?php echo $row['parking']; ?>"/>
                    </td>

                    <td>Access Through: <br>
                        <input type="text" name="access_through" placeholder="£" class="form-control" value="<?php echo $row['access_through']; ?>"/>
                    </td>
                    <td>
                        <a target="_blank" href="https://www.epcregister.com/reportSearchAddressTerms.html?redirect=reportSearchAddressByPostcode"> Floor Area:</a><br>
                        <input type="text" name="floor_area" class="form-control" value="<?php echo $row['floor_area']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td >
                        Property Condition: <br>
                        <input type="text" name="property_condition" class="form-control" value="<?php echo $row['property_condition']; ?>"/>
                    </td>

                    <td>
                        Heating Type <br>
                        <input type="text" name="heating_type" class="form-control" value="<?php echo $row['heating_type']; ?>"/>
                    </td>

                    <td>
                        <a target="_blank" href="http://cti.voa.gov.uk/cti/inits.asp">Council Tax Band</a><br>
                        <input type="text" name="council_tax_band" class="form-control" value="<?php echo $row['council_tax_band']; ?>"/>

                    </td>

                    <td>
                        Council Tax Cost (Per Annum) </a><br>
                        <input type="text" name="council_tax_cost" placeholder="£" class="form-control" value="<?php echo $row['council_tax_cost']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>Pets Allowed: <br>
                        <input type="text" name="pets_allowed" placeholder="£" class="form-control" value="<?php echo $row['pets_allowed']; ?>"/>
                    </td>

                    <td>Children Allowed: <br>
                        <input type="text" name="children_allowed" placeholder="£" class="form-control" value="<?php echo $row['children_allowed']; ?>"/>
                    </td>

                    <td>Sharers Allowed: <br>
                        <input type="text" name="sharers_allowed" placeholder="£" class="form-control" value="<?php echo $row['sharers_allowed']; ?>"/>
                    </td>

                    <td>Students Allowed: <br>
                        <input type="text" name="students_allowed" placeholder="£" class="form-control" value="<?php echo $row['students_allowed']; ?>"/>
                    </td>
                </tr>
                <tr>
                <tr>
                    <td colspan="2">
                        Feature 1: <input style="width:100%; margin-top: 12px; margin-bottom: 6px" type="text" name="feature_1" class="form-control" value="<?php echo $row['feature_1']; ?>"/><br>
                        Feature 2: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_2" class="form-control"value="<?php echo $row['feature_2']; ?>"/> <br>
                        Feature 3: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_3" class="form-control" value="<?php echo $row['feature_3']; ?>"/><br>
                        Feature 4: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_4" class="form-control" value="<?php echo $row['feature_4']; ?>"/><br>
                        Feature 5: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_5" class="form-control" value="<?php echo $row['feature_5']; ?>"/><br>
                    </td>
                    <td colspan="2">
                        Feature 6: <input style="width:100%; margin-top: 12px; margin-bottom: 6px" type="text" name="feature_6" class="form-control" value="<?php echo $row['feature_6']; ?>"/><br>
                        Feature 7: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_7" class="form-control" value="<?php echo $row['feature_7']; ?>"/> <br>
                        Feature 8: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_8" class="form-control" value="<?php echo $row['feature_8']; ?>"/><br>
                        Feature 9: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_9" class="form-control" value="<?php echo $row['feature_9']; ?>"/><br>
                        Feature 10: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_10" class="form-control" value="<?php echo $row['feature_10']; ?>"/><br>
                    </td>
                </tr>



                <th colspan="4">
                    Landord Details:

                </th>
                <tr>
                    <td>First Name: <br>
                        <input type="text" name="landlord_fn" placeholder="" class="form-control" value="<?php echo $row['landlord_fn']; ?>"/>
                    </td>

                    <td>Last Name: <br>
                        <input type="text" name="landlord_ln" placeholder="" class="form-control" value="<?php echo $row['landlord_fn']; ?>" />
                    </td>

                    <td>Contact Number: <br>
                        <input type="text" name="landlord_contact" placeholder="" class="form-control" value="<?php echo $row['landlord_contact']; ?>"/>

                    </td>
                    <td>Email Address:<br>
                        <input type="text" name="landlord_email" placeholder="" class="form-control" value="<?php echo $row['landlord_email']; ?>" />
                    </td>
                </tr>
                </tr>
                <tr>
                    <th colspan="4">
                        Access Through:
                    </th>
                </tr>
                <tr>
                    <td>
                        Name:
                        <br>
                        <input name="viewing_arrangements_name" type="text" id="viewing_arrangements_name" class="form-control" value="<?php echo $row['viewing_arrangements_name']; ?>"/>
                    </td>
                    <td>
                        Contact Number:
                        <br>
                        <input name="viewing_arrangements_contact_number" type="text" id="viewing_arrangements_contact_number" class="form-control" value="<?php echo $row['viewing_arrangements_contact_number']; ?>">
                    </td>
                    <td>
                        Email:
                        <br>
                        <input name="viewing_arrangements_email" type="text" id="viewing_arrangements_email" class="form-control" value="<?php echo $row['viewing_arrangements_email']; ?>">
                    </td>
                    <td>
                        Special Notes:
                        <br>
                        <input name="viewing_arrangements_notes" type="text" id="viewing_arrangements_notes" class="form-control" value="<?php echo $row['viewing_arrangements_notes']; ?>">
                    </td>
                </tr>


                <script type = "text/javascript">
                    var isChecked = false;
                    function allSelected2(){
                        isChecked = !isChecked;
                        $('input:checkbox.jpparking').attr('checked',isChecked);
                    }
                </script>
                <tr>
                    <th class="labelCol3" colspan="4">Parking:<br>
                        <!-- This SelectALL makes no sense
                        <label>
                            <input id="selectAllCheckbox" onClick="allSelected2()" type="checkbox">Select All
                        </label><br/>-->
                    </th>
                </tr>
                <td colspan="4" class="dataCol3">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>

                                    <input name="parking_details" class="form-control" type="text" id="parking" value="<?php echo $row['parking_details']; ?>" >
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>



                <tr>
                    <th class="labelCol3" colspan="4">Outside Space:<br>
                        <!-- THIS SELECTALL DOESNT MAKE SENSE<label>
                            <input id="selectAllCheckbox" onClick="allSelected3()" type="checkbox">Select All
                        </label>-->
                    </th>
                </tr>
                <td colspan="4" class="dataCol3">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>

                                <input name="outside_space" class="form-control" type="text" id="outside_space" value="<?php echo $row['outside_space']; ?>" >
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>




            </table>
            <table>
                <tr>
                    <div style="text-align:center">
                        <th colspan="4" >
                            <button type="submit" name="btn-update" class="form-control">
                                <strong>
                                    UPDATE
                                </strong>
                            </button>
                        </th>
                    </div>
                </tr>
            </table>
</form>
</div>
</div>
<?php 
mysqli_close($conn);
?>

</body>
</html>