<?php
if (isset($_GET['name'])) {
$servername = $_GET['name'];
} else {
$servername = "Minecraft Server";
}
if (isset($_GET['server'])) {
$serverip = $_GET['server'];
} else {
$serverip = "localhost";
}
if (isset($_GET['port'])) {
$serverport = $_GET['port'];
} else {
$serverport = "25565";
}

include_once 'MinecraftServerStatus/status.class.php';
	$status = new MinecraftServerStatus();
	$response = $status->getStatus($serverip, '1.7.*', $serverport);


// Set the content-type
header('Content-Type: image/png');
 
// Create the image
$SourceFile = "background.png";
$im = imagecreatefrompng($SourceFile);
 
// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$craft = imagecolorallocate($im, 247, 144, 0);
$red = imagecolorallocate($im, 255, 0, 0);
// Replace path by your own font path
$font = '/var/www/Bannerz/arial.ttf';
if ($serverport == ("25565")) {
$port = "";
} else {
$port = ":".$serverport."";
}
$serverpic = imagecreatefrompng($response['favicon']);
imageAlphaBlending($serverpic, true);
imageSaveAlpha($serverpic, true);
imagettftext($im, 20, 0, 90, 30, $white, $font, $servername);
imagettftext($im, 10, 0, 90, 50, $white, $font, "Players Online: ".$response['players']."/".$response['maxplayers']."");
imagettftext($im, 10, 0, 90, 65, $white, $font, $response['motd']);
imagettftext($im, 14, 0, 500, 90, $white, $font, "".$response['version']."");
if(isset($_GET['srv']) and ($_GET['srv'] == ("true"))) {
imagettftext($im, 14, 0, 90, 90, $white, $font, "Connect to: ".$_GET['srvaddress']."");
} else {
imagettftext($im, 14, 0, 90, 90, $white, $font, "Connect to: ".$serverip."".$port."");
}
imagettftext($im, 10, 0, 550, 20, $white, $font, "".$response['ping']."ms");
imagecopy($im, $serverpic, 10, 20, 0, 0, 64, 64);
 
 
// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>