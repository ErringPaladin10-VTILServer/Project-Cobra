<?php

function search($userId){
    echo file_get_contents("https://www.roblox.com/users/" . $userId . "/profile");
}

if (isset($_GET['userId'])) {
    search($_GET['userId']);
}

?>