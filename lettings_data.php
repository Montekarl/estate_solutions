<?php
    require 'functions.php';
    auth();
    require 'dbconfig.php';

    if (!$conn)
    {
        die("Connection failed: ". mysqli_connect_error());
    }

    $query = "SELECT * FROM users ORDER BY user_id DESC";
    $init_result = mysqli_query($conn, $query);
    
    if(isset($_GET['delete_id']))
        {
            $sql_query="DELETE FROM users WHERE user_id=".$_GET['delete_id'];
            mysqli_query($conn, $sql_query);
            header("Location: $_SERVER[PHP_SELF]");
        }
?>

<script type="text/javascript">
        function book_viewing(id) 
        {
            window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
        }

        function edt_id(id) 
        {
            window.location.href = 'edit_data.php?edit_id=' + id;
        }

        function property_match(id)
        {
            window.location.href= 'property_matcher_lettings.php?property_match=' + id;
        }

        function delete_id(id) 
        {
            if (confirm('Two step confirmation required to prevent accidental deletion')) 
            {
                if(confirm('Please confirm twice'))
                {
                        window.location.href = 'lettings_data.php?delete_id=' + id;
                }
            }
        }
        
        function bollocks(id)
        {
            var bollocks = document.getElementById('bollocks'+id);
            if (bollocks.style.display=="block") 
            {
                bollocks.style.display="none"; 
            } 
            else 
            {
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
            <div class="table-responsive" style="width:80%; margin-left:auto; margin-right:auto">
                <div class="table table-bordered table-striped table-hover">
                    <h2 class = "text-center text-dark pt-2">Lettings Applicants</h2>
                    <hr>
                    <form action="functionality_handler.php" method="POST">
                        <select name="functionality_option" style="position: fixed; top:80px; left:100px;">
                            <option value="add_to_notes">Add to Notes</option>
                            <option value="delete">Delete</option>
                            <option value="email">Send Email (coming)</option>
                            <option value="text">Send Text</option>
                            <option>
                        </select>
                        <input style="font-size: 14px; position: fixed; top:107px; left:100px;" type="submit" value="Finish Selection" " />
                        <table class="table table-bordered table-hover" style="width:100%;" id="example">
                            <thead>
                                <tr> 
                                    <th><img src="http://www.myiconfinder.com/uploads/iconsets/256-256-924590246403a197a00e4a64c3e46da4-accept.png" style="width:22px; height:22px"></th>
                                    <th><img src="https://cdn3.iconfinder.com/data/icons/office-set-pack-1/512/12-512.png" style="width:20px; height:20px"></th>
                                    <th><img src="https://image.flaticon.com/icons/png/512/69/69544.png" style="width:20px; height:20px"></th>
                                    <th id="bollocks<?=$row['user_id']?>" style="display:none">Additional Information </th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th style="width: 200px;">Email</th>
                                    <th>Contact No</th>
                                    <th>Bedrooms</th>
                                    <th>Max Budget</th>
                                    <th>Income</th>
                                    <th style="display:none">Special Conditions</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($init_result)) 
                                {
                                    /*$sql="SELECT * FROM users ORDER BY user_id DESC";
                                    $res=$conn->query($sql);
                                    while($row=$res->fetch_assoc()){*/
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="functionality[]" value="<?= $row['user_id'] ?>"></td>
                                        <td>
                                            <?php 
                                                $date = date('Y-m-d');
                                                $strtodata = $row['Reg_Date'];
                                                $string = date('Y-m-d', strtotime($strtodata));
                                                    if ($string == $date){ 
                                                    ?> <h5>x</h5> <?php
                                                    }
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <a href="#" onclick="bollocks('<?=$row["user_id"]?>')"> + </a>
                                        </td>
                                        
                                        <td colspan="17" id="bollocks<?=$row['user_id']?>" style="display:none">
                                            <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')">edit</i></a>
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
                                                email
                                            </a>

                                            <a href="javascript:book_viewing('<?php echo $row['user_id']; ?>')" style="font-size: 14px; white-space: nowrap;" id="book_viewing_handler">
                                                book
                                            </a>

                                            <a href="javascript:property_match('<?php echo $row['user_id']; ?>')" style="font-size: 14px; white-space: nowrap;" id="property_match">
                                                match
                                            </a>

                                            <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')">
                                                del
                                            </a>
                                            
                                            <ul>
                                                <?=$row['contact_number']?>
                                                <li>Job Title: <?=$row['job_title']?></li>
                                                <li>Children: <?=$row['children']?></li>
                                                <li>Pets: <?=$row['pets']?></li>
                                                <li>DSS: <?=$row['pets']?></li>
                                            </ul>
                                            <br>
                                            
                                            <pre>
                                                <?=$row['special_conditions']?>
                                            </pre>

                                        </td>
                                        
                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo $row['user_id'] ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo $row['title'] ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo $row['first_name'] ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo $row['last_name'] ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap; width:200px;">
                                            <?php echo $row['email']; ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo str_replace(" ","",$row['contact_number']); ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo $row['bedrooms']; ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php echo $row['maximum_budget']; ?>
                                        </td>

                                        <td style="font-size: 14px; white-space: nowrap;">
                                            <?php
                                                if($row["salary"]!=null){
                                                    echo "Income: £" . $row["salary"] . "/ Potential: £" . round(($row['salary'] / 30), 0);
                                                } else {
                                                    echo "Income Unknown";
                                                }
                                            ?>
                                        </td>

                                        <td style="display:none">
                                            <?php echo $row['special_conditions']; ?>  
                                        </td>

                                        <td>
                                            <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')">edit</a>                                                            
                                        </td>

                                        <td>
                                            <a href="mailto:<?php echo $row['email']; ?>?subject=<?php echo $subject ?>&body=<?php echo $body; ?>">email</a>
                                        </td>

                                        <td>
                                            <a href="javascript:book_viewing('<?php echo $row['user_id']; ?>')" id="book_viewing_handler">
                                                book
                                            </a>
                                        </td>

                                        <td>
                                            <a href="javascript:property_match('<?php echo $row['user_id']; ?>')" id="property_match">
                                                match
                                            </a>
                                        </td>

                                        <td>
                                            <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')">del</i></a>                                                          
                                        </td>

                                    </tr>
                                <?php 
                                } 
                                ?>
                            </tbody>
                        </table>
                    </form>
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