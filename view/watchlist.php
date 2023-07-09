<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="container">
    <div class="movie-container">
        <div class="movie-list-name">
            <h1>Watchlist</h1><br>
        </div >
        <div class="movie-content">
            <?php foreach( $show_watchlist as $m ) { 
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
            $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );
            $popupId = 'ratingPopup_' . $m->__get('id_movie');
            ?>
            <div class="movie-box">
                <a href="<?php echo $mov; ?>">
                    <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                </a>
                <div class="movie-data">
                <div class="movie-title">
                    <a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a>
                </div>
                    <div class = "movie-buttons">
                    <button class="rating-button" onclick="showRatingPopup('<?php echo $popupId; ?>')">&#9733; <?php echo $ratings_watchlist[$m->__get('id_movie')]; ?></button>
                            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=watchlist/updateWatchlist' ;?>" 
                                onsubmit="return confirm('Are you sure you want to update this movie on the watchlist?');" id="watchlistForm1">
                                <button type="submit" class="remove-watchlist-button" name="id_movie" value="<?php echo $m->__get('id_movie'); ?>">&#x2764;</button>
                             </form>
                            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=watchlist/updateWatched'; ?>" 
                                onsubmit="return confirm('Are you sure you want to update this movie on the watchlist?');" id="watchedForm1">
                                <button type="submit" class="remove-watched-button" name="id_movie" value="<?php echo $m->__get('id_movie'); ?>">&#x1F4FA;</button>
                            </form>
                    </div>
                    <div class="movie-atributes">
                        <?php echo $m->__get('year'); ?> | 
                        <?php echo $m->__get('duration'); ?> min | 
                        <?php echo $m->__get('genre'); ?>
                    </div>
                    <?php echo $m->__get('description'); ?><br>
                </div>
            </div>
            <div id="<?php echo $popupId; ?>" class="popup" data-state="closed">
                    <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=movies/rateMovie&id_movie=' . $m->__get('id_movie'); ?>">
                        <h2>Rate the Movie</h2>
                        <div class="rating-stars">
                            <input type="radio" name="rating" id="<?php echo $popupId . '_star10'; ?>" value="10">
                            <label for="<?php echo $popupId . '_star10'; ?>">10 stars</label>  

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star9'; ?>" value="9">
                            <label for="<?php echo $popupId . '_star9'; ?>">9 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star8'; ?>" value="8">
                            <label for="<?php echo $popupId . '_star8'; ?>">8 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star7'; ?>" value="7">
                            <label for="<?php echo $popupId . '_star7'; ?>">7 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star6'; ?>" value="6">
                            <label for="<?php echo $popupId . '_star6'; ?>">6 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star5'; ?>" value="5">
                            <label for="<?php echo $popupId . '_star5'; ?>">5 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star4'; ?>" value="4">
                            <label for="<?php echo $popupId . '_star4'; ?>">4 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star3'; ?>" value="3">
                            <label for="<?php echo $popupId . '_star3'; ?>">3 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star2'; ?>" value="2">
                            <label for="<?php echo $popupId . '_star2'; ?>">2 stars</label>

                            <input type="radio" class="rating-stars" name="rating" id="<?php echo $popupId . '_star1'; ?>" value="1">
                            <label for="<?php echo $popupId . '_star1'; ?>">1 stars</label>
                                   
                        </div><br><br>
                        <input type="hidden" name="movieId" id="<?php echo $popupId . '_ratingMovieId'; ?>" value="<?php echo $m->__get('id_movie'); ?>">
                        <br>
                        <input type="submit" name="rate" value="Rate" class="comment-button" id="rate">
                    </form>
                    <button class="comment-button" onclick="togglePopup('<?php echo $popupId; ?>')" id="close">Close</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="movie-container">
        <div class="movie-list-name">
            <h1>Watched</h1><br>
        </div >
        <div class="movie-content">
            <?php foreach( $show_watched as $index => $m ) { 
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
            $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );
            $popupId = 'ratingPopup_' . $m->__get('id_movie');
            ?>
            <div class="movie-box">
                <a href="<?php echo $mov; ?>">
                    <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                </a>
                <div class="movie-data">
                <div class="movie-title">
                    <a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a>
                </div>
                    <div class = "movie-buttons">
                    <button class="rating-button" onclick="showRatingPopup('<?php echo $popupId; ?>')">&#9733; <?php echo $ratings_watched[$m->__get('id_movie')]; ?></button>
                            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=watchlist/updateWatchlist' ;?>" 
                                onsubmit="return confirm('Are you sure you want to update this movie on the watchlist?');" id="watchlistForm2">
                                <button type="submit" class="remove-watched-button" name="id_movie" value="<?php echo $m->__get('id_movie'); ?>" disabled >&#x2764;</button>
                             </form>
                            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=watchlist/updateWatched'; ?>" 
                                onsubmit="return confirm('Are you sure you want to update this movie on the watchlist?');" id="watchedForm2">
                                <button type="submit" class="remove-watched-button" name="id_movie" value="<?php echo $m->__get('id_movie'); ?>">&#x1F4FA;</button>
                            </form>
                    </div>
                    <div class="movie-atributes">
                        <?php echo $m->__get('year'); ?> | 
                        <?php echo $m->__get('duration'); ?> min | 
                        <?php echo $m->__get('genre'); ?>
                    </div>
                    <?php echo $m->__get('description'); ?><br>
                </div>
            </div>
            <div id="<?php echo $popupId; ?>" class="popup" data-state="closed">
                    <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=movies/rateMovie&id_movie=' . $m->__get('id_movie'); ?>">
                        <h2>Rate the Movie</h2>
                        <div class="rating-stars">
                            <input type="radio" name="rating" id="<?php echo $popupId . '_star10'; ?>" value="10">
                            <label for="<?php echo $popupId . '_star10'; ?>">10 stars</label>  

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star9'; ?>" value="9">
                            <label for="<?php echo $popupId . '_star9'; ?>">9 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star8'; ?>" value="8">
                            <label for="<?php echo $popupId . '_star8'; ?>">8 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star7'; ?>" value="7">
                            <label for="<?php echo $popupId . '_star7'; ?>">7 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star6'; ?>" value="6">
                            <label for="<?php echo $popupId . '_star6'; ?>">6 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star5'; ?>" value="5">
                            <label for="<?php echo $popupId . '_star5'; ?>">5 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star4'; ?>" value="4">
                            <label for="<?php echo $popupId . '_star4'; ?>">4 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star3'; ?>" value="3">
                            <label for="<?php echo $popupId . '_star3'; ?>">3 stars</label>

                            <input type="radio" name="rating" id="<?php echo $popupId . '_star2'; ?>" value="2">
                            <label for="<?php echo $popupId . '_star2'; ?>">2 stars</label>

                            <input type="radio" class="rating-stars" name="rating" id="<?php echo $popupId . '_star1'; ?>" value="1">
                            <label for="<?php echo $popupId . '_star1'; ?>">1 stars</label>
                                   
                        </div><br><br>
                        <input type="hidden" name="movieId" id="<?php echo $popupId . '_ratingMovieId'; ?>" value="<?php echo $m->__get('id_movie'); ?>">
                        <br>
                        <input type="submit" name="rate" value="Rate" class="comment-button" id="rate">
                    </form>
                    <button class="comment-button" onclick="togglePopup('<?php echo $popupId; ?>')" id="close">Close</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('watchlistForm1').addEventListener('click', function(){
        document.getElementById('watchlistForm').submit();
    });

    document.getElementById('watchedForm1').addEventListener('click', function(){
        document.getElementById('watchedForm').submit();
    });

    document.getElementById('watchlistForm2').addEventListener('click', function(){
        document.getElementById('watchlistForm').submit();
    });

    document.getElementById('watchedForm2').addEventListener('click', function(){
        document.getElementById('watchedForm').submit();
    });

    function showRatingPopup(popupId) {
        console.log('showRatingPopup called');
        document.getElementById(popupId).classList.add('active');
    }

    function togglePopup(popup) {
        console.log('togglePopup called');
        var popupElement = document.getElementById(popup);
        var currentState = popupElement.getAttribute('data-state');

        if (currentState === 'closed') {
            popupElement.classList.add('active');
            popupElement.setAttribute('data-state', 'open');
        } else {
            popupElement.classList.remove('active');
            popupElement.setAttribute('data-state', 'closed');
        }
    }
</script>

<?php require_once __SITE_PATH . '/view/_footer.php';?>
