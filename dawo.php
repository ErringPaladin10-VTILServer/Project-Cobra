<?php

require_once('connect.php');
require_once('header.php');

if ($pcdata['rank'] == 7 || $pcdata['id'] == 119) {
$RobuxInfo = $con->query("SELECT SUM(`purch_amt`) AS `Worth`, COUNT(*) AS `Total` FROM `purchases`")->fetch_assoc();
$RankL0 = $con->query("SELECT COUNT(*) AS `Count` FROM `players` WHERE `rank`<0")->fetch_assoc()['Count'];
$Rank1 = $con->query("SELECT COUNT(*) AS `Count` FROM `players` WHERE `rank`=1")->fetch_assoc()['Count'];
$Rank2 = $con->query("SELECT COUNT(*) AS `Count` FROM `players` WHERE `rank`=2")->fetch_assoc()['Count'];
$Rank3 = $con->query("SELECT COUNT(*) AS `Count` FROM `players` WHERE `rank`=3")->fetch_assoc()['Count'];

$Months = array("Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec")

?>

<div class="row"><br /><br /></div>
<div class="row">
  <div class="col-lg-4">
    <canvas id="RobuxChart"></canvas>
    <strong class="text-muted">Robux: <?php echo $RobuxInfo['Worth']; ?></strong>
    <h4>Profit vs Tax</h4>

    <script>
      var ctx = document.getElementById('RobuxChart').getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Profit", "Roblox Tax"],
            datasets: [{
                label: "Total Robux",
                backgroundColor: [
                  '#1ca8dd',
                  '#1bc98e'
                ],
                borderColor: '#FFFFFF',
                data: [<?php echo round($RobuxInfo['Worth'] * 0.7); ?>, <?php echo round($RobuxInfo['Worth'] * 0.3); ?>],
            }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: false
          },
          cutoutPercentage: 80
        }
      });
    </script>
  </div>
  <div class="col-lg-4">
    <canvas id="UsersChart"></canvas>
    <strong class="text-muted">Users: <?php echo $RankL0 + $Rank1 + $Rank2 + $Rank3; ?></strong>
    <h4>Each Rank</h4>

    <script>
      var ctx = document.getElementById('UsersChart').getContext('2d');
      new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Banned", "Rank 1", "Rank 2", "Rank 3"],
            datasets: [{
                label: "Total Users",
                backgroundColor: [
                  '#E64759',
                  '#9F86FF',
                  '#1CA8DD',
                  '#1BC98E'
                ],
                borderColor: '#FFFFFF',
                data: [<?php echo $RankL0; ?>, <?php echo $Rank1; ?>, <?php echo $Rank2; ?>, <?php echo $Rank3; ?>],
            }]
        },
        options: {
          legend: {
            display: false
          },
          title: {
            display: false
          },
          cutoutPercentage: 80
        }
      });
    </script>
  </div>
  <div class="col-lg-4">
    <canvas id="LoadsChart"></canvas>
    <strong class="text-muted">Loads: <?php echo $con->query("SELECT SUM(`loads`) AS `Count` FROM `place_settings`")->fetch_assoc()['Count']; ?></strong>
    <h4>Each Place</h4>

    <script>
      var ctx = document.getElementById('LoadsChart').getContext('2d');
      new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',
    
        // The data for our dataset
        data: {
            labels: ["Dev. Place", "Voids Place 2", "Other places"],
            datasets: [{
                label: "Total Loads",
                backgroundColor: [
                  '#1CA8DD',
                  '#1BC98E'
                ],
                borderColor: '#FFFFFF',
                data: [<?php echo $con->query("SELECT * FROM `place_settings` WHERE `id`=1")->fetch_assoc()['loads']; ?>, <?php echo $con->query("SELECT * FROM `place_settings` WHERE `id`=2")->fetch_assoc()['loads']; ?>, <?php echo $con->query("SELECT SUM(`loads`) AS `Count` FROM `place_settings` WHERE `id`>2")->fetch_assoc()['Count']; ?>],
            }]
        },
    
        // Configuration options go here
        options: {
          legend: {
            display: false
          },
          title: {
            display: false
          },
          cutoutPercentage: 80
        }
      });
    </script>
  </div>
