<div class='comments'>
    <div class="comment-review"><h1>User comments <button class="comment-button" onclick="toggle('popup')" style="float:right;">Comment</button></h1> </div>
    <?php 
    $i = 0;
    foreach( $show_comments as $index => $c ) { ?>
        <div class="all_comments">
                    <div class = "title_date_name">
                        <div class="name">
                            <div class ="bold_text">
                                User:
                            </div>
                             <?php echo $user_names[$i++]->__get('username') ; ?>
                        </div>
                        <div class="title">
                            <div class ="bold_text">
                                Movie:
                            </div>
                            <?php echo $show_movie->__get('title'); ?>
                        </div>
                        <div class="date">
                            <div class ="bold_text">
                                Date:
                            </div>
                            <?php echo $c->__get('date'); ?> <br>
                        </div>
                    </div>
                    <div class="content">
                        <br>
                        <?php echo $c->__get('content'); ?>
                    </div>
                    <?php /*dovrsi dodat action na button da obrise ako je admin taj komentar*/
                        if($_SESSION['admin'] == 1 ) { ?>
                    <br>
                    <div class="button_com">
                        <button class="but_com">Delete</button>
                    </div>
                    <?php } ?>
                </div>
                <br>
 
    <?php } ?>

    <div id="popup" class="popup">
                <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=comments/addNewComment&id_movie=' . $show_movie->__get( 'id_movie' ) ?>">
                    <div class="form-group">
                        <label for="comment" style="font-weight: bold;">Write comment below</label><br><br>
                        <textarea class="form-control" id="comment-input" name="comment-input" type="text" placeholder="Write comment.." required style="height: 200px; width: 600px"></textarea>
                    </div>
                    <br><br>
                    <div class="float-end">
                        <input class="comment-button" type="submit" name="comment" value="Comment" style="float: right;"/>
                        <button class="comment-button" onclick="toggle('popup')" style="float: left;">Close</button>
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