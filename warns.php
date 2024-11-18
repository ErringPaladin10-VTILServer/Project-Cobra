<?php

require('connect.php');

$headers = getallheaders();

if (verifyRequest($con, $headers, $_SERVER)) {
  if ($_SERVER['REQUEST_METHOD'] == "POST") { //POST
    $Params = json_decode(file_get_contents('php://input'), true);
    switch($Params['Method']) {
      case 'update': {
        $check = mysqli_query($con, "SELECT * FROM `warns` WHERE `user_id`=" . safe($con, $Params['User-Id']) . " AND `id`=" . safe($con, $Params['Warn-Id']));
        if (mysqli_num_rows($check) == 0) {
          $sql = "INSERT INTO `warns`(`user_id`, `staff_id`, `message`) VALUES (" . safe($con, $Params['User-Id']) . ", " . safe($con, $Params['Staff-Id']) . ", '" . safe($con, $Params['Message']) . "')";
        } else {
          $sql = "UPDATE `warns` SET `accepted`='" . safe($con, $Params['Accepted']) . "' WHERE `user_id`=" . safe($con, $Params['User-Id']) . " AND `id`=" . safe($con, $Params['Warn-Id']);
        }
        $res = mysqli_query($con, $sql);
        if (!$res)
          die(json_encode(array("status" => "Internal error: " . mysqli_error($con))));
        die(json_encode(array("status" => "Success")));
        break;
      }
    }
  } else { //GET
    $Params = $_GET;
    switch($Params['Action']) {
      case 'getall': {
        $sql = "SELECT * FROM `warns` WHERE `user_id`=" . safe($con, $Params['User-Id']);
        $res = mysqli_query($con, $sql);
        if (!$res)
          die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
        if (mysqli_num_rows($res) < 1)
          die(json_encode(array("status" => "Error", "data" => "No warnings.")));
        $data = array();
        while ($row = mysqli_fetch_assoc($res)) {
          $data[$row['id']] = array(
              "StaffId" => (int) $row['staff_id'],
              "Message" => $row['message'],
              "Accepted" => (int) $row['accepted']
              );
        }
        die(json_encode(array("status" => "Success", "data" => $data)));
        break;
      }
    }
  }
} else {
  die(require_once('index.php'));
}

?>