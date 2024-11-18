<?php

  $username = 'USERNAME HERE';
  $password = 'PASSWORD HERE';
  $database = 'project_cobra';
  $con = mysqli_connect("127.0.0.1", $username, $password, $database, 3306);
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  require('funcs.php');
?>
