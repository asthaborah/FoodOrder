<?php include("Partials-front/menu.php"); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <!-- code for fetching categories from the backend -->
            <?php
            
                //query for displaying the categories
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes";
            ?>

            <a href="category-foods.html">
            <div class="box-3 float-container">
                <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>    

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

<?php include("Partials-front/footer.php"); ?>