<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="container">
    <div class="movie-container">
        <div class="movie-list-name">
            <h1>Top movies:</h1><br>
            <div class="select-sort">
                <label for="selectSort">Sort by:</label>
                <select name="selectSort" id="selectSort">
                    <option value="byTitle">title</option>
                    <option value="byYear">year</option>
                    <option value="byGenre">genre</option>
                    <option value="byRating">HEIMDB rating</option>
                </select>
            </div>
        </div>
        <div class="movie-content">
            <?php foreach( $show_movies as $index => $m ) { 
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );?>

            <div class="movie-box">
                <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                <div class="movie-data">
                    <div class="movie-title">
                        <h2><?php echo $m->__get( 'title' );?></h2>
                    </div class>
                    <div class = "movie-buttons">
                        <p>Rating: </p>
                        <button class="remove-watched-button" onclick="removeFromWatched(<?php echo $m->__get('id');?>)">&#x2764;</button>
                        <button class="remove-watchlist-button" onclick="removeFromWatchlist(<?php echo $m->__get('id');?>)">&#x1F4FA;</button>
                    </div>
                    <div class="movie-atributes">
                        <?php echo $m->__get('year'); ?> | 
                        <?php echo $m->__get('duration'); ?> min | 
                        <?php echo $m->__get('genre'); ?>
                    </div>
                    <?php echo $m->__get('description'); ?><br>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php';?>