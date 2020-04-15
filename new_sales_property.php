<?php
    require 'functions.php';
    auth();
    include 'dbconfig.php';

    function mysqlescape($array)
    {
        global $conn;
        foreach($array as $item => $value)
        {
            $array[$item] = $value;
        }
            return $array;
    }


    if (!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }

    if(isset($_POST['btn-save'])) 
    {
        $Address1 = isset($_POST['Address1']) ? mysqli_real_escape_string($conn, $_POST['Address1']) : false;
        $Address2 = isset($_POST['Address2']) ? mysqli_real_escape_string($conn, $_POST['Address2']) : false;
        $Address3 = isset($_POST['Address3']) ? mysqli_real_escape_string($conn, $_POST['Address3']) : false;
        $postcode = isset($_POST['postcode']) ? mysqli_real_escape_string($conn, $_POST['postcode']) : false;
        $property_level = isset($_POST['property_level']) ? mysqli_real_escape_string($conn, $_POST['property_level']) : false;
        $sales_availability = isset($_POST['sales_availability']) ? mysqlescape($_POST['sales_availability']) : false;
        $isales_availability = is_array($sales_availability) ? implode(", ", $sales_availability) : false;
        $dwelling_type = isset($_POST['dwelling_type']) ? mysqli_real_escape_string($conn, $_POST['dwelling_type']) : false;
        $key_tag = isset($_POST['key_tag']) ? mysqli_real_escape_string($conn, $_POST['key_tag']) : false;
        $price = isset($_POST['price']) ? mysqli_real_escape_string($conn, $_POST['price']) : false;
        $bedrooms = isset($_POST['bedrooms']) ? mysqli_real_escape_string($conn, $_POST['bedrooms']) : false;
        $bathrooms = isset($_POST['bathrooms']) ? mysqli_real_escape_string($conn, $_POST['bathrooms']) : false;
        $receptions = isset($_POST['receptions']) ? mysqli_real_escape_string($conn, $_POST['receptions']) : false;
        $borough = isset($_POST['borough']) ? mysqli_real_escape_string($conn, $_POST['borough']) : false;
        $garden = isset($_POST['garden']) ? mysqli_real_escape_string($conn, $_POST['garden']) : false;
        $parking = isset($_POST['parking']) ? mysqli_real_escape_string($conn, $_POST['parking']) : false;
        $access_through = isset($_POST['access_through']) ? mysqli_real_escape_string($conn, $_POST['access_through']) : false;
        $floor_area = isset($_POST['floor_area']) ? mysqli_real_escape_string($conn, $_POST['floor_area']) : false;
        $property_age = isset($_POST['property_age']) ? mysqli_real_escape_string($conn, $_POST['property_age']) : false;
        $property_condition = isset($_POST['property_condition']) ? mysqli_real_escape_string($conn, $_POST['property_condition']) : false;
        $heating_type = isset($_POST['heating_type']) ? mysqli_real_escape_string($conn, $_POST['heating_type']) : false;
        $council_tax_band = isset($_POST['council_tax_band']) ? mysqli_real_escape_string($conn, $_POST['council_tax_band']) : false;
        $council_tax_cost = isset($_POST['council_tax_cost']) ? mysqli_real_escape_string($conn, $_POST['council_tax_cost']) : false;
        $sales_tenure = isset($_POST['sales_tenure']) ? mysqli_real_escape_string($conn, $_POST['sales_tenure']) : false;
        $feature_1 = isset($_POST['feature_1']) ? mysqli_real_escape_string($conn, $_POST['feature_1']) : false;
        $feature_2 = isset($_POST['feature_2']) ? mysqli_real_escape_string($conn, $_POST['feature_2']) : false;
        $feature_3 = isset($_POST['feature_3']) ? mysqli_real_escape_string($conn, $_POST['feature_3']) : false;
        $feature_4 = isset($_POST['feature_4']) ? mysqli_real_escape_string($conn, $_POST['feature_4']) : false;
        $feature_5 = isset($_POST['feature_5']) ? mysqli_real_escape_string($conn, $_POST['feature_5']) : false;
        $feature_6 = isset($_POST['feature_6']) ? mysqli_real_escape_string($conn, $_POST['feature_6']) : false;
        $feature_7 = isset($_POST['feature_7']) ? mysqli_real_escape_string($conn, $_POST['feature_7']) : false;
        $feature_8 = isset($_POST['feature_8']) ? mysqli_real_escape_string($conn, $_POST['feature_8']) : false;
        $feature_9 = isset($_POST['feature_9']) ? mysqli_real_escape_string($conn, $_POST['feature_9']) : false;
        $feature_10 = isset($_POST['feature_10']) ? mysqli_real_escape_string($conn, $_POST['feature_10']) : false;
        $landlord_fn = isset($_POST['landlord_fn']) ? mysqli_real_escape_string($conn, $_POST['landlord_fn']) : false;
        $landlord_ln = isset($_POST['landlord_ln']) ? mysqli_real_escape_string($conn, $_POST['landlord_ln']) : false;
        $landlord_contact = isset($_POST['landlord_contact']) ? mysqli_real_escape_string($conn, $_POST['landlord_contact']) : false;
        $landlord_email = isset($_POST['landlord_email']) ? mysqli_real_escape_string($conn, $_POST['landlord_email']) : false;
        $landlord_address = isset($_POST['landlord_address']) ? mysqli_real_escape_string($conn, $_POST['landlord_address']) : false;
        $leasehold_remaining = isset($_POST['leasehold_remaining']) ? mysqli_real_escape_string($conn, $_POST['leasehold_remaining']) : false;
        $service_charge = isset($_POST['service_charge']) ? mysqli_real_escape_string($conn, $_POST['service_charge']) : false;
        $ground_rent = isset($_POST['ground_rent']) ? mysqli_real_escape_string($conn, $_POST['ground_rent']) : false;
        $outside_space = isset($_POST['outside_space']) ? mysqlescape($_POST['outside_space']) : false;
        $ioutside_space = is_array($outside_space) ? implode(", ", $outside_space) : false;
        $parking_type = isset($_POST['parking_type']) ? mysqlescape($_POST['parking_type']) : false;
        $iparking_type = is_array($parking_type) ? implode(", ", $parking_type) : false;
        $viewing_arrangements_name = isset($_POST['viewing_arrangements_name']) ? mysqli_real_escape_string($conn, $_POST['viewing_arrangements_name']) : false;
        $viewing_arrangements_contact_number = isset($_POST['viewing_arrangements_contact_number']) ? mysqli_real_escape_string($conn, $_POST['viewing_arrangements_contact_number']) : false;
        $viewing_arrangements_email = isset($_POST['viewing_arrangements_email']) ? mysqli_real_escape_string($conn, $_POST['viewing_arrangements_email']) : false;
    
        $sql_query = "INSERT INTO sales_properties(Address1,Address2,Address3,postcode,property_level,sales_availability,dwelling_type,
        key_tag,price,bedrooms,bathrooms,receptions,borough,garden,parking,access_through,floor_area,property_age,property_condition,heating_type,council_tax_band,
        council_tax_cost,sales_tenure,feature_1,feature_2,feature_3,feature_4,feature_5,feature_6,feature_7,feature_8,feature_9,feature_10,landlord_fn,
        landlord_ln,landlord_contact,landlord_email,landlord_address,leasehold_remaining,service_charge,ground_rent,outside_space,parking_type,
        viewing_arrangements_name,viewing_arrangements_contact_number,viewing_arrangements_email) 
        VALUES('$Address1','$Address2','$Address3','$postcode','$property_level',
        '$isales_availability','$dwelling_type','$key_tag','$price','$bedrooms','$bathrooms',
        '$receptions','$borough','$garden','$parking','$access_through','$floor_area','$property_age',
        '$property_condition','$heating_type','$council_tax_band','$council_tax_cost','$sales_tenure','$feature_1','$feature_2',
        '$feature_3','$feature_4','$feature_5','$feature_6','$feature_7','$feature_8','$feature_9','$feature_10',
        '$landlord_fn','$landlord_ln','$landlord_contact','$landlord_email','$landlord_address','$leasehold_remaining',
        '$service_charge','$ground_rent','$ioutside_space','$iparking_type','$viewing_arrangements_name','$viewing_arrangements_contact_number',
        '$viewing_arrangements_email')";

        if($q = mysqli_query($conn, $sql_query))
        {
        ?>
            <script type="text/javascript">
                setTimeout(function () {alert('Data Inserted'); }, 10000);
                window.location.href = 'property_sales_data.php';
            </script>
        <?php
        }
        else
        {
            die(mysqli_error($conn));
        ?>
        <?php
        }
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>
            Database - Add Property
        </title>

        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>

    <body>
        <?php 
            include "header.php";
        ?>

        <div id="header" style="text-align: center">
            <div id="content">
                <h2>
                    Add New Sales Property
                </h2>
            </div>
        </div>

        <form method="post">
            <div class ="container" style="width:1000px;" align="center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="4" style="background-color:firebrick;"> 
                                <h4 style="color:gold">
                                    Location:
                                </h4> 
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3" >
                                Address Line 1:
                                  
                                    <input style="margin-top: 12px; margin-bottom: 6px" type="text" name="Address1" class="form-control">
                                  
                                Address Line 2: 
                                    <br/>
                                    <input style="margin-top: 3px; margin-bottom: 6px" type="text" name="Address2" class="form-control">
                                  
                                Address Line 3: 
                                   
                                    <input style="margin-top: 3px; margin-bottom: 6px" type="text" name="Address3" class="form-control">
                                   
                                Postcode: 
                                    <br/>
                                    <input style="margin-top: 3px; margin-bottom: 6px" type="text" name="postcode"  class="form-control">
                            </td>

                            <td> <h4>Status: </h4><br/>


                            <label>
                                <input name="sales_availability[]" type="radio" value="Available"> 
                                Available
                            </label>

                            <br/>

                            <label>
                                <input name="sales_availability[]" type="radio" value="On Hold"> 
                                On Hold
                            </label>

                            <br/>

                            <label>
                                <input name="sales_availability[]" type="radio" value="Under Offer"> 
                                Under Offer
                            </label>
                           
                            <br/>

                            <label>
                                <input name="sales_availability[]" type="radio" value="Sold">
                                Sold
                            </label>

                            <br/>

                            <button type="sumbit" name="btn-save">
                                <strong>
                                    Update
                                </strong>
                            </button>

                            <br/>

                            Key Tag: 
                            
                            <br/>

                            <input name="key_tag" type="text" id="key_tag">
                            </td>
                        </tr>

                        <tr>
                            <th colspan="4" style="background-color:firebrick;"> 
                                <h4 style="color:gold">
                                    Property Information:
                                </h4> 
                            </th>
                        </tr>

                        <tr>
                            <td>Level & Dwelling Type: <br/>
                                <select name="property_level" class="form-control"/>
                                    <option></option>
                                    <option value="Basement">Basement</option>
                                    <option value="Ground Floor">Ground Floor</option>
                                    <option value="First Floor">First Floor</option>
                                    <option value="Second Floor">Second Floor</option>
                                    <option value="Third Floor">Third Floor</option>
                                    <option value="Fourth Floor">Fourth Floor</option>
                                    <option value="Split Level">Split Level</option>
                                    <option value="Purpose Built">Purpose Built</option>
                                    <option value="Link Detached">Link Detached</option>
                                    <option value="Semi-Detached">Semi-Detached</option>
                                    <option value="Mid-Terraced">Mid-Terraced</option>
                                    <option value="End-Terraced">End-Terraced</option>
                                    <option value="Purpose Built">Purpose Built</option>
                                </select>
                            </td>

                            <td>Dwelling Type: <br/>
                            <select name="dwelling_type" class="form-control"/>
                                <option></option>
                                <option value="Flat">Flat</option>
                                <option value="House">House</option>
                                <option value="Apartment">Apartment</option>
                                <option value="Farm House">Farm House</option>
                                <option value="Manor House">Manor House</option>
                                <option value="Maisonette">Maisonette</option>
                                <option value="Mews">Mews</option>
                                <option value="Town House">Town House</option>
                                <option value="Villa">Villa</option>
                                <option value="Shared House">Shared House</option>
                                <option value="Shared Flat">Shared Flat</option>
                                <option value="Sheltered House">Sheltered House</option>
                                <option value="Chalet">Chalet</option>
                                <option value="Barn Conversion">Barn Conversion</option>
                                <option value="Cottage">Cottage</option>
                                <option value="Room Let">Room Let</option>
                            </select>
                            </td>

                            <td>Price:<br/>
                                <input type="text" name="price" placeholder="£" class="form-control"/>
                            </td>

                            <td>
                                Sales Tenure:
                                <select name="sales_tenure" class="form-control"/>
                                    <option></option>
                                    <option value="Leasehold">Leasehold</option>
                                    <option value="Share of Freehold">Share of Freehold</option>
                                    <option value="Freehold">Freehold</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td >Bedrooms:<br/>
                                <select name="bedrooms" class="form-control"/>
                                    <option></option>
                                    <option value="0">0</option>
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

                            <td>Bathrooms:<br/>
                                <select name="bathrooms" class="form-control"/>
                                    <option></option>
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

                            <td>Reception Rooms: <br/>
                                <select name="receptions" class="form-control"/>
                                    <option></option>
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

                            <td>Local Borough: <br/>
                                <select name="borough" class="form-control">
                                <option></option>
                                    <option value="Barnet">Barnet</option>
                                    <option value="Bexley">Bexley</option>
                                    <option value="Brent">Brent</option>
                                    <option value="Bromley">Bromley</option>
                                    <option value="Camden">Camden</option>
                                    <option value="Croydon">Croydon</option>
                                    <option value="Ealing">Ealing</option>
                                    <option value="Enfield">Enfield</option>
                                    <option value="Greenwich">Greenwich</option>
                                    <option value="Hackney">Hackney</option>
                                    <option value="Hammersmith and Fulham">Hammersmith and Fulham</option>
                                    <option value="Haringey">Haringey</option>
                                    <option value="Harrow">Harrow</option>
                                    <option value="Havering">Havering</option>
                                    <option value="Hillingdon">Hillingdon</option>
                                    <option value="Hounslow">Hounslow</option>
                                    <option value="Islington">Islington</option>
                                    <option value="Kensington and Chelsea">Kensington and Chelsea</option>
                                    <option value="Kingston Upon Thames">Kingston upon Thames</option>
                                    <option value="Lambeth">Lambeth</option>
                                    <option value="Lewisham">Lewisham</option>
                                    <option value="Merton">Merton</option>
                                    <option value="Newham">Newham</option>
                                    <option value="Redbridge">Redbridge</option>
                                    <option value="Richmond upon Thames">Richmond upon Thames</option>
                                    <option value="Southwark">Southwark</option>
                                    <option value="Sutton">Sutton</option>
                                    <option value="Tower Hamlets">Tower Hamlets</option>
                                    <option value="Waltham Forest">Waltham Forest</option>
                                    <option value="Wandsworth">Wandsworth</option>
                                    <option value="Westminster">Westminster</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Outside Space: <br/>
                                <select name="garden" class="form-control"/>
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>

                            <td>Parking: <br/>
                                <select name="parking" class="form-control"/>
                                    <option></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>

                            <td>
                                <a target="_blank" href="https://www.epcregister.com/reportSearchAddressTerms.html?redirect=reportSearchAddressByPostcode"> 
                                    Floor Area:
                                </a>
                                <input type="text" name="floor_area" placeholder="sq.m." class="form-control" >
                            </td>
                                    
                            <td>EPC Rating: 
                                <select name="epc_rating" class="form-control" >
                                    <option></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                </select>
                            </td>
                            
                        </tr>

                        <tr>
                            <td >
                                Property Condition: <br/>
                                <select name="property_condition" class="form-control"/>
                                    <option></option>
                                    <option value="Very Good">Very Good</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Work Required">Work Required</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Newly Refurbished">Newly Refurbished</option>
                                </select>
                            </td>

                            <td>
                                Heating Type <br/>
                                <select name="heating_type" class="form-control"/>
                                    <option></option>
                                    <option value="Gas Central Heating">Gas Central Heating</option>
                                    <option value="Oil Central Heating">Oil Central Heating</option>
                                    <option value="Electric Heating">Electric Heating</option>
                                    <option value="Electric Storage Heating">Electric Storage Heating</option>
                                    <option value="Underfloor Heating">Underfloor Heating</option>
                                    <option value="Solar Heating">Solar Heating</option>
                                    <option value="LPG Central Heating">LPG Central Heating</option>
                                    <option value="Solid Fuel">Solid Fuel</option>
                                </select>
                            </td>

                            <td>
                                <a target="_blank" href="http://cti.voa.gov.uk/cti/inits.asp">Council Tax Band</a><br/>
                                <select name="council_tax_band" class="form-control"/>
                                    <option></option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                    <option value="G">G</option>
                                    <option value="H">H</option>
                                    <option value="I">I</option>
                                </select>
                            </td>

                            <td>
                                Council Tax Cost (Per Annum)<br/>
                                <input type="text" name="council_tax_cost" placeholder="£" class="form-control"/>
                            </td>
                        </tr>

                        <tr>
                            <td>Service Charge: <br/>
                                <input type="text" name="service_charge" placeholder="£" class="form-control"/>
                            </td>

                            <td>Ground Rent: <br/>
                                <input type="text" name="ground_rent" placeholder="£" class="form-control"/>
                            </td>

                            <td>Remaining Leasehold: <br/>
                                <input type="text" name="leasehold_remaining" class="form-control"/>
                            </td>

                            <td>Property Age: <br/>
                                <select name="property_age" class="form-control">
                                    <option></option>
                                    <option value="Georgian">Georgian</option>
                                    <option value="Victorian">Victorian</option>
                                    <option value="Edwardian">Edwardian</option>
                                    <option value="Modern">Modern</option>
                                </select>
                            </td>
                        </tr>
                      
                        <tr>
                            <th colspan="4" style="background-color:firebrick;"> 
                                <h4 style="color:gold">
                                    Feature:
                                </h4> 
                            </th>
                        </tr>
                        <tr>
                            
                            <td colspan="2">
                                Feature 1: <input style="width:100%; margin-top: 12px; margin-bottom: 6px" type="text" name="feature_1" class="form-control"/><br/>
                                Feature 2: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_2" class="form-control"/> <br/>
                                Feature 3: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_3" class="form-control"/><br/>
                                Feature 4: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_4" class="form-control"/><br/>
                                Feature 5: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_5" class="form-control"/><br/>
                            </td>
                            <td colspan="2">
                                Feature 6: <input style="width:100%; margin-top: 12px; margin-bottom: 6px" type="text" name="feature_6" class="form-control"/><br/>
                                Feature 7: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_7" class="form-control"/> <br/>
                                Feature 8: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_8" class="form-control"/><br/>
                                Feature 9: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_9" class="form-control"/><br/>
                                Feature 10: <input style="width:100%; margin-top: 3px; margin-bottom: 6px" type="text" name="feature_10" class="form-control"/><br/>
                            </td>
                        </tr>



                        <th colspan="4" style="background-color:firebrick;">
                            <h4 style="color:gold">Landord Details:</h4>
                        </th>

                        <tr>
                            <td>First Name: <br/>
                                <input type="text" name="landlord_fn" placeholder="" class="form-control"/>
                            </td>

                            <td>Last Name: <br/>
                                <input type="text" name="landlord_ln" placeholder="" class="form-control" />
                            </td>

                            <td>Contact Number: <br/>
                                <input type="text" name="landlord_contact" placeholder="" class="form-control"/>
                            </td>

                            <td>Email Address:<br/>
                                <input type="text" name="landlord_email" placeholder="" class="form-control" />
                            </td>
                        </tr>

                        <tr>
                            <th colspan="4" style="background-color:firebrick;"> 
                                <h4 style="color:gold">Tenant (if applicable):</h4> 
                            </th>
                        </tr>

                        <tr>
                            <td>Access Through: <br/>
                                <select name="access_through" class="form-control"/>
                                    <option></option>
                                    <option value="Vacant">Vacant</option>
                                    <option value="Tenant">Tenant</option>
                                    <option value="Vendor">Vendor</option>
                                    <option value="Other">Other</option>
                                </select>
                            </td>

                            <td>
                                Name:<br/>
                                <input name="viewing_arrangements_name" type="text" id="viewing_arrangements_name" class="form-control">
                            </td>

                            <td>
                                Contact Number:<br/>
                                <input name="viewing_arrangements_contact_number" type="text" id="viewing_arrangements_contact_number" class="form-control">
                            </td>

                            <td>
                                Email:<br/>
                                <input name="viewing_arrangements_email" type="text" id="viewing_arrangements_email" class="form-control">
                            </td>
                        </tr>

                        <script type = "text/javascript">
                            var isChecked = false;
                            function allSelected2()
                            {
                                isChecked = !isChecked;
                                $('input:checkbox.jpparking').attr('checked',isChecked);
                            }
                        </script>

                        <tr>
                            <th colspan="4" style="background-color:firebrick;"> 
                                <h4 style="color:gold">Parking:</h4> 
                            </th>
                        </tr>

                        <td colspan="4" class="dataCol3">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td width="33%">
                                            <label>
                                                <input name="parking_type[]" class = "jpparking" type="checkbox" id="parking[]" value="Garage" class="form-control"> Garage
                                            </label>
                                        </td>

                                        <td width="33%">
                                            <label>
                                                <input name="parking_type[]" class = "jpparking" type="checkbox" id="parking[]" value="Double Garage" class="form-control"> Double Garage
                                            </label>
                                        </td>

                                        <td width="33%">
                                            <label>
                                                <input name="parking_type[]" class = "jpparking" type="checkbox" id="parking[]" value="Triple Garage" class="form-control"> Triple Garage
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>
                                                <input name="parking_type[]" type="checkbox" class = "jpparking" id="parking[]" value="Carport" class="form-control"> Carport
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="parking_type[]" type="checkbox" class = "jpparking" id="parking[]" value="Off Road Parking" class="form-control"> Off Road Parking
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="parking_type[]" type="checkbox" class = "jpparking" id="parking[]" value="On Road Parking" class="form-control"> On Road Parking
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>
                                                <input name="parking_type[]" type="checkbox" class = "jpparking" id="parking[]" value="Permit Parking" class="form-control"> Permit Parking
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="parking_type[]" type="checkbox" class = "jpparking" id="parking[]" value="Secure Gated Parking" class="form-control"> Secure Gated Parking
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="parking_type[]" type="checkbox" class = "jpparking" id="parking[]" value="Allocated Parking" class="form-control"> Allocated Parking
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>

                        <script type = "text/javascript">
                            var isChecked = false;
                            function allSelected3()
                            {
                                isChecked = !isChecked;
                                $('input:checkbox.jpoutsidespace').attr('checked',isChecked);
                            }
                        </script>

                        <tr>
                            <th colspan="4" style="background-color:firebrick;"> 
                                <h4 style="color:gold">
                                Outside Space:
                                </h4> 
                            </th>
                        </tr>
                        
                        <td colspan="4" class="dataCol3">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td width="33%">
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Conservatory"> Conservatory
                                            </label>
                                        </td>

                                        <td width="33%">
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Communal Garden"> Communal Garden
                                            </label>
                                        </td>

                                        <td width="33%">
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Large Garden"> Large Garden
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Balcony"> Balcony
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Patio" > Patio
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="South Facing Garden"> South Facing Garden
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Roof Terrace"> Roof Terrace
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Garden"> Garden
                                            </label>
                                        </td>

                                        <td>
                                            <label>
                                                <input name="outside_space[]" type="checkbox" class = "jpoutsidespace" id="outside_space[]" value="Off-Street Parking"> Off-Street Parking
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                                                
                        <tr>
                            <div style="text-align:center">
                                <th colspan="4" >
                                    <button type="submit" name="btn-save" class="form-control" style="background-color: goldenrod;">
                                        <strong style="color:indigo">
                                            SAVE
                                        </strong>
                                    </button>
                                </th>
                            </div>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
        
        <?php 
        mysqli_close($conn);
        ?>
    </body>
</html>