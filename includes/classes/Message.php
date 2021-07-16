<?php

class Message {
    private $user_obj;
    private $con;


    public function __construct($con, $user){
      $this->con = $con;
      $this->user_obj = new User($con, $user);
    }


    public function getMostRecentUser(){

        $userLoggedIn = $this->user_obj->getUserName();
        
        $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE
         user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC LIMIT 1");

         if(mysqli_num_rows($query) == 0){
             return false;
         }

         $row = mysqli_fetch_array($query);

         $user_to = $row['user_to'];
         $user_from = $row['user_from'];


         if($user_to != $userLoggedIn){
             return $user_to;
         } else {
             return $user_from;
         }

    }



    public function sendMessage($user_to, $body, $date){
        if($body != ""){
            $userLoggedIn = $this->user_obj->getUserName();
            $query = mysqli_query($this->con, "INSERT INTO messages VALUES('', '$user_to', '$userLoggedIn', '$body', '$date', 'no', 'no', 'no')");
        }
    }



public function getMessages($otherUser){
            $userLoggedIn = $this->user_obj->getUserName();

            $data = "";
            $query = mysqli_query($this->con, "UPDATE messages SET opened='yes' WHERE (user_to='$userLoggedIn' AND user_from='$otherUser')");

            $get_message_query = mysqli_query($this->con, "SELECT * FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$otherUser')
             OR (user_from='$userLoggedIn' AND user_to='$otherUser')");


        
        while($row = mysqli_fetch_array($get_message_query)){
          $user_to = $row['user_to'];
          $user_from = $row['user_from'];
          $body = $row['body'];

          $div_top = ($user_to == $userLoggedIn) ? "<div class='message' id='green'>" : "<div class='message' id='blue'>";
          $data = $data . $div_top . $body  . "</div><br><br>";
      }

      return  $data;
}


public function getLatestMessage($userLoggedIn, $user_to){

    $details_array = array();

    $query = mysqli_query($this->con, "SELECT body, user_to, date FROM messages WHERE (user_to='$userLoggedIn' AND user_from='$user_to')
       OR (user_to='$user_to' AND user_from='$userLoggedIn') ORDER BY id DESC LIMIT 1");

       $row = mysqli_fetch_array($query);

       $sent_by = ($row['user_to'] == $userLoggedIn) ? "They said: " : "You said: ";



       // Timeframe
                                    $date_time_now = date("Y-m-d H:i:s");
                                    $start_date = new DateTime($row['date']); // Time of the post
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
                                
    array_push($details_array, $sent_by);     
    array_push($details_array, $row['body']);     
    array_push($details_array, $time_massage);     

    return $details_array;
}

public function getConvos(){

    $userLoggedIn = $this->user_obj->getUserName();
    $return_string = "";
    $convos = array();

    $query = mysqli_query($this->con, "SELECT user_to, user_from FROM messages WHERE user_to='$userLoggedIn' OR user_from='$userLoggedIn' ORDER BY id DESC");

    while($row = mysqli_fetch_array($query)){
        $user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];


        if(!in_array($user_to_push, $convos)){
            array_push($convos, $user_to_push);
        }
    }

    foreach($convos as $username){
        $user_found_obj = new User($this->con, $username);
        $latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

        $dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
        $split = str_split($latest_message_details[1], 12);
        $split = $split[0] . $dots;


        $return_string .= "<a href='messages.php?u=$username'><div class='user_found_message'> 
                           <img src='" . $user_found_obj->getProfilePic() . "' style='border-radius:5px; margin-right:5px;'>
                           " . $user_found_obj->getFirstAndLastName() . " <span class='timestamp_smaller' id='grey'>" 
                            . $latest_message_details[2] . "</span>
                            <p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . "</p>
                            </div>
                            </a>";
    }

    return $return_string;
}

}
?>