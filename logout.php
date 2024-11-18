<?php

require('connect.php');
if (isset($_COOKIE['RoPlaySecurity'])) {
  setcookie("RoPlaySecurity", "", time() - 3600);
}
header("Location: index.php");

?>