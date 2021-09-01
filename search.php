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
    $usersReturnedQuery = mysqli_query($con, "SELECT * FROM users WHERE (username LIKE '$query%' OR username LIKE '%$query') AND user_closed='no' limit 8 ");

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
 



  }

?>

</div>