<?php include("Partials/menu.php") ?>
<html>

<head>
    <style>
        td{
            font-size: 12px;
            border-collapse: collapse;
            text-align: left;
        }

        .td-wrap{
            word-wrap: break-word;
        }
    </style>
</head>
    <div class="main-content">
        <div style="width:95%" class="wrapper">
            <h1>Manage Order</h1>

            <br><br><br>
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
                $sql = "SELECT * FROM tbl_order ORDER BY order_date desc"; // display the latest order on basis of date 
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $count = mysqli_num_rows($res);
                    if ($count > 0) {
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
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
                                <td class = "td-wrap" colspan="1">
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
                                    <?php echo $status ?>
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
                                <td class = "td-wrap">
                                    <?php echo $customer_address ?>
                                </td>
                                <td>
                                    <a href="#" class="btn-success">Update Admin</a>
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