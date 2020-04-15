<?php
require 'functions.php';
auth();
require 'dbconfig.php'; 
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
$query = "SELECT * FROM lettings_properties ORDER BY user_id DESC";
$init_result = mysqli_query($conn, $query);
if(isset($_POST["get_data"])){
    $id = $_POST["id"];
    $sql= "SELECT * FROM lettings_properties WHERE user_id='$id'";
    $details_handler = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($details_handler);
    echo json_encode($result);
    exit();
}
if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM lettings_properties WHERE user_id=".$_GET['delete_id'];
        mysqli_query($conn, $sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lettings Property</title>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <script type="text/javascript">
        function edt_id(id) {
            window.location.href = 'edit_lettings_property.php?edit_id=' + id;
        }
        function delete_id(id) {
            if (confirm('Sure to Delete ?')) {
                if(confirm('Confirm twice')){
                    window.location.href = 'property_lettings_data_old.php?delete_id=' + id;
                }
            }
        }
    </script>
</head>
<body>

<?php include "header.php";?>



<div class="container" style="width:1800px;" align="center">
    <h3 class="text-center">Lettings Properties</h3>
    <div class="table-responsive" id="lettings_table">
        <table class="table table-bordered">

                <tr>
                    <td style = "font-size: 14px;" colspan="15">
                        <form action="property_lettings_data.php" method="POST">
                        <input style="font-size: 14px" type="text" name="query" />
                        <input style="font-size: 14px" type="submit" name="search" value="Search" />
                            <a style="font-size: 14px" target="_blank" href="https://www.rightmove.co.uk/property-to-rent/find.html?locationIdentifier=BRANCH%5E62389&sortType=1&includeSSTC=true&viewType=GRID"> All Properties</a> |
                            <a style="font-size: 14px" target="_blank" href="https://www.epcregister.com/reportSearchAddressTerms.html?redirect=reportSearchAddressByPostcode">EPC Register</a> |
                            <a style="font-size: 14px" target="_blank" href="http://cti.voa.gov.uk/cti/inits.asp">Council Tax Band</a>  |
                            <a style="font-size: 14px" target="_blank" href="https://mightytext.net/web8/">Mighty Text</a>  |
                            <a style="font-size: 14px" target="_blank" href=" https://login.jupix.co.uk/index4.php/">Jupix</a>  |
                            <a style="font-size: 14px" target="_blank" href="https://batchgeo.com/">Batch Geo</a>  |
                            <a style="font-size: 14px" target="_blank" href="https://www.freemaptools.com/">Free Map Tools</a>  |
                            <a style="font-size: 14px" target="_blank" href=" http://remote.bensonpartners.co.uk/mail/?_task=mail&_mbox=INBOX">Emails</a>
                            <div style='float: right; font-size: 14px'>
                        </form>
                        <form method="get" action="new_lettings_property.php">
                            <button type="submit"> Add Property </button>
                        </form>

                    </td>

                </tr>

                    <tr>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>Level</th>
                        <th>Dwelling Type</th>
                        <th>Price</th>
                        <th>Bedrooms</th>
                        <th>Bathrooms</th>
                        <th>Reception Rooms</th>
                        <th>Garden</th>
                        <th>Parking</th>
                        <th>Access Through</th>
                        <th>Floor Area</th>
                        <th>Status</th>
                        <th colspan="3">Operations</th>
                    </tr>
                    
            <?php 
            
           
                if(isset($_POST['search'])){
                    $valuetosearch = $_POST['query'];
                    $query = "SELECT * FROM lettings_properties
                    WHERE (`Address1` LIKE '%".$valuetosearch."%') 
                    OR (`Address2` LIKE '%".$valuetosearch."%')
                    OR (`Address3` LIKE '%".$valuetosearch."%') 
                    OR (`postcode` LIKE '%".$valuetosearch."%')
                    OR (`property_level` LIKE '%".$valuetosearch."%') 
                    OR (`parking_details` LIKE '%".$valuetosearch."%')
                    OR (`dwelling_type` LIKE '%".$valuetosearch."%') ORDER BY lettings_properties.time DESC";
                    $result=filterTable($conn,$query);
                } else {
                    $query = "SELECT * FROM lettings_properties ORDER BY lettings_properties.time DESC ";
                    $result = filterTable($conn, $query);
                }
                    function filterTable($conn,$query){
                    $filter_Result = mysqli_query($conn, $query);
                    return $filter_Result;
                }
            ?>
            <?php
            $sql_query="SELECT * FROM lettings_properties ORDER BY lettings_properties.bedrooms ASC, price DESC";
            $result_set=mysqli_query($conn,$sql_query);
            while($row=mysqli_fetch_assoc($result_set))
                while ($row = mysqli_fetch_array($result)) {
            {
                ?>
                <tr>
                    <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal">
                            <?php echo $row['Address1'].$row['Address2'].$row['Address3']; ?>
                    </td>
                    <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['postcode']; ?></td> <!-- Postcode-->
                    <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['property_level']; ?></td> <!--Dwelling Type-->
                    <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['dwelling_type']; ?></td> <!--Dwelling Type-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['price']; ?></td> <!--Price-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['bedrooms']; ?></td> <!--Bedrooms-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['bathrooms']; ?></td> <!--Bathrooms-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['receptions']; ?></td> <!--Reception Rooms-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['garden']; ?></td> <!--Garden Boolean-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['parking']; ?></td> <!--Parking Boolean-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['access_through']; ?></td> <!--Access Through-->
                    <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['floor_area']; ?></td> <!--Floor Area-->
                    <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['lettings_availability']; ?></td> <!--Floor Area-->

                    <td >
                        <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')">Edit</a>
                    </td>
                    <td >
                        <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')">Delete</a>
                    </td>

                </tr>
                <?php
                }}
            ?>
            </table>
        </div>
    </div>
        <script>
            function loadData(id) {
                $.ajax({
                    url: "property_lettings_data_old.php",
                    method: "POST",
                    data: {get_data: 1, id: id},
                    success: function (response) {
                        response = JSON.parse(response);
                        console.log(response);
                        //var html = "";
                        var html = '<table class="table">\n' +
                            '  <tbody>\n' +
                            '    <th colspan="4">\n ' + response.Address1 + response.Address2 + response.Address3 + '</th>' +
                            '    <tr> \n' +
                            '      <td style="font-size: 14px">' + response.property_level + '</td>\n' +
                            '      <td style="font-size: 14px">' + response.dwelling_type+  '</td>\n' +
                            '      <td style="font-size: 14px">Price: £'+ response.price + '</td>\n' +
                            '      <td style="font-size: 14px">Floor Area: ' + response.floor_area + 'sq.m.</td>\n' +
                            '    </tr>\n' +
                            '    <tr>\n' +
                            '      <td style="font-size: 14px">Bedrooms: ' + response.bedrooms + '</td>\n' +
                            '      <td style="font-size: 14px">Bathrooms:' + response.bathrooms +  '</td>\n' +
                            '      <td style="font-size: 14px">Receptions:'+ response.receptions + '</td>\n' +
                            '      <td style="font-size: 14px">Status: '+ response.lettings_availability + '</td>\n' +
                            '    </tr>\n' +
                            '    <th colspan="4">\n ' + 'Key Features' + '</th>' +
                            '    <tr>\n' +
                            '      <td style="font-size: 14px">Outside Space: <br>' + response.outside_space + '</td>\n' +
                            '      <td style="font-size: 14px">Parking: <br>' + response.parking_details +  '</td>\n' +
                            '      <td style="font-size: 14px">Heating Type: <br>' + response.heating_type + '</td>\n' +
                            '      <td style="font-size: 14px">Condition: <br> ' + response.property_condition + '</td>\n' +
                            '    </tr>\n' +
                            '    <tr>\n' +
                            '      <td style="font-size: 14px">Borough: <br>' + response.borough + '</td>\n' +
                            '      <td style="font-size: 14px">Council Tax Band: <br> rated: ' + response.council_tax_band +  '</td>\n' +
                            '      <td style="font-size: 14px">Approx Council Tax:<br> £' + response.council_tax_cost + ' per annum</td>\n' +
                            '      <td style="font-size: 14px">Available From:<br> ' + response.available_from + '</td>\n' +
                            '    </tr>\n' +
                            '    <th colspan="4">\n ' + 'Requirements' + '</th>' +
                            '    <tr>\n' +
                            '      <td style="font-size: 14px">Pets: ' + response.pets_allowed + '</td>\n' +
                            '      <td style="font-size: 14px">Students: ' + response.students_allowed +  '</td>\n' +
                            '      <td style="font-size: 14px">Children:' + response.children_allowed + '</td>\n' +
                            '      <td style="font-size: 14px">Sharers:' + response.sharers_allowed + '</td>\n' +
                            '    </tr>\n' +
                            '    <th colspan="4">\n ' + 'Features' + '</th>' +
                            '    <tr>\n' +
                            '      <td colspan="4" style="font-size: 14px">' + '<ul style="list-style-type:none;"><li>'+response.feature_1+'</li><li>'+response.feature_2+'</li><li>'+response.feature_3+'</li><li>'+response.feature_4+'</li><li>'+response.feature_5+'</li><li>'+response.feature_6+'</li><li>'+response.feature_7+'</li><li>'+response.feature_8+'</li><li>'+response.feature_9+'</li><li>'+response.feature_10+'</li></ul>' + '</td>\n' +
                            '    </tr>\n' +
                            '    <th colspan="4">\n ' + 'Landlord Details' + '</th>' +
                            '    <tr>\n' +
                            '      <td style="font-size: 14px">' + response.landlord_fn + '</td>\n' +
                            '      <td style="font-size: 14px">' + response.landlord_contact +  '</td>\n' +
                            '      <td style="font-size: 14px">' + response.landlord_email + '</td>\n' +
                            '      <td style="font-size: 14px">' + response.landlord_address + '</td>\n' +
                            '    </tr>\n' +
                            '    <th colspan="4">\n ' + 'Viewing Arrangements' + '</th>' +
                            '    <tr>\n' +
                            '      <td style="font-size: 14px"> ' + response.access_through +  '</td>\n' +
                            '      <td style="font-size: 14px">'+ response.viewing_arrangements_name +  ' '+ response.viewing_arrangements_contact_number +  '</td>\n' +
                            '      <td style="font-size: 14px">' + response.viewing_arrangements_email + '</td>\n' +
                            '      <td style="font-size: 14px">Key Tag: ' + response.key_tag + '</td>\n' +
                            '    </tr>\n' +
                            '  </tbody>\n' +
                            '</table>';
                        $("#modal-body").html(html);
                        $("button#edit-modal").attr('onclick', 'javascript:edt_id(' + response.user_id + ')' );
                        $("button#delete-modal").attr('onclick', 'javascript:delete_id(' + response.user_id + ')' );
                        $("button#applicant-match").attr('onclick', 'javascript:applicant_match(' + response.user_id + ')' );
                        // And finally you can this function to show the pop-up/dialog
                        $("#myModal").modal();
                    }
                });
            }
        </script>
        <!-- Modal -->
        <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">
            <div class = "modal-dialog" style="width:800px">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h4 class = "modal-title">
                            Property Details
                        </h4>
                        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                            ×
                        </button>
                    </div>
                    <div id = "modal-body">
                        Press ESC button to exit.
                    </div>
                    <div class = "modal-footer">
                        <button id ="edit-modal" type = "button" class = "btn btn-default"  data-dismiss = "modal">
                            Edit
                        </button>
                        <button id ="book_viewing_handler" type = "button" class = "btn btn-default"  data-dismiss = "modal">
                            Applicant Match
                        </button>
                        <button id="delete-modal" type = "button" class = "btn btn-default" data-dismiss = "modal"">
                        Delete
                        </button>
                        <button type = "button" class = "btn btn-default" data-dismiss = "modal">
                            Close
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<?php
mysqli_close($conn);
?>
</body>

</html>