<?php
require_once('connect.php');

if (!isset($_COOKIE['RoPlaySecurity'])) {
  die(require_once('auth.php'));
}

require_once('header.php');
?>

<div class="row">
  <br /><br /><br />
</div>
<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-lg-8"><a class="btn btn-primary" role="button" href="/sbguidelines.html" download>Download the guidelines here!</a></div>
  <div class="col-sm-2"></div>
</div>
<div class="row"><br /></div>
<div class="row">
  <iframe src="/sbguidelines.html" width="100%" height="100%"></iframe>
</div>

<?php
require_once('footer.php');
?>