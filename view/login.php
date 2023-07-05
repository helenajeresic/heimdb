<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="center-div">
    <h2><?php echo $title; ?></h2>
    <div class="form">
        <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=login' ?>">
                <label for="username">Username</label><br>
                <input class="form-control" id="username" name="username" type="text" placeholder="Username.." required>
                <br>
                <br>
                <label for="password">Password</label><br>
                <input class="form-control" id="password" name="password" type="password" placeholder="Password.." required>
                <br>
                <br>
                <input class="btn" type="submit" name="login" value="Log in"/>
                <br>
                <br>
        </form>
    </div>
    
    <div class="link">
        <a href="<?php echo __SITE_URL . '/index.php?rt=register' ?>">Don't have an account? Sign up.</a></label>
    </div>
</div>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>