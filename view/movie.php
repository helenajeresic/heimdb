<?php require_once __SITE_PATH . '/view/_header.php';?>

<?php $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $show_movie->__get( 'image' );?>

<div class='img-blur-wrap'>
  <div class='img-blur-bg' style="background-image: url('<?php echo $src;?>');"></div>
  <div class='img-blur' style="background-image: url('<?php echo $src;?>');"></div>
  <div class='info'>
    <?php echo $show_movie->__get('title'); ?><br>
    <?php echo $show_movie->__get('year'); ?><br>
    <?php echo $show_movie->__get('genre'); ?><br>
    <?php echo $show_movie->__get('description'); ?><br>
    <?php echo $show_movie->__get('duration'); ?><br>
  </div>
</div>

<?php require_once __SITE_PATH . '/view/comments.php';?>
<?php require_once __SITE_PATH . '/view/recommendations.php';?>
<?php require_once __SITE_PATH . '/view/_footer.php';?>

