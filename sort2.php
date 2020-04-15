<script type="text/javascript">
    function book_viewing(id) {
    window.location.href = 'viewing_sales_handler.php?book_viewing=' + id;
    }
    function edit_sale_client(id) {
    window.location.href = 'edit_sales_applicant_handler.php?sales_client=' + id;
    }
    function property_match(id){
        window.location.href= 'property_matcher.php?property_match=' + id;
        }
    function delete_id(id) {
        if (confirm('3 Step Confirmation required to prevent accidental deletion. Confirm?')) {
            if(confirm('Confirm twice?')){
                if(confirm('Confirm thrice?')){
                    window.location.href = 'sales_data.php?delete_id=' + id;
                }
            }
        }
    }
</script>
<?php
require 'dbconfig.php';
$output = '';
$order = $_POST["order"];
if($order == 'desc')
{
    $order = 'asc';
}
else
{
    $order = 'desc';
}

$query = "SELECT * FROM sales_applicant ORDER BY ".$_POST['column_name']. " " .$_POST['order']."";
$result = mysqli_query($conn, $query);
$output = '
    <table class="table table-bordered table-hover">
    <tr>
        <td colspan="18">
            <form action="sales_data.php" method="POST">
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
                <div style=\'float: right; font-size: 14px\';>
            </form>
                    <form method="get" action="new_sales_applicant.php">
                        <button type="submit"> New Applicant </button>
                    </form>
                </div>
        </td>
    </tr>

    <tr>
    
    
    <th><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
    <th><a class="column_sort" id="title" data-order="'.$order.'" href="#">Title</a></th>
    <th><a class="column_sort" id="firstname" data-order="'.$order.'" href="#">First Name</a></th>
    <th><a class="column_sort" id="lastname" data-order="'.$order.'" href="#">Last Name</a></th>
    <th><a class="column_sort" id="email" data-order="'.$order.'" href="#">Email</a></th>
    <th><a class="column_sort" id="contact_number" data-order="'.$order.'" href="#">Contact Number</a></th>
    <th><a class="column_sort" id="bedrooms" data-order="'.$order.'" href="#">Bedrooms</a></th>
    <th><a class="column_sort" id="maximum_budget" data-order="'.$order.'" href="#">Maximum Budget</a></th>
    <th><a class="column_sort" id="mortgage_status" data-order="'.$order.'" href="#">Mortgage Status</a></th>
    <th><a class="column_sort" id="buyer_position" data-order="'.$order.'" href="#">Buyers Position</a></th>
    <th><a class="column_sort" id="tenure" data-order="'.$order.'" href="#">Tenure</a></th>
    <th><a class="column_sort" id="reg_date" data-order="'.$order.'" href="#">Registered</a></th>
    <th colspan="5"><a class="column_sort" id="operations" data-order="'.$order.'" href="#">Tasks</a></th>

    </tr>
';


while($row = mysqli_fetch_assoc($result)){
    $userid=$row['id'];
    $output .= '
    <tr>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $userid .'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["title"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["firstname"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["lastname"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["email"].'</td>
    <td style="font-size: 14px">'. $row["contact_number"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["bedrooms"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["maximum_budget"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["mortgage_status"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["buyer_position"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["tenure"].'</td>
    <td style="font-size: 14px" onclick=loadData(this.getAttribute("data-id")); data-id="' . $userid .'" data-toggle="modal" data-target="#myModal">'. $row["reg_date"].'</td>
    <td style="font-size: 14px">
         <a href="javascript:edit_sale_client('.$row['id'].')"><span class="glyphicon glyphicon-pencil" style="top:5px;"></a>
    </td>
    <td style="font-size: 14px">
         <a href="javascript:delete_id('.$row['id'].')"><span class="glyphicon glyphicon-trash" style="top:5px;"></a>
    </td>
    <td style="font-size: 14px">
        
        <a href="mailto:'. $row["email"].'"><span class="glyphicon glyphicon-envelope" style="top:5px;"></a>
    </td>
    <td style="font-size: 14px">
        <a href="javascript:book_viewing('.$row['id'].')"><span class="glyphicon glyphicon-calendar" style="top:5px;"></a>
    </td>
    <td style="font-size: 14px">
        <a href="javascript:property_match('.$row['id'].')"><span class="glyphicon glyphicon-cog" style="top:5px;"></a>
    </td>

</tr>
';
}
echo '</table>';
echo $output;