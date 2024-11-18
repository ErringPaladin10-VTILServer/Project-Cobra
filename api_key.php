<?php

require('connect.php');

$headers = getallheaders();

if (verifyAPIKey($con, $headers, $_GET)) {
  die(json_encode(array("status" => "Success", "data" => 1)));
} else {
  die(json_encode(array("status" => "Success", "data" => 0)));
}
die(json_encode(array("status" => "Error", "data" => "What??")));

?>