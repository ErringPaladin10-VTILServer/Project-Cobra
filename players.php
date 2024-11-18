<?php

require_once('connect.php');

$headers = getallheaders();

/*if (verifyRequest($con, getallheaders()) == true) {
  die("Valid");
} else {
  die("Invalid");
}*/

if (verifyRequest($con, $headers, $_SERVER) || isset($_GET['Yoink'])) {
  header('Content-type: application/json');
  if ($_SERVER['REQUEST_METHOD'] == "POST") { //POST
    $Params = json_decode(file_get_contents('php://input'), true);
    if (!isset($Params['Method'])) die(json_encode(array("status" => "Error", "data" => "Some dummy didn't specify Method")));
    switch($Params['Method']) {
      case 'update': {
        $check = $con->query("SELECT * FROM `players` WHERE `user_id`=" . safe($con, $Params['User-Id']));
        if (!isset($Params['Rank']))
          die(json_encode(array("status" => "Error", "data" => "Some Derp (Cole) didn't include a Rank variable")));
        if (!isset($Params['Prefix']) || strlen($Params['Prefix']) < 1)
          die(json_encode(array("status" => "Error", "data" => "Some Derp (Cole) didn't include a Prefix variable or Prefix isn't long enough.")));
        if (!isset($Params['ExtraData']) || strlen($Params['ExtraData']) < 2)
          die(json_encode(array("status" => "Error", "data" => 'Some Derp (Cole) didn\'t include an ExtraData variable or ExtraData isn\'t long enough (Shorter than "{}").')));
        if (mysqli_num_rows($check) == 0) {
          $sql = "INSERT INTO `players`(`user_id`, `rank`, `prefix`, `extra_data`) VALUES (" . safe($con, $Params['User-Id']) . ", " . safe($con, $Params['Rank']) . ", '" . safe($con, $Params['Prefix']) . "', '" . safe($con, $Params['ExtraData']) . "')";
        } else {
          if ($Params['Rank'] < mysqli_fetch_assoc($check)['rank'] && !isset($Params['Override'])) {
            $sql = "UPDATE `players` SET `prefix`='" . safe($con, $Params['Prefix']) . "', `extra_data`='" . safe($con, $Params['ExtraData']) . "' WHERE `user_id`=" . safe($con, $Params['User-Id']);
          } else {
            $sql = "UPDATE `players` SET `rank`=" . safe($con, $Params['Rank']) . ", `prefix`='" . safe($con, $Params['Prefix']) . "', `extra_data`='" . safe($con, $Params['ExtraData']) . "' WHERE `user_id`=" . safe($con, $Params['User-Id']);
            if ($Params['Rank'] < 0)
              $con->query("INSERT INTO `prior_bans`(`user_id`, `reason`, `banned_by`) VALUES (" . safe($con, $Params['User-Id']) . ", '" . safe($con, $Params['Reason']) . "', " . safe($con, $Params['Banned-By']) . ")");
          }
        }
        $res = $con->query($sql);
        if (!$res)
          die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
        die(json_encode(array("status" => "Success", "data" => "Updated user data")));
        break;
      }
    }
  } else { //GET
    $Params = $_GET;
    if (!isset($Params['Action'])) die(json_encode(array("status" => "Error", "data" => "Some dummy didn't specify Action")));
    switch($Params['Action']) {
      case 'getall': {
        $sql = "SELECT * FROM `players`";// WHERE `rank`<>'0'";
        $res = $con->query($sql);
        if (!$res)
          die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
        if (mysqli_num_rows($res) < 1)
          die(json_encode(array("status" => "Error", "data" => "No players??")));
        $data = array();
        while ($row = $res->fetch_assoc()) {
          if ($row['rank'] != 0)
            $data[$row['user_id']] = formatData($row);
        }
        die(json_encode(array("status" => "Success", "data" => $data)));
        break;
      }
      case 'get': {
        $sql = "SELECT * FROM `players` WHERE `user_id`=" . safe($con, $Params['User-Id']);
        $res = $con->query($sql);
        if (!$res)
          die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
        if (mysqli_num_rows($res) < 1)
          die(json_encode(array("status" => "Error", "data" => "No player found.")));
        $row = $res->fetch_assoc();
        $data = formatData($row);
        die(json_encode(array("status" => "Success", "data" => $data)));
        break;
      }
    }
  }
} else {
  die(require_once('index.php'));
}

?>