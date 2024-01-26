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

<!-- session to show the order places or not -->

<?php   
    echo "<br>";
    echo "<br>";
    echo "<br>";
    if(isset($_SESSION['ordered'])){
        echo $_SESSION['ordered'];
        unset($_SESSION['ordered']);
    }
?>
<br>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <!-- adding the categories dynamically from the database -->
        <?php
        //creating sql query for displaying the categories
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

        //executing the query
        $res = mysqli_query($conn, $sql);

        //check whether the count is greater than 0 means the categories exist
        
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            //categories exist
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                //show the data in the div we created for categories
                ?>
                <!-- if the image is set or not -->
                <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>&title=<?php echo $title?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class = 'error'>Image not added.</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/Category/<?php echo $image_name; ?>" alt="Pizza"
                                class="img-responsive img-curve category-image-responsive">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white">
                            <?php echo $title; ?>
                        </h3>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<div class = 'error'>Category Not added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- adding functionality to add featured food through database -->
        <?php
        $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

        //execute the query
        
        $res2 = mysqli_query($conn, $sql2);

        //count the rows
        
        $count = mysqli_num_rows($res2);

        //check whether is food exist or not
        
        if ($count > 0) {
            //fetch the data using loop
            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php 
                            if($image_name == ""){
                                echo "<div class = 'error'>Image not Added</div>";
                            }else{
                                ?>
                                <img src="<?php echo SITEURL;?>images/Food/<?php echo $image_name?>" alt="Food" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title;?></h4>
                        <p class="food-price">₹<?php echo $price;?></p>
                        <p class="food-detail"><?php echo $description;?></p>
                        <br>
                        <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class = 'error'>Food not added</div>";
        }
        ?>


        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>