<?php

if(isset($_POST['update_details'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];


    $email_check = mysqli_query($con, "SELECT * FROM  users WHERE email='$email'");
    $row = mysqli_fetch_array($email_check);
    
    if(isset($row['username'])){
        $matched_user = $row['username'];
    } else {
         $matched_user = "";
    }
   
    if($matched_user == "" || $matched_user == $userLoggedIn){
        $message = "Details updated!<br><br>";

        $query = mysqli_query($con, "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE username='$userLoggedIn'");
    } else {
        $message= "That email is already in use!<br><br>";
    }
} else {
    $message= "";
}

?>