<?php

require('connect.php');

$headers = getallheaders();

die(json_encode(mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `info`"))));

?>