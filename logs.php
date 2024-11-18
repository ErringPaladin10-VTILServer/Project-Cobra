<?php

require_once('connect.php');

$headers = getallheaders();

if (verifyRequest($con, $headers, $_SERVER)) {
  if ($_SERVER['REQUEST_METHOD'] == "POST") { //POST
    $Params = json_decode(file_get_contents('php://input'), true);
    switch($Params['Method']) {
      case 'log': {
        $Commands = $Params['Commands'];
        foreach ($Commands as $key => $logData) {
          $res = $con->query("INSERT INTO `command_logs`(`user_id`, `command`, `args`) VALUES (" . $logData['UserId'] . ", '" . $logData['Command'] . "', '" . $logData['Args'] . "')");
          if (!$res)
            die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
        }
        die(json_encode(array("status" => "Success", "data" => "Logged")));
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