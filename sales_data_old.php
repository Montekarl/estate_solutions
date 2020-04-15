<?php
    require 'functions.php';
    auth();
    require 'dbconfig.php';
    
    if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
    }
    $query = "SELECT * FROM sales_applicant ORDER BY id DESC";
    $init_result = mysqli_query($conn, $query);
    
    if(isset($_POST["get_data"]))
    {
        $id = $_POST["id"];
        $sql = "SELECT * FROM sales_applicant WHERE id = '$id'";
        $details_handler = mysqli_query($conn,$sql);
        $result = mysqli_fetch_array($details_handler);
        echo json_encode($result);
        exit();
    }
    if(isset($_POST['property_match']))
    {
        $sql_query="SELECT FROM sales_applicant WHERE id=".$_GET['property_match'];
        mysqli_query($conn,$sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }
        if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM sales_applicant WHERE id=".$_GET['delete_id'];
        mysqli_query($conn,$sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }
        
?>

<!DOCTYPE html>
    <head>
        <title>Sales Applicants</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        


        <script type="text/javascript">
            function edit_sale_client(id) {
                window.location.href = 'edit_sales_applicant_handler.php?sales_client=' + id;
            }

            function book_viewing(id){
                window.location.href = 'viewing_sales_handler.php?book_viewing=' + id;
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
    </head>
    <body>
        <?php include "header.php";?>
        <br/>
        <div class="container" style="width:1900px;" align="center">
        <h3 class="text-center">Sales Applicants</h3>
        <div class="table-responsive" id="lettings_table">
        <table class="table table-bordered table-hover">
        <tr>
        <td colspan="19">
       
        <form action="sales_data.php" method="POST">
        <input type="text" name="query" style="font-size: 14px"/>
        <input type="submit" name="search" value="Search" style="font-size: 14px"/>
        <a style="font-size: 14px" target="_blank" href="https://www.rightmove.co.uk/property-for-sale/find.html?locationIdentifier=BRANCH%5E62389&sortType=1&includeSSTC=true&viewType=GRID">All Properties</a> |
        <a style="font-size: 14px" target="_blank" href="https://www.epcregister.com/reportSearchAddressTerms.html?redirect=reportSearchAddressByPostcode">EPC Register</a> |
        <a style="font-size: 14px" target="_blank" href="http://cti.voa.gov.uk/cti/inits.asp">Council Tax Band</a>  |
        <a style="font-size: 14px" target="_blank" href="https://mightytext.net/web8/">Mighty Text</a>  |
        <a style="font-size: 14px" target="_blank" href="https://login.jupix.co.uk/index4.php/">Jupix</a>  |
        <a style="font-size: 14px" target="_blank" href="https://batchgeo.com/">Batch Geo</a>  |
        <a style="font-size: 14px" target="_blank" href="https://www.freemaptools.com/">Free Map Tools</a>  |
        <a style="font-size: 14px" target="_blank" href=" http://remote.bensonpartners.co.uk/mail/?_task=mail&_mbox=INBOX">Emails</a>
        <div style='float: right; font-size: 14px'>
        </form>
        <form method="get" action="new_sales_applicant.php">
        <button type="submit"> New Applicant </button>
        </form>
        </div>

        <tr>
        
        <th><span class="glyphicon glyphicon-time" style="top:10px;height:30px"></span></th>
        <div id="myDIV">
            <th><span class="glyphicon glyphicon-check" style="top:10px;"></span><a class="column_sort" id="checkbox" data-order="desc" href="#"></th>
        </div>
        <th><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>
        <th><a class="column_sort" id="title" data-order="desc" href="#">Title</a></th>
        <th><a class="column_sort" id="firstname" data-order="desc" href="#">First Name</a></th>
        <th><a class="column_sort" id="lastname" data-order="desc" href="#">Last Name</a></th>
        <th><a class="column_sort" id="email" data-order="desc" href="#">Email</a></th>
        <th><a class="column_sort" id="contact_number" data-order="desc" href="#">Contact Number</a></th>
        <th><a class="column_sort" id="bedrooms" data-order="desc" href="#">Bedrooms</a></th>
        <th><a class="column_sort" id="maximum_budget" data-order="desc" href="#">Maximum Budget</a></th>
        <th><a class="column_sort" id="mortgage_status" data-order="desc" href="#">Mortgage Status</a></th>
        <th><a class="column_sort" id="buyers_position" data-order="desc" href="#">Buyers Position</a></th>
        <th><a class="column_sort" id="tenure" data-order="desc" href="#">Tenure</a></th>
        <th><a class="column_sort" id="reg_date" data-order="desc" href="#">Registered</a></th>
        <th colspan="5"><a class="column_sort" id="operations" data-order="desc" href="#">Tasks</a></th>
        </tr>

        <?php
        if(isset($_POST['search'])){
            $valuetosearch = $_POST['query'];
            $query = "SELECT * FROM sales_applicant 
            WHERE (`firstname` LIKE '%".$valuetosearch."%')
            OR(`lastname` LIKE '%".$valuetosearch."%')
            OR (`email` LIKE '%".$valuetosearch."%')
            OR (`special_conditions` LIKE '%".$valuetosearch."%')
            OR (`contact_number` LIKE '%".$valuetosearch."%') ORDER BY sales_applicant.reg_date DESC";
            $result = filterTable($conn,$query);
        } else {
            $query = "SELECT * FROM sales_applicant ORDER BY sales_applicant.reg_date DESC";
            $result = filterTable($conn, $query);
        }
            function filterTable($conn,$query){
            $filter_Result = mysqli_query($conn, $query);
            return $filter_Result;
        }
        ?>
        <form action="functionality_handler2.php" method="POST">
        <input style="font-size: 14px; position: fixed; top:100px; left:100px;" type="submit" value="Finish Selection" " />
        <?php 
            while($init_row = mysqli_fetch_array($init_result)) {
                while($row = mysqli_fetch_array($result)){ 
        ?>
        <tr>
            <td class="today">
                <?php 
                    $date = date('Y-m-d');
                    $strtodata = $row['reg_date'];
                    $string = date('Y-m-d', strtotime($strtodata));
                    if ($string == $date){ 
                    ?> <span class="glyphicon glyphicon-ok"></span><?php
                    //document.querySelector(".today").style.background = "#F9B8AA";
                    }
                ?>
            </td>
            <td><input type="checkbox" name="functionality[]" value="<?= $row['id'] ?>"></td>
            <td style="font-size: 14px; " onclick="loadData(this.getAttribute('data-id'));"
                data-id="<?= $row['id'] ?>" data-toggle="modal"
                data-target="#myModal"><?php echo $row['id']; ?>
            </td>
            <td style="font-size: 14px;" onclick="loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['title']; ?>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['firstname']; ?>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['lastname']; ?>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" onclick = "loadData(this.getAttribute('data-id'));"
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['email']; ?>
            </td>
            <td style="font-size: 14px; white-space: nowrap;">
                <?php
                $name = str_replace(' ', '', $row['contact_number']);
                echo $name;
                ?>
            </td>
            <td style="font-size: 14px; " onclick = "loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['bedrooms']; ?>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" onclick = "loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['maximum_budget']; ?>
            </td>
            <td style="font-size: 14px;" onclick = "loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['mortgage_status']; ?>
            </td>
            <td style="font-size: 14px;" onclick = "loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['buyer_position']; ?>
            </td>
            <td style="font-size: 14px;" onclick = "loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['tenure']; ?>
            </td>
            <td style="font-size: 14px;" onclick = "loadData(this.getAttribute('data-id'));" 
                data-id="<?=$row['id']?>" data-toggle="modal" 
                data-target="#myModal"><?php echo $row['reg_date']; ?>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" >
                <a href="javascript:edit_sale_client('<?php echo $row['id']; ?>')"><span class="glyphicon glyphicon-pencil" style="top:5px;"></a>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" >
                <a href="javascript:delete_id('<?php echo $row['id']; ?> ')" ><span class="glyphicon glyphicon-trash" style="top:5px;"></a>
            </td>
            <td style="font-size: 14px; white-space: nowrap;">
                <?php
                $date=date("H");
                if($date<"12:00"){
                $body="Good%20Morning%20".$row['firstname'].",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20".$row['bedrooms']."%20bedroom%20property%20for%20sale,%20please%20see%20below%20properties%20matching%20your%20criteria.";
                $subject="Property%20Enquiry%20-%20Benson%20and%20Partners";
                }else{
                $body="Good%20Afternoon%20".$row['firstname'].",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20".$row['bedrooms']."%20bedroom%20property%20for%20sale,%20please%20see%20below%20properties%20matching%20your%20criteria.";
                $subject="Property%20Enquiry%20-%20Benson%20and%20Partners";
                }?>
                <a href="mailto:<?php echo $row['email'];?>?subject=<?php echo $subject ?>&body=<?php echo $body;?>"><span class="glyphicon glyphicon-envelope" style="top:5px;"></a>
            </td>
            <td style="font-size: 14px; white-space: nowrap;" >
                <a  href="javascript:book_viewing('<?php  echo $row[0];?>')" style="font-size: 14px" id="book_viewing_handler">
                <span class="glyphicon glyphicon-calendar" style="top:5px;"></a>
            </td>
            <td style="font-size: 14px; white-space: nowrap;">
                <a target="_blank" href="javascript:property_match('<?php echo $row[0];?>')" style="font-size: 14px" id="property_match"><span class="glyphicon glyphicon-cog" style="top:5px;"></a>
            </td>
        </tr>
        <?php }} ?>
        </form>
        </table>
        </div>
        </div>
        
        <script>
            $(document).ready(function () {
                $(document).on('click','.column_sort',function() {
                    var column_name = $(this).attr("id");
                    var order = $(this).data("order");
                    var arrow = '';
                        if(order == 'desc')
                    {
                        arrow='&nbsp;<span class = "glyphicon glyphicon-arrow-down"></span>';
                    }
                    else
                    {
                        arrow='&nbsp;<span class = "glyphicon glyphicon-arrow-up"></span>';
                    }
                    $.ajax({
                        url:"sort2.php",
                        method:"POST",
                        data:{column_name:column_name, order:order},
                        success:function(data)
                        {
                            $('#lettings_table').html(data);
                            $('#'+column_name+'').append(arrow);
                        }
                
                    })
                });
            });
        </script>
        
        
        
        <script>
        function loadData(id) {
        $.ajax({
        url: "sales_data.php",
        method: "POST",
        data: {get_data: 1, id: id},
        success: function (response) {
        response = JSON.parse(response);
        console.log(response);
        //var html = "";
        var html = '<table class="table">\n' +
        '  <tbody>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">First Name</td>\n' +
        '      <td style="font-size: 14px">' + response.firstname + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Last Name</td>\n' +
        '      <td style="font-size: 14px">' + response.lastname + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Email</td>\n' +
        '      <td style="font-size: 14px">' + response.email + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Contact Number</td>\n' +
        '      <td style="font-size: 14px">' + response.contact_number + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Address</td>\n' +
        '      <td style="font-size: 14px">' + response.address + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Bedrooms</td>\n' +
        '      <td style="font-size: 14px">' + response.bedrooms + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Maximum Budget</td>\n' +
        '      <td style="font-size: 14px">' + response.maximum_budget + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Mortage Status</td>\n' +
        '      <td style="font-size: 14px">' + response.mortgage_status + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Buyers Position</td>\n' +
        '      <td style="font-size: 14px">' + response.buyer_position + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Tenure</td>\n' +
        '      <td style="font-size: 14px">' + response.tenure + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Areas</td>\n' +
        '      <td style="font-size: 14px">' + response.areas + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Special Conditions</td>\n' +
        '      <td style="font-size: 14px"> <pre style="white-space: pre-wrap">' + response.special_conditions + '</pre></td>\n' +
        '    </tr>\n' +
        '    <tr>\n' +
        '      <td style="font-size: 14px">Registered Time</td>\n' +
        '      <td style="font-size: 14px">' + response.reg_date + '</td>\n' +
        '    </tr>\n' +
        '    <tr>\n'+
        '      <td style="font-size: 14px">ID</td>\n' +
        '      <td style="font-size: 14px">' + response.id + '</td>\n' +
        '    </tr>\n' +
        '  </tbody>\n' +
        '</table>';
        // And now assign this HTML layout in pop-up body
        $("#modal-body").html(html);
        $("button#edit-modal").attr('onclick', 'javascript:edit_sale_client(' + response.id + ')' );
        $("button#delete-modal").attr('onclick', 'javascript:delete_id(' + response.id + ')' );
        $("button#book_viewing_handler").attr('onclick', 'javascript:book_viewing(' + response.id + ')' );
        $("button#property_match").attr('onclick', 'javascript:property_match(' + response.id + ')' );
        // And finally you can this function to show the pop-up/dialog
        $("#myModal").modal();


        }
        });
        }
        </script>

        <!-- Modal -->
        <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" aria-hidden = "true">
        <div class = "modal-dialog" style="width:800px">
        <div class = "modal-content" >
        <div class = "modal-header">
        <h4 class = "modal-title">
        Customer Details
        </h4>
        <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
        <img src="img/close-512.png" style="width:30px;height:30px">
        </button>
        </div>
        <div id = "modal-body">
        Press ESC button to exit.
        </div>
        <div class = "modal-footer">
        <button id="book_viewing_handler" type = "button" class = "btn btn-default" data-dismiss = "modal">
        Book a Viewing
        </button>
        <button id="property_match" type = "button" class = "btn btn-default" data-dismiss = "modal">
        Property Match
        </button>
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


