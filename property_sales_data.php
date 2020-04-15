<?php
    require 'functions.php';
    auth();
    require 'dbconfig.php';

    if (!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }
    $query = "SELECT * FROM sales_properties ORDER BY user_id DESC";
    $init_result = mysqli_query($conn, $query);
    if(isset($_GET['delete_id']))
        {
            $sql_query="DELETE FROM sales_properties WHERE user_id=".$_GET['delete_id'];
            mysqli_query($conn, $sql_query);
            header("Location: $_SERVER[PHP_SELF]");
        }
?>

<script type="text/javascript">
       
        function edt_id(id) {
            window.location.href = 'edit_sales_property.php?edit_id=' + id;
        }
        function delete_id(id) {
            if (confirm('Sure to Delete ?')) {
                if(confirm('Confirm twice')){
                    window.location.href = 'property_sales_data.php?delete_id=' + id;
                }
            }
        }
        
        function bollocks(id){
            var bollocks = document.getElementById('bollocks'+id);
            if (bollocks.style.display=="block")  {
                bollocks.style.display="none"; 
            } else {
                bollocks.style.display="block";
            }
        }
</script>
<?php
    include "header.php";
?>
<!DOCTYPE html>
    <head>
        <title>
            Lettings Viewings Database
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/DTstyle.css"/>
    
    
    <body class="bg-info">
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

         <div>
            <div class="table-responsive" style="overflow-x: auto; width:100%;">
                <div class="table table-bordered table-striped table-hover">
                    <h2 class = "text-center text-dark pt-2">Sales Properties</h2>
                    <hr>
                        <table class="table table-bordered table-striped table-hover" style="width:100%;" id="example">
                            <thead>
                                <tr> 
                                    <th></th>
                                    <th style="display:none"></th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                       Address
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Postcode
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Property Level
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Dwelling Type
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Price
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Bedrooms
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Bathrooms
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Receptions
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Garden
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Parking
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Access Through
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Floor Area
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Lettings Availability
                                    </th>
                                    <th>
                                        
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($init_result)) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="#" onclick="bollocks('<?=$row["user_id"]?>')"> <img src="https://img.icons8.com/pastel-glyph/2x/plus.png" style="width:20px; height:20px"> </a>
                                    </td>
                                    <td id="bollocks<?=$row['user_id']?>" style="display:none">
                                        <table>
                                            <tr>
                                                <td>
                                                    <ul style="list-style-type:none;">
                                                        <li style = "font-size: 14px;"><?php echo $row['property_level']." ".$row['dwelling_type']." in ".$row['postcode'] ." for £". $row['price']; ?></li>
                                                    </ul>
                                                        <ul style="list-style-type:none">
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_1']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_2']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_3']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_4']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_5']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_6']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_7']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_8']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_9']?></li>
                                                        <li style = "font-size: 14px;"><?php echo $row['feature_10']?></li>
                                                        <li style = "font-size: 14px;"><?php echo "Outside Space: ".$row['garden']." (".$row['outside_space'].")"?></li>
                                                        <li style = "font-size: 14px;"><?php echo "Parking: ".$row['parking']." (".$row['parking_type'].")"?></li>
                                                        <li style = "font-size: 14px;"><?php echo "Floor Area: ".$row['floor_area']."m<sup>2</sup>"?></li>
                                                        <li style = "font-size: 14px;"><?php echo "Access Through: ".$row['access_through']."<br> ".$row['viewing_arrangements_name']."<br>".$row['viewing_arrangements_contact_number']."<br>".$row['Notes']?></li>
                                                        <text style = "font-size: 14px;"><?php echo "Landlord Details: ".$row['landlord_fn']." ".$row['landlord_ln']."<br>".$row['landlord_contact']."<br>".$row['landlord_email']?>
                                                    </ul>
                                                
                                                
                                                <pre>
                                                    <textarea width="100%" rows="20" cols="40" id="special_conditions" name="special_conditions" placeholder="Special Conditions" class="form-control" style="width: 100%;height: 300px;"> </textarea>
                                                </pre>
                                                </td>
                                                
                                                <a style="align:center;" href="javascript:edt_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/thin-reading-writing/57/thin-001_compose_write_pencil_new-512.png" style="width:20px; height:20px"></a>
                                                <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/network-technology-2-3/48/72-512.png" style="width:20px; height:20px"></a>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style = "font-size: 14px; white-space: nowrap;"><?php echo $row['Address1'].$row['Address2'].$row['Address3']; ?></td>
                                    <td style = "font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['postcode']; ?>
                                    </td>
                                    
                                    <td style = "font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['property_level']; ?>
                                    </td>
                                    <td style = "font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['dwelling_type']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['price']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['bedrooms']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                       <?php echo $row['bathrooms']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                       <?php echo $row['receptions']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['garden']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['parking']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['access_through']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['floor_area']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['sales_availability']; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/thin-reading-writing/57/thin-001_compose_write_pencil_new-512.png" style="width:20px; height:20px"></a>
                                    </td>
                                    <td>
                                        <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/network-technology-2-3/48/72-512.png" style="width:20px; height:20px"></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                 
                </div>
            </div>   
        </div>
                <script>
                        $('table').DataTable({
                                order:[[3,'desc']],
                                pagingType:'full_numbers',
                                scrollY: '50vh',
                                scrollX: true,
                                scrollCollapse: true,
                                autoFill:true,
                                stateSave: true,
                        });
                </script>
                    
                    
       
    </body>
</html>