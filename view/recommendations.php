<div class='recommendations'>
    <div class="recommendation-container">
    <div class="recommendation-content">
    <h1>More to explore</h1>
            <?php foreach( $show_recommendations as $index => $m ) { 
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
            $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );?>

            <div class="recommendation-box">
                <img src="<?php echo $src;?>" class="recommendation-image" alt="<?php echo $m->__get( 'title' );?>" >
                <div class="recommendation-data">
                    <div class="recommendation-title"><a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a></div>
                    <div><?php echo $m->__get('year'); ?></div>
                    <div><?php echo $m->__get('genre'); ?></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>