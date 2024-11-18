<?php
require('connect.php');
require('header.php');

//$alphas = $con->query("SELECT * FROM `players` WHERE `alpha_tester`='1' AND `verified`='1'");
?>

<div class="row"><br /><br /></div>
<div class="row">
  <div class="col-2"></div>
  <div class="col-lg-8">
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Alpha Testers</th>
        </tr>
      </thead>
      <tbody>
        <?php /*
        while ($row = $alphas->fetch_assoc()) {
          $discord = json_decode($row['discord_data'], true);
          $roblox = getName($row['user_id']);
          $roblox_id = $row['user_id'];
          if (isset($discord['username']))
            $discord = $discord['username'];
          else
            $discord = $roblox;
          echo "<tr>
            <td><a href=\"https://www.roblox.com/users/$roblox_id/profile\" target=\"_blank\">$roblox</a></td>
          </tr>";
        }*/
        ?>
        <tr>
          <td><a href="https://www.roblox.com/users/21467784/profile" target="_blank"><?php echo getName(21467784); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/13282741/profile" target="_blank"><?php echo getName(13282741); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/73173779/profile" target="_blank"><?php echo getName(73173779); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/103266991/profile" target="_blank"><?php echo getName(103266991); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/25803262/profile" target="_blank"><?php echo getName(25803262); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/109787605/profile" target="_blank"><?php echo getName(109787605); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/246260994/profile" target="_blank"><?php echo getName(246260994); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/38716801/profile" target="_blank"><?php echo getName(38716801); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/310055057/profile" target="_blank"><?php echo getName(310055057); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/237171263/profile" target="_blank"><?php echo getName(237171263); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/10847192/profile" target="_blank"><?php echo getName(10847192); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/66520289/profile" target="_blank"><?php echo getName(66520289); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/36181181/profile" target="_blank"><?php echo getName(36181181); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/148089885/profile" target="_blank"><?php echo getName(148089885); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/61968682/profile" target="_blank"><?php echo getName(61968682); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/245060548/profile" target="_blank"><?php echo getName(245060548); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/99123679/profile" target="_blank"><?php echo getName(99123679); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/49352468/profile" target="_blank"><?php echo getName(49352468); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/6911602/profile" target="_blank"><?php echo getName(6911602); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/16675887/profile" target="_blank"><?php echo getName(16675887); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/31705236/profile" target="_blank"><?php echo getName(31705236); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/40451685/profile" target="_blank"><?php echo getName(40451685); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/218958298/profile" target="_blank"><?php echo getName(218958298); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/88371991/profile" target="_blank"><?php echo getName(88371991); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/41539096/profile" target="_blank"><?php echo getName(41539096); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/4654062/profile" target="_blank"><?php echo getName(4654062); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/18619905/profile" target="_blank"><?php echo getName(18619905); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/41083627/profile" target="_blank"><?php echo getName(41083627); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/340696693/profile" target="_blank"><?php echo getName(340696693); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/161671670/profile" target="_blank"><?php echo getName(161671670); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/266856124/profile" target="_blank"><?php echo getName(266856124); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/72725119/profile" target="_blank"><?php echo getName(72725119); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/63894355/profile" target="_blank"><?php echo getName(63894355); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/18280789/profile" target="_blank"><?php echo getName(18280789); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/137946866/profile" target="_blank"><?php echo getName(137946866); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/130196765/profile" target="_blank"><?php echo getName(130196765); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/35375868/profile" target="_blank"><?php echo getName(35375868); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/107333245/profile" target="_blank"><?php echo getName(107333245); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/291367743/profile" target="_blank"><?php echo getName(291367743); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/21766280/profile" target="_blank"><?php echo getName(21766280); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/34263959/profile" target="_blank"><?php echo getName(34263959); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/14988114/profile" target="_blank"><?php echo getName(14988114); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/338770363/profile" target="_blank"><?php echo getName(338770363); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/90356877/profile" target="_blank"><?php echo getName(90356877); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/469075528/profile" target="_blank"><?php echo getName(469075528); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/68192774/profile" target="_blank"><?php echo getName(68192774); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/98059858/profile" target="_blank"><?php echo getName(98059858); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/122316056/profile" target="_blank"><?php echo getName(122316056); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/32873573/profile" target="_blank"><?php echo getName(32873573); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/89430243/profile" target="_blank"><?php echo getName(89430243); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/119729064/profile" target="_blank"><?php echo getName(119729064); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/100502227/profile" target="_blank"><?php echo getName(100502227); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/23041574/profile" target="_blank"><?php echo getName(23041574); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/401188385/profile" target="_blank"><?php echo getName(401188385); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/127907495/profile" target="_blank"><?php echo getName(127907495); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/61892511/profile" target="_blank"><?php echo getName(61892511); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/328204362/profile" target="_blank"><?php echo getName(328204362); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/78203000/profile" target="_blank"><?php echo getName(78203000); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/113928401/profile" target="_blank"><?php echo getName(113928401); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/403895933/profile" target="_blank"><?php echo getName(403895933); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/89252302/profile" target="_blank"><?php echo getName(89252302); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/139444091/profile" target="_blank"><?php echo getName(139444091); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/152803251/profile" target="_blank"><?php echo getName(152803251); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/39961465/profile" target="_blank"><?php echo getName(39961465); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/216921597/profile" target="_blank"><?php echo getName(216921597); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/36629158/profile" target="_blank"><?php echo getName(36629158); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/86808784/profile" target="_blank"><?php echo getName(86808784); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/241402875/profile" target="_blank"><?php echo getName(241402875); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/310106655/profile" target="_blank"><?php echo getName(310106655); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/252646421/profile" target="_blank"><?php echo getName(252646421); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/286795143/profile" target="_blank"><?php echo getName(286795143); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/278229280/profile" target="_blank"><?php echo getName(278229280); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/58138472/profile" target="_blank"><?php echo getName(58138472); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/181174608/profile" target="_blank"><?php echo getName(181174608); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/180384074/profile" target="_blank"><?php echo getName(180384074); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/115716259/profile" target="_blank"><?php echo getName(115716259); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/161950881/profile" target="_blank"><?php echo getName(161950881); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/68853586/profile" target="_blank"><?php echo getName(68853586); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/124500373/profile" target="_blank"><?php echo getName(124500373); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/395402280/profile" target="_blank"><?php echo getName(395402280); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/94085547/profile" target="_blank"><?php echo getName(94085547); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/118575623/profile" target="_blank"><?php echo getName(118575623); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/171196681/profile" target="_blank"><?php echo getName(171196681); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/304167448/profile" target="_blank"><?php echo getName(304167448); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/118351461/profile" target="_blank"><?php echo getName(118351461); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/369981372/profile" target="_blank"><?php echo getName(369981372); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/328001669/profile" target="_blank"><?php echo getName(328001669); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/159244371/profile" target="_blank"><?php echo getName(159244371); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/23985795/profile" target="_blank"><?php echo getName(23985795); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/78370545/profile" target="_blank"><?php echo getName(78370545); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/48453102/profile" target="_blank"><?php echo getName(48453102); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/81837667/profile" target="_blank"><?php echo getName(81837667); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/479062056/profile" target="_blank"><?php echo getName(479062056); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/311396332/profile" target="_blank"><?php echo getName(311396332); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/70014269/profile" target="_blank"><?php echo getName(70014269); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/123688057/profile" target="_blank"><?php echo getName(123688057); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/125031596/profile" target="_blank"><?php echo getName(125031596); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/119490169/profile" target="_blank"><?php echo getName(119490169); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/656806009/profile" target="_blank"><?php echo getName(656806009); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/124558453/profile" target="_blank"><?php echo getName(124558453); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/145593426/profile" target="_blank"><?php echo getName(145593426); ?></a></td>
        </tr><tr>
          <td><a href="https://www.roblox.com/users/28367615/profile" target="_blank"><?php echo getName(28367615); ?></a></td>
        </tr>
      </tbody>
    </table>
    <br /><br />
  </div>
  <div class="col-2"></div>
</div>


<?php
require('footer.php');
?>