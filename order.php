<?php include("Partials-front/menu.php"); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search" style="height:fit-content; ">
    <div class="container">

        <!-- get the id for food -->
        <?php
        if (isset($_GET['food_id'])) {
            $id = $_GET['food_id'];
        } else {
            //trying to access without clicking order button
            header("location:" . SITEURL . "index.php");
        }
        ?>

        <div>
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order" method="post">
                <fieldset>
                    <legend>Selected Food</legend>

                    <!-- fetching food data from the database -->
                    <?php
                    $sql = "SELECT * FROM tbl_food WHERE id = $id";

                    //executing the query
                    $res = mysqli_query($conn, $sql);

                    //count the rows
                    $count = mysqli_num_rows($res);

                    if ($count == 1) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                        }
                    } else {
                        header("location:" . SITEURL . "index.php");
                    }
                    ?>

                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class = 'error'>Image not added</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" alt="Food" class="img-responsive img-curve">
                        <?php
                        }

                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">₹<?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Astha Borah" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 8169xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. asthaborah@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        </div>


        <!-- for submitting the order details -->
        <?php
        if (isset($_POST['submit'])) {
            $full_name = $_POST['full-name'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $quantity = $_POST['qty'];
            $total = $quantity * $price;
            $status = "Ordered";
            $order_date = date("Y-m-d h:i:sa");

            $sql2 = "INSERT INTO tbl_order SET
                    food = '$title',
                    price = $price,
                    qty = $quantity,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$full_name',
                    customer_contact = '$contact',
                    customer_email = '$email',
                    customer_address = '$address'";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2) {
                $_SESSION['ordered'] = "<div class = 'success text-align'>Order placed successfully</div>";
                header("location:" . SITEURL);
            } else {
                $_SESSION['ordered'] = "<div class = 'error'>Couldn't place the order</div>";
                header("location:" . SITEURL);
            }
        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>