<?php include("Partials-front/menu.php"); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <!-- code for fetching categories from the backend -->
        <?php

        //query for displaying the categories
        $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
        //executing the query
        $res = mysqli_query($conn, $sql);

        //count the rows
        $count = mysqli_num_rows($res);

        //check according to count if the categories exist or not
        if ($count > 0) {
            //categories exist
            //loop to fetch all the categories
            while ($row = mysqli_fetch_assoc($res)) {
                //fetch the id , title and image_name
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

                ?>
                <a href="<?php SITEURL;?>category-foods.php?category_id=<?php echo $id;?>&title=<?php echo $title?>">
                    <div class="box-3 float-container">
                        <?php 
                            //check if the image exist or not
                            if($image_name == ""){
                                //image doesn't exist
                                echo "<div class = 'error'>Image not added</div>";
                            }else{
                                //image exist
                                ?>
                                <img src="<?php echo SITEURL;?>images/Category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                    </div>
                </a>
                <?php
            }
        } else {
            //category doesn't exist
            echo "<div class = 'error'>Category not added</div>";
        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>