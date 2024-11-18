<?php

//251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F

function verifyRequest($con, $Headers, $SERVER) {
  if (isset($Headers) && isset($Headers['Key']) && $Headers['Key'] == "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F") {
    $ip = $SERVER['REMOTE_ADDR'];
    $ua = $Headers['User-Agent'];
    $con->query("INSERT INTO `skid_tracker`(`ip`, `user_agent`) VALUES ('$ip', '$ua')");
  }
  if (!(isset($Headers['Key'])) || !(isset($Headers['Roblox-Id'])) || ($Headers['User-Agent'] != "RoPlay/0.0.1"
                                                                       && $Headers['User-Agent'] != "Roblox/Linux"
                                                                       && $Headers['User-Agent'] != "RobloxStudio/WinInet"
                                                                       && $Headers['User-Agent'] != "RobloxGameCloud/1.0 (+http://www.roblox.com)")
                                                                       && $Headers['Key'] != "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F") {
    return false;
  }
  $res = $con->query("SELECT COUNT(*) AS `Count` FROM `place_settings` WHERE `place_id`=" . $Headers['Roblox-Id']);//$PlaceId);
  if ($Headers['Key'] == "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F" && $Headers['Roblox-Id'] == 0) {
    return true;
  }
//  if ($Headers['Key'] == "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F")
//  echo $Headers['Key'] . " - " . $Headers['User-Agent'] . " - " . $Headers['Roblox-Id'];
  return $Headers['Key'] == "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F" && $res->fetch_assoc()['Count'] > 0;
}

function placeAllowed($con, $Headers, $SERVER) {
  if ($SERVER['REQUEST_METHOD'] == "GET") return true;
  if (!(isset($Headers['Roblox-Id'])) || ($Headers['User-Agent'] != "RoPlay/0.0.1"
                                          && $Headers['User-Agent'] != "Roblox/Linux"
                                          && $Headers['User-Agent'] != "RobloxStudio/WinInet"
                                          && $Headers['User-Agent'] != "RobloxGameCloud/1.0 (+http://www.roblox.com)")
                                          && $Headers['Key'] != "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F") {
    return false;
  }
  if ($Headers['Roblox-Id'] == 0) {
    return false;
  }
  $res = $con->query("SELECT COUNT(*) AS `Count` FROM `place_settings` WHERE `place_id`=" . $Headers['Roblox-Id']);
  switch($res->fetch_assoc()['Count']) {
    case 0:
      return false;
      break;
    default:
      $res2 = $con->query("UPDATE `place_settings` SET `loads`=`loads`+1 WHERE `place_id`=" . $Headers['Roblox-Id']);
      return true;
      break;
  }
}

function verifyAPIKey($con, $Headers, $Params) {
  if (!(isset($Headers['Roblox-Id'])) || ($Headers['User-Agent'] != "RoPlay/0.0.1"
                                          && $Headers['User-Agent'] != "Roblox/Linux"
                                          && $Headers['User-Agent'] != "RobloxStudio/WinInet"
                                          && $Headers['User-Agent'] != "RobloxGameCloud/1.0 (+http://www.roblox.com)")
                                          && $Headers['Key'] != "251EF652F40000006F28E568400000003CC43AB322000000000000005FE3119F") {
    return false;
  }
  if ($Headers['Roblox-Id'] == 0) {
    return true;
  }
  $res = mysqli_query($con, "SELECT * FROM `api_keys` WHERE `api_key`='" . $Params['API-Key'] . "'");
  switch(mysqli_num_rows($res)) {
    case 0:
      return false;
      break;
    default:
      return true;
      break;
  }
}

function voidStaff($uid) {
  foreach (json_decode(file_get_contents("https://api.roblox.com/users/{$uid}/groups"), true) as $guild) {
    foreach ($guild as $k => $v) {
      if ($k == "Id" && $v == 3256759)
        return $guild['Rank'];
    }
  }
  return 0;
}

function getName($uid) {
  $data = json_decode(file_get_contents("https://api.roblox.com/users/$uid"), true);
  if (isset($data))
    if (isset($data['Username']))
      if ($data['Username'])
        return $data['Username'];
  return "Name not found";
}

function getId($name) {
  $data = json_decode(file_get_contents("https://api.roblox.com/users/get-by-username?username=$name"), true);
  if (isset($data))
    if (isset($data['Id']))
      if ($data['Id'])
        return $data['Id'];
  return "Id not found";
}

function getUser($token) {
  $link = "https://discordapp.com/api/users/@me";
  $ch = curl_init($link);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
  return json_decode(curl_exec($ch), true);
}

function getRobloxId($con, $discord_id) {
  return $con->query("SELECT `user_id` FROM `players` WHERE `discord_id`='$discord_id'")->fetch_assoc()['user_id'];
}

function getProductInfo($product_id, $type = 0) {
  $link;
  switch ($type) {
    case 2:
      $link = "game-pass-product-info?gamePassId";
      break;
    default:
      $link = "productinfo?assetId";
      break;
  }
  return json_decode(file_get_contents("https://api.roblox.com/marketplace/$link=$product_id"), true); //https://api.roblox.com/marketplace/game-pass-product-info?gamePassId=
}

function generateGUID($wrap = false) {
  $format = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx';
  $format = preg_replace_callback("/[xy]/", function($matches) {
    foreach ($matches as $match) {
      $r = (rand() * 16 | 0);
      return dechex($match == 'x' ? $r : ($r && 0x3 || 0x8));
    }
  }, $format);

  if ($wrap)
    return '{' . $format . '}';
  else
    return $format;
};

function safe($con, $Param) {
  if (isset($Param))
    return mysqli_real_escape_string($con, $Param);
  return null;
}

function formatData($row) {
  if (isset($row))
    return array(
      "id" => $row['id'],
      "Rank" => (int) $row['rank'],
      "Discord" => $row['discord_id'],
      "Verified" => $row['verified'],
      "Prefix" => $row['prefix'],
      "Alpha" => $row['alpha_tester'],
      "ExtraData" => $row['extra_data'],
      "GamepassOverride" => $row['override_gamepass']
    );
  else
    return array();
}

function postToDiscord($message, $webhook='595341727934447623/R6eFK962CZJsYeA18dzdTe9J1HD3ZgyB8rDDyB5faNcUWqWd9xDb4yNbD8hthD3xW21o') {
  
  $webhookurl = "https://discordapp.com/api/webhooks/$webhook";
  
  $json_data = array ('content'=>"$message");
  $make_json = json_encode($json_data);
  
  $ch = curl_init( $webhookurl );
  curl_setopt( $ch, CURLOPT_POST, 1);
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $make_json);
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt( $ch, CURLOPT_HEADER, 0);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
  
  return curl_exec( $ch );
}

?>