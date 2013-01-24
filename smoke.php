<?php

$img = imagecreatefrompng('smoke.png');

if (isset($_GET['w'])) {
    $word = $_GET['w'];
    $word =  mb_convert_encoding($word,"UTF-8","auto");
    renderString($img, $word);
}

header ("Content-type: image/png");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // 過去の日付

imagepng($img);

imagedestroy($img);

exit;

function renderString($img, $string) {

    if ((0 >= strlen($string)) || (strlen($string) >= 400)) {
        return;
    }

    $font_size = 20;
    $font_angle = 0;

    $font_path = "./mplus.ttf";

    $tx = 10;
    $ty = 25;

    $font_color = imagecolorallocate($img, 255, 255, 255);

    $texts = preg_split("/\r\n|\r|\n/", $string);
    foreach($texts as $string) {
        imagettftext($img, $font_size, $font_angle, $tx, $ty, $font_color, $font_path, $string);
        $ty += 25;
    }
}

