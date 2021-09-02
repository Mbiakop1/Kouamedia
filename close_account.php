<?php
include "./header.php";

if(isset($_POST['cancel'])){
    header("Location: settings.php");

}

if(isset($_POST['close_account'])){
    $close_query = mysqli_query($con, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
    session_destroy();
    header("Location: register.php");
}

?>


<div class="main_column column">

    <h4> Close your account </h4>
    Are you sure you want to close your account?<br><br>
    Closing your account will hide your profile and all your activity from other users.<br><br>
    You can re-open your account at any time by simply logging in.<br><br>

    <form action="close_account.php" method="POST">
        <input class="btn btn-danger" type="submit" name="close_account" id="close_account" value="Yes! Close it!">
        <input class="btn btn-primary" type="submit" name="cancel" id="cancel" value="Cancel">

    </form>
</div>