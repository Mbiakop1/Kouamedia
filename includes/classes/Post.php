<?php

class Post {
    private $user_obj;
    private $con;


    public function __construct($con, $user){
      $this->con = $con;
      $this->user_obj = new User($con, $user);
    }

    public function submitPost($body, $user_to){
         $body = strip_tags($body);
         $body = mysqli_real_escape_string($this->con, $body);
         $body = str_replace('\r\n', '\n', $body);

         $body = nl2br($body);
         $check_empty = preg_replace('/\s+/', '', $body);

         if($check_empty != ""){

            // current date and time   
            $date_added = date("Y-m-d H:i:s");
            //get username
            $added_by = $this->user_obj->getUserName();

            // If user is  on own profile, user to is none

            if($user_to == $added_by){
                $user_to = "none";
            }

            $query = mysqli_query($this->con, "INSERT INTO posts VALUES(
                '', '$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0'
                )");
                
                $returned_id = mysqli_insert_id($this->con);

                //Insert notification

                //Update post count for user

                $num_posts = $this->user_obj->getNumPosts();
                $num_posts++;
                $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts'  WHERE username='$added_by'");
         }
    }

    public function loadPostsFriends(){
          $str = ""; //String to return
          $data  = mysqli_query($this->con, "SELECT * FROM posts WHERE  deleted='no' ORDER BY id DESC");

          while($row =mysqli_fetch_array($data)){
              $id = $row['id'];
              $body = $row['body'];
              $added_by = $row['added_by'];
              $date_time = $row['date_added'];

              //prepare user to string so it can be included even if not posted to a user

              if($row['user_to'] == "none"){
                  $user_to = "";
              }
              else {
                    $user_to_obj = new User($this->con, $row['user_to']);
                    $user_to_name = $user_to_obj->getFirstAndLastName();
                    $user_to = "to <a href='".$row['user_to']."'>" .$user_to_name ."</a>";
              }

              //Check if user who posted, has their account closed
                    $added_by_obj = new User($this->con, $added_by);
                    if($added_by_obj->isClosed()){
                        continue;
                    }

                    $user_details_query = mysqli_query(
                    $this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                    $user_row = mysqli_fetch_array($user_details_query);
                    $first_name = $user_row['first_name'];
                    $last_name = $user_row['last_name'];
                    $profile_pic = $user_row['profile_pic'];


                // Timeframe
                $date_time_now = date("Y-m-d H:i:s");
                $start_date = new DateTime($date_time); // Time of the post
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
                       $days = $interval->d . " day ago";
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
                       $days = $interval->d . " Day ago";
                   }
                   else {
                       $days = $interval->d . " Days ago";
                   }
                }
                else if($interval->h >= 1){

                     if($interval->h == 1){
                       $time_massage = $interval->h . " hour ago";
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

                   if($interval->s == 1){
                       $time_massage = $interval->s . "Just now";
                   }
                   else {
                       $time_massage = $interval->s . " Seconds ago";
                   }
                }
                
                
                $str .= "<div class ='status_post'>
                            <div class='post_profile_pic'>
                              <img src='$profile_pic' width='50px'>
                            </div>

                            <div class ='posted_by' style='color:#ACACAC;'>
                               <a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time_massage
                            </div>

                            <div id='post_body'>
                              $body
                              <br>
                            </div>  
                            
                         </div>" ;



          }

          echo $str;
          
          
    }

}


?>