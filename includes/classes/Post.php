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

    public function loadPostsFriends($data, $limit){
           
          $page = $data['page'];
          $userLoggedIn = $this->user_obj->getUsername();
          if($page == 1){
              $start = 0;
          }
          else {
              $start = ($page - 1) * $limit;
          }
          

          $str = ""; //String to return
          $data_query  = mysqli_query($this->con, "SELECT * FROM posts WHERE  deleted='no' ORDER BY id DESC");

          if(mysqli_num_rows($data_query) > 0){

              $num_iterations = 0; // Number of results checked (not necasserily posted)
              $count = 1; 

                
                while($row =mysqli_fetch_array($data_query)){
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

                        $user_logged_obj = new User($this->con, $userLoggedIn);

                        if($user_logged_obj->isFriend($added_by)){

                            
                            if($num_iterations++ < $start){
                                continue;
                            }
                            
                            
                            //once 10 posts have been loaded , brake
                            if($count > $limit){
                             break;
                            } else {
                                $count++;
                            }

                            
                            $user_details_query = mysqli_query(
                                $this->con, "SELECT first_name, last_name, profile_pic FROM users WHERE username='$added_by'");
                            $user_row = mysqli_fetch_array($user_details_query);
                            $first_name = $user_row['first_name'];
                            $last_name = $user_row['last_name'];
                            $profile_pic = $user_row['profile_pic'];
                            
                            ?>
<script>
function toggle<?php echo $id;?>() {
    var target = $(event.target);
    if (!target.is("a")) {

        var element = document.getElementById("toggleComment<?php echo $id ;?>");
        if (element.style.display == "block") {
            element.style.display = "none";
        } else {
            element.style.display = "block";
        }

    }

}
</script>




<?php
   
   $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
   $comments_check_num = mysqli_num_rows($comments_check);


                            
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
                            
                            
                            $str .= "<div class ='status_post' onClick='javascript:toggle$id()'>
                                <div class='post_profile_pic'>
                                <img src='$profile_pic' width='50px'>
                                </div>
                                
                                <div class ='posted_by' style='color:#ACACAC;'>
                                <a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $time_massage
                                </div>
                                
                                <div id='post_body'>
                                 $body
                                <br>
                                </div>
                                <br><br>

                                <div class='newsfeedPostOptions'>
                                  Comments($comments_check_num) &nbsp;&nbsp;&nbsp;

                                  <iframe id='like_frame' src='like.php?post_id=$id' scrolling='no'></iframe>

                                </div>

                                </div>

                                <div class='post_comment' id='toggleComment$id' style='display:none;'>
                                   <iframe src='comment_frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                                </div>
                                <hr>" ;
                                
                                
                            }
                                
                    } // end of while loop.
                            
                            if($count > $limit){
                                $str .= "<input type='hidden' class='nextPage' value='" .($page + 1) . "'>
                                <input type='hidden' class='noMorePosts' value='false'>";
                                
                            } else {
                                
                                $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: center;'> No more posts to show</p>";
                                
                        }   

                    }
          echo $str;
          
          
        }
        
    }
    
    
?>