<?php

require_once('connect.php');

// Text content of the QRCode
$data = '21467784';
// QRCode size
$size = '200x200';


// Get QR Code image from Google Chart API
// http://code.google.com/apis/chart/infographics/docs/qr_codes.html
$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));

// START TO DRAW THE IMAGE ON THE QR CODE
//$logo = imagecreatefromstring(file_get_contents($logo));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);

//$logo_width = imagesx($logo);
//$logo_height = imagesy($logo);

// Scale logo to fit in the QR Code
$logo_qr_width = $QR_width/3;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;

imagecopyresampled($QR, $QR_width/3, $QR_height/3, 0, 0);

// END OF DRAW

/**
 * As this example is a plain PHP example, return
 * an image response.
 *
 * Note: you can save the image if you want.
 */
header('Content-type: image/png');
imagepng($QR);
imagedestroy($QR);

// If you decide to save the image somewhere remove the header and use instead :
// $savePath = "/path/to-my-server-images/myqrcodewithlogo.png";
// imagepng($QR, $savePath);
?>
