<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEIMDB</title>
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL . '/css/style.css';?>">
    <link rel="shortcut icon" href=<?php echo __SITE_URL . '/images/heimdb.ico';?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="fixed">
  <div class="topnav">
    <div class="left-section">
      <img src="<?php echo __SITE_URL . '/images/heimdb.png';?>" class="icon_heimdb" alt="heimdb">
      <div class="search-container">
        <form action="index.php?rt=movies/search" method="post" >
          <input type="text" placeholder="Search movies by..." name="search">
          <div class="custom-select" >
              <select name="by">
                <option value="1">Title</option>
                <option value="2">Year</option>
                <option value="3">Genre</option>
              </select>
            </div>
          <button type="submit"><i class="fa fa-search"></i>Search</button>
        </form>
      </div>
    </div>
    <div class="right-section">
      <a href="index.php?rt=movies"><i class="fas fa-home"></i>Home</a>
      <div class="dropdown">
        <button class="dropbtn active"><i class="fas fa-bars"></i>Menu</button>
        <div class="dropdown-content">
          <a href="index.php?rt=movies/topRated">Top rated</a>
          <a href="index.php?rt=movies/mostWatched">Most watched</a>
          <a href="index.php?rt=movies/mostPopular">Most popular</a>
        </div>
      </div>
      <a href="index.php?rt=watchlist"><i class="fas fa-film"></i>Watchlist</a>
      <?php if (isset($_SESSION['username'])) { ?>
      <div class="dropdown">
        <button class="dropbtn active"><i class="fas fa-user"></i><?php echo $_SESSION['username']; ?></button>
        <div class="dropdown-content">
          <a href="index.php?rt=comments/myComments">My Comments</a>
          <a href="index.php?rt=rates/myRates">My Rates</a>
          <a href="index.php?rt=users/updateProfile">Update Profile</a>
          <?php if (isset($_SESSION['username']) && $_SESSION['admin'] == 1) { ?>
          <a href="index.php?rt=users/deleteUser">Delete User</a>
          <a href="index.php?rt=movies/addMovie">Add Movie</a>
          <?php } ?>
        </div>
      </div>
      <a href="index.php?rt=logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
      <?php }
      else { ?> <a href="index.php?rt=login"><i class="fas fa-sign-out-alt"></i>Login</a>
      <?php } ?>

    </div>
  </div>
</div>
