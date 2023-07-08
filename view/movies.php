<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="container">
    <div class="movie-container">
        <div class="movie-list-name">
            <h1><?php echo $title;  ?></h1><br>
            <div class="select-sort">
                <label for="selectSort">Sort by:</label>
                <select name="selectSort" id="selectSort">
                    <option value="byTitle">title</option>
                    <option value="byYear">year</option>
                    <option value="byGenre">genre</option>
                    <option value="byRating">HEIMDB rating</option>
                </select>
                <button class="order-toggle" id="orderToggle" data-order="asc">&darr; Descending</button>
            </div>
        </div >
        <div class="movie-content">
            <?php foreach( $show_movies as $index => $m ) {
            $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );
            $mov = 'http://' . $_SERVER['SERVER_NAME'] . htmlentities( dirname( $_SERVER['PHP_SELF'] ) ) . '/index.php?rt=Movies/showMovie&id_movie=' . $m->__get( 'id_movie' );?>
            <div class="movie-box">
                <a href="<?php echo $mov; ?>">
                    <img src="<?php echo $src;?>" class="movie-image" alt="<?php echo $m->__get( 'title' );?>" >
                </a>
                <div class="movie-data">
                <div class="movie-title">
                    <a href="<?php echo $mov;?>"><?php echo $m->__get( 'title' );?></a>
                </div>
                    <div class = "movie-buttons">
                        <button class="rating-button" >&#9733; <?php echo $ratings[$m->__get('id_movie')]; ?></button>
                        <button class="remove-watchlist-button <?php echo $movieOnWatchlist[$m->__get('id_movie')] ? 'added' : 'not-added'; ?>" >&#x2764;</button>
                        <button class="remove-watched-button <?php echo $movieOnWatched[$m->__get('id_movie')] ? 'watched' : 'not-watced'; ?>" >&#x1F4FA;</button>
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
<script>
    var orderToggleBtn = document.getElementById('orderToggle');

    document.getElementById('selectSort').addEventListener('change', function() {
        var selectedValue = this.value;
        var movieContent = document.querySelector('.movie-content');
        var movies = movieContent.getElementsByClassName('movie-box');
        var moviesArray = Array.from(movies);

        moviesArray.sort(function(a, b) {
            var titleA = a.querySelector('.movie-title').textContent.trim().toLowerCase();
            var titleB = b.querySelector('.movie-title').textContent.trim().toLowerCase();

            if (selectedValue === 'byTitle') {
                return compareValues(titleA, titleB);
            } else if (selectedValue === 'byYear') {
                var yearA = parseInt(a.querySelector('.movie-atributes').textContent.trim().split('|')[0]);
                var yearB = parseInt(b.querySelector('.movie-atributes').textContent.trim().split('|')[0]);
                return compareValues(yearA, yearB);
            } else if (selectedValue === 'byGenre') {
                var genreA = a.querySelector('.movie-atributes').textContent.trim().split('|')[2].trim().toLowerCase();
                var genreB = b.querySelector('.movie-atributes').textContent.trim().split('|')[2].trim().toLowerCase();
                return compareValues(genreA, genreB);
            } else if (selectedValue === 'byRating') {
                var ratingA = parseInt(a.querySelector('.rating-button').textContent.trim().split(' ')[1]);
                var ratingB = parseInt(b.querySelector('.rating-button').textContent.trim().split(' ')[1]);
                return compareValues(ratingB, ratingA);
            }
        });

        if (orderToggleBtn.dataset.order === 'desc') {
            moviesArray.reverse();
        }

        movieContent.innerHTML = '';
        moviesArray.forEach(function(movie) {
            movieContent.appendChild(movie);
        });
    });

    orderToggleBtn.addEventListener('click', function() {
        var currentOrder = orderToggleBtn.dataset.order;
        orderToggleBtn.dataset.order = currentOrder === 'asc' ? 'desc' : 'asc';
        orderToggleBtn.textContent = currentOrder === 'asc' ? '↑ Ascending' : '↓ Descending';

        // Ponovno pokreni sortiranje
        document.getElementById('selectSort').dispatchEvent(new Event('change'));
    });

    function compareValues(valueA, valueB) {
        if (valueA < valueB) {
            return -1;
        } else if (valueA > valueB) {
            return 1;
        } else {
            return 0;
        }
    }
</script>

<?php require_once __SITE_PATH . '/view/_footer.php';?>