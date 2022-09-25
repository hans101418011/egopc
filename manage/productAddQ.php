<?php
include_once('../comm/dbo.php');
// print_r($_POST);
// print_r($_FILES);
$p_type = $_POST['p_type'];
$p_cname = $_POST['p_cname'];
$p_price = $_POST['p_price'];
$p_desc = $_POST['p_desc'];
$p_spec = $_POST['p_spec'];
$p_promotion = $_POST['p_promotion'];
$p_status = $_POST['p_status'];
$p_date = date("Y-m-d"); 

$qry = "insert into product(p_type, p_cname, p_price, p_desc, p_spec, p_date, p_promotion, p_status, p_photo) values ('$p_type', '$p_cname', '$p_price', '$p_desc', '$p_spec', '$p_date', '$p_promotion', '$p_status', '')";
$dbo->query($qry);

if($dbo->errno==0){
	$p_sn = $dbo->insert_id;
	$imgName = $p_sn.'.jpg';
	$locFlod = '../productImg/tiny/'.$imgName;
	$file = $_FILES['p_photo']['tmp_name'];

	$tinyW = 200;
	$maxSize = 800;

	$srcImg=imagecreatefromjpeg($file);
	list($imgW,$imgH) = GetImageSize($file);
	$tinyPrc = $tinyW / $imgW;
	$tinyH = floor($imgH * $tinyPrc);

	$tinyImg = imagecreatetruecolor($tinyW,$tinyH);
	imagecopyresampled($tinyImg,$srcImg,0,0,0,0,$tinyW,$tinyH,$imgW,$imgH);
	imageJPEG($tinyImg,$locFlod);

	if($imgW>$maxSize || $imgH>$maxSize){
		if($imgW>$imgH){
			$newW = $maxSize;
			$maxPrc = $newW / $imgW; 
			$newH = floor($imgH * $maxPrc);
		}else{
			$newH = $maxSize;
			$maxPrc = $newH / $imgH;
			$newW = floor($imgW * $maxPrc);
		}
		$dst=imagecreatetruecolor($newW,$newH);
		imagecopyresampled($dst,$srcImg,0,0,0,0,$newW,$newH,$imgW,$imgH);
		imageJPEG($dst,'../productImg/'.$imgName);
	}else{
		move_uploaded_file($file,'../productImg/'.$imgName);
	}

	$qry="update `product` set `p_photo`='$imgName' where `p_sn`='$p_sn'";
	$dbo->query($qry);

	echo 'Added';
}else{
	echo 'Error :'.$dbo->errno;
}



?>