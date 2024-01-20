<!-- Body of the html -->

<?php include("Partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>

        <!-- calculating the total number of categories -->
        <?php

        //query to calculate the number of categories
        $sql = "SELECT * FROM tbl_category";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $count = mysqli_num_rows($res);
            ?>
            <div class="col-4 text-align">
                <h3>
                    <?php echo $count ?>
                </h3>
                Categories
            </div>
            <?php
        }
        ?>

        <!-- calculating the total number of food item -->
        <?php
        $sql1 = "SELECT * FROM tbl_food";
        $res1 = mysqli_query($conn, $sql1);
        if ($res) {
            $count1 = mysqli_num_rows($res);
            ?>
            <div class="col-4 text-align">
                <h3>
                    <?php echo $count ?>
                </h3>
                Foods
            </div>
            <?php
        }
        ?>

        <!-- calculating the total number of order placed -->
        <?php
        $sql2 = "SELECT * FROM tbl_order";
        $res2 = mysqli_query($conn, $sql2);
        if ($res2) {
            $count2 = mysqli_num_rows($res2);
            ?>
            <div class="col-4 text-align">
                <h3>
                    <?php echo $count2 ?>
                </h3>
                Total Orders
            </div>
            <?php
        }
        ?>

        <!-- calculating the total number of order placed -->
        <?php
        //query to add the total of the row
        $sql3 = "SELECT sum(total) AS Total FROM tbl_order WHERE status = 'Delivered'";

        $res3 = mysqli_query($conn, $sql3);
        if ($res3) {
            //this function is taking row in the form of associative array since there is only one row total so it has 1 value
            $row = mysqli_fetch_assoc($res3);

            // we are extracting the value from the row 
            $total_revenue = $row['Total'];
            ?>
            <div class="col-4 text-align">
                <h3>₹<?php echo $total_revenue?></h3>
                Revenue Generated
            </div>
            <?php
        }
        ?>





        <div class="clearfix"></div>
    </div>
    <?php include("Partials/Footer.php") ?>