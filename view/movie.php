<?php require_once __SITE_PATH . '/view/_header.php';?>

<?php $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $show_movie->__get( 'image' );
$popupId = 'ratingPopup_' . $show_movie->__get('id_movie');?>

<div class='img-blur-wrap'>
  <div class='img-blur-bg' style="background-image: url('<?php echo $src;?>');"></div>
  <div class='img-blur' style="background-image: url('<?php echo $src;?>');"></div>
  <div class='info'>
    <div class='info-first' ><?php echo $show_movie->__get('title'); ?></div>
    <div class='info-second'><p><?php echo $show_movie->__get('year'); ?> | <?php echo $show_movie->__get('duration'); ?> min</p></div>
    <div class='info-third'><?php echo $show_movie->__get('genre'); ?></div><br>
    <div class='info-forth'><?php echo $show_movie->__get('description'); ?></div><br>
    <div class='info-fifth'>DIRECTORS <?php foreach( $show_directors as $index => $d ) { echo ' | ' . $d->__get('name') . ' ' .$d->__get('surname') ;}?></div><br>
    <div class='info-sixth'>ACTORS <?php foreach( $show_actors as $index => $a ) { echo ' | ' . $a->__get('name') . ' ' .$a->__get('surname');}?></div><br>
    <div class='info-seven'><button class="rating-button"  onclick="toggle('<?php echo $popupId; ?>')">&#9733; <?php echo $rating; ?></button>
                            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=watchlist/updateWatchlist' ;?>" id="watchlistForm">
                            <button type="submit" <?php if(isset($_SESSION['id_user']) && $movieOnWatchlist[$show_movie->__get('id_movie')]) { ?> class="remove-watched-button-colored" <?php } else { ?> class="remove-watched-button" <?php } ?> name="id_movie" value="<?php echo $show_movie->__get('id_movie'); ?>" >&#x2764;</button>
                             </form>
                            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=watchlist/updateWatched'; ?>" id="watchedForm">
                            <button type="submit" <?php if(isset($_SESSION['id_user']) && $movieOnWatched[$show_movie->__get('id_movie')]) { ?> class="remove-watched-button-colored" <?php } else { ?> class="remove-watched-button" <?php } ?> name="id_movie" value="<?php echo $show_movie->__get('id_movie'); ?>">&#x1F4FA;</button>
                            </form>
    </div><br>
</div>
</div>

<div id="<?php echo $popupId; ?>" class="popup">
    <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=movies/rateMovieOnMovie&id_movie=' . $show_movie->__get('id_movie') ?>">
    <label for="rating-stars" style="font-weight: bold;">Rate movie below</label><br><br>
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
        <input type="hidden" name="movieId" id="<?php echo $popupId . '_ratingMovieId'; ?>" value="<?php echo $show_movie->__get('id_movie'); ?>">
        <br>
        <input type="submit" name="rate" value="Rate" class="comment-button" id="rate">
    </form>
    <button class="comment-button" onclick="toggle('<?php echo $popupId; ?>')" id="close">Close</button>
</div>

<script src="<?php echo __SITE_URL . '/util/popup.js'; ?>"></script>

<?php require_once __SITE_PATH . '/view/comments.php';?>
<?php require_once __SITE_PATH . '/view/recommendations.php';?>
<?php require_once __SITE_PATH . '/view/_footer.php';?>