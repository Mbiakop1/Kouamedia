<?php
include "./header.php";
include "./includes/form_handlers/settings_handler.php";


?>

<div class="main_column column">
    <h4>Account Settings</h4>

    <?php
       echo "<img src='" . $user['profile_pic']. "' id='small_profile_pics'>";
     ?>
    <br>
    <a href="upload.php" class="btn btn-secondary"> Upload new profile picture</a>

    Modify the values and click 'Update details'

    <form action="settings.php" method="POST">
        Firts Name: <input type="text" name="first_name" value="<?php echo $user['first_name']?>" required> <br>
        Last Name: <input type="text" name="last_name" value="<?php echo $user['last_name']?>" required> <br>
        Email: <input type="text" name="email" value="<?php echo $user['email']?>" required><br>
        <input type="submit" name="update_details" id="save_details" value="Update_details"> <br>

    </form>

    <h4> change password</h4>
    <form action="settings.php" method="POST">
        Old password: <input type="password" name="old_password" required> <br>
        New password: <input type="password" name="new_password_1" required> <br>
        new possword: <input type="password" name="new_password_2" required><br>
        <input type="submit" name="update_password" id="save_details" value="Update_password"> <br>

    </form>

    <h4>Close Account</h4>
    <form action="settings.php" method="POST">
        <input type="submit" name="close_account" value="Close Account" class="btn btn-danger">
    </form>
</div>