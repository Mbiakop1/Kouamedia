<?php
session_start();


$con = mysqli_connect("localhost", "root", "", "social");


if(mysqli_connect_errno()){
    echo "failed to connect: ". mysqli_connect_errno();
}

// Declaring variables to prevent errors

$fname =""; // First name
$lname =""; // last name
$em =""; // Email
$em2 =""; // Email 2
$password =""; // password
$password2 =""; // password 2
$date = ""; // Sign up date
$error_array= array();  //holds error messages


if(isset($_POST['register_button'])){
    // Resgistration form values

    //First name
    $fname = strip_tags($_POST['reg_fname']); //Remove htlm tags
    $fname =str_replace(' ', '', $fname);   // Remove spaces
    $fname = ucfirst(strtolower($fname)); // uppercase first letter 
    $_SESSION['reg_fname'] = $fname;   // Stores first name into session variables

    //Last name
    $lname = strip_tags($_POST['reg_lname']); //Remove htlm tags
    $lname =str_replace(' ', '', $lname);   // Remove spaces
    $lname = ucfirst(strtolower($lname)); // uppercase first letter 
    $_SESSION['reg_lname'] = $lname;   // Stores last name into session variables

    // email
    $em = strip_tags($_POST['reg_email']); //Remove htlm tags
    $em =str_replace(' ', '', $em);   // Remove spaces
    $em = ucfirst(strtolower($em)); // uppercase first letter
    $_SESSION['reg_email'] = $em;   // Stores email into session variables
    
    //emial 2
    $em2 = strip_tags($_POST['reg_email2']); //Remove htlm tags
    $em2 =str_replace(' ', '', $em2);   // Remove spaces
    $em2 = ucfirst(strtolower($em2)); // uppercase first letter
    $_SESSION['reg_email2'] = $em2;   // Stores email2 into session variables 

    //password
    $password = strip_tags($_POST['reg_password']); //Remove htlm tags
    $password2 = strip_tags($_POST['reg_password2']); //Remove htlm tags


    $date = date("Y-m-d"); // current date

    if($em == $em2){
          if(filter_var($em, FILTER_VALIDATE_EMAIL)){
              $em = filter_var($em, FILTER_VALIDATE_EMAIL);

              // check if email already exist
               $e_check = mysqli_query($con, "select email from users where email='$em'");

               //count count number of rows returned

               $num_rows = mysqli_num_rows($e_check);

               if($num_rows>0){

                array_push($error_array, "Email already in use <br>");
               }
          } 
          else {
              array_push($error_array, "Invalid email format <br>");
          }

    } else {
        array_push($error_array, "emails dont match <br>");
    }

    if(strlen($fname)>25 || strlen($fname)<2){
        array_push($error_array, "Your first name must be between 2 and 25 characters <br>");
    }

    if(strlen($lname)>25 || strlen($lname)<2){
        array_push($error_array, "Your last name must be between 2 and 25 characters <br>");
    }

    if($password != $password2){
        array_push($error_array, "Your passwords do not match <br>");
    }
    else {

        if(preg_match('/[^A-Za-z0-9]/', $password)){
            
            array_push($error_array, "Your password must contain only english characters or numbers<br>");

        }

    }

    if (strlen($password) > 30 || strlen($password) < 5){
        array_push($error_array, "Your password must be between 5 and 3o characters <br>");
    }


    
}


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
        <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use <br>"; ?>

        <input type="text" name="reg_lname" placeholder="Last Name" required value="<?php 
          if(isset($_SESSION['reg_lname']))
          echo $_SESSION['reg_lname'];
        ?>"><br>
        <input type="email" name="reg_email" placeholder="Email" required value="<?php 
          if(isset($_SESSION['reg_email']))
          echo $_SESSION['reg_email'];
        ?>"><br>
        <input type="email" name="reg_email2" placeholder="Confrim Email" required value="<?php 
          if(isset($_SESSION['reg_email2']))
          echo $_SESSION['reg_email2'];
        ?>"><br>
        <input type="password" name="reg_password" placeholder="Password" required><br>
        <input type="password" name="reg_password2" placeholder="Confrim Password" required><br>
        <input type="submit" name="register_button" value="register"><br>

    </form>
</body>

</html>