<?php
require('connect.php');
$staff = true;
require('header.php');

//$cmdsize = $con->query("SELECT COUNT(*) AS `Size` FROM `command_logs`")->fetch_assoc();;
if (isset($_GET["page"]))
  $page = $_GET["page"];
else
  $page = 1;
  
$results_per_page = 20;
$start_from = ($page - 1) * $results_per_page;
$cmds = $con->query("SELECT * FROM `command_logs` ORDER BY `id` DESC LIMIT $start_from, $results_per_page");
//$cmds = $con->query("SELECT * FROM `command_logs` LIMIT 0, 15");

$sql = "SELECT COUNT(`id`) AS `total` FROM `command_logs`";
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
          <th scope="col">Command Logs</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = $cmds->fetch_assoc()) {
          $roblox = getName($row['user_id']);
          $command = $row['command'] . " " . $row['args'];
          $timestamp = $row['tstamp'];
          echo "<tr>
            <td><p>
              $roblox | $command
            </p><p class=\"text-muted\">$timestamp</p></td>
          </tr>";
        }
        ?>
      </tbody>
    </table><br />
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page == 1) {echo "disabled";} ?>"><a class="page-link" href="cmdlogs.php?page=<?php echo ($page - 1); ?>">Previous</a></li>
        <?php /*for ($i = 1; $i <= $total_pages; $i++) {
          echo "<li class=\"page-item "; if ($page == $i) {echo "active";} echo "\"><a class=\"page-link\" href=\"cmdlogs.php?page=$i\">$i</a></li>";
        }; */
        $one = $page - 2;
        $two = $page - 1;
        
        $one > 0 ? $one = $one : $one = 1;
        $two > 1 ? $two = $two : $two = 2;
        
        ?>
        <li class="page-item <?php if ($page == $one) {echo "active";} ?>"><a class="page-link" href="cmdlogs.php?page=<?php echo ($one); ?>"><?php echo $one; ?></a></li>
        <li class="page-item <?php if ($page == $two) {echo "active";} ?>"><a class="page-link" href="cmdlogs.php?page=<?php echo ($two); ?>"><?php echo $two; ?></a></li>
        <li class="page-item disabled"><a class="page-link">...</a></li>
        <li class="page-item <?php if ($page == ($total_pages - 1)) {echo "active";} ?>"><a class="page-link" href="cmdlogs.php?page=<?php echo ($total_pages - 1); ?>"><?php echo $total_pages - 1; ?></a></li>
        <li class="page-item <?php if ($page == $total_pages) {echo "active";} ?>"><a class="page-link" href="cmdlogs.php?page=<?php echo ($total_pages); ?>"><?php echo $total_pages; ?></a></li>
        <li class="page-item <?php if ($page == $total_pages) {echo "disabled";} ?>">
          <a class="page-link" href="cmdlogs.php?page=<?php echo ($page + 1); ?>">Next</a>
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