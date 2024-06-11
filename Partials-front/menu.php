<?php include("config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap">
</head>

<body>
    <!-- navbar starts here  -->
    <nav>
        <div class="menu-container">
            <!-- Header starts here  -->
            <div class="navbar nav-item1">
                <div class="logo">
                    <a href="<?php echo SITEURL ?>" title="Logo">
                        <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- header ends here  -->
            <!-- menu starts here  -->
            <div class="nav-item2">
                <div class="nav-item2_items">
                    <a href="#" class="text-right-align text-right">Log In</a>
                </div>
                <div class="clearfix"></div>
                <h1 class="header-center text-align" style="color: #94703A; font-weight:200; font-size:3em;">Wow Food
                </h1>
                <hr style="margin-top:20px;">
                <div class="menu text-align">
                    <ul>
                        <li>
                            <a href="<?php echo SITEURL?>index.php">Home</a>
                        </li>
                        <li>
                            <a href="categories.php">Categories</a>
                        </li>
                        <li>
                            <a href="foods.php">Foods</a>
                        </li>
                        <li>
                            <a href="foods.php">Blog</a>
                        </li>
                        <li>
                            <a href="#">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- menu ends here  -->
        </div>
    </nav>
    <!-- navbar ends here -->
</body>

</html>