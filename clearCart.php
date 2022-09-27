<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($_GET['p_sn'])){
	$p_sn = $_GET['p_sn'];
}
setcookie("cartList",'',0);
unset($_COOKIE["cartList"]);

if(isset($p_sn)){
	header('Location: productDetl.php?p_sn='.$p_sn);
}else{
	header('Location: index.php');
}
?>