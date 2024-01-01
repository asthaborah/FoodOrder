<?php include("Partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"Category"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- category id received through get method -->
    <?php 
        if(isset($_GET['category_id'])){
            //security measure so that no one can access without clicking on category
            $category_id = $_GET['category_id'];
        }else{
            header("location:" . SITEURL . "index.php");
        }
    ?>


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>
                <!-- query for displaying foods based on category -->
                <?php 
                    $sql = "SELECT * FROM tbl_food WHERE category_id = $category_id";

                    //executing the query

                    $res = mysqli_query($conn , $sql);

                    //count the rows
                    $count = mysqli_num_rows($res);

                    if($count > 0){
                        // food exist
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id']; 
                            $title = $row['title']; 
                            $description = $row['description']; 
                            $price = $row['price']; 
                            $image_name = $row['image_name']; 
                        }
                    }else{
                        //food doesn't exist
                        echo "<div class = 'error'>Food doesn't exist</div>";
                    }
                ?>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>