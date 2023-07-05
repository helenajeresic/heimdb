<?php
require_once __SITE_PATH . '/view/_header.php';?>

<div class="com-wrapper">
    <div class="com">
        <h2><?php echo $title; ?></h2>
        <?php
        $i = 0;
        foreach ($comments as $c) {
        ?>
            <div class="all_comments">
                <div class="title_date_name">
                    <div class="name">
                        <div class="bold_text">
                            User:
                        </div>
                        <?php echo $current_user; ?>
                    </div>
                    <div class="title">
                        <div class="bold_text">
                            Movie:
                        </div>
                        <?php echo $movie_names[$i++]->__get('title') . "     "; ?>
                    </div>
                    <div class="date">
                        <div class="bold_text">
                            Date:
                        </div>
                        <?php echo date('d.m.Y.', strtotime($c->__get('date'))); ?><br>
                    </div>
                </div>
                <div class="content">
                    <?php echo $c->__get('content'); ?>
                </div>
                <br>
                <div class="button_com">
                    <button class="but_com">Delete</button>
                </div>
            </div>
            <br>
        <?php
        }
        ?>
    </div>
</div>




<?php
require_once __SITE_PATH . '/view/_footer.php';
?>
