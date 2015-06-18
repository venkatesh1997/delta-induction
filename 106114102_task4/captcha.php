<?php 
session_start(); 
$text = rand(10000,99999); 
$_SESSION["captcha"] = $text; 
$height = 30; 
$width = 70; 
$r=rand(0,255);
$g=rand(0,255);
$b=rand(0,255);

$image_p = imagecreate($width, $height); 
$black = imagecolorallocate($image_p, $r, $g, $b); 
$white = imagecolorallocate($image_p, $g, $b, $r); 
$font_size = 14; 
  
imagestring($image_p, $font_size, 5, 5, $text, $white); 
imagejpeg($image_p, null, 80); 

?>