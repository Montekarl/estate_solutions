<?php
    require 'functions.php';
    auth();
    include_once 'dbconfig.php';
    if(isset($_GET['delete_viewing']))
    {
        $sql_query="DELETE FROM viewings_sales WHERE viewing_id=".$_GET['delete_viewing'];
        mysqli_query($conn,$sql_query);
        header("Location: $_SERVER[PHP_SELF]");
    }
?>
<?php
    include "header.php";
?>
<!DOCTYPE html>
    <head>
        <title>
            Sales Viewings Database
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/DTstyle.css"/>
    
    
    <body class="bg-info">
     
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />       
        <script type="text/javascript">
            function delete_viewing(id)
            {
                if(confirm('Remove this viewing?'))
                {
                window.location.href = 'viewings_database_sales.php?delete_viewing='+ id;
                }
            }
            function sales_feedback(id)
            {
                window.location.href = 'viewing_feedback_handler_sales.php?feedback_id='+ id;
            }
        </script>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <?php
       $sql_viewings="SELECT viewings_sales.*, sales_applicant.* FROM viewings_sales INNER JOIN sales_applicant 
                        ON viewings_sales.user_id=sales_applicant.id ORDER BY viewing_date";
                        $result_viewings = mysqli_query($conn,$sql_viewings); 
    ?>
    </head>
    
    <h3 class="text-center">
        Sales Viewings
    </h3> 
    
    
    <body>
       
        <div>
            <div class="table-responsive" style="overflow-x: auto; width:100%;">
                <div class="table table-bordered table-striped table-hover">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Viewing ID</th>
                                <th>Applicant Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Negotiator</th>
                                <th>Meeting Place</th>
                                <th>Budget</th>
                                <th>Feedback</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while($rowviewing=mysqli_fetch_assoc($result_viewings)){
                        ?>
                            <tr>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <?php 
                                        echo $rowviewing['viewing_id']; 
                                    ?>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <div class="hideextra" style="width:200px">
                                        <?php
                                        echo $rowviewing['firstname'].' '.$rowviewing['lastname'];
                                        ?>
                                    </div>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                <?php echo $rowviewing['viewing_date']; ?>
                                </td >
                                <td style="font-size: 14px; white-space: nowrap;">
                                <?php echo $rowviewing['viewing_time']; ?>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <div class="hideextra" style="width:500px">
                                        <?php
                                        //$prefix = $row['Type'] == 'Sales' ? 'sales_' : 'lettings_';
                                        $result_address = mysqli_query($conn,"SELECT sales_addresses.*,sales_properties.* FROM sales_addresses INNER JOIN 
                                        sales_properties ON sales_addresses.sales_id=sales_properties.user_id WHERE viewing_id='$rowviewing[viewing_id]'");
                                        while($address_listing=mysqli_fetch_assoc($result_address)){
                                        echo $address_listing['Address1'].' '.$address_listing['Address2'].' '.$address_listing['Address3'].'<br>';
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <div class="hideextra" style="width:150px">
                                        <?php echo $rowviewing['contact_number']; ?>
                                    </div>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <?php echo $rowviewing['negotiator']; ?>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <?php echo $rowviewing['meeting_place']; ?>
                                </td>
                                <td style="font-size: 14px; white-space: nowrap;">
                                    <?php echo $rowviewing['maximum_budget']; ?>  
                                </td>
                                <td> 
                                    <?php echo $rowviewing['feedback']; ?> 
                                </td>
                                <td>
                                <a href="javascript:delete_viewing('<?php echo $rowviewing['viewing_id']; ?>')">Delete</a>
                                </td>
                                <td>
                                <a href="javascript:sales_feedback('<?php echo $rowviewing['viewing_id']; ?>')">Feedback</a>
                                </td>
                                <td>
                                <a href="javascript:edit_viewing('<?php echo $rowviewing['viewing_id']; ?>')">Edit</a>
                                </td>
                            </tr>
                            <?php
                            }
                                mysqli_close($conn); 
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
        
        <script>
      
            $('table').DataTable({
                    iDisplayLength: 50, 
                    responsive: true,
                    order:[[3,'desc']],
                    pagingType:'full_numbers',
                    scrollY: '62vh',
                    scrollX: true,
                    scrollCollapse: true,
                    autoFill:true,
                    stateSave: true,
            });
        </script>
    </body>
    
</html>