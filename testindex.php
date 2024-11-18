<?php
require_once('connect.php');

if (!isset($_COOKIE['RoPlaySecurity'])) {
  die(require_once('auth.php'));
}

require_once('header.php');
?>

<div class="modal fade" id="APIKeys" tabindex="-1" role="dialog" aria-labelledby="APIKeysLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="APIKeysLabel">API Keys</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $APIKeys; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="row"><br /><br /></div>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-lg-4">
    <!--h3>Dashboard</h3><hr /-->
    <div class="card text-center" style="width: 18rem;">
      <br />
      <?php
      if ($search) {
        if ($searchfound)
          require('searchcard.php');
        else
          require('searchcardempty.php');
      } else {
        require('defaultcard.php');
      }
      ?>
    </div>
  <!--?php echo "dashboard<br />logged in as ~ $username#$discriminator<br />discord id ~ $id<br>"; echo json_encode($userarr); ?></div-->
  <div class="col-sm-4"></div>
</div>

<?php
require_once('footer.php');
?>