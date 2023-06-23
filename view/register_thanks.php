<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<h2>
    Registration was successfully completed.<br>
    Now you can log in.
</h2>

<div class="form-group">
            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=login' ?>">
            <br>
            <div class="float-end">
            <br>
            <input class="btn btn-secondary" type="submit" name="register" value="Log in"/>
        </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>