<?php  require_once __SITE_PATH . '/view/_header.php';?>

<div class="com-wrapper">
    <div class="com">
        <h2><?php echo $title; ?></h2>
        <?php
        $i = 0;
        foreach ($rates as $r) {
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
                        <?php echo date('d.m.Y.', strtotime($r->__get('date'))); ?><br>
                    </div>
                </div>
                <div class="content">
                    <style>
                        .star {
                            color: #F3CE13;
                        }
                    </style>
                    <?php
                    $n = $r->__get('rate'); // Zamijenite brojem n s vašim određenim brojem
                    for ($j = 0; $j < 10; $j++) {
                        if ($j < $n) {
                            echo '<span class="star">&#9733;</span> ';
                        } else {
                            echo "&#9733; ";
                        }
                    }
                    ?>
                    <?php echo " " . $r->__get('rate') . "  / 10  "; ?>

                </div>

            </div>
            <br>
        <?php
        }
        ?>
    </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php';?>
