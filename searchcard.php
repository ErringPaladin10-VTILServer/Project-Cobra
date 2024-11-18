<?php
$rname = getName($spcdata['user_id']);
$sdiscord_data = json_decode($spcdata['discord_data'], true);
$last10 = $con->query("SELECT * FROM `command_logs` WHERE `user_id`=" . $spcdata['user_id'] . " ORDER BY `tstamp` DESC LIMIT 10");

$displayrank = "Rank: " . $spcdata['rank'];
if ($pcdata['rank'] == 7) {
  $user_id = $spcdata['user_id'];
  $displayrank = "<div class=\"btn-group\">
    <button id=\"showRank\" type=\"button\" class=\"btn btn-secondary\" disabled>Rank: " . $spcdata['rank'] . "</button>
    <button type=\"button\" class=\"btn btn-secondary dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
      <span class=\"sr-only\">Toggle Dropdown</span>
    </button>
    <div class=\"dropdown-menu\">
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=-2', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        -2
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=-1', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        -1
      </button>
      <div class=\"dropdown-divider alert-danger\"></div>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=0', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        0
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=1', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        1
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=2', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        2
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=3', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        3
      </button>
      <div class=\"dropdown-divider alert-danger\"></div>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=4', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        4
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=5', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        5
      </button>
    </div>
  </div>";
} elseif ($pcdata['rank'] == 5) {
  $user_id = $spcdata['user_id'];
  $displayrank = "<div class=\"btn-group\">
    <button id=\"showRank\" type=\"button\" class=\"btn btn-secondary\" disabled>Rank: " . $spcdata['rank'] . "</button>
    <button type=\"button\" class=\"btn btn-secondary dropdown-toggle dropdown-toggle-split\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
      <span class=\"sr-only\">Toggle Dropdown</span>
    </button>
    <div class=\"dropdown-menu\">
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=-2', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        -2
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=-1', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        -1
      </button>
      <div class=\"dropdown-divider alert-danger\"></div>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=0', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        0
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=1', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        1
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=2', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        2
      </button>
      <button class=\"dropdown-item\" onclick=\"$.ajax({url:'ajax.php?Action=updateRank&User-Id=$user_id&newRank=3', success:function(res) {
        $('#showRank').html('Rank: ' + res);
      }});\">
        3
      </button>
    </div>
  </div>";
}
?>
<img src="https://www.roblox.com/headshot-thumbnail/image?userId=<?php echo $spcdata['user_id']; ?>&width=420&height=420&format=png" alt="<?php echo $rname; ?>'s profile picture" class="rounded-circle mx-auto d-block img-thumbnail" width="150px" height="150px">
<div class="card-body shadow">
  <h5 class="card-title"><?php echo $rname . " - " . $spcdata['user_id']; ?></h5>
  <p class="text-muted">Viewing <?php echo $rname; ?> as <?php echo "$username#$discriminator"; ?></p>
  <p class="card-text">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Project Cobra ID: <?php echo $spcdata['id']; ?></li>
      <li class="list-group-item">Alpha Tester: <?php echo ($spcdata['alpha_tester'] == 0 ? "No" : "Yes"); ?></li>
      <li class="list-group-item">Discord Verified: <?php echo ($spcdata['verified'] == 0 ? "No" : ($sdiscord_data['username'] == "" ? "Couldn't find Discord tag" : $sdiscord_data['username'] . "#" . $sdiscord_data['discriminator'])); ?></li>
      <li class="list-group-item">Joined: <?php echo date("m/d/Y", strtotime($spcdata['join_date'])); ?></li>
      <?php
      if ($pcdata['rank'] >= 4) {
        if (isset($spcdata)) {
          if (isset(json_decode($spcdata['extra_data'], true)['JoinMessage']))
            echo "<li class=\"list-group-item\">Join Message: " . json_decode($spcdata['extra_data'], true)['JoinMessage'] . "</li>";
          else
            echo "<li class=\"list-group-item\">Join Message: None</li>";
        }
      }
      ?>
      <li class="list-group-item"><?php echo $displayrank; ?></li>
    </ul>
  </p>
  <div class="btn-group">
    <a role="button" class="btn btn-outline-primary" target="_blank" href="https://www.roblox.com/users/<?php echo $spcdata['user_id']; ?>/profile">
      Profile
    </a>
    <?php
    if ($pcdata['rank'] >= 5) {
    echo "<button class=\"btn btn-outline-danger\" onclick=\"{var reason = prompt('Please enter a ban reason:'); $.ajax({url:'ajax.php?Action=ban&User-Id={$spcdata['user_id']}&Admin-Id={$pcdata['user_id']}&reason=' + reason});}\">
      Ban
    </button>";
    }
    ?>
    <a role="button" class="btn btn-outline-success" target="_blank" href="https://www.roblox.com/games/1679056195/Project-Cobra#!/store">Rank Store</a>
  </div>
</div>
</div><br /><div>
<table class="table table-sm">
  <thead>
    <tr>
      <th>Time</th>
      <th>Command</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    if (mysqli_num_rows($last10) > 0) {
      while ($row = mysqli_fetch_assoc($last10)) {
        echo "<tr><td>" . $row['tstamp'] . "</td><td>" . $row['command'] . " " . $row['args'] . "</td></tr>";
      }
    } else {
      echo "<tr><td>No Commands Found!</td></tr>";
    }
    
    ?>
  </tbody>
</table>
