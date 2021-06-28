<?php
include("header.php");


if(isset($_GET['profile_username'])){

    $username = $_GET['profile_username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);

    $num_friends= (substr_count($user_array['friend_array'], ",")) - 1;
}


if(isset($_POST['remove_friend'])){
    $user = new User($con, $userLoggedIn);
    $user->removeFriend($username);
}


if(isset($_POST['add_friend'])){
    $user = new User($con, $userLoggedIn);
    $user->sendRequest($username);
}

if(isset($_POST['respond_request'])){
    header("Location: requests.php");
}

?>
<style>
.wrapper {
    margin-left: 0px;
    padding-left: 0px;
}
</style>


<div class="profile_left">

    <img src="<?php echo $user_array['profile_pic'];?>" alt="profile_pic">

    <div class="profile_info">
        <p> <?php echo "Posts: " . $user_array['num_posts'];?></p>
        <p> <?php echo "Likes: " . $user_array['num_likes'];?></p>
        <p> <?php echo "Friends: " . $num_friends;?></p>
    </div>

    <form action="<?php echo $username;?>" method="POST">

        <?php
         $profile_user_obj = new User($con, $username);
         if($profile_user_obj->isClosed()){
             header("Location: user_closed.php");
         }

         $logged_in_user_obj = new User($con, $userLoggedIn);
         if($userLoggedIn != $username){
             if($logged_in_user_obj->isFriend($username)){
                 echo '<input type="submit" name="remove_friend" class="danger remove_friend" value="Remove Friend"><br>';
             }
             else if($logged_in_user_obj->didReceiveRequest($username)){
                 echo '<input type="submit" name="respond_request" class="warning respond_request" value="Respond to request"><br>';
                 
             }
             else if($logged_in_user_obj->didSendRequest($username)){
                 echo '<input type="submit" name="" class="default request_sent" value="Request sent"><br>';
                 
             } 
             else {
                 echo '<input type="submit" name="add friend" class="success add_friend" value="Add friend"><br>';
                 
             }
         }
        
        
        ?>

    </form>

    <input type="submit" class="deep_blue" data-bs-toggle="modal" data-bs-target="#post_form" value="Post Something">
</div>




<div class="main_column column">
    <?php echo $username; ?>
</div>


<!-- Modal -->
<div class="modal fade" id="post_form" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Something</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>This will appear on the user's profile and also their newsfeed for your friends to see</p>
                <form class="profile_post" action="" method="POST">
                    <div class="form-group">
                        <textarea class="form-control" name="post_body"></textarea>
                        <input type="hidden" name="user_from" value="<?php echo $userLoggedIn;?>">
                        <input type="hidden" name="user_to" value="<?php echo $username;?>">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="submit_profile_post" name="post_button" type="button" class="btn btn-primary">Post</button>
            </div>
        </div>
    </div>
</div>



<!----- closing tag for wrapper div in the header--------->
</div>
</body>

</html>