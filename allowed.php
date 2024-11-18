<?php

require('connect.php');

$headers = getallheaders();

//echo placeAllowed($con, $headers);
if (placeAllowed($con, $headers, $_SERVER)) {
  die("1");
} else {
  die("0");
}
?>