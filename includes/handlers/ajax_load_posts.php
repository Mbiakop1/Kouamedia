<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post.php");


$limit = 10; // number of pot to be loaded


$post = new Post($con, $_REQUEST['userLoggedIn']);
$post->loadPostsFriends($_REQUEST, $limit);
?>