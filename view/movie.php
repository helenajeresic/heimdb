<?php require_once __SITE_PATH . '/view/_header.php';?>

<?php $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $show_movie->__get( 'image' );?>

<div class='img-blur-wrap'>
  <div class='img-blur-bg' style="background-image: url('<?php echo $src;?>');"></div>
  <div class='img-blur' style="background-image: url('<?php echo $src;?>');"></div>
  <div class='info'>
    <div class='info-first'><?php echo $show_movie->__get('title'); ?></div>
    <div class='info-second'><p><?php echo $show_movie->__get('year'); ?> | <?php echo $show_movie->__get('duration'); ?> min</p></div>
    <div class='info-third'><?php echo $show_movie->__get('genre'); ?></div><br>
    <div class='info-forth'><?php echo $show_movie->__get('description'); ?></div><br>
    <div class='info-fifth'>DIRECTORS <?php foreach( $show_directors as $index => $d ) { echo ' | ' . $d->__get('name') . ' ' .$d->__get('surname') ;}?></div><br>
    <div class='info-sixth'>ACTORS <?php foreach( $show_actors as $index => $a ) { echo ' | ' . $a->__get('name') . ' ' .$a->__get('surname');}?></div><br>

</div>
</div>

<?php require_once __SITE_PATH . '/view/comments.php';?>
<?php require_once __SITE_PATH . '/view/recommendations.php';?>
<?php //require_once __SITE_PATH . '/view/_footer.php';?>
