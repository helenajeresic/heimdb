<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<h2> <?php echo $title; ?> </h2>
<br>
<div class="container_user">
    <div class="userData">
        <h3> Your current data </h3>
        Name : <?php echo $data->name; ?> <br>
        Surname : <?php echo $data->surname; ?> <br>
        Date of birth : <?php echo $data->date_of_birth; ?> <br>
        Email : <?php echo $data->email; ?> <br>
    </div>

    <div class="dataChange">
        <h3> Change your data here </h3>
        <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=users/updateProfile' ?>">
            Name : <input type="text" name="name" placeholder="enter new name"> <br>
            Surname : <input type="text" name="surname" placeholder="enter new surname"> <br>
            Email : <input type="text" name="email" placeholder="enter new email"> <br>
            Date of birth :
            <input type="date" name="date">
            <br>
            <br>
            <button type="submit" name="save">Save changes!</button>
        </form>

    </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
