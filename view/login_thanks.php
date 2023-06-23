<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<h2>
    Thank you for your application. <br>
    To complete the registration, click on the link in the email we sent you.
</h2>

<div class="form-group">
            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=login' ?>">
            <br>
            <div class="float-end">
            <br>
            <input class="btn btn-secondary" type="submit" name="register" value="Vrati se na prijavu"/>
        </div>
</div>



<?php require_once __SITE_PATH . '/view/_footer.php'; ?>