<?php require_once __SITE_PATH . '/view/_header.php';?>

<div class="center-div">
    <h2><?php echo $title; ?></h2>
    <div class="form">
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
            <input class="btn" type="submit" name="submit" value="Sign up" />
            <br>
            <br>
        </form>
    </div>
   
    <div class="link">
        <a href="<?php echo __SITE_URL . '/index.php?rt=login' ?>">Already have an account? Login.</a></label>
    </div>
</div>



<?php require_once __SITE_PATH . '/view/_footer.php'; ?>