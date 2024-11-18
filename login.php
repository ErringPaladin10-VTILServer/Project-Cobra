<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require('connect.php');
	
	$client_id = "DISCORD BOT.CLIENT ID HERE"; // the application id
	$client_secret = "DISCORD BOT.CLIENT SECRET HERE"; // you really want to keep this a secret. don't share it!
	$redirect = "https://projectcobra.example.com/login.php";
	$main_page = "https://projectcobra.example.com/";
	$redirect_e = urlencode($redirect);
		
	function exchangeCode($code) {
		global $client_id, $client_secret, $redirect;
		$data = array(
			"client_id" => $client_id,
			"client_secret" => $client_secret,
			"grant_type" => "authorization_code",
			"code" => $code,
			"redirect_uri" => $redirect
		);
		$link = "https://discordapp.com/api/oauth2/token";
		$ch = curl_init($link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		return json_decode(curl_exec($ch), true);
	}
	
	if (isset($_GET["error"])) {
		echo json_encode(array("message" => "Authorization Error"));
		// an error occured. that's not good.

	} elseif (isset($_GET["code"])) {
		$code = $_GET["code"];
		$codearr = exchangeCode($code);
		$access_token = $codearr['access_token'];
		$data = getUser($access_token);
		$roblox = getRobloxId($con, $data['id']);
		$oauth = json_encode($codearr);
		if (!isset($_COOKIE['RoPlaySecurity'])) {
			$token = generateGUID(false);
			setcookie("RoPlaySecurity", $token, strtotime("1 January 2050"), "/");
      if (mysqli_num_rows($con->query("SELECT * FROM `users` WHERE `user_roblox_uid`=$roblox")) > 0) {
        $con->query("UPDATE `users` SET `token`='$token', `access_token`='$access_token', `oauth`='$oauth' WHERE `user_roblox_uid`=$roblox");
      } else {
  			$con->query("INSERT INTO `users`(`token`, `user_roblox_uid`, `access_token`, `oauth`) VALUES ('$token', $roblox, '$access_token', '$oauth')");
      }
		}
		header("Location: $main_page");

	} else {
		// send person to authorize
		$place = "https://discordapp.com/api/oauth2/authorize?client_id=$client_id&redirect_uri=$redirect_e&response_type=code&scope=identify%20email";
		header("Location: $place");
	}
?>