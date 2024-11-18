<img src="https://www.roblox.com/headshot-thumbnail/image?userId=<?php echo $pcdata['user_id']; ?>&width=420&height=420&format=png" alt="Your profile picture" class="rounded-circle mx-auto d-block img-thumbnail" width="150px" height="150px">
<div class="card-body shadow">
  <h5 class="card-title"><?php echo getName($pcdata['user_id']) . " - " . $pcdata['user_id']; ?></h5>
  <p class="text-muted">Logged in as <?php echo "$username#$discriminator"; ?></p>
  <p class="card-text">
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Project Cobra ID: <?php echo $pcdata['id']; ?></li>
      <li class="list-group-item">Alpha Tester: <?php echo ($pcdata['alpha_tester'] == 0 ? "No" : "Yes"); ?></li>
      <li class="list-group-item">Joined: <?php echo date("m/d/Y", strtotime($pcdata['join_date'])); ?></li>
      <?php
      if (isset($spcdata)) {
        if (isset(json_decode($spcdata['extra_data'], true)['JoinMessage']))
          echo "<li class=\"list-group-item\">Join Message: " . json_decode($spcdata['extra_data'], true)['JoinMessage'] . "</li>";
        else
          echo "<li class=\"list-group-item\">Join Message: None</li>";
      }
      ?>
      <li class="list-group-item">Rank: <?php echo $pcdata['rank']; ?></li>
      <li class="list-group-item">Prefix: <?php echo $pcdata['prefix']; ?></li>
    </ul>
  </p>
  <div class="btn-group">
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#APIKeys">
      API Keys
    </button>
    <a role="button" class="btn btn-outline-success" target="_blank" href="https://www.roblox.com/games/1679056195/Project-Cobra#!/store">Rank Store</a>
  </div>
</div>
