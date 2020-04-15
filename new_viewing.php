<?php
    require 'functions.php';
    auth();
    include_once 'dbconfig.php';
?>
<?php
    if(isset($_POST['add_viewing']))
    {
        $viewing_date=$_POST['viewing_date'];
        $insert_viewing_sql = "INSERT INTO viewing(viewing_date)VALUES('$viewing_date')";
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Database</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <link rel="stylesheet" href="style.css" type="text/css" />

        <script type="text/javascript">
            
            function edt_id(id)
            {
                window.location.href = 'edit_data.php?edit_id=' + id;
            }

            function delete_id(id) 
            {
                if (confirm('Delete this?')) 
                {
                    window.location.href = 'index.php?delete_id=' + id;
                }
            }

            function full_id(id) 
            {
                window.location.href = 'full_details.php?full_id' + id;
            }

        </script>

    </head>
    <body>
    <div id="header">
        <div id="content">
            <label>
                Add a New Viewing
            </label>
        </div>
    </div>

    <div id="body">
        <div id="content">
            <table style ="width:100%">
                <tr>
                    <th colspan="3" class="menutable">
                        <a href="index.php">
                            Lettings Applicants
                        </a>
                    </th>
                    
                    <th colspan="3" class="menutable">
                        <a href="property_lettings_data.php">
                            Lettings Property
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="new_viewing.php">
                            New Viewing
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="#">
                            Property Match
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="#">
                            Lettings Offer
                        </a>
                    </th>
                </tr>

                <tr>
                    <th colspan="3" class="menutable">
                        <a href="sales_data.php">
                            Sales Applicants
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="property_sales_data.php">
                            Sales Property
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="viewings_database.php">
                            Viewing Database
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="#">
                            Applicant Match
                        </a>
                    </th>

                    <th colspan="3" class="menutable">
                        <a href="#">
                            Sales Offer
                        </a>
                    </th>
                </tr>

                <table style="width:100%">
                    <th colspan="4">
                        Lettings Applicants
                    </th>
                    
                    <tr>
                        <td>
                            <a href="new_viewing.php">
                                Lettings
                            </a>
                        </td>

                        <td>
                            <a href="new_viewing_sales.php">
                                Sales
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">
                            <?php
                            if(isset($_POST['search']))
                            {
                                $valueToSearch = $_POST['valuetoSearch'];
                                $query = "SELECT * FROM `users` 
                                WHERE (`first_name` LIKE '%".$valueToSearch."%') 
                                OR (`last_name` LIKE '%".$valueToSearch."%')
                                OR (`email` LIKE '%".$valueToSearch."%') 
                                OR (`contact_number` LIKE '%".$valueToSearch."%')";
                                $search_result = filterTable($query);
                            } 
                            else 
                            {
                                $query = "SELECT * FROM `users`";
                                $search_result = filterTable($query);
                            }
                            
                            function filterTable($query)
                            {
                                global $conn;
                                $filter_Result = mysqli_query($conn, $query);
                                return $filter_Result;
                            }
                            ?>
                            <form action="new_viewing.php" method="post" name="filter_applicant" />
                                <input type="text" name="valuetoSearch" placeholder="Search Letting Applicant" value="<?php if (isset($_POST['valuetoSearch'])) echo $_POST['valuetoSearch']; ?>">
                                <input type="submit" name="search" value="Filter" placeholder="Search Letting Applicant">
                            </form>
                        </td>
                        </td>
                    </tr>

                    <?php while($row = mysqli_fetch_array($search_result)):?>
                        <tr>
                            <td>
                                <a href="javascript:book_viewing('<?php  echo $row[0];?>')">
                                    <?php  echo $row['first_name']." ".$row['last_name'];?>
                                </a>
                            </td>

                            <td>
                                <?php  echo "<a href="."'mailto:".$row['email']."'>".$row['email']."</a>"; ?>
                            </td>

                            <td>
                                <?php  echo $row['contact_number']; ?>
                            </td>

                            <td>
                                <?php  echo $row['tenants']." Adults ".$row['children']." Children looking for " .$row['bedrooms']. " Bedroom property around £".$row['maximum_budget']." in ". $row['areas'];?>
                            </td>

                        </tr>
                    <?php endwhile;?>
                    <tr>
                        <?php
                            if(isset($_POST['search1']))
                            {
                                $valueToSearch1 = $_POST['valuetoSearch1'];
                                $query1 = "SELECT * FROM `lettings_properties` 
                                WHERE (`Address1` LIKE '%".$valueToSearch1."%') 
                                OR (`Address2` LIKE '%".$valueToSearch1."%')
                                OR (`Address3` LIKE '%".$valueToSearch1."%') 
                                OR (`postcode` LIKE '%".$valueToSearch1."%')";
                                $search_result1 = filterTable1($query1);
                            } 
                            else 
                            {
                                $query1 = "SELECT * FROM `lettings_properties`";
                                $search_result1 = filterTable1($query1);
                            }
                            
                            function filterTable1($query1)
                            {
                                global $conn;
                                $filter_Result1 = mysqli_query($conn, $query1);
                                return $filter_Result1;
                            }
                        ?>

                        <script type="text/javascript">
                            function book_viewing(id) 
                            {
                                window.location.href = 'viewing_lettings_handler.php?book_viewing=' + id;
                            }
                        </script>
                    </tr>
                </table>
            </table>
        <?php 
            mysqli_close($conn);
        ?>
    </body>
</html>