<?php

if (!isset($_COOKIE['RoPlaySecurity']) && !($_SERVER['PHP_SELF']) == "/discord.11.5.0.js") header("Location: /login.php");

$cookie_token = $_COOKIE['RoPlaySecurity'];
if ($con->query("SELECT COUNT(*) AS `Count` FROM `users` WHERE `token`='$cookie_token'")->fetch_assoc()['Count'] < 1) header("Location: /logout.php");
$userdata = $con->query("SELECT * FROM `users` WHERE `token`='$cookie_token'")->fetch_assoc();

$userarr = getUser($userdata['access_token']);
if (sizeof($userarr) < 0) header("Location: /logout.php");
if (isset($userarr['username']))
  $username = $userarr['username'];
if (isset($userarr['discriminator']))
  $discriminator = $userarr['discriminator'];
if (isset($userarr['id']))
  $id = $userarr['id'];
else
  unset($id);

if (!(isset($id)) || $id == "") header("Location: /logout.php");
$pcdata = $con->query("SELECT * FROM `players` WHERE `discord_id`='$id'")->fetch_assoc();
if($_SERVER['PHP_SELF'] == "/testindex.php" && $pcdata['alpha_tester'] == '0') header("Location: /index.php");
if($_SERVER['PHP_SELF'] == "/index.php" && $pcdata['alpha_tester'] == '1') header("Location: /testindex.php");
if (isset($staff)) if ($staff && $pcdata['rank'] < 4) header("Location: /index.php");
$json_userarr = json_encode($userarr);
$up = $con->query("UPDATE `players` SET `discord_data`='$json_userarr' WHERE `discord_id`='$id'");

$search = false;
$searchfound = true;
$term = NULL;
if (isset($_GET['search'])) {
  $term = $_GET['search'];
  if (strlen($term) > 0) {
    $search = true;
    $spcdata = NULL;
    if (is_numeric($_GET['search'])) {
      $searchres = $con->query("SELECT * FROM `players` WHERE `user_id`=$id or `user_id`=$term or `id`=$term or `discord_id`=$term");
      if (mysqli_num_rows($searchres) > 0) {
        $spcdata = $searchres->fetch_assoc();
      } else {
        $searchfound = false;
      }
    } else {
      $id = getId($_GET['search']);
      if ($id == "Id not found") {
        $searchfound = false;
      } else {
        $searchres = $con->query("SELECT * FROM `players` WHERE `user_id`=$id");
        if (mysqli_num_rows($searchres) > 0) {
          $spcdata = $searchres->fetch_assoc();
        } else {
          $searchfound = false;
        }
      }
    }
  }
}

$APIKeys = "You have no API keys.";
$keys = $con->query("SELECT * FROM `api_keys` WHERE `user_id`=" . $pcdata['user_id']);
$numKeys = 1;
if (mysqli_num_rows($keys) > 0) {
  $APIKeys = "<table class=\"table table-borderless\">
  <thead>
    <tr>
      <th scope=\"col\">#</th>
      <th scope=\"col\">Key</th>
    </tr>
  </thead>
  <tbody>";
  while ($row = $keys->fetch_assoc()) {
    $APIKeys .= "<tr><td scope=\"row\">" . $numKeys . "</td><td><p id=\"ApiKey$numKeys\">" . $row['api_key'] . "</p></td></tr>";
    $numKeys++;
  }
  $APIKeys .= "</tbody></table>";
}
?>
<html>
  <head>
    <title>Project Cobra</title>
    <!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" integrity="sha256-JG6hsuMjFnQ2spWq0UiaDRJBaarzhFbUxiUTxQDA9Lk=" crossorigin="anonymous"></script>
    <link href="stickyfooter.css" rel="stylesheet">
    <link href="open-iconic-bootstrap.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="http://projectcobra.example.com/">
        Dashboard
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == "/index.php" || $_SERVER['PHP_SELF'] == "/testindex.php") echo "active"; ?>">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == "/alphat.php") echo "active"; ?>">
            <a class="nav-link" href="alphat.php">Alpha Testers</a>
          </li>
          <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == "/guidelines.php") echo "active"; ?>">
            <!--a class="nav-link" href="guidelines.php">SB Guidelines</a-->
            <a class="nav-link" href="https://docs.google.com/spreadsheets/d/1Ym3mfhPxx4duoyqS9uMfMwrjbq9xP6_ssYpsZlrPpl0" target="_blank">SB Guidelines</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="https://discord.gg/ywzYAje">Discord</a>
          </li>
          <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == "/staffform.php") echo "active"; ?>">
            <a class="nav-link" href="staffform.php">Apply for Staff</a>
          </li>
          <?php
          $active = "";
          if (isset($staff)) if ($staff) $active = "active";
          if ($pcdata['rank'] >= 4) {
          echo <<<StaffMenu
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle $active" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Staff
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/reports.php">Reports</a>
              <a class="dropdown-item" href="/cmdlogs.php">Command Logs</a>
StaffMenu;
            if ($pcdata['rank'] > 4) echo '<a class="dropdown-item" href="/applications.php">Applications</a>';
            echo <<<StaffMenu
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/dawo.php">Danny & Wave Only ;)</a>
            </div>
          </li>
StaffMenu;
}
        ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="<?php echo ($pcdata['alpha_tester'] == '0' ? "/index.php" : "/testindex.php"); ?>">
          <input class="form-control mr-sm-2" type="search" placeholder="Search<?php if ($search && $searchfound && $term) { echo " - " . $term; } ?>" aria-label="Search" name="search" >
          <div class="btn-group">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <a role="button" class="btn btn-outline-danger" href="/logout.php">Logout</a>
          </div>
        </form>
      </div>
    </nav>
    <center>
      <div class="container">
