<?php

require('connect.php');

$headers = getallheaders();

if (verifyRequest($con, $headers, $_SERVER)) {
  if ($_SERVER['REQUEST_METHOD'] == "POST") { //POST
    $Params = json_decode(file_get_contents('php://input'), true);
    switch($Params['Method']) {
      case 'update': {
        $check = mysqli_query($con, "SELECT * FROM `players` WHERE `user_id`=" . safe($con, $Params['User-Id']));
        $check2 = mysqli_query($con, "SELECT * FROM `tokens` WHERE `token`='" . safe($con, $Params['Token']) . "'");
        if (mysqli_num_rows($check) == 0) {
          $sql = "INSERT INTO `players`(`user_id`, `discord_id`, `verified`) VALUES (" . safe($con, $Params['User-Id']) . ", '" . mysqli_fetch_assoc($check2)['discord_id'] . "', '1')";
        } else {
          if (mysqli_num_rows($check2) == 1) {
            $sql = "UPDATE `players` SET `discord_id`='" . mysqli_fetch_assoc($check2)['discord_id'] . "', `verified`='1' WHERE `user_id`=" . safe($con, $Params['User-Id']);
          } else {
            die(json_encode(array("status" => "Error", "data" => "You stoopid")));
          }
        }
        $res = mysqli_query($con, $sql);
        if (!$res)
          die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
        die(json_encode(array("status" => "Success", "data" => "Verified")));
        break;
      }
    }
  } else { //GET
    $Params = $_GET;
    switch($Params['Action']) {
      default: {
        die(json_encode(array("status" => "Error", "data" => "No cases for get yet.")));
        break;
      }
    }
  }
} else {
  die(require_once('index.php'));
}

?>