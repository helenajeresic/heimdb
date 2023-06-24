<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEIMDB</title>
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL . '/css/style.css';?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class = "sticky">
        <div style="display: inline-block;">
            <img src=<?php echo __SITE_URL . '/images/heimdb.png';?> class = "icon_heimdb" alt="heimdb">
        </div>
        <?php if( isset ($_SESSION['username'] ) )
        {?>

            <div class="topnav">
                <div class="dropdown">
                    <button class="dropbtn active"><i class="fas fa-bars"></i>Menu
                    </button>
                    <div class="dropdown-content">
                      <a href="index.php?rt=movies/topRated">Top rated</a>
                      <a href="index.php?rt=movies/mostWatched">Most watched</a>
                      <a href="index.php?rt=movies/mostPopular">Most popular</a>
                    </div>
                  </div>
                <a href="index.php?rt=movies"><i class="fas fa-film"></i>Watchlist</a>
                <a href="index.php?rt=user"><i class="fas fa-user"></i>My profile</a>
                <a href="index.php?rt=logout"><i class="fas fa-sign-out-alt"></i>Log out</a>
            </div>


       <?php } ?>
   </div>
