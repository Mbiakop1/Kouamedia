<?php
include("header.php");
$message_obj = new Message($con, $userLoggedIn);


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

if(isset($_POST['post_message'])){
    if(isset($_POST['message_body'])){
        $body = mysqli_real_escape_string($con, $_POST["message_body"]);
        $date = date("Y-m-d H:i:s");
        $message_obj->sendMessage($username, $body, $date);
        
    }
    $link = "#myTab #contact-tab";
    echo "<script>
             $(function(){
                $('" . $link ."').tab('show');
             });
    </script>";
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

    <?php
      
      if($userLoggedIn != $username){
          echo '<div class="profile_info_bottom">';
          echo $logged_in_user_obj->getMutualFriends($username) . "  Mutual Friends";
          echo '</div>'; 
      }
    
    ?>
</div>




<div class="profile_main_column column">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Newsfeed</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                role="tab" aria-controls="contact" aria-selected="false">Messages</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div role="tabpanel" class="tab-pane active" id="newsfeed_div">
                <div class="posts_area"></div>

                <img id="loading" width="60px" src="./Assets/images/icons/loading.gif" alt="Loading...">
            </div>
        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div role="tabpanel" class="tab-pane " id="messages_div">
                <?php

                    echo "<h4> You and <a href='" .$username ."'>" . $profile_user_obj->getFirstAndLastName() . "</a></h4><hr><br>"; 

                    echo "<div class='loaded_messages' id='scroll_messages'>";
                    echo $message_obj->getMessages($username);
                    echo "</div>";
            ?>

                <div class="message_post">
                    <form action="" method="POST">
                        <textarea name='message_body' id='message_textarea'
                            placeholder='Write your message ...'></textarea>
                        <input type='submit' name='post_message' class='info' id='message_submit' value='Send'>
                    </form>
                </div>


                <script>
                var div = document.getElementById("scroll_messages");
                div.scrollTop = div.scrollHeight;
                </script>
            </div>
        </div>
    </div>





    <!-- 
    <ul class="nav nav-tabs" id="profile" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#newsfeed_div" aria-controls="newsfeed_div" role="tab"
                data-toggle="tab">Newsfeed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" aria-controls="about_div" role="tab" data-toggle="tab"
                href="#about_div">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-current="page" aria-controls="messages_div" role="tab" data-toggle="tab"
                href="#messages_div">Messages</a>
        </li>
    </ul>

    <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="newsfeed_div">
            <div class="posts_area"></div>

            <img id="loading" width="60px" src="./Assets/images/icons/loading.gif" alt="Loading...">
        </div>


        <div role="tabpanel" class="tab-pane " id="about_div">

        </div>

        <div role="tabpanel" class="tab-pane " id="messages_div">
            <?php

            $message_obj = new Message($con, $userLoggedIn);
                    echo "<h4> You and <a href='" .$username ."'>" . $profile_user_obj->getFirstAndLastName() . "</a></h4><hr><br>"; 

                    echo "<div class='loaded_messages' id='scroll_messages'>";
                    echo $message_obj->getMessages($username);
                    echo "</div>";
            ?>

            <div class="message_post">
                <form action="" method="POST">
                    <textarea name='message_body' id='message_textarea'
                        placeholder='Write your message ...'></textarea>";
                    <input type='submit' name='post_message' class='info' id='message_submit' value='Send'>";
                </form>
            </div>


            <script>
            var div = document.getElementById("scroll_messages");
            div.scrollTop = div.scrollHeight;
            </script>
        </div>
    </div> -->



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


<script>
var userLoggedIn = '<?php echo $userLoggedIn?>';

var profileUsername = "<?php  echo $username;?>";

$(document).ready(function() {
    $('#loading').show();

    // Original ajax request for loading first posts

    $.ajax({
        url: "./includes/handlers/ajax_load_profile_post.php",
        type: "POST",
        data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
        cache: false,

        success: function(data) {
            $('#loading').hide();
            $('.posts_area').html(data);
        }
    });

    $(window).scroll(function() {
        var height = $('.posts_area').height(); // div containig post 
        var scroll_top = $(this).scrollTop();
        var page = $('.posts_area').find('.nextPage').val();
        var noMorePosts = $('.posts_area').find('.noMorePosts').val();


        if ((document.body.scrollHeight == window.pageYOffset + window.innerHeight) &&
            noMorePosts == 'false') {
            $('#loading').show();


            var ajaxReq = $.ajax({
                url: "./includes/handlers/ajax_load_profile_post.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" +
                    profileUsername,
                cache: false,

                success: function(response) {
                    $('.posts_area').find('.nextPage').remove(); // remove current .nextpage
                    $('.posts_area').find('.noMorePosts').remove();


                    $('#loading').hide();
                    $('.posts_area').append(response);
                }
            });


        } //end if

        return false;

    }); // end $(document).ready(function())

})
</script>

<!----- closing tag for wrapper div in the header--------->
</div>
</body>

</html>