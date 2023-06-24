<?php require_once __SITE_PATH . '/view/_header.php';?>

<?php foreach( $show_movies as $index => $m ) { 
    $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );?>
        <div>
            <img src="<?php echo $src;?>" class="movie_image" alt="<?php echo $m->__get( 'title' );?>" 
            sytle="width: 200px; height: auto;">
            <div class="title"><?php echo $m->__get( 'title' );?></div>
        </div>
    <?php echo $m->__get('year'); ?><br>
    <?php echo $m->__get('genre'); ?><br>
    <?php echo $m->__get('description'); ?><br>
    <?php echo $m->__get('duration'); ?><br>
 
<?php } ?>

<?php require_once __SITE_PATH . '/view/_footer.php';?>