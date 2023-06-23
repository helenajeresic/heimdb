<?php require_once __SITE_PATH . '/view/_header.php';?>

<?php foreach( $show_movies as $index => $m ) { 
    $src = "https://heimdb.s3.eu-north-1.amazonaws.com/" . $m->__get( 'image' );?>
        <div>
            <img src="<?php echo $src;?>" alt="<?php echo $m->__get( 'title' );?>">
            <div class="title"><?php echo $m->__get( 'title' );?></div>
        </div>
 
<?php } ?>

<?php require_once __SITE_PATH . '/view/_footer.php';?>