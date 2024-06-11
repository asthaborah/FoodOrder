<?php include("Partials/menu.php") ?>
<html>

<head>
    <style>
        td{
            font-size: 12px;
            border-collapse: collapse;
            text-align: left;
            word-wrap: break-word;
            max-width: 10px;
        }
    </style>
</head>
    <div class="main-content">
        <div style="width:95%;overflow-x:auto" class="wrapper">
            <h1>Manage Order</h1>

            <br>
                <?php 
                //message display if order is updated or not
                    if(isset($_SESSION['update-order'])){
                        echo $_SESSION['update-order'];
                        unset($_SESSION['update-order']);
                    }
                ?>
            <br><br>
            <table class="tbl-full">
                <!-- displaying all the details of the order in the table -->
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_order ORDER BY id desc"; // display the latest order on basis of date 
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>
                            <tr>
                                <td>
                                    <?php echo $sn++ ?>
                                </td>
                                <td>
                                    <?php echo $food ?>
                                </td>
                                <td>
                                    <?php echo $price ?>
                                </td>
                                <td>
                                    <?php echo $qty ?>
                                </td>
                                <td>
                                    <?php echo $total ?>
                                </td>
                                <td>
                                    <?php echo $order_date ?>
                                </td>
                                <td>
                                    <!-- now setting the colour according to status -->
                                    <?php 
                                        if($status == "On delivery"){
                                            echo "<label style='color:orange;font-weight:bold;'>$status</label>";
                                        }else if($status == "Delivered"){
                                            echo "<label style='color:green;font-weight:bold;'>$status</label>";
                                        }else if($status == "Cancelled"){
                                            echo "<label style='color:red;font-weight:bold;'>$status</label>";
                                        }else{
                                            echo $status;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $customer_name ?>
                                </td>
                                <td>
                                    <?php echo $customer_contact ?>
                                </td>
                                <td>
                                    <?php echo $customer_email ?>
                                </td>
                                <td>
                                    <?php echo $customer_address ?>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL?>admin/update-order.php?id=<?php echo $id?>" class="btn-success" style = "font-size:12px; padding:5px">Update Order</a>
                                </td>

                            </tr>

                            <?php

                        }
                    } else {
                        echo "<tr><td colspan = '12' class = 'error'>Orders not available</td></tr>";
                    }
                }

                ?>

            </table>
        </div>
    </div>

</html>

<?php include("Partials/Footer.php") ?>