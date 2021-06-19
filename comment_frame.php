 <?php
    require 'config/config.php';
    include("./includes/classes/User.php");
    include("./includes/classes/Post.php");



    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
        

    }
    else {
        header("Location: register.php");
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="./Assets/CSS/style.css">

</head>

<body>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bellota+Text&family=Bellota:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');

*{
   font-size:12px;
   font-family: 'Bellota ', cursive, sans-serif;
}
</style>

    <script>
    function toggle() {
        var element = document.getElementById("comment_section");
        if (element.style.display == "block") {
            element.style.display = "none";
        } else {
            element.style.display = "block";
        }
    }
    </script>


    <?php
//  Get id of post

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}
    
    $user_query = mysqli_query($con, "SELECT added_by , user_to FROM posts WHERE id='$post_id'");
    
    $row = mysqli_fetch_array($user_query);
    
    $posted_to = $row['added_by'];
    
    if(isset($_POST['postComments' . $post_id])){
        $post_body = $_POST['post_body'];
        $post_body = mysqli_escape_string($con, $post_body);
        
        $date_time_now = date("Y-m-d H:i:s");
        
        $insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$posted_to', 
      '$date_time_now', 'no', '$post_id')");

echo "<p>Comment Posted!</p>";
}



?>


    <form action="comment_frame.php?post_id=<?php echo $post_id;?>" method="POST"
        name="postComment<?php echo $post_id?>" id="comment_form">

        <textarea name="post_body"></textarea>
        <input type="submit" name="postComments<?php echo $post_id;?>" value="Post">


    </form>

    <!------ load comments----->


    <?php 
      $get_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id ASC");
      $count = mysqli_num_rows($get_comments);

      if($count != 0){
          while($comment = mysqli_fetch_array($get_comments)){
              $comment_body = $comment['post_body'];
              $posted_to = $comment['posted_to'];
              $posted_by = $comment['posted_by'];
              $date_added = $comment['date_added'];
              $removed = $comment['removed'];

// Timeframe
                            $date_time_now = date("Y-m-d H:i:s");
                            $start_date = new DateTime($date_added); // Time of the post
                            $end_date = new DateTime($date_time_now); //Current time
                            $interval = $start_date->diff($end_date); // difference btw two dates
                            
                            if($interval->y >= 1){
                                if($interval->y == 1 ){
                                    $time_massage = $interval->y . " Year ago"; // 1 year ago
                                    
                                } 
                                else {
                                    $time_massage = $interval->y . " Years ago"; // 1+ years ago 
                                }
                            }
                            else if ($interval-> m >= 1){
                                if($interval->d == 0){
                                    $days = " ago";
                                    
                                } 
                                else if($interval->d == 1){
                                    $days = $interval->d . " Day ago";
                                }
                                else {
                                    $days = $interval->d . " Days ago";
                                }
                                
                                if($interval->m == 1){
                                    $time_massage = $interval->m . " Month" . $days;
                                } 
                                else {
                                    $time_massage = $interval->m . " Months" . $days;
                                    
                                }
                            }
                            else if($interval->d >= 1){
                                if($interval->d == 1){
                                    $time_massage = $interval->d . " Day ago";
                                }
                                else {
                                    $time_massage = $interval->d . " Days ago";
                                }
                            }
                            else if($interval->h >= 1){
                                
                                if($interval->h == 1){
                                    $time_massage = $interval->h . " Hour ago";
                                }
                                else {
                                    $time_massage = $interval->h . " Hours ago";
                                }
                            }
                            else if($interval->i >= 1){
                                
                                if($interval->i == 1){
                                    $time_massage = $interval->i . " Minute ago";
                                }
                                else {
                                    $time_massage = $interval->i . " Minutes ago";
                                }
                            }
                            
                            else {
                                
                                if($interval->s <= 1){
                                    $time_massage = "Just now";
                                }
                                else {
                                    $time_massage = $interval->s . " Seconds ago";
                                }
                            }              

              
              $user_obj = new User($con, $posted_by); 

    ?>
              
             <div class="comment_section">
                <a href="<?php echo $posted_by?>" target="_parent"><img src="<?php echo $user_obj->getProfilePic();?>"
                        alt="Profile pic" title="<?php echo $posted_by?>" style="float:left;" height="30px"></a>
                <a href="<?php echo $posted_by?>" target="_parent"><b><?php echo $user_obj->getFirstAndLastName(); ?></b></a>
                &nbsp; &nbsp; &nbsp; &nbsp;<?php echo $time_massage . "<br>" . $comment_body?>
                <hr>
            </div>
    <?php
          }
      }
      else {
          echo "<center> <br><br>No Comments Yet!</center>";
      }
    
    ?>

</body>

</html>