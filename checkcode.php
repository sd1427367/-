<?php
$bg=imagecreatetruecolor(200,50);
$bg_color=imagecolorallocate($bg,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
imagefilledrectangle($bg,0,0,200,50,$bg_color);
$text='0123456789qwertyuipasdfghjklzxcvbnmQWERTYUIPASDFGHJKLZXCVBNM';
$maxindex=strlen($text)-1;
$captcha='';
for ($i=0; $i < 4; $i++) { 
	$captcha.=$text[mt_rand(0,$maxindex)];
}
session_start();
$_SESSION['captcha']=$captcha;
$text_color=imagecolorallocate($bg, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
$font_w=imagefontwidth(5);
$font_h=imagefontheight(5);
$x=(50-$font_w)/2;
$y=(50-$font_h)/2;
for ($i=0; $i < 4; $i++) { 
	imagechar($bg,5, $x+50*$i, $y,$captcha[$i],$text_color);
}
$pixel_num=mt_rand(100,500);
for ($i=0; $i < $pixel_num; $i++) { 
	$pixel_color=imagecolorallocate($bg, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imagesetpixel($bg,mt_rand(0,200),mt_rand(0,50),$pixel_color);
}
$line_num=mt_rand(5,10);
for ($i=0; $i < $line_num; $i++) { 
	$line_color=imagecolorallocate($bg, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	imageline($bg, mt_rand(0,200), mt_rand(0,50), mt_rand(0,200), mt_rand(0,50), $line_color);
}

header('content-type:image/png');
imagepng($bg);


