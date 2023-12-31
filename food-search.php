<?php include("Partials-front/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on Your Search <a href="#" class="text-white">"Momo"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <!-- implementing search through database -->
        <?php
        //getting keyword for search
        $search = $_POST['search'];

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
                        <p class="food-price"><?php echo $price;?></p>
                        <p class="food-detail">
                        <?php echo $description;?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
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