</div>
<div class="hr-divider afn afd">
  <h3 class="hr-divider-text bpw">Quick stats</h3>
</div>
<div class="row">
  <div class="col-lg-3">
    <div class="card bgc-green text-white p-3">
      <div class="card-body">
        <?php
          $lastMonth = $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 2 MONTH);")->fetch_assoc()['Current'];
          $currMonth = $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(NOW()) AND `time` > DATE_SUB(NOW(), INTERVAL 1 MONTH);")->fetch_assoc()['Current'];
          $dif = $currMonth - $lastMonth;
          //$dif = $con->query("SELECT COUNT(*) AS `Difference` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 2 MONTH) - (SELECT COUNT(*) FROM `purchases` WHERE MONTH(`time`) = MONTH(NOW()) AND `time` > DATE_SUB(NOW(), INTERVAL 1 MONTH))")->fetch_assoc()['Difference'];
        ?>
        <h5 class="card-title">Purchases <small class="bpj <?php echo ($lastMonth <= $currMonth ? "bpk" : "bpl"); ?>"><?php echo $dif; ?></small></h5>
        <canvas id="PurchasesChart"></canvas>
      </div>
      <script>
        var ctx = document.getElementById('PurchasesChart').getContext('2d');
        new Chart(ctx, {
          // The type of chart we want to create
          type: 'line',
      
          // The data for our dataset
          data: {
              labels: ["<?php echo date('M', strtotime('-5 months')); ?>", "<?php echo date('M', strtotime('-4 months')); ?>", "<?php echo date('M', strtotime('-3 months')); ?>", "<?php echo date('M', strtotime('-2 months')); ?>", "<?php echo date('M', strtotime('-1 month')); ?>", "<?php echo date('M'); ?>"],
              datasets: [{
                  label: "Purchases",
                  backgroundColor: 'rgba(255, 255, 255, 0.35)',
                  borderColor: '#FFFFFF',
                  data: [
                    <?php echo $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 5 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 6 MONTH);")->fetch_assoc()['Current'];?>,
                    <?php echo $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 4 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 5 MONTH);")->fetch_assoc()['Current'];?>,
                    <?php echo $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 3 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 4 MONTH);")->fetch_assoc()['Current'];?>,
                    <?php echo $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 2 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 3 MONTH);")->fetch_assoc()['Current'];?>,
                    <?php echo $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) AND `time` > DATE_SUB(NOW(), INTERVAL 2 MONTH);")->fetch_assoc()['Current'];?>,
                    <?php echo $con->query("SELECT COUNT(*) AS `Current` FROM `purchases` WHERE MONTH(`time`) = MONTH(NOW()) AND `time` > DATE_SUB(NOW(), INTERVAL 1 MONTH);")->fetch_assoc()['Current'];?>]
              }]
          },
      
          // Configuration options go here
          options: {
            legend: {
              scaleLabel: {
                fontColor: '#FFFFFF'
              },
              display: false,
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "white"
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "white"
                    }
                }]
            },
            title: {
              display: false
            }
          }
        });
      </script>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card bgc-blue text-white p-3">
      <div class="card-body">
        <h5 class="card-title">Discord Verified</h5>
        <p class="card-text"><?php echo $con->query("SELECT COUNT(*) AS `Count` FROM `players` WHERE `verified`='1' AND `discord_id`<>''")->fetch_assoc()['Count']; ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card bgc-red text-white p-3">
      Coming Soon.
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card bgc-purple text-white p-3">
      <?php if ($pcdata['rank'] != 7)
          echo "Coming Soon.";
        else
        echo <<<SourceUpdate
        <div class="card-body">
          <h5 class="card-title">Update Source</h5>
          <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Source" name="submit">
          </form>
          <!--form action="devup.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Dev Source" name="submit">
          </form>
        </div-->
SourceUpdate;
?>
    </div>
  </div>
</div>
<div class="form-floating mb-3">
  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Email address</label>
</div>
<div class="form-floating">
  <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>

<?
} else {
  echo "<br />Hehe. You thought.<br />~Derp";
}

require_once('footer.php');
?>