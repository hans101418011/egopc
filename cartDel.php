<?php
if(!isset($_SESSION)){
	session_start();
}

$delCartSN = $_POST['delCartSN'];
$cartList = json_decode($_COOKIE['cartList'],true);

unset($cartList[$delCartSN]);
$cartList = array_values($cartList);
// print_r($cartList);
$json = json_encode($cartList,JSON_UNESCAPED_UNICODE);
setcookie("cartList",$json,time()+3600*24*3);
echo $delCartSN;
print_r($cartList);
print_r($_COOKIE['cartList']);

?>