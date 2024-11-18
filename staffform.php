<?php
require_once('connect.php');

if (!isset($_COOKIE['RoPlaySecurity'])) {
  die(require_once('auth.php'));
}

require_once('header.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
  if ($pcdata['rank'] < 4) {
    $con->query("INSERT INTO `staff_applications`(`discord_id`, `position`, `why`, `what`, `extra`) VALUES ('" . $pcdata['discord_id'] . "', '" . safe($con, $_POST['position']) . "', '" . safe($con, $_POST['why']) . "', '" . safe($con, $_POST['what']) . "', '" . safe($con, $_POST['extra']) . "')");
    
?>

<br>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Thank you for your interest!</h4>
  <p>We will get back to you as soon as we can. You will receive a message on Discord if you are accepted.</p><hr>
  <p>This is in case we get back to you a few months after you apply and you are no longer interested.</p>
</div>

<?php
  } else {
?>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Thank you for your interest!</h4>
  <p>If you are accepted you will be demoted on Discord for being staff already.</p><hr>
  <p>Derp.</p>
</div>

<?php
  }
} else {
  $submitted = $con->query("SELECT * FROM `staff_applications` WHERE `discord_id`='" . $pcdata['discord_id'] . "'");
  if (mysqli_num_rows($submitted) > 0) {
    $submitted = $submitted->fetch_assoc();
    ?>
    
    <div class="row"><br />
      <div class="col-sm-12"></div>
    </div>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <div class="card text-center text-white <?php echo ($submitted['accepted'] == '0' ? "bg-warning" : ($submitted['accepted'] == '1' ? "bg-success" : "bg-danger")); ?>">
          <div class="card-body">
            <h5 class="card-title">Status: <?php echo ($submitted['accepted'] == '0' ? "Open" : ($submitted['accepted'] == '-1' ? "Rejected" : "Accepted")); ?></h5>
            <p class="card-text">We will get back to you as soon as we can. You will receive a message on Discord if you are accepted.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-4"></div>
    </div>
    
    <?php
  } else {
?>

</center>
<div class="row"><br />
  <div class="col-sm-12"></div>
</div>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-lg-4">
    <form method="post" class="needs-validation" novalidate>
      <div class="form-group row">
        <label for="staticUser" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" id="staticUser" value="<?php echo getName($pcdata['user_id']); ?>">
        </div>
      </div>
      <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Position</legend>
          <div class="col-sm-10">
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" name="position" id="mod" value="1" checked>
              <label class="custom-control-label" for="mod">
                Moderator (Rank 4)
              </label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" name="position" id="admin" value="2">
              <label class="custom-control-label" for="admin">
                Administrator (Rank 5)
              </label>
            </div>
          </div>
        </div>
      </fieldset>
      <div class="form-group">
        <label for="whyLabel">Why should we hire you?</label>
        <textarea class="form-control" id="whyLabel" name="why" rows="3" required></textarea>
        <div class="valid-feedback">
          Looks good!
        </div>
        <div class="invalid-feedback">
          Please answer this question.
        </div>
      </div>
      <div class="form-group">
        <label for="whatLabel">What can you bring to the team?</label>
        <textarea class="form-control" id="whatLabel" name="what" rows="3" required></textarea>
        <div class="valid-feedback">
          Looks good!
        </div>
        <div class="invalid-feedback">
          Please answer this question.
        </div>
      </div>
      <div class="form-group">
        <label for="extraLabel">Anything else you want us to know?</label>
        <textarea class="form-control" id="extraLabel" name="extra" rows="3"></textarea>
      </div>
      <div class="form-group row">
        <div class="col-sm-2">Terms</div>
        <div class="col-sm-10">
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" value="" id="terms" required>
            <label class="custom-control-label" for="terms">
              Agree to terms and conditions
              <hr />
              <small class="text-muted">
                <ul>
                  <li>Being staff is a privilege and can be revoked at any time the developers deem fit</li>
                  <li>This is a voluntary job, you are not going to be paid for this job</li>
                  <li>Getting the job is not guaranteed</li>
                </ul>
              </small>
            </label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-sm-4"></div>
</div>
<center>
  
<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php
  }
}

require_once('footer.php');
?>