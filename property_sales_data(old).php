<?php

require 'functions.php';
auth();
include 'dbconfig.php';
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

$query = "SELECT * FROM sales_properties ORDER BY user_id DESC";
$init_result = mysqli_query($conn, $query);

if(isset($_POST["get_data"])){
    $id = $_POST["id"];
    $sql = "SELECT * FROM sales_properties WHERE user_id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
    exit();
}

if(isset($_GET['delete_id']))
{
    $sql_query="DELETE FROM sales_properties WHERE user_id=".$_GET['delete_id'];
    mysqli_query($conn, $sql_query);
    header("Location: $_SERVER[PHP_SELF]");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <title>Sales Property</title>

    <script type="text/javascript">
        function edt_id(id) {
            window.location.href = 'edit_sales_property.php?edit_id=' + id;
        }
        function delete_id(id) {
            if (confirm('Sure to Delete ?')) {
                if(confirm('Confirm twice')){
                    if(confirm('Confirm thrice')){
                        window.location.href = 'property_sales_data.php?delete_id=' + id;
                    }
                }
            }
        }
    </script>
</head>
<body>


               <?php include "header.php"?>
                <div class="container" style="width:1600px;" align="center">
                    <h3 class="text-center">Sales Properties</h3>
                    <div class="table-responsive" id="lettings_table">
                        <table class="table table-bordered">
                <tr>
                    <td style = "font-size: 14px;" colspan="15">
                        <form action="property_sales_data.php" method="POST">
                        <input style="font-size: 14px" type="text" name="query" />
                        <input style="font-size: 14px" type="submit" name="search" value="Search" />

                            <a style="font-size: 14px" target="_blank" href="https://www.rightmove.co.uk/property-for-sale/find.html?locationIdentifier=BRANCH%5E62389&sortType=1&includeSSTC=true&viewType=GRID"> All Properties</a> |
                            <a style="font-size: 14px" target="_blank" href="https://www.epcregister.com/reportSearchAddressTerms.html?redirect=reportSearchAddressByPostcode">EPC Register</a> |
                            <a style="font-size: 14px" target="_blank" href="http://cti.voa.gov.uk/cti/inits.asp">Council Tax Band</a>  |
                            <a style="font-size: 14px" target="_blank" href="https://mightytext.net/web8/">Mighty Text</a>  |
                            <a style="font-size: 14px" target="_blank" href=" https://login.jupix.co.uk/index4.php/">Jupix</a>  |
                            <a style="font-size: 14px" target="_blank" href="https://batchgeo.com/">Batch Geo</a>  |
                            <a style="font-size: 14px" target="_blank" href="https://www.freemaptools.com/">Free Map Tools</a>  |
                            <a style="font-size: 14px" target="_blank" href=" http://remote.bensonpartners.co.uk/mail/?_task=mail&_mbox=INBOX">Emails</a>
                            <div style='float: right; font-size: 14px'>
                        </form>
                        <form method="get" action="new_sales_property.php">
                            <button type="submit"> Add Property </button>
                        </form>

                    </td>
                </tr>

                    <tr>
                        <th >Address</th>
                        <th>Postcode</th>
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
                    $query = "SELECT * FROM sales_properties
                    WHERE (`Address1` LIKE '%".$valuetosearch."%') 
                    OR (`Address2` LIKE '%".$valuetosearch."%')
                    OR (`Address3` LIKE '%".$valuetosearch."%') 
                    OR (`postcode` LIKE '%".$valuetosearch."%')
                    OR (`property_level` LIKE '%".$valuetosearch."%') 
                    OR (`outside_space` LIKE '%".$valuetosearch."%')
                    OR (`sales_tenure` LIKE '%".$valuetosearch."%')
                    OR (`parking_type` LIKE '%".$valuetosearch."%')
                    OR (`dwelling_type` LIKE '%".$valuetosearch."%') ORDER BY sales_properties.bedrooms DESC";
                    $result=filterTable($conn,$query);
                } else {
                    $query = "SELECT * FROM sales_properties ORDER BY sales_properties.bedrooms ASC, sales_properties.price ASC ";
                    $result = filterTable($conn, $query);
                }
                    function filterTable($conn,$query){
                    $filter_Result = mysqli_query($conn, $query);
                    return $filter_Result;
                }
            ?>
            <?php
            $sql_query="SELECT * FROM sales_properties ORDER BY sales_properties.bedrooms DESC, sales_properties.price DESC";
            $result_set=mysqli_query($conn,$sql_query);
            while($row=mysqli_fetch_assoc($result_set))
                while($row=mysqli_fetch_array($result))
                {
            {
                ?>
                     <tr>
                        <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal">
                            <?php echo $row['Address1'].$row['Address2'].$row['Address3']; ?><span class="tooltiptext">
                        </td>
                        <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal" ><?php echo $row['postcode']; ?></td>
                        <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['dwelling_type']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['price']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['bedrooms']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['bathrooms']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['receptions']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['garden']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['parking']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['access_through']; ?></td>
                        <td style = "font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['floor_area']; ?></td>
                        <td style = "font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" data-id="<?= $row['user_id']?>" data-toggle="modal" data-target="#myModal"><?php echo $row['sales_availability']; ?></td>
                        <td >
                            <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')">edit</a>
                        </td>
                        <td >
                            <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')">delete</a>
                        </td>
                        <td >
                           
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
                url: "property_sales_data.php",
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
                        '      <td style="font-size: 14px"> Postcode: ' + response.postcode + '</td>\n' +
                        '      <td style="font-size: 14px"> Dwelling Type: ' + response.dwelling_type+  '</td>\n' +
                        '      <td style="font-size: 14px">Price: £'+ response.price + '</td>\n' +
                        '      <td style="font-size: 14px">Floor Area: ' + response.floor_area + 'sq.m.</td>\n' +
                        '    </tr>\n' +
                        '    <tr>\n' +
                        '      <td style="font-size: 14px">Bedrooms: ' + response.bedrooms + '</td>\n' +
                        '      <td style="font-size: 14px">Bathrooms:' + response.bathrooms +  '</td>\n' +
                        '      <td style="font-size: 14px">Receptions:'+ response.receptions + '</td>\n' +
                        '      <td style="font-size: 14px">Tenure: '+ response.sales_tenure + '</td>\n' +
                        '    </tr>\n' +
                        '    <th colspan="4">\n ' + 'Key Features' + '</th>' +
                        '    <tr>\n' +
                        '      <td style="font-size: 14px">' + response.outside_space + '</td>\n' +
                        '      <td style="font-size: 14px">Parking: ' + response.parking_type +  '</td>\n' +
                        '      <td style="font-size: 14px">' + response.heating_type + '</td>\n' +
                        '      <td style="font-size: 14px">' + response.property_condition + '</td>\n' +
                        '    </tr>\n' +
                        '    <tr>\n' +
                        '      <td style="font-size: 14px">Leasehold: ' + response.leasehold_remaining + '</td>\n' +
                        '      <td style="font-size: 14px">Service Charge: ' + response.service_charge +  '</td>\n' +
                        '      <td style="font-size: 14px">Ground Rent:' + response.ground_rent + '</td>\n' +
                        '      <td style="font-size: 14px">Property Age:' + response.property_age + '</td>\n' +
                        '    </tr>\n' +
                        '    <tr>\n' +
                        '      <td style="font-size: 14px">Borough: ' + response.borough + '</td>\n' +
                        '      <td style="font-size: 14px">Council Tax Band: ' + response.council_tax_band +  '</td>\n' +
                        '      <td style="font-size: 14px">Council Tax Cost: ' + response.council_tax_cost + '</td>\n' +
                        '      <td style="font-size: 14px">EPC Rating: ' + response.epc_rating + '</td>\n' +
                        '    </tr>\n' +
                        '    <th colspan="4">\n ' + 'Features' + '</th>' +
                        '    <tr>\n' +
                        '      <td colspan="4" style="font-size: 14px">' + '<ul style="list-style-type:none;"><li>'+response.feature_1+'</li><li>'+response.feature_2+'</li><li>'+response.feature_3+'</li><li>'+response.feature_4+'</li><li>'+response.feature_5+'</li><li>'+response.feature_6+'</li><li>'+response.feature_7+'</li><li>'+response.feature_8+'</li><li>'+response.feature_9+'</li><li>'+response.feature_10+'</li></ul>' + '</td>\n' +
                        '    </tr>\n' +
                        '    <th colspan="4">\n ' + 'Landlord Details' + '</th>' +
                        '    <tr>\n' +
                        '      <td style="font-size: 14px">' + response.landlord_fn + ' ' + response.landlord_ln+ '</td>\n' +
                        '      <td style="font-size: 14px">' + response.landlord_contact +  '</td>\n' +
                        '      <td style="font-size: 14px">' + response.landlord_email + '</td>\n' +
                        '      <td style="font-size: 14px">' + response.landlord_address + '</td>\n' +
                        '    </tr>\n' +
                        '    <th colspan="4">\n ' + 'Viewing Arrangements' + '</th>' +
                        '    <tr>\n' +
                        '      <td style="font-size: 14px">Access Through: ' + response.access_through + ' ' + response.landlord_ln+ '</td>\n' +
                        '      <td style="font-size: 14px">' + response.viewing_arrangements_name + ' '+ response.viewing_arrangements_contact_number +  '</td>\n' +
                        '      <td style="font-size: 14px">' + response.viewing_arrangements_email + '</td>\n' +
                        '      <td style="font-size: 14px">Key Tag: ' + response.key_tag + '</td>\n' +
                        '    </tr>\n' +
                        '  </tbody>\n' +
                        '</table>';
                    $("#modal-body").html(html);
                    $("button#edit-modal").attr('onclick', 'javascript:edt_id(' + response.user_id + ')' );
                    $("button#delete-modal").attr('onclick', 'javascript:delete_id(' + response.user_id + ')' );
                    $("button#book_viewing_handler").attr('onclick', 'javascript:book_viewing(' + response.user_id + ')' );
                    // And finally you can this function to show the pop-up/dialog
                    $("#myModal").modal();
                }
            });
        }
    </script>
    <!-- Modal -->
    <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">
        <div class = "modal-dialog">
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
</body>
</html>