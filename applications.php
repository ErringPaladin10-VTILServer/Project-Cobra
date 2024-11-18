<?php
require('connect.php');
$staff = true;
require('header.php');

if (isset($_GET["page"]))
  $page = $_GET["page"];
else
  $page = 1;
  
$results_per_page = 5;
$start_from = ($page - 1) * $results_per_page;
$cmds = $con->query("SELECT * FROM `staff_applications` WHERE `accepted`='0' ORDER BY `id` ASC LIMIT $start_from, $results_per_page");
//$cmds = $con->query("SELECT * FROM `command_logs` LIMIT 0, 15");

$sql = "SELECT COUNT(`id`) AS `total` FROM `staff_applications`";
$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / $results_per_page);
?>

<div class="row"><br /><br /></div>
<div class="row">
  <div class="col-2"></div>
  <div class="col-lg-8">
    <table class="table table-hover table-sm">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Staff Applications</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = $cmds->fetch_assoc()) {
          $searchdata = $con->query("SELECT * FROM `players` WHERE `discord_id`='" . $row['discord_id'] . "'")->fetch_assoc();
          $roblox = getName($searchdata['user_id']);
          $pid = $searchdata['id'];
          $current = $searchdata['rank'];
          $timestamp = $row['timestamp'];
          $join_date = $searchdata['join_date'];
          $position = $row['position'] == 1 ? "Moderator" : "Administrator";
          $r1 = $row['why'];
          $r2 = $row['what'];
          $r3 = $row['extra'];
          $status = $row['accepted'];
          echo <<<nocluewhattonameit
          <tr><td>
          <nav id="$roblox-navbar" class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="testindex.php?search=$pid">$roblox - Rank $current</a>
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link" href="#$roblox-pos">Position</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#$roblox-one">Question 1</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#$roblox-two">Question 2</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#$roblox-three">Question 3</a>
              </li>
            </ul>
          </nav>
          <div data-spy="scroll" data-target="#$roblox-navbar" data-offset="0">
            <h4 id="$roblox-pos">Position</h4>
            <p>$position</p>
            <h4 id="$roblox-one">Why should we hire you?</h4>
            <p>$r1</p>
            <h4 id="$roblox-two">What can you bring?</h4>
            <p>$r2</p>
            <h4 id="$roblox-three">Anything else?</h4>
            <p>$r3</p>
          </div>
          <hr>
          <p class="text-muted">Join date: $join_date</p><p class=\"text-muted\">$timestamp</p>
nocluewhattonameit;
          if ($pcdata['rank'] > 5) {
            $accepto = ($status == '1' ? "" : "-outline");
            $rejecto = ($status == '-1' ? "" : "-outline");
          echo <<<nocluewhattonameit
          <div class="btn-group" role="group" aria-label="Decision">
            <button class="btn btn$accepto-success" onclick="$.ajax({url:'ajax.php?Action=staffApp&Status=1&Position={$row['position']}&CobraId=$pid'});">
              Accept
            </button>
            <button class="btn btn$rejecto-danger" onclick="$.ajax({url:'ajax.php?Action=staffApp&Status=-1&Position={$row['position']}&CobraId=$pid'});">
              Reject
            </button>
          </div>
nocluewhattonameit;
          }
          echo <<<nocluewhattonameit
          </td>
          </tr>
nocluewhattonameit;
        }
        ?>
      </tbody>
    </table><br />
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page == 1) {echo "disabled";} ?>"><a class="page-link" href="applications.php?page=<?php echo ($page - 1); ?>">Previous</a></li>
        <?php /*for ($i = 1; $i <= $total_pages; $i++) {
          echo "<li class=\"page-item "; if ($page == $i) {echo "active";} echo "\"><a class=\"page-link\" href=\"applications.php?page=$i\">$i</a></li>";
        }; */
        $one = $page - 2;
        $two = $page - 1;
        
        $one > 0 ? $one = $one : $one = 1;
        $two > 1 ? $two = $two : $two = 2;
        
        ?>
        <li class="page-item <?php if ($page == $one) {echo "active";} ?>"><a class="page-link" href="applications.php?page=<?php echo ($one); ?>"><?php echo $one; ?></a></li>
        <?php if ($total_pages > 1) { ?>
        <li class="page-item <?php if ($page == $two) {echo "active";} ?>"><a class="page-link" href="applications.php?page=<?php echo ($two); ?>"><?php echo $two; ?></a></li>
        <li class="page-item disabled"><a class="page-link">...</a></li>
        <li class="page-item <?php if ($page == ($total_pages - 1)) {echo "active";} ?>"><a class="page-link" href="applications.php?page=<?php echo ($total_pages - 1); ?>"><?php echo $total_pages - 1; ?></a></li>
        <?php } ?>
        <li class="page-item <?php if ($page == $total_pages) {echo "active";} ?>"><a class="page-link" href="applications.php?page=<?php echo ($total_pages); ?>"><?php echo $total_pages; ?></a></li>
        <li class="page-item <?php if ($page == $total_pages) {echo "disabled";} ?>">
          <a class="page-link" href="applications.php?page=<?php echo ($page + 1); ?>">Next</a>
        </li>
      </ul>
    </nav>
    <br /><br />
  </div>
  <div class="col-2"></div>
</div>

<?php
require('footer.php');
?>