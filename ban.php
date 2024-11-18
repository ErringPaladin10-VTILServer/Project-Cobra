<?php

require('connect.php');

$headers = getallheaders();

if (verifyRequest($con, $headers, $_SERVER)) {
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Params = json_decode(file_get_contents('php://input'), true);
    
  } else {
    $Params = array();
    foreach ($_GET as $Key => $Value)
      $Params[$Key] = $Value;
    switch($Params['Action']) {
      
    }
  }
} else {
  die(require_once('index.php'));
}

?>