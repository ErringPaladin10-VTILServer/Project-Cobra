<?php

require_once('connect.php');

if (isset($_GET['Action'])) {
	switch ($_GET['Action']) {
		case 'updateRank': {
			$rname = getName($_GET['User-Id']);
			$curr = $con->query("SELECT * FROM `players` WHERE `user_id`=" . $_GET['User-Id'])->fetch_assoc();
			$newRank = $_GET['newRank'];
			if ($curr['rank'] != $newRank) {
				$con->query("UPDATE `players` SET `rank`=$newRank, `override_gamepass`='1' WHERE `user_id`={$_GET['User-Id']}");
				//echo "Changed {$rname}'s rank to: $newRank.";
				echo $newRank;
			}
			
			break;
		}
		case 'staffApp': {
			if ($_GET['Status'] == '1') {
				$curr = $con->query("SELECT * FROM `players` WHERE `id`=" . $_GET['CobraId'])->fetch_assoc();
				$newRank = 3 + $_GET['Position'];
				if ($curr['rank'] != $newRank) {
					$con->query("UPDATE `players` SET `rank`=$newRank, `override_gamepass`='1' WHERE `id`={$_GET['CobraId']}");
					echo $newRank;
				}
				$con->query("UPDATE `staff_applications` SET `accepted`='1' WHERE `discord_id`={$curr['discord_id']}");
			} else {
				$curr = $con->query("SELECT * FROM `players` WHERE `id`=" . $_GET['CobraId'])->fetch_assoc();
				$con->query("UPDATE `staff_applications` SET `accepted`='-1' WHERE `discord_id`={$curr['discord_id']}");
				
			}
			break;
		}
		case 'ban': {
			$curr = $con->query("SELECT * FROM `players` WHERE `user_id`=" . $_GET['User-Id'])->fetch_assoc();
			$newRank = -2;
			if ($curr['rank'] != $newRank) {
				$con->query("UPDATE `players` SET `rank`=$newRank, `override_gamepass`='1' WHERE `user_id`={$_GET['User-Id']}");
			}
			break;
		}
	}
  exit();
}

?>