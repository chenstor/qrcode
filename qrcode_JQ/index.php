<!DOCTYPE html>
<?php
if(empty( $_GET['url']) || !isset($_GET['url'])){
	$url = "https://itlu.org/";
}else{
	$url = $_GET['url'];
}
if(empty( $_GET['height']) || !isset($_GET['height'])){
	$height = "250";	
}else{
	$height = $_GET['height'];
}
if(empty( $_GET['width']) || !isset($_GET['width'])){
	$width = "250";
}else{
	$width = $_GET['width'];
}
$half_height = $height/2 + 10;
$half_width = $width/2 + 10;
?>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>二维码生成-挨踢路</title>
<style>
*{margin:0;padding:0}
body{background:rgb(14, 14, 14);}
#qrDiv{width:<?php echo $width;?>px;height:<?php echo $height;?>px;background:#fff;padding:10px;position:absolute;
left: 50%;top: 50%;margin-left:-<?php echo $half_width;?>px;margin-top:-<?php echo $half_height;?>px;}
</style>
</head>
<body><div id="qrDiv"></div>
</body>
</html>
<script src="//upcdn.b0.upaiyun.com/libs/jquery/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="./jquery.qrcode.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	var a = document.documentElement.clientHeight;
	$("#qrDiv").qrcode({ 
		width: <?php echo $width;?>, //宽度 
		height:<?php echo $height;?>, //高度 
		text: "<?php echo $url;?>" //任意内容 
	});	
	//从 canvas 提取图片 image 
	function convertCanvasToImage(canvas) { 
		var image = new Image();
		image.src = canvas.toDataURL("image/png"); 
		return image; 
	}
	var mycanvas1=document.getElementsByTagName('canvas')[0]; 
	$('#qrDiv').html("");
	var img=convertCanvasToImage(mycanvas1); 
	$('#qrDiv').append(img);//imagQrDiv表示你要插入的容器id
</script>