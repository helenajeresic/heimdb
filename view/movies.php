<?php require_once __SITE_PATH . '/view/_header.php';?>

<?php foreach( $show_movies as $index => $m ) { 
    $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
    $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );?>
        <div>
            <img src="<?php echo $src;?>" class="movie_image" alt="<?php echo $m->__get( 'title' );?>" 
            sytle="width: 200px; height: auto;">
            <div class="title"><a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a></div>
        </div>
    <?php echo $m->__get('year'); ?><br>
    <?php echo $m->__get('genre'); ?><br>
    <?php echo $m->__get('description'); ?><br>
    <?php echo $m->__get('duration'); ?><br>
 
<?php } ?>

<?php require_once __SITE_PATH . '/view/_footer.php';?>