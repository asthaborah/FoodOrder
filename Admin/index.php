<!-- Body of the html -->

<?php include("Partials/menu.php") ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>

        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <div class="col-4 text-align">
            <h3>5</h3>
            Categories
        </div>
        <div class="col-4 text-align">
            <h3>5</h3>
            Categories
        </div>
        <div class="col-4 text-align">
            <h3>5</h3>
            Categories
        </div>
        <div class="col-4 text-align">
            <h3>5</h3>
            Categories
        </div>

        <div class="clearfix"></div>
    </div>
    <?php include("Partials/Footer.php") ?>