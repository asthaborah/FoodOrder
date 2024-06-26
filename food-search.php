<?php include("Partials-front/menu.php"); ?>
<?php 
//getting keyword for search
//to secure the search from sql injection we will use a function
// $search = $_POST['search'];
$search = mysqli_real_escape_string($conn , $_POST['search']); //The mysqli_real_escape_string function in PHP is used to escape special characters in a string to make it safe for use in a MySQL query
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search-special text-center">
    <div class="container">
        <div>
            <h2 style = "color:black">Foods on Your Search <a href="#" class="text-black">"<?php echo $search;?>"</a></h2>
        </div>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- implementing search through database -->
        <?php

        //sql for searching an item
        $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        //executing the query
        $res = mysqli_query($conn, $sql);

        //count the rows
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //food exist
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['title'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                $price = $row['price'];

                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                            if($image_name == ""){
                                echo "<div class = 'error'>Image not added</div>";
                            }else{
                                ?>
                                <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name;?>" alt="Food" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title;?></h4>
                        <p class="food-price">₹<?php echo $price;?></p>
                        <p class="food-detail">
                        <?php echo $description;?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            //food doesn't exist
            echo "<div class = 'error'>Food doesn't exist</div>";
        }
        ?>
        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>