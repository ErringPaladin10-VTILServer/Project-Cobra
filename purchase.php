<?php

require_once('connect.php');

$headers = getallheaders();

if (verifyRequest($con, $headers, $_SERVER)) {
  if ($_SERVER['REQUEST_METHOD'] == "POST") { //POST
    $Params = json_decode(file_get_contents('php://input'), true);
    switch($Params['Method']) {
      case 'add': {
//        if (!isset($Params['Produt-Id'])) die(json_encode(array("status" => "Error", "data" => "Product-Id not specified")));
        if (mysqli_num_rows($con->query("SELECT * FROM `purchases` WHERE `user_id`=" . safe($con, $Params['User-Id']) . " and `prod_id`=" . safe($con, $Params['Product-Id']))) == 0) {
          $notes = safe($con, $Params['Note']) || "None";
          $price = getProductInfo($Params['Product-Id'], 2)['PriceInRobux'];
          $sql = "INSERT INTO `purchases`(`user_id`, `prod_id`, `purch_amt`, `place_id`, `notes`) VALUES (" . safe($con, $Params['User-Id']) . ", " . safe($con, $Params['Product-Id']) . ", $price, " . $headers['Roblox-Id'] . ", '" . $notes . "')";
          $res = $con->query($sql);
          if (!$res)
            die(json_encode(array("status" => "Error", "data" => "Internal error: " . mysqli_error($con))));
          die(json_encode(array("status" => "Success", "data" => "None")));
        } else {
          die(json_encode(array("status" => "Error", "data" => "Already in database")));
        }
        break;
      }
    }
  } else { //GET
    
  }
} else {
  die(require_once('index.php'));
}

/*
if($_SERVER['REQUEST_METHOD'] == "GET" && !isset($_GET['user_id'])){
  exit("What are you doing here....");
}else{
  if(isset($_GET['action'])) {
    switch($_GET['action']){
      case 'Nothing': {
        echo "Nothing here m9.";
      } break;
    }
    exit();
  }
}

if(isset($_POST['user_id'], $_POST['place_id'], $_POST['status'])){
  if(isset($_POST['method'])){
    if($_POST['method'] == "addReceipt"){
      if(isset($_POST['item_status'])){
        $command = "INSERT INTO `dev_prod_receipts` (`receipt_num`, `user_id`, `prod_id`, `purch_amt`, `place_id`, `status`, `item_status`) VALUES ('" . mysqli_real_escape_string($con, $_POST['receipt']) . "','" . mysqli_real_escape_string($con, $_POST['user_id']) . "','" . mysqli_real_escape_string($con, $_POST['prod_id']) . "','" . mysqli_real_escape_string($con, $_POST['purch_amt']) . "','" . mysqli_real_escape_string($con, $_POST['place_id']) . "','" . mysqli_real_escape_string($con, $_POST['status']) . "','" . mysqli_real_escape_string($con, $_POST['item_status']) . "')";
      }else{
        $command = "INSERT INTO `dev_prod_receipts` (`receipt_num`, `user_id`, `prod_id`, `purch_amt`, `place_id`, `status`) VALUES ('" . mysqli_real_escape_string($con, $_POST['receipt']) . "','" . mysqli_real_escape_string($con, $_POST['user_id']) . "','" . mysqli_real_escape_string($con, $_POST['prod_id']) . "','" . mysqli_real_escape_string($con, $_POST['purch_amt']) . "','" . mysqli_real_escape_string($con, $_POST['place_id']) . "','" . mysqli_real_escape_string($con, $_POST['status']) . "')";
      }
    }
    if(isset($command)){
      $query = mysqli_query($con, $command);
    }
  }else{
    exit("Error: No method!");
  }
}else{
  exit("Error: No required parameters found!");
}
*/
?>