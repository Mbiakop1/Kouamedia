<?php 
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
    $lname = strip_tags($_POST['reg_lname']); //Remove htlm tagss
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
        array_push($error_array, "Your password must be between 5 and 30 characters <br>");
    }

    if(empty($error_array)){
        $password = md5($password); // Encrypt password before sending to database

        // generate username by concatenating first and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username from users where username='$username'");

        $i = 0;

        // if username exist add number to username
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . "_" . $i;
            $check_username_query = mysqli_query($con, "SELECT username from users where username='$username'");
            
        }

        // Default profile picture assignment
        $rand = rand(1,2);
        if($rand == 1){

            $profile_pic = "Assets/images/profile_pics/defaults/head_deep_blue.png";
        }
        else if ( $rand == 2){
            $profile_pic = "Assets/images/profile_pics/defaults/head_pete_river.png";

        }
        

        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',' )");

        array_push($error_array, "<span style='color:#14c800'>You're all set! go ahead and login! </span>");

        // Clear session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

    } 
    

}

?>