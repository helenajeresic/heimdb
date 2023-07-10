<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<script>
        var birthday_mess = "<?php echo $birthday; ?>";
        if (birthday_mess !== "") {
            var balloonCount = 5; // Number of balloons to display
            var spacing = (window.innerWidth - balloonCount * 50) / (balloonCount + 1); // Calculate spacing between balloons
            for (var i = 1; i <= balloonCount; i++) {
                var balloon = document.createElement("div");
                balloon.className = "balloon";
                balloon.style.left = (spacing * i + 50 * (i - 1)) + "px"; // Calculate horizontal position
                document.body.appendChild(balloon);
            }

            // Remove balloons after animation ends
            var balloons = document.querySelectorAll(".balloon");
            setTimeout(function() {
                for (var i = 0; i < balloons.length; i++) {
                    balloons[i].remove();
                }
            }, 6000); // 6000ms = 6s (animation duration)
        }
</script>

<?php if($birthday !== "") { ?>

<div class ="center-div">
    <h1> <?php echo $birthday; ?> </h1>
    <br>
<?php } ?>

<div class="center-div">
    <div class="container_user">
        <h2><?php echo $title; ?></h2>
        <div class="userData">
            <h3>Your current data</h3>
            <div>
                <label for="name">Name:</label>
                <span><?php echo $data->name; ?></span>
            </div>
            <div>
                <label for="surname">Surname:</label>
                <span><?php echo $data->surname; ?></span>
            </div>
            <div>
                <label for="date_of_birth">Date of birth:</label>
                <span><?php echo date('d.m.Y.', strtotime($data->date_of_birth)); ?></span>
            </div>
            <div>
                <label for="email">Email:</label>
                <span><?php echo $data->email; ?></span>
            </div>
        </div>

        <div class="dataChange">
            <h3>Change your data here</h3>
            <form method="post" action="<?php echo __SITE_URL . '/index.php?rt=users/updateProfile' ?>">
                Name: <input type="text" name="name" placeholder="Enter new name"><br>
                Surname: <input type="text" name="surname" placeholder="Enter new surname"><br>
                Email: <input type="text" name="email" placeholder="Enter new email"><br>
                Date of birth:
                <input type="date" name="date">
                <br>
                <br>
                <button type="submit" name="save">Save changes!</button>
            </form>
        </div>
    </div>
</div>


<?php require_once __SITE_PATH . '/view/_footer.php'; ?>
