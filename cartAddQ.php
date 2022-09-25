<?php
include_once('comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}


if(isset($_POST['addPSN'])){
	$p_sn= $dbo->real_escape_string($_POST['addPSN']);
	$qry='select * from `product` where `p_sn`='.$p_sn.' limit 0,1';
	$row = $dbo->query($qry)->fetch_array();
	if($row['p_status']==0){
		$cartList=array();
		if(isset($_COOKIE['cartList'])){
			$cartList = json_decode($_COOKIE['cartList'],true);
			$nx = count($cartList);
		}else{
			$nx =0;
		}
		array_push($cartList,array('p_sn'=>$p_sn));
		$json = json_encode($cartList,JSON_UNESCAPED_UNICODE);
		setcookie("cartList",$json,time()+3600*24*3);
		echo "200,";
		
		$html = '<div class="cartItem" data-psn="'.$p_sn.'">';
		$html .= '<span>'.$row['p_cname'].'</span>';
		if(isset($row['p_discount'])){
			$html .= '<span>$'.$row['p_discount'].'</span>';
		}else{
			$html .= '<span>$'.$row['p_price'].'</span>';
		}
		$html .= '<a href="#" data-del-cartsn="'.$nx.'"></a>';
		$html .= '</div>';
		
		echo $html;
		// print_r($cartList);
	}else{
		echo "404";
	}
}else{
	echo "401";
}

?>