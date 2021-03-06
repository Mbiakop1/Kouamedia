<?php

include "./header.php";

if(isset($_GET['q'])){
    $query = $_GET['q'];
} else {
    $query = "";
}

if(isset($_GET['type'])){
    $type = $_GET["type"];
} else {
    $type = "name";
}

?>

<div class="main_column column" id="main_column">

    <?php
  if($query == ""){
      echo "You must enter somthing in the search box";
  } else {

    

// if query contains an underscore, assume user is searching for username

if($type == "username"){
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (username LIKE '$query%' OR username LIKE '%$query') AND user_closed='no'");

}//if there are two, assume they are firts and last name respectively
else {
    $name = explode(" ", $query);


        if (count($name) == 3){
        $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users  WHERE
        (( first_name LIKE '$name[0]%' AND last_name LIKE '$name[2]%') OR ( first_name LIKE '%$name[0]' AND last_name LIKE '%$name[2]') OR ( first_name LIKE '$name[2]%' AND
        last_name LIKE '$name[0]%') OR ( first_name LIKE '%$name[2]' AND last_name LIKE '%$name[0]')) AND user_closed='no'");

    } // if query has one word only,  search first names or last names
    else if (count($name) == 2) {

        $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users  WHERE
        (( first_name LIKE '$name[0]%' AND last_name LIKE '$name[1]%') OR ( first_name LIKE '%$name[0]' AND last_name LIKE '%$name[1]') OR ( first_name LIKE '$name[1]%' AND
        last_name LIKE '$name[0]%') OR ( first_name LIKE '%$name[1]' AND last_name LIKE '%$name[0]')) AND user_closed='no'");

} else {

    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE ((first_name LIKE '$name[0]%' OR first_name LIKE '%$name[0]') OR (last_name LIKE '$name[0]%' OR last_name LIKE '%$name[0]')) AND user_closed='no'");
}

}
//  check if results were found 

if(mysqli_num_rows($usersReturnedQuery) == 0){
    echo "We cant find anyone with a " . $type . " like: " .$query;
} else {
    echo mysqli_num_rows($usersReturnedQuery) . " results found: <br><br>";
} 

echo "<p id='grey'>Try searching for:</p>";
echo "<a href='search.php?q=" . $query. "&type=name'>Names</a>,  <a href='search.php?q=" . $query ."&type=username'>Usernames</a><br><br><hr id='search_hr'>";
echo "<div class='main_container'>";

while($row = mysqli_fetch_array($usersReturnedQuery)){
    $user_obj = new User($con, $user['username']);

    $button = "";
    $mutual_friends = "";

    if($user['username'] != $row['username']){
        // generate button depending on friendship status
        if($user_obj->isFriend($row['username'])){
            $button = "<input type='submit' name='" . $row['username']. "' class='btn btn-danger' value='Remove Friend'>";
        } else if($user_obj->didReceiveRequest($row['username'])){
            $button = "<input type='submit' name='" . $row['username']. "' class='btn btn-warning' value='Respond to request'>";
             
        } else if($user_obj->didSendRequest($row['username'])){
            $button = "<input type='button' class='btn btn-light' value='Request Sent'>";
        } else {
            $button = "<input type='submit' name='" . $row['username']. "' class='btn btn-success' value='Add friend'>";
            
        }

        $mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";


        // button forms
        if(isset($_POST[$row['username']])){
            if($user_obj->isFriend($row['username'])){
                $user_obj->removeFriend($row['username']);
                header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

            } else if($user_obj->didReceiveRequest($row['username'])){
                header("Location: request.php");
            } else if($user_obj->didSendRequest($row['username'])){

            } else {
                $user_obj->sendRequest($row['username']);
                header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

            }
        }

    }

    echo "<div class='search_result'>
            <div class='searchPageFriendsButton'>
                <form action='' method='POST'>
                    " . $button . "
                    <br>
                </form>
            </div>

            <div class='result_profile_pic'>
              <a href='" . $row['username'] ."'><img src='" . $row['profile_pic'] ."' stlye='height: 100px;'></a>
            </div>
              <a href='" . $row['username'] ."'>" . $row['first_name']. " " . $row['last_name']. "
               <p id='grey'> ". $row['username']."</p>
              </a>
              <br>
              " . $mutual_friends . "<br>
         </div>
         <hr id='search_hr'>";



} // end of while loop
 
echo "</div>";


  }

?>

</div>