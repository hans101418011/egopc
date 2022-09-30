<?php
include_once('../comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}

if(isset($_POST['pSN'])){
	$pSN = $_POST['pSN'];
	$delCount = 0;
	$delList = '';
	foreach($pSN as $delSN){
		$delSN = $dbo->real_escape_string($delSN);
		$qry = 'update `product` set p_status=4 where `p_sn`='.$delSN;
		$dbo->query($qry);
		if($dbo->error==0){
			$delCount++;
			$delList.=$delSN.' ';
		}else{
			echo "DB Delete Error : ".$dbo->error;
			break;
		}
	}
	echo '已刪除 '.$delList.'共'.$delCount.'筆商品';

}

?>