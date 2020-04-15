<?php
    require 'functions.php';
    auth();
    require 'dbconfig.php';
    ?>
    
    <html>
    <head>
        <title>
            Appointment Database
        </title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    
    <?php
    if (!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }
    $query = "SELECT
            viewing_id,
            viewing_date,
            viewing_time,
            negotiator,
            meeting_place,
            feedback,
            sales_applicant.firstname,
            sales_applicant.lastname,
            sales_applicant.email,
            sales_applicant.contact_number,
            sales_applicant.maximum_budget,
            type
        FROM
            viewings_sales
        LEFT JOIN 
            sales_applicant 
        ON 
            viewings_sales.user_id = sales_applicant.id
        WHERE viewing_date= CURDATE()
        UNION
        SELECT
            viewing_id,
            viewing_date,
            viewing_time,
            negotiator,
            meeting_place,
            feedback,
            users.first_name AS firstname,
            users.last_name AS lastname,
            users.email,
            users.contact_number,
            users.maximum_budget,
            type
        FROM
            viewings
        LEFT JOIN 
            users 
        ON 
            viewings.user_id = users.user_id
        WHERE viewing_date= CURDATE()
        ORDER BY
            viewing_time ASC";
    $result_set = mysqli_query($conn, $query);
?>

<!--https://www.youtube.com/watch?v=hoReHlBraDk-->
<!DOCTYPE html>

        </style>
        <title>Appointments</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/DTstyle.css"/>
    
    
    <body class="bg-info">
    
        <?php include "header.php"; ?>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

        <div >
           <div class="table-responsive" style="overflow-x: auto; width:100%;">
                <div class="table table-bordered table-striped table-hover">
                    <h4 class = "text-center text-dark pt-2">Appointments</h4>
                    <hr>
                   
                   
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>                         
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Full Name</th>
                                    <th>Budget</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Meeting Place</th>
                                    <th>Negotiator</th>
                                    <th>Type</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 <?php 
                                    while($init_row = mysqli_fetch_assoc($result_set)){
                                ?>
                           
                                <tr>
                                    <td>
                                        <div class="hideextra" style="width:500px">
                                            <?php
                                           $type = $init_row['type']=='sales'?'sales_id':'lettings_id';
                                           $x_properties = $init_row['type']=='sales'?'sales_properties':'lettings_properties';
                                           $x_addresses = $init_row['type']=='sales'?'sales_addresses':'lettings_addresses';

                                           $sql_viewings= "SELECT $type, $x_properties.Address1, $x_properties.Address2, $x_properties.Address3 
                                           FROM $x_addresses INNER JOIN $x_properties ON $x_properties.user_id = $x_addresses.$type 
                                           WHERE $x_addresses.viewing_id = '$init_row[viewing_id]'";
                                               $result_viewings = mysqli_query($conn,$sql_viewings);
                                                   while($address_listing=mysqli_fetch_assoc($result_viewings)){
                                                       echo $address_listing['Address1'].' '.$address_listing['Address2'].' '.$address_listing['Address3'].'<br>';
                                                   }
                                           ?>
                                       </div>
                                        
                                    </td>
                                        <?php
                                            /*$now = date("h:i:s");
                                            $strtodata = $row['viewing_time'];
                                            $string = date('h:i:s', strtotime($strtodata));
                                            if ($string > $now){*/?>             
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['viewing_date'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['viewing_time'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['firstname'].' '.$init_row['lastname']; ?> </td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['maximum_budget'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['contact_number'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['email'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['meeting_place'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap;"><?php echo $init_row['negotiator'] ?></td>
                                    <td style="font-size: 14px; white-space: nowrap; column-width: 100px"><?php echo $init_row['type'] ?></td>
                                    
                                   
                                </tr>
                            <?php 
                                }
                            ?>
                            </tbody>
                        </table>
                    
                </div>
            </div>   
        </div>
        <!--<script>
      
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
        </script>-->
      
       
    </body>
</html>