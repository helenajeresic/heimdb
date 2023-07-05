<?php require_once __SITE_PATH . '/view/_header.php';?>
<div class="center-div">
    <h2>Delete users</h2>
    <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=users/deleteUser' ?>">
        <select name="lang[]" id="users" multiple class="form-control">
            <?php foreach ($usersToDelete as $u) { ?>
                <option value="<?php echo $u->__get('id_user'); ?>"><?php echo $u->__get('username'); ?></option>
            <?php } ?>
        </select>
        <br>
        <br>
        <div>
            <input type="submit" name="submit" value="Delete users">
        </div>
    </form>
</div>

<?php require_once __SITE_PATH . '/view/_footer.php';?>