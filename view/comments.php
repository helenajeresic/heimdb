<div class='comments'>
    <div class="comment-review"><h1>User reviews <button onclick="toggle('popup')" style="float:right;">Review</button></h1> </div>
    <?php foreach( $show_comments as $index => $c ) { ?>

 
    <?php } ?>

    <div id="popup" class="popup">
                <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=comments/addNewComment&id_movie=' . $show_movie->__get( 'id_movie' ) ?>">
                    <div class="form-group">
                        <label for="comment">Write review below</label><br><br>
                        <textarea class="form-control" id="comment-input" name="comment-input" type="text" placeholder="Write review.." required style="height: 200px; width: 600px"></textarea>
                    </div>
                    <br><br>
                    <div class="float-end">
                        <input class="btn btn-primary" type="submit" name="comment" value="Review" style="float: right;"/>
                        <button onclick="toggle('popup')" style="float: left;">Close</button>
                    </div>
            </form>
    </div>

    <script>
        function toggle(popup){
            var popup = document.getElementById(popup);
            popup.classList.toggle('active');
        }
    </script>
</div>