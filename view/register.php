<?php require_once __SITE_PATH . '/view/_header.php';?>

<h2><?php echo $title; ?></h2>

<form action="<?php echo __SITE_URL . '/index.php?rt=register' ?>" method="post">		
    <label for="fname">Name</label><br>
    <input type="text" id="fname" name="name" placeholder="Name.." required><br>
    <br>
    <label for="lname">Surname</label><br>
    <input type="text" id="lname" name="surname" placeholder="Surname.." required><br>
    <br>
    <label for="rusername">Username</label><br>
    <input type="text" id="rusername" name="username" placeholder="Username.." required><br>
    <br>
    <label for="rpassword">Password</label><br>
    <input type="password" id="rpassword" name="password" placeholder="Password.." required><br>
    <br>
    <label for="lmail">e-mail</label><br>
    <input type="email" id="lmail" name="email" placeholder="E-mail.." required><br>
    <br>
    <br>
    <input type="submit" name="submit" value="Register" />
</form>

<br>
<div class="form-group">
            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=login' ?>">
            <br>
            <div class="float-end">
            <br>
            <input class="btn btn-secondary" type="submit" name="register" value="Go back to login"/>
        </div>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php'; ?>