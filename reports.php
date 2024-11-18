<?php
require('connect.php');
$staff = true;
require('header.php');

$reports = $con->query("SELECT * FROM `reports`");
?>

<div class="row"><br /><br /></div>
<div class="row">
  <div class="col-2"></div>
  <div class="col-lg-8">
    <div class="accordion" id="accordion">
      <table class="table table-borderless table-sm">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Reports</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = $reports->fetch_assoc()) {
            $id = $row['id'];
            $discord_name = $row['reporter_name'];
            $reported = $row['reportee'];
            $description = $row['description'];
            $proof = $row['proof'];
            $notes = json_decode($row['notes']);
            $notes_disp = "No notes.";
            $resolve_note = $row['message'];
            $resolver = $row['resolver'];
            if (sizeof($notes) > 0) {
              $notes_disp = "";
              foreach ($notes as $note) {
                $notes_disp .= "$note<br />&nbsp;&nbsp;&nbsp;";
              }
            }
            $resolved = "alert alert-warning";
            if ($row['resolved'] == '1') $resolved = "alert alert-success";
            echo "<tr>
              <td>
                <div class=\"card\">
                  <div class=\"card-header\" id=\"headingOne\">
                    <h5 class=\"$resolved mb-0\">
                      <button class=\"btn btn-link\" type=\"button\" data-toggle=\"collapse\" data-target=\"#accord$id\" aria-expanded=\"false\" aria-controls=\"accord$id\">
                        Report #$id - $discord_name
                      </button>
                    </h5>
                  </div>
              
                  <div id=\"accord$id\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion\">
                    <div class=\"card-body\">
                      <ul class=\"list-group list-group-flush\">
                      <li class=\"list-group-item\">User Reported:<br />&nbsp;&nbsp;&nbsp;$reported</li>
                      <li class=\"list-group-item\">Description:<br />&nbsp;&nbsp;&nbsp;$description</li>
                      <li class=\"list-group-item\">Proof:<br />&nbsp;&nbsp;&nbsp;$proof</li>
                      <li class=\"list-group-item\">Notes:<br />&nbsp;&nbsp;&nbsp;$notes_disp</li>
                      <li class=\"list-group-item\">Resolve Message:<br />&nbsp;&nbsp;&nbsp;$resolve_note<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;~$resolver</li>
                    </ul>
                    </div>
                  </div>
                </div>
              </td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <br /><br />
  </div>
  <div class="col-2"></div>
</div>

<?php
require('footer.php');
?>