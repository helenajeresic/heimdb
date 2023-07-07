<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<div class="center-div">
    <h2><?php echo $title; ?></h2>
    <div class="form">
        <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=movies/addMovie' ?>" onsubmit="return validateForm()" enctype="multipart/form-data">
            <label for="title">Title:</label><br>
            <input type="text" name="title" placeholder="Title..." required><br><br>

            <label for="year">Year:</label><br>
            <input type="number" min="1888" max="2023" name="year" step="1" value="2023" required><br><br>

            <label for="genre">Genre:</label><br>
            <select name="genre" multiple required>
                <option value="crime">crime</option>
                <option value="drama">drama</option>
                <option value="action">action</option>
                <option value="adventure">adventure</option>
                <option value="animation">animation</option>
                <option value="comedy">comedy</option>
                <option value="fantasy">fantasy</option>
                <option value="horror">horror</option>
                <option value="mystery">mystery</option>
                <option value="romance">romance</option>
                <option value="sci-fi">sci-fi</option>
                <option value="thriller">thriller</option>
                <option value="music">music</option>
                <option value="western">western</option>
                <option value="war">war</option>
                <option value="sport">sport</option>
                <option value="biography">biography</option>
            </select><br><br>


            <label for="description">Description:</label><br>
            <textarea name="description" type="text" placeholder="Description..." required style="height: 100px; width: 400px" required></textarea><br><br>

            <label for="duration">Duration:</label><br>
            <input type="number" min="10" max="300" name="duration" step="1" value="120" required><br><br>

            <label for="dir-name-1">Directiors:</label><br>
            <div class="form-group">
            <label for="dir-name-1">Name:</label>
            <input type="text" name="dir-name-1" placeholder="First director..." required>
            </div>
            <div class="form-group">
            <label for="dir-surname-1">Surname:</label>
            <input type="text" name="dir-surname-1" placeholder="First director..." required>
            </div>
            <div class="form-group">
            <label for="dir-name-2">Name:</label>
            <input type="text" name="dir-name-2" placeholder="Second director...">
            </div>
            <div class="form-group">
            <label for="dir-surname-2">Surname:</label>
            <input type="text" name="dir-surname-2" placeholder="Second director...">
            </div>
            <div class="form-group">
            <label for="dir-name-3">Name:</label>
            <input type="text" name="dir-name-3" placeholder="Third director...">
            </div>
            <div class="form-group">
            <label for="dir-surname-3">Surname:</label>
            <input type="text" name="dir-surname-3" placeholder="Third director...">
            </div>


            <label for="act-name-1">Actors:</label><br>
            <div class="form-group">
            <label for="act-name-1">Name:</label>
            <input type="text" name="act-name-1" placeholder="First actor..." required>
            </div>
            <div class="form-group">
            <label for="act-surname-1">Surname:</label>
            <input type="text" name="act-surname-1" placeholder="First actor..." required>
            </div>

            <div class="form-group">
            <label for="act-name-2">Name:</label>
            <input type="text" name="act-name-2" placeholder="Second actor...">
            </div>
            <div class="form-group">
            <label for="act-surname-2">Surname:</label>
            <input type="text" name="act-surname-2" placeholder="Second actor...">
            </div>

            <div class="form-group">
            <label for="act-name-3">Name:</label>
            <input type="text" name="act-name-3" placeholder="Third actor...">
            </div>
            <div class="form-group">
            <label for="act-surname-3">Surname:</label>
            <input type="text" name="act-surname-3" placeholder="Third actor...">
            </div>

            <label for="image">Slika:</label><br>
            <input type="file" name="image" id="slika-input" required>
            <label for="slika-input" class="custom-file-upload">Choose File</label><br><br>


            <button type="submit" name="add">Add movie!</button>
        </form>
    </div>
    <br>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
