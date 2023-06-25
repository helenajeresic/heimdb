<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="container">
    <div class="movie-container">
        <h2>Watchlist</h2>
        <div class="movie-content">
            <?php foreach( $show_watchlist as $index => $m ) {
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
            $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );?>

            <div class="movie-box">
                <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                <div class="movie-data">
                    <div class="movie-title"><a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a></div>
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

<div class="container">
    <div class="movie-container">
        <h2>Watched</h2>
        <div class="movie-content">
            <?php foreach( $show_watched as $index => $m ) {
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
            $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );?>

            <div class="movie-box">
                <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                <div class="movie-data">
                    <div class="movie-title"><a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a></div>
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
