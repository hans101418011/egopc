<?php
include_once('comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}

$cartList = json_decode($_COOKIE['cartList'],true);
$nx = count($cartList);
echo $nx;

?>