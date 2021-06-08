<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Kouamedia</title>
</head>

<body>

    <form action="register.php" method="POST">
        <input type="text" name="reg_fname" placeholder="First Name" required value="<?php 
          if(isset($_SESSION['reg_fname']))
          echo $_SESSION['reg_fname'];
        ?>"><br>
        <?php if(in_array("Your first name must be between 2 and 25 characters <br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>

        <input type="text" name="reg_lname" placeholder="Last Name" required value="<?php 
          if(isset($_SESSION['reg_lname']))
          echo $_SESSION['reg_lname'];
        ?>"><br>
        <?php if(in_array("Your last name must be between 2 and 25 characters <br>", $error_array)) echo "Your last name must be between 2 and 25 characters <br>"; ?>

        <input type="email" name="reg_email" placeholder="Email" required value="<?php 
          if(isset($_SESSION['reg_email']))
          echo $_SESSION['reg_email'];
        ?>"><br>
        <input type="email" name="reg_email2" placeholder="Confrim Email" required value="<?php 
          if(isset($_SESSION['reg_email2']))
          echo $_SESSION['reg_email2'];
        ?>"><br>

        <?php if(in_array("Email already in use <br>", $error_array)){ echo "Email already in use <br>";} 
          else if(in_array("Invalid email format <br>", $error_array)) {echo "Invalid email format <br>"; }
          else if(in_array("emails dont match <br>", $error_array)){ echo "emails dont match <br>";}
        ?>


        <input type="password" name="reg_password" placeholder="Password" required><br>
        <input type="password" name="reg_password2" placeholder="Confrim Password" required><br>
        <?php if(in_array("Your passwords do not match <br>", $error_array)) echo "Your passwords do not match <br>"; 
          else if(in_array("Your password must contain only english characters or numbers<br>", $error_array)) echo "Your password must contain only english characters or numbers<br>"; 
          else if(in_array("Your password must be between 5 and 30 characters <br>", $error_array)) echo "Your password must be between 5 and 30 characters <br>";
          ?>

        <input type="submit" name="register_button" value="Register">
        <br>
        <?php if(in_array("<span style='color:#14c800'>You're all set! go ahead and login! </span>", $error_array)) echo "<span style='color:#14c800'>You're all set! go ahead and login! </span>"; ?>


    </form>
</body>

</html>