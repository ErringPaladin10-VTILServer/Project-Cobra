<?php

require('connect.php');

$headers = getallheaders();

if (verifyRequest($con, $headers, $_SERVER)) {
  header('Content-type: application/json');
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Params = json_decode(file_get_contents('php://input'), true);
    switch($Params['Method']) {
      case 'Add':
        $command = "INSERT INTO `servers` (`place_id`, `job_id`, `player_count`, `max_players`, `shutdown_msg`) VALUES (" . $headers['Roblox-Id'] . ",'" . $headers['Job-Id'] . "'," . safe($con, $Params['Player-Count']) . "," . safe($con, $Params['Max-Players']) . ", 'This server has been shutdown! Sorry about that. Derp.')";
        $query = mysqli_query($con, $command);
        if ($query)
          echo json_encode(array("Status" => "Success"));
        else
          echo json_encode(array("Status" => "Error", "Error" => mysqli_error($con)));
        break;
      case 'UpdatePlayerCount':
        $command = "UPDATE `servers` SET `player_count`=" . safe($con, $Params['Player-Count']) . " WHERE `job_id`='" . $headers['Job-Id'] . "'";
        $query = mysqli_query($con, $command);
        if ($query)
          echo json_encode(array("Status" => "Success"));
        else
          die(json_encode(array("Error" => mysqli_error($con))));
        break;
      case 'AddPlayer':
        $command = "INSERT INTO `players`(`user_id`, `user_name`, `server`) VALUES (" . safe($con, $Params['User-Id']) . ", '" . safe($con, $Params['Name']) . "', '" . $headers['Job-Id'] . "')";
        $query = mysqli_query($con, $command);
        mysqli_query($con, "UPDATE `servers` SET `player_count`=" . safe($con, $Params['Player-Count']) . " WHERE `job_id`='" . $headers['Job-Id'] . "'");
        if ($query)
          echo json_encode(array("Status" => "Success"));
        else
          echo json_encode(array("Status" => "Error", "Error" => mysqli_error($con)));
        break;
      case 'RemPlayer':
        $command = "DELETE FROM `players` WHERE `user_id`=" . safe($con, $Params['User-Id']) . " AND `server`='" . $headers['Job-Id'] . "'";
        $query = mysqli_query($con, $command);
        mysqli_query($con, "UPDATE `servers` SET `player_count`=" . safe($con, $Params['Player-Count']) . " WHERE `job_id`='" . $headers['Job-Id'] . "'");
        if ($query)
          echo json_encode(array("Status" => "Success"));
        else
          echo json_encode(array("Status" => "Error", "Error" => mysqli_error($con)));
        break;
      case 'Remove':
        $command = "DELETE FROM `servers` WHERE `job_id`='" . $headers['Job-Id'] . "'";
        $query = mysqli_query($con, $command);
        if ($query)
          echo json_encode(array("Status" => "Success"));
        else
          echo json_encode(array("Status" => "Error", "Error" => mysqli_error($con)));
        break;
      case 'SetMsgs':
        if (isset($Params['ShutdownMessage'])) {
          if (!$Params['ShutdownMessage'] == "") {
            mysqli_query($con, "UPDATE `servers` SET `shutdown_msg`='" . safe($con, $Params['ShutdownMessage']) . "' WHERE `job_id`='" . safe($con, $Params['JobId']) . "'");
          }
        }
        if (isset($Params['SystemMessage'])) {
          if (!$Params['SystemMessage'] == "") {
            mysqli_query($con, "UPDATE `servers` SET `send_msg`='" . safe($con, $Params['SystemMessage']) . "' WHERE `job_id`='" . safe($con, $Params['JobId']) . "'");
          }
        }
        break;
    }
  } else {
    $Params = array();
    foreach ($_GET as $Key => $Value)
      $Params[$Key] = $Value;
    switch($Params['Action']) {
      case 'ShutdownCheck': {
        $Data = mysqli_query($con, "SELECT * FROM `servers` WHERE `job_id`='" . $headers['Job-Id'] . "'");
        if(mysqli_num_rows($Data) > 0){
          $Data = mysqli_fetch_assoc($Data);
          mysqli_query($con, "UPDATE `servers` SET `send_msg`='' WHERE `job_id`='" . $headers['Job-Id'] . "'");
          die(json_encode(array(
            "System" => array(
              "Message" => $Data['send_msg']
            ),
            "Shutdown" => array(
              "Status" => $Data['shutting_down'],
              "Message" => $Data['shutdown_msg']
            )
          )));
        }
        die(json_encode(array("Status" => "Error: no data")));
        break;
      }
    }
  }
} else {
  header("Location: /index.php");
}
?>