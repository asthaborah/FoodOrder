<?php include("Partials-front/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- Adding functionality for fetching food data from the database -->
        <?php
        $sql = "SELECT * FROM tbl_food WHERE active = 'Yes'";
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
                                <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>

                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            //food doesn't exist
            echo "<div class = 'error'>Food not added</div>";
        }
        ?>

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>