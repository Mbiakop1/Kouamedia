<?php
ob_start();
session_start();

$timezone = date_default_timezone_set("Africa/Douala");


$con = mysqli_connect("localhost", "root", "", "social"); // local db con


// $con = mysqli_connect("sql103.epizy.com", "epiz_29637416", "3ms5dmxjZTUoot", "epiz_29637416_social"); // online db con


if(mysqli_connect_errno()){
    echo "failed to connect: ". mysqli_connect_errno();
}

?>