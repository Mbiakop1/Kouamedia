<?php

include("header.php");





if(isset($_POST['post'])){
   $upLoadOk = 1;

   $imageName = $_FILES['fileToUpload']['name'];
   $errorMessage = "";

   if($imageName != ""){
       $targetDir = "Assets/images/posts";
       $imageName = $targetDir . uniqid() . basename($imageName);
       $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

       if($_FILES['fileToUpload']['size'] > 10000000){
          $errorMessage = "Sorry your file is too large";
          $upLoadOk = 0;
       }

       if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png"){
            $errorMessage = "Sorry only jpeg, jpg and png files are allowed";
          $upLoadOk = 0;
       }

       if($upLoadOk){
           if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)){
            //    image uploaded
           } else {
            //    image did not upload
            $upLoadOk = 0;
           }
       }
   }


 if($upLoadOk){
   
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none', $imageName);
 } else {
     echo "<div style='text-align:center;' class='alert alert-danger'>
               $errorMessage
          </div>";
 }


    // header("Location: index.php");
}
   
?>


<div class="user_details column">
    <a href="<?php echo $userLoggedIn;?>"> <img src="<?php echo $user['profile_pic']?>" alt="Profile picture"> </a>
    <div class="user_details_left_right">
        <a href="<?php echo $userLoggedIn;?>">
            <?php
              echo $user['first_name'] . " " . $user['last_name'];
            ?>
        </a><br>

        <?php 
            echo "Posts: " . $user['num_posts'] . "<br>";
            echo "Likes: " . $user['num_likes'];
        ?>
    </div>

</div>

<div class="main_column column">

    <form action="index.php" method="POST" class="post_form" enctype="multipart/form-data">
        <button id="select_image" class="btn btn-primary" type="button"
            onclick="document.getElementById('fileToUpload').click()">Add
            Image</button>
        <input onchange="myFunction(event)" type="file" name="fileToUpload" id="fileToUpload"
            style="visibility:hidden;">
        <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" id="post_button" value="Post">
        <hr>
    </form>

    <div class="posts_area">

    </div>
    <img id="loading" width="60px" src="./Assets/images/icons/loading.gif" alt="Loading...">




</div>

<div class="user_details column">
    <h4>Popular</h4>
    <div class="trends">
        <?php
            $query = mysqli_query($con, "SELECT * FROM trends ORDER BY hits DESC LIMIT 9");

            foreach($query as $row){
                $word  = $row['title'];
                $word_dot = strlen($word) >= 14 ? "..." : "";

                $trimmed_word = str_split($word, 14);
                $trimmed_word = $trimmed_word[0];

                echo "<div style='padding: 5px'>";
                echo  $trimmed_word . $word_dot;
                echo "<br></div>";
            }
         ?>
    </div>
</div>

<script>
var userLoggedIn = '<?php echo $userLoggedIn?>';

$(document).ready(function() {
    $('#loading').show();
    // Original ajax request for loading first posts
    $.ajax({
        url: "./includes/handlers/ajax_load_posts.php",
        type: "POST",
        data: "page=1&userLoggedIn=" + userLoggedIn,
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
                url: "./includes/handlers/ajax_load_posts.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
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


<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
</body>

</html>