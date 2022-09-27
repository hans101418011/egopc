<?php
include_once('comm/dbo.php');
if(!isset($_SESSION)){
session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>e-Go PC 易購電腦</title>
	<link rel="shortcut icon" href="./images/favicon.gif" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/color.css" />
	<link rel="stylesheet" href="css/cart.css">
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script>
		$(function(){
			console.log('?');
			$('.count').change(function(){
				var num=$(this);
				if(num.val()==0){
					$.ajax({
						url:'cartDel.php',
						type:'post',
						data:{'delCartSN':num.parent().attr('class')},
						error:function(){
							alert('Server Error');
						},
						success:function(info){
							console.log(info);
						}
					});


				}

			});

		});
	</script>
</head>
<body>
	<div class="container">
		<header><?php include_once('_header.php'); ?></header>
		<main>
			<form id="checkout" action="checkout.php" method="post">
				<div>
					<div><span class="cname">商品名稱</span><span class="spec">規格</span><span class="count">數量</span><span class="price">價格</span></div>
					<?php
						$cartList = json_decode($_COOKIE['cartList'],true);
						$cartNum = count($cartList);
						$html = '';
						$sum = 0;
						for($i=0; $i<$cartNum; $i++){
							$p_sn = $cartList[$i]['p_sn'];
							$qry='select * from `product` where `p_sn`='.$p_sn.' limit 0,1';
							$row = $dbo->query($qry)->fetch_array();

							$html .='<div class="'.$i.'"><span class="cname">'.$row['p_cname'].'</span>';
							$html .='<span class="spec">'.$row['p_spec'].'</span>'; 
							$html .='<input type="number" name="num'.$p_sn.'" class="count" value="1">';
							if(isset($row['p_discount'])){
								$html .='<span class="price">$'.$row['p_discount'].'</span></div>';
								$sum+=$row['p_discount'];
							}else{
								$html .='<span class="price">$'.$row['p_price'].'</span></div>';
								$sum+=$row['p_price'];
							}
						}
						echo $html;
						// p_cname | p_spac | count | p_price
						// echo "<hr><pre>";
						// // print_r($cartList);
						// echo "</pre>";
					?>
					
				</div>
				<div id="sum"><span><?php echo '總計 $'.$sum; ?></span></div>
				<div id="pay"><input type="submit" value="結帳" class="btn"><a href="#" class="btn">清空購物車</a></div>
			</form>
		</main>
		<footer><?php include_once('_footer.php'); ?></footer>
	</div>
	<a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
