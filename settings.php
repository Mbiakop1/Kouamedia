<?php
include "./header.php";
include "./includes/form_handlers/settings_handler.php";


?>

<div id="main_settings" class="main_column column">
    <h4>Account Settings</h4>

    <?php
       echo "<img src='" . $user['profile_pic']. "' id='small_profile_pics'>";
     ?>
    <br>
    <a href="upload.php" class="btn btn-primary upload_profile_pic"> Upload new profile picture</a>

    Modify the values and click 'Update details'

    <?php
    
    $user_data_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $row = mysqli_fetch_array($user_data_query);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];

    ?>

    <form action="settings.php" method="POST">
        Firts Name: <input type="text" name="first_name" value="<?php echo $first_name?>" id="settings_input" required>
        <br>
        Last Name: <input type="text" name="last_name" value="<?php echo $last_name?>" id="settings_input" required>
        <br>
        Email: <input type="text" name="email" value="<?php echo $email?>" id="settings_input" required><br>
        <?php echo $message; ?>
        <input type="submit" class="btn btn-warning" name="update_details" id="save_details" value="Update_details">
        <br>

    </form>

    <h4> change password</h4>
    <form action="settings.php" method="POST">
        Old password: <input type="password" name="old_password" id="settings_input" required> <br>
        New password: <input type="password" name="new_password_1" id="settings_input" required> <br>
        New possword: <input type="password" name="new_password_2" id="settings_input" required><br>
        <?php echo $password_message; ?> <br>

        <input type="submit" class="btn btn-warning" name="update_password" id="save_details" value="Update_password">
        <br>

    </form>

    <h4>Close Account</h4>
    <form action="settings.php" method="POST">
        <input type="submit" name="close_account" value="Close Account" class="btn btn-danger">
    </form>
</div>