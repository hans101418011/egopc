<?php
include_once('../comm/dbo.php');
// print_r($_POST);
// print_r($_FILES);
$p_sn = $_POST['p_sn'];
$p_type = $_POST['p_type'];
$p_cname = $_POST['p_cname'];
$p_price = $_POST['p_price'];
$p_discount = $_POST['p_discount'];
$p_desc = $_POST['p_desc']?$_POST['p_desc']:NULL;
$p_spec = $_POST['p_spec'];
$p_promotion = $_POST['p_promotion']?$_POST['p_promotion']:Null;
$p_status = $_POST['p_status'];
$p_date = date("Y-m-d"); 

$qry = "update product set p_type='$p_type', p_cname='$p_cname', p_price='$p_price', p_discount='$p_discount', p_desc='$p_desc', p_spec='$p_spec', p_date='$p_date', p_promotion='$p_promotion', p_status='$p_status' where p_sn='$p_sn'";

$dbo->query($qry);

if($dbo->errno==0){
	if(isset($_FILES['p_photo']['tmp_name'])){
		$file = $_FILES['p_photo']['tmp_name'];
		$imgName = $p_sn.'.jpg';
		$locFlod = '../productImg/tiny/'.$imgName;

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
	}

	echo 'Update';
}else{
	echo 'Error :'.$dbo->errno;
}



?>