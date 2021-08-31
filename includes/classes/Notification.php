<?php

class Notification {
    private $user_obj;
    private $con;


    public function __construct($con, $user){
      $this->con = $con;
      $this->user_obj = new User($con, $user);
    }


    public function getUnreadNumber(){

    $userLoggedIn = $this->user_obj->getUserName();
    $query = mysqli_query($this->con, "SELECT * FROM notifications where viewed='no' AND user_to='$userLoggedIn'");

    return mysqli_num_rows($query);
}


public function insertNotification($post_id, $user_to, $type){
    $userLoggedIn = $this->user_obj->getUserName();
    $userLoggedInName = $this->user_obj->getFirstAndLastName();

    $date_time = date("Y-m-d H:i:s");

    switch($type){
      case 'comment':
           $message = $userLoggedInName . " commented on your post ";
           break;
       case 'like':
           $message = $userLoggedInName . " liked on your post ";     
           break;
      case 'profile_post':
           $message = $userLoggedInName . " posted on your profile ";    
           break;
      case 'comment_non_owner':
           $message = $userLoggedInName . " commented on a post you commented on";
           break;
      case 'profile_comment':
           $message = $userLoggedInName . " commented on your profile post ";
           break;
    }

    $link = "post.php?id=" . $post_id;
    $insert_query = mysqli_query($this->con, "INSERT INTO notifications VALUES('', '$user_to', '$userLoggedIn', '$message', '$link', '$date_time', 'no', 'no')");

    }



public function getNotifications($data, $limit, ){

  
    $page = $data['page'];
    $userLoggedIn = $this->user_obj->getUserName();
    $return_string = "";
    
    if($page == 1){
        $start = 0;
    }else {
        $start = ($page - 1) * $limit;
    }

    $set_viewed_query = mysqli_query($this->con, "UPDATE notifications SET viewed='yes' WHERE user_to='$userLoggedIn'");

    $query = mysqli_query($this->con, "SELECT * FROM notifications WHERE user_to='$userLoggedIn' ORDER BY id DESC");

    if(mysqli_num_rows($query) == 0){
      echo "You have no notifications";

      return;
    }

    $num_iterations = 0; //Number of messages checked
    $count = 1; // number of messages posted

    while($row = mysqli_fetch_array($query)){

        if($num_iterations++ < $start){
            continue;
        }

        if( $count > $limit){
            break;
        } else {
            $count++;
        }

        $user_from = $row['user_from'];
        $user_data_query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$user_from'");
        $user_data = mysqli_fetch_array($user_data_query);



         // Timeframe
                            $date_time_now = date("Y-m-d H:i:s");
                            $start_date = new DateTime($row['datetime']); // Time of the post
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

         $opened = $row['opened'];
         $style = (isset($row['opened']) && $row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";

        $return_string .= "<a href='". $row['link'] ."'>
                            <div class='resultDisplay resultDisplayNotification' style='" . $style. "'>
                            <div class='notificationsProfilePic'>
                              <img src='". $user_data['profile_pic']."'>   
                            </div>
                            <p class='timestamp_smaller' id='grey'>" . $time_massage ."</p>" . $row['message'] . "
                            </div>
                            </a>";
    }

    // if post were loaded 

    if($count > $limit){
        $return_string.= "<input type='hidden' class='nextPagedropDown' value='" . ($page + 1). "'> <input type='hidden' class='noMoreDropdownData' value='false'>";
    } else {
        $return_string.= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align:center;'>No more notifications to load! </p>";
    }

    return $return_string;
}

}

?>