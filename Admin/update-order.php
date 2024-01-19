<?php include("Partials/menu.php"); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br><br>
            <form action="#" method="post">
                <table class = "tbl-custom">
                    <!-- displaying items from the database in the table -->
                    <?php 
                        if(isset($_GET['id'])){
                            $id = $_GET['id']; 
                            //query to display the row
                            $sql = "SELECT * FROM tbl_order WHERE id = $id";

                            //executing the query
                            $res = mysqli_query($conn , $sql);

                            //count the rows
                            $count = mysqli_num_rows($res);

                            if($count == 1){
                                while($row = mysqli_fetch_assoc($res)){
                                    $food = $row['food'];
                                    $price = $row['price'];
                                    $qty = $row['qty'];
                                    $status = $row['status'];
                                    $customer_name = $row['customer_name'];
                                    $customer_contact = $row['customer_contact'];
                                    $customer_email = $row['customer_email'];
                                    $customer_address = $row['customer_address'];
                                }
                            }
                        }else{
                            header("location:" . SITEURL . "admin/manage-order.php");
                        }
                    ?>
                    <tr>
                        <td>Food Name</td>
                        <td style="font-weight:bold">
                            <?php echo $food ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td style="font-weight:bold">
                            ₹<?php echo $price ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td><input type="number" name="qty" value="<?php echo $qty?>"></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name = "status">
                                <option <?php if($status == "Ordered"){echo "selected";}?>  name = "Ordered" >Ordered</option>
                                <option <?php if($status == "On delivery"){echo "selected";}?>  name = "On delivery" >On delivery</option>
                                <option <?php if($status == "Delivered"){echo "selected";}?>  name = "Delivered" >Delivered</option>
                                <option <?php if($status == "Cancelled"){echo "selected";}?>  name = "Cancelled" >Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Name:</td>
                        <td><?php echo $customer_name?></td>
                    </tr>
                    <tr>
                        <td>Customer Contact:</td>
                        <td><?php echo $customer_contact?></td>
                    </tr>
                    <tr>
                        <td>Customer Email:</td>
                        <td><?php echo $customer_email?></td>
                    </tr>
                    <tr>
                        <td>Customer Address:</td>
                        <td style = "max-width:40px;word-wrap:break-word"><?php echo $customer_address?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input type="submit" name="submit" value = "Update" class = "btn-success">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- updating the order status -->
        <?php 
            
            if(isset($_POST['submit'])){
                
                $status = $_POST['status'];

                // query to update 
                $sql2 = "UPDATE tbl_order SET
                status = '$status' WHERE id = $id";

                //executing the query
                $res2 = mysqli_query($conn , $sql2);

                //check if the query is executed or not
                if($res2){
                    $_SESSION['update-order'] = "<div class = 'success'>Order updated successfully</div>";
                    header("location:" . SITEURL . "admin/manage-order.php");
                }else{
                    $_SESSION['update-order'] = "<div class = 'error'>Order is not updated</div>";
                    header("location:" . SITEURL . "admin/manage-order.php");
                }

            }
        ?>
    </div>
<?php include("Partials/footer.php"); ?>