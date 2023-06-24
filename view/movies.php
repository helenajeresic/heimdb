<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="container">
    <div class="movie-container">
    <div class="movie-content">
            <?php foreach( $show_movies as $index => $m ) { 
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );?>

            <div class="movie-box">
                <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                <div class="movie-data">
                    <div class="movie-title"><?php echo $m->__get( 'title' );?></div>
                    <div><?php echo $m->__get('year'); ?></div>
                    <div><?php echo $m->__get('genre'); ?></div>
                    <div><?php echo $m->__get('description'); ?></div>
                    <div><?php echo $m->__get('duration'); ?></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php';?>