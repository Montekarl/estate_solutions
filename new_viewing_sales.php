
<?php
require 'functions.php';
auth();

include_once 'dbconfig.php';?>
<?php
if(isset($_POST['add_viewing'])){
    $viewing_date=$_POST['viewing_date'];
    $insert_viewing_sql = "INSERT INTO viewing(viewing_date)VALUES('$viewing_date')";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Database</title>
    <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript">
        function edt_id(id) {
            //if(confirm('Sure to edit ?'))
            //{
            window.location.href = 'edit_data.php?edit_id=' + id;
            //}
        }

        function delete_id(id) {
            if (confirm('Delete this?')) {
                window.location.href = 'index.php?delete_id=' + id;
            }

        }

        function full_id(id) {
            window.location.href = 'full_details.php?full_id' + id;
        }
    </script>

</head>

<body>

<div id="header">
    <div id="content">
        <label>Add a New Viewing
            <a href="http://cleartuts.blogspot.com" target="_blank"></a>
        </label>
    </div>
</div>

<div id="body">
    <div id="content">
        <table style ="width:100%">
            <?php include "header.php" ?>



            <table style="width:100%">

                <th colspan="4">
                    Sales Applicants</th>

                </tr>

                <tr>
                    <td>
                        <a href="new_viewing.php">Lettings</a>
                    </td>
                    <td>
                        <a href="new_viewing_sales.php">Sales</a>
                    </td>
                </tr>




                <!-- FILTER AND SEARCH SECTION START -->
                <!-- LETTINGS APPLICANT START -->
                <tr>
                    <td colspan="4">
                        <?php
                        if(isset($_POST['search']))
                        {
                            $valueToSearch = $_POST['valuetoSearch'];
                            $query = "SELECT * FROM `sales_applicant` 
                            WHERE (`first_name` LIKE '%".$valueToSearch."%') 
                            OR (`last_name` LIKE '%".$valueToSearch."%')
                            OR (`email` LIKE '%".$valueToSearch."%') 
                            OR (`contact_number` LIKE '%".$valueToSearch."%')";
                            $search_result = filterTable($query);
                        } else {
                            $query = "SELECT * FROM `sales_applicant`";
                            $search_result = filterTable($query);
                        }
                        function filterTable($query){
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

                <!-- Lettings Applicant Column populated START  -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                    <tr>
                        <td>
                            <a href="javascript:book_viewing('<?php  echo $row[0];?>')">
                                <?php  echo $row['firstname']." ".$row['lastname'];?></a>
                        </td>
                        <td>
                            <?php  echo "<a href="."'mailto:".$row['email']."'>".$row['email']."</a>"; ?>
                        </td>
                        <td>
                            <?php  echo $row['contact_number']; ?>
                        </td>
                        <td>
                            <?php  echo "Looking for a ". $row['bedrooms']." bedroom(s)"." in ".$row['areas']." for up to: £". $row['maximum_budget'];?>
                        </td>

                    </tr>
                <?php endwhile;?>
                <!--Lettings Applicant Column populated END -->
                <!-- LETTINGS APPLICANT END -->

                <!-- LETTINGS PROPERTY START -->
                <tr>

                    <?php
                    if(isset($_POST['search1']))
                    {
                        $valueToSearch1 = $_POST['valuetoSearch1'];
                        $query1 = "SELECT * FROM `sales_properties` 
                        WHERE (`Address1` LIKE '%".$valueToSearch1."%') 
                        OR (`Address2` LIKE '%".$valueToSearch1."%')
                        OR (`Address3` LIKE '%".$valueToSearch1."%') 
                        OR (`postcode` LIKE '%".$valueToSearch1."%')";
                        $search_result1 = filterTable1($query1);
                    } else {
                        $query1 = "SELECT * FROM `sales_properties`";
                        $search_result1 = filterTable1($query1);
                    }
                    function filterTable1($query1){
                        $connect1 = mysqli_connect("localhost:3306","montechr_user","sK[kH?3XF?t;XxhoKF","montechr_dbtuts");
                        $filter_Result1 = mysqli_query($connect1, $query1);
                        return $filter_Result1;
                    }
                    ?>






                    <!-- BOOK A VIEWING START-->

                    <script type="text/javascript">
                        function book_viewing(id) {
                            //if(confirm('Sure to edit ?'))
                            //{
                            window.location.href = 'viewing_sales_handler.php?book_viewing=' + id;
                            //}
                        }
                    </script>







                </tr>
            </table>





        </table>

<?php mysql_close($conn); ?>
<?php $connect= mysqli_connect('localhost:3306','montechr_user','sK[kH?3XF?t;XxhoKF','montechr_dbtuts'); 
mysqli_close($connect);
?>
</body>
</html>