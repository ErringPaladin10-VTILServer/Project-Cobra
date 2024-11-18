<?php
    if (isset($_GET['userid'])) {
        $userid = $_GET['userid'];
        echo $userid;

        $data = file_get_contents("https://friends.roblox.com/v1/users/$userid", true); // This causes a warning
        // @file_get_contents("https://friends.roblox.com/v1/users/$userid", true); works though but returns nothing
        echo $data;
    } else {
        // User id not found in url
    }
?>