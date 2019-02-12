<?php
if(empty( $_GET['url']) || !isset($_GET['url'])){
	$value = 'https://itlu.org/';
}else{
	$value = $_GET['url'];
}
if(empty( $_GET['size']) || !isset($_GET['size'])){
	$pic_size = 9;
}else{
	$pic_size = floor(abs($_GET['size']));
	if( $pic_size<1){$pic_size = 9;}
}
if(empty( $_GET['logo']) || !isset($_GET['logo'])){
	$logo = '';
}else{
	$logo = $_GET['logo'];
}
/**size=16**/
function short_md5($str) {
    return substr(md5($str), 8, 16);
}
include 'phpqrcode.php';
$errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H 
$matrixPointSize = $pic_size; // 点的大小：1到10
if(empty($logo)){
	QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize, 2);
}else{
	$filepath = 'qrimg/';//文件目录
	$old_name = $filepath.date("Ymd_").short_md5($value).'_itlu.png';
	$new_name = $filepath.date("Ymd_").short_md5($value).'_qrcode.png';
	QRcode::png($value, $old_name, $errorCorrectionLevel, $matrixPointSize, 2);
	$QR = $old_name;//已经生成的原始二维码图
	$QR = imagecreatefromstring(file_get_contents($QR)); 
	$logo = imagecreatefromstring(file_get_contents($logo)); 
	$QR_width = imagesx($QR);//二维码图片宽度 
	$QR_height = imagesy($QR);//二维码图片高度 
	$logo_width = imagesx($logo);//logo图片宽度 
	$logo_height = imagesy($logo);//logo图片高度 
	$logo_qr_width = $QR_width / 5; 
	$scale = $logo_width/$logo_qr_width; 
	$logo_qr_height = $logo_height/$scale; 
	$from_width = ($QR_width - $logo_qr_width) / 2; 
	//重新组合图片并调整大小 
	imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height); 
	//输出图片
	imagepng($QR, $new_name);
	$content = file_get_contents($new_name);
	header('Content-type: image/png');
	echo $content;
}
?>