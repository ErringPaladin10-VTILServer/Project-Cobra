<?php
if (!isset($con)) require_once('connect.php');
$redirect = "https://projectcobra.example.com/login.php";
if (isset($_COOKIE['token'])) setcookie("token", "", time() -3600);
?>
<html>
  <head>
    <title>Project Cobra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="stickyfooter.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="https://projectcobra.example.com/">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="discord.gg/ywzYAje">Discord</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" disabled>
          <div class="btn-group">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" disabled>Search</button>
          </div>
        </form>
      </div>
    </nav>
    
    <center>
      <div class="container">
        <div class="row"><br /><br />
        </div>
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-lg-4">
            <div class="card text-center" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Login With Discord</h5>
                </p>
                <div class="btn-group">
                  <a role="button" class="btn btn-success" href="<?php echo $redirect; ?>">Authorize</a>
                </div>
              </div>
            </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
    </center>
    
<?php require('footer.php'); ?>