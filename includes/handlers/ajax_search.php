<?php

include "../../config/config.php";
include "../../includes/classes/User.php";

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$name = explode(" ", $query);

// if query contains an underscore, assume user is searching for username

if(strpos($query, "_") !== false){
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (username LIKE '$query%' OR username LIKE '%$query') AND user_closed='no' limit 8 ");

}//if there are two, assume they are firts and last name respectively
 else if (count($name) == 2){
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users  WHERE
     (( first_name LIKE '$name[0]%' AND last_name LIKE '$name[1]%') OR ( first_name LIKE '%$name[0]' AND last_name LIKE '%$name[1]') OR ( first_name LIKE '$name[1]%' AND
      last_name LIKE '$name[0]%') OR ( first_name LIKE '%$name[1]' AND last_name LIKE '%$name[0]')) AND user_closed='no' limit 8 ");

} // if query has one word only,  search first names or last names
else {
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE ((first_name LIKE '$name[0]%' OR first_name LIKE '%$name[0]') OR (last_name LIKE '$name[0]%' OR last_name LIKE '%$name[0]')) AND user_closed='no' limit 8 ");
}

if($query != ""){
    while($row = mysqli_fetch_array($usersReturnedQuery)){
        $user = new User($con, $userLoggedIn);

        if($row['username'] != $userLoggedIn){
            $mutual_friends = $user->getMutualFriends($row['username']) . " friends in common";
        } else {
            $mutual_friends = "";

        }

        echo "<div class='resultDisplay'>
               <a href='" . $row['username'] ."' style='color: #1485BD'>
                <div class='liveSearchProfilePic'>
                  <img src='" . $row['profile_pic']. "'>
                </div>

                <div class='liveSearchText'>
                  " . $row['first_name']. " " . $row['last_name'] . "
                  <p>" . $row['username'] . "</p>
                  <p id='grey'>" . $mutual_friends ."</p>
                </div>
               </a>
               </div>";

    }
}

?>