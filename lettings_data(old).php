<?php
require 'functions.php';
auth();
require 'dbconfig.php';

//print_r($_SESSION);

if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}
$query = "SELECT * FROM users ORDER BY user_id DESC";
$init_result = mysqli_query($conn, $query);

if(isset($_POST["get_data"])){
    $id = $_POST["id"];
    $sql= "SELECT * FROM users WHERE user_id='$id'";
    $details_handler = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($details_handler);
    echo json_encode($result);
    exit();
}
if(isset($_GET['delete_id']))
    {
        $sql_query="DELETE FROM users WHERE user_id=".$_GET['delete_id'];
        mysqli_query($conn, $sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }
?>

<!DOCTYPE html >
<head>
    <title>Lettings Applicants</title>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Database</title>
    <script type="text/javascript">
        function book_viewing(id) {
            window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
        }
        function edt_id(id) {
            window.location.href = 'edit_data.php?edit_id=' + id;
        }
        function property_match(id){
            window.location.href= 'property_matcher_lettings.php?property_match=' + id;
        }
        function delete_id(id) {
            if (confirm('Three step confirmation required to prevent accidental deletion')) {
                if(confirm('Please confirm twice')){
                    if(confirm('Please confirm thrice')){
                        window.location.href = 'lettings_data.php?delete_id=' + id;
                    }
                }
            }
        }
    </script>
</head>
<body>
<?php include "header.php";
?>
<br />
<div class="container" style="width:1800px;" align="center">
                <h3 class="text-center">Lettings Applicants</h3>
                <div class="table-responsive" id="lettings_table">
                    <table class="table table-bordered table-hover">
            <tr>
                <td colspan="18">
                    <form action="lettings_data.php" method="POST">
                        <input style="font-size: 14px" type="text" name="query" />
                        <input style="font-size: 14px" type="submit" name="search" value="Search" />
                        <a  target="_blank" href="#"> Toggle Multi-Tool</a> |
                        <div style='float: right; font-size: 14px';>
                    </form>
                    <form method="get" action="add_data.php" >
                        <button type="submit" style="text-align:center"> New Applicant </button>
                    </form>
    </div>
    </td>
    </tr>
    <tr>
        <th><span class="glyphicon glyphicon-time" style="top:10px;"></span></th>
        <div id="myDIV">
            <th><span class="glyphicon glyphicon-check" style="top:10px;"></span><a class="column_sort" id="checkbox" data-order="desc" href="#"></th>
        </div>
        <th><a class="column_sort" id="user_id" data-order="desc" href="#" style="padding-top: 19px;">ID</a></th>
        <th><a class="column_sort" id="title" data-order="desc" href="#" style="padding-top: 19px">Title</a></th>
        <th><a class="column_sort" id="first_name" data-order="desc" href="#" style="padding-top: 19px">First Name</a></th>
        <th><a class="column_sort" id="last_name" data-order="desc" href="#" style="padding-top: 19px">Last Name</a></th>
        <th><a class="column_sort" id="email" data-order="desc" href="#" style="padding-top: 19px">Email</a></th>
        <th><a class="column_sort" id="contact_number" data-order="desc" href="#" style="padding-top: 19px">Contact Number</a></th>
        <th><a class="column_sort" id="bedrooms" data-order="desc" href="#" style="padding-top: 19px">Bedrooms</a></th>
        <th><a class="column_sort" id="tenants" data-order="desc" href="#" style="padding-top: 19px">Tenants</a></th>
        <th><a class="column_sort" id="maximum_budget" data-order="desc" href="#" style="padding-top: 19px">Maximum Budget</a></th>
        <th><a class="column_sort" id="salary" data-order="desc" href="#" style="padding-top: 19px">Income</a></th>
        <th><a class="column_sort" id="Reg_Date" data-order="desc" href="#" style="padding-top: 19px">Register Date</a></th>
        <th colspan="5"><a class="column_sort" id="operations" data-order="desc" href="#" style="padding-top: 19px">Tasks</a></th>
    </tr>


    <?php
    if(isset($_POST['search'])){
        $valuetosearch = $_POST['query'];
        $query = "SELECT * FROM users 
        WHERE (`first_name` LIKE '%".$valuetosearch."%') 
        OR (`last_name` LIKE '%".$valuetosearch."%')
        OR (`email` LIKE '%".$valuetosearch."%') 
        OR (`special_conditions` LIKE '%".$valuetosearch."%') 
        OR (`contact_number` LIKE '%".$valuetosearch."%') ORDER BY users.Reg_Date DESC";
        $result=filterTable($conn,$query);
    } else {
        $query = "SELECT * FROM users ORDER BY users.Reg_Date DESC ";
        $result = filterTable($conn, $query);
    }
        function filterTable($conn, $query){
        $filter_Result = mysqli_query($conn, $query);
        return $filter_Result;
    }

?>
        <form action="functionality_handler.php" method="POST">
            <input style="font-size: 14px; position: fixed; top:100px; left:100px;" type="submit" value="Finish Selection" " />
        
                <?php
                    while($init_row = mysqli_fetch_array($init_result)) {
                        while ($row = mysqli_fetch_array($result)) {
                ?>
                            
                            <tr class = "today">
                            <td>
                             <?php 
                                $date = date('Y-m-d');
                                $strtodata = $row['Reg_Date'];
                                $string = date('Y-m-d', strtotime($strtodata));
                                    if ($string == $date){ 
                                      ?> <span class="glyphicon glyphicon-ok"></span><?php
                                    }
                               ?>
                            </td>
                            <td><input type="checkbox" name="functionality[]" value="<?= $row['user_id'] ?>"></td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['user_id'] ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['title'] ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['first_name'] ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['last_name'] ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['email']; ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;"><?php $name = str_replace(' ', '', $row['contact_number']);
                                echo $name; ?></td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['bedrooms']; ?></td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['tenants']; ?></td>
                            <td style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal"><?php echo $row['maximum_budget']; ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;">
                                <?php
                                if($row["salary"]!=null){
                                    echo "Income: £" . $row["salary"] . "/ Potential Budget: £" . round(($row['salary'] / 30), 0);
                                } else {
                                    echo "Income Unknown";
                                }
                                ?>
                            </td>
                            <td  style="font-size: 14px; white-space: nowrap;" onclick="loadData(this.getAttribute('data-id'));"
                                data-id="<?= $row['user_id'] ?>" data-toggle="modal"
                                data-target="#myModal">
                                <?php echo $row['Reg_Date'];
                                       /* Colour row if condition is met. 
                                        $date = date('Y-m-d'); 
                                        $strtodata = $row['Reg_Date'];
                                        $string = date('Y-m-d', strtotime($strtodata));
                                          
                                                if ($string == $date){ 
                                                    echo "this is today";
                                                       //document.querySelector(".today").style.background = "#F9B8AA";
                                                }*/
                                       ?>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;">
                                <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')">
                                    <span class="glyphicon glyphicon-pencil" style="top:5px;">
                                </a>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;">
                                <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')">
                                    <span class="glyphicon glyphicon-trash" style="top:5px;">
                                </a>
                            </td>
                            <td style="font-size: 14px; white-space: nowrap;">
                                <?php
                                    $date = date("H");
                                    if ($date < "12:00") {
                                        $body = "Good%20Morning%20" . $row['first_name'] . ",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20" . $row['bedrooms'] . "%20bedroom%20property%20to%20rent,%20please%20see%20below%20properties%20matching%20your%20criteria.";
                                        $subject = "Property%20Enquiry%20-%20Benson%20and%20Partners";
                                    } else {
                                        $body = "Good%20Afternoon%20" . $row['first_name'] . ",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20" . $row['bedrooms'] . "%20bedroom%20property%20to%20rent,%20please%20see%20below%20properties%20matching%20your%20criteria.";
                                        $subject = "Property%20Enquiry%20-%20Benson%20and%20Partners";
                                    } 
                                ?>
                                <a href="mailto:<?php echo $row['email']; ?>?subject=<?php echo $subject ?>&body=<?php echo $body; ?>">
                                    <span class="glyphicon glyphicon-envelope" style="top:5px;">
                                </a>
                            </td>
                            <td>
                                <a href="javascript:book_viewing('<?php echo $row['user_id']; ?>')" style="font-size: 14px; white-space: nowrap;"
                                   id="book_viewing_handler">
                                   <span class="glyphicon glyphicon-calendar" style="top:5px;">
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="javascript:property_match('<?php echo $row['user_id']; ?>')"
                                   style="font-size: 14px; white-space: nowrap;" id="property_match">
                                   <span class="glyphicon glyphicon-cog" style="top:5px;">
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                ?>
        </form>
    </table>
</div>
</div>
</body>
</html>
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
                url:"sort.php",
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
            url: "lettings_data(old).php",
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
                    '      <td style="font-size: 14px">' + response.first_name + '</td>\n' +
                    '    </tr>\n' +
                    '    <tr>\n' +
                    '      <td style="font-size: 14px">Last Name</td>\n' +
                    '      <td style="font-size: 14px">' + response.last_name + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px; font-style: bold">Maximum Budget</td>\n' +
                    '      <td style="font-size: 14px">' + response.maximum_budget + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px; font-style: bold">Contact Number</td>\n' +
                    '      <td style="font-size: 14px">' + response.contact_number + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Email</td>\n' +
                    '      <td style="font-size: 14px">' + response.email + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Bedrooms</td>\n' +
                    '      <td style="font-size: 14px">' + response.bedrooms + '</td>\n' +
                    '    </tr>\n' +
                    '     <tr>\n' +
                    '      <td style="font-size: 14px">Tenants</td>\n' +
                    '      <td style="font-size: 14px">' + response.tenants + '</td>\n' +
                    '    </tr>\n' +
                    ' <tr>\n' +
                    '      <td style="font-size: 14px">Furniture</td>\n' +
                    '      <td style="font-size: 14px">' + response.furniture + '</td>\n' +
                    '    </tr>\n' +
                    ' <tr>\n' +
                    '      <td style="font-size: 14px">Move By</td>\n' +
                    '      <td style="font-size: 14px">' + response.move_by + '</td>\n' +
                    '    </tr>\n' +
                    ' <tr>\n' +
                    '      <td style="font-size: 14px">Address</td>\n' +
                    '      <td style="font-size: 14px">' + response.city_name + '</td>\n' +
                    '    </tr>\n' +
                    '      <td style="font-size: 14px">Areas</td>\n' +
                    '      <td style="font-size: 14px">' + response.areas + '</td>\n' +
                    '    </tr>\n' +
                    ' <tr>\n' +
                    '      <td style="font-size: 14px">Employment Status</td>\n' +
                    '      <td style="font-size: 14px">' + response.employment_status + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Job Title</td>\n' +
                    '      <td style="font-size: 14px">' + response.job_title + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Income</td>\n' +
                    '      <td style="font-size: 14px">' + response.salary + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Planning to stay for: </td>\n' +
                    '      <td style="font-size: 14px">' + response.lease + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Special Conditions</td>\n' +
                    '      <td style="font-size: 14px"><pre style="white-space: pre-wrap;">' + response.special_conditions + '</pre></td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">DSS</td>\n' +
                    '      <td style="font-size: 14px">' + response.dss + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Pets</td>\n' +
                    '      <td style="font-size: 14px">' + response.pets + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td style="font-size: 14px">Children</td>\n' +
                    '      <td style="font-size: 14px">' + response.children + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td id="edit_id" style="font-size: 14px">ID</td>\n' +
                    '      <td style="font-size: 14px">' + response.user_id + '</td>\n' +
                    '    </tr>\n' +
                    '<tr>\n' +
                    '      <td id="edit_id" style="font-size: 14px">Registered Time</td>\n' +
                    '      <td style="font-size: 14px">' + response.Reg_Date + '</td>\n' +
                    '    </tr>\n' +
                    '  </tbody>\n' +
                    '</table>';
                $("#modal-body").html(html);
                $("button#edit-modal").attr('onclick', 'javascript:edt_id(' + response.user_id + ')' );
                $("button#delete-modal").attr('onclick', 'javascript:delete_id(' + response.user_id + ')' );
                $("button#book_viewing_handler").attr('onclick', 'javascript:book_viewing(' + response.user_id + ')' );
                $("button#property_match").attr('onclick', 'javascript:property_match(' + response.user_id + ')' );
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
                <!--<button onclick="" id="test">link</button>-->
                <button id="edit-modal" type = "button" class = "btn btn-default"  data-dismiss = "modal">
                    Edit
                </button>
                <button id="delete-modal"  type = "button" class = "btn btn-default" data-dismiss = "modal" ">
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

