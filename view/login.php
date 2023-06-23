<?php require_once __SITE_PATH . '/view/_header.php';?>

<h2><?php echo $title; ?></h2>

<form method="post" action="<?php echo __SITE_URL . '/index.php?rt=login' ?>">
        <div class="form-group">
            <label for="username">Username</label><br>
            <input class="form-control" id="username" name="username" type="text" placeholder="Username.." required>
        </div>
        <br>
        <div class="form-group">
            <label for="password">Password</label><br>
            <input class="form-control" id="password" name="password" type="password" placeholder="Password.." required>
        </div>
        <br>
        <div class="float-end">
            <input class="btn btn-primary" type="submit" name="login" value="Log in"/>
        </div>
        <br>
</form>

<br>
<div class="form-group">
            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=register' ?>">
            <div class="float">
            <br>
            <label>Register</label>
            <br>
            <input class="btn btn-secondary" type="submit" name="register" value="Register"/>
        </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>