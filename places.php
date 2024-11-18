<?php

require_once('connect.php');
require_once('header.php');

$places = $con->query("SELECT * FROM `place_settings` ORDER BY `loads` DESC");

?>

<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-lg-8">
		<br />
		<h3>Allowed Places</h3>
		<br />
	</div>
	<div class="col-sm-2"></div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-lg-8">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Place</th>
					<th scope="col">Owner</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				if (mysqli_num_rows($places) > 0) {
					while ($row = mysqli_fetch_assoc($places)) {
						if ($row['owner_type'] == '1') $link = "https://www.roblox.com/Groups/Group.aspx?gid=" . $row['owner_id'];
						else $link = "https://www.roblox.com/" . $row['owner_id'] . "/profile";
						echo "<tr><td><a href=\"https://www.roblox.com/games/" . $row['place_id'] . "/Place\" target=\"_blank\">" . $row['game_title'] . "</a></td><td><a href=\"" . $link . "\" target=\"_blank\">Creator's Page</a></td></tr>";
					}
				} else {
					echo "<tr><td>No places found!??</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="col-sm-2"></div>
</div>

<?php

require_once('footer.php');

?>
