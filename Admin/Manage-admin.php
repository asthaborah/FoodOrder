<?php include("Partials/menu.php") ?>
<div class="wrapper">
    <h1>Manage Admin</h1>

    <!-- if admin is addes succesfully then the message is shown -->
    <?php
    if (isset($_SESSION['add'])) { // to check if the session is added or not
        echo $_SESSION['add']; // to display the session message
        unset($_SESSION['add']); // to remove the session message once displayed
    }
    ?>

    <br><br>
    <a href="add-admin.php" class="btn-primary">Add Admin</a>

    <br><br><br>
    <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>UserName</th>
            <th>Actions</th>
        </tr>

        <!-- Run a query to fetch the data from the table in the database -->
        <?php
        $sql = "SELECT * FROM `tbl_admin`";
        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        if ($res) {
            $count = mysqli_num_rows($res);
            //if there is data in database
            if ($count > 0) {
                $sn = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    //using loop to get all the data from the database
                    //it will run as long as the data is inside the table
        
                    //get the individual data
                    $id = $row["id"];
                    $username = $row["username"];
                    $full_name = $row["full_name"];

                    ?>
                    <!-- Setting the data into the table -->
                    <tr>
                        <td>
                            <?php echo $sn++ ?>
                        </td>
                        <td>
                            <?php echo $full_name ?>
                        </td>
                        <td>
                            <?php echo $username ?>
                        </td>
                        <td>
                            <a href="#" class="btn-success">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>

                    </tr>
                    <?php
                }
            } else {
                //when we do not have data
            }
        }

        ?>
    </table>
</div>
<?php include("Partials/Footer.php") ?>