<?php
include_once('comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}

if(isset($_GET['p_sn'])){
	$p_sn = $dbo->real_escape_string($_GET['p_sn']);
	$qry='select * from `product` where `p_sn`='.$p_sn.' limit 0,1';
	$row = $dbo->query($qry)->fetch_array();
}

$pdNum = 0;
if(isset($_COOKIE['cartList'])){
	$cartList = json_decode($_COOKIE['cartList'],true);
	$pdNum = count($cartList);
}


// setcookie("cartList",'',0);
// unset($_COOKIE["cartList"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-Go PC 易購電腦-商品資訊</title>
    <link rel="shortcut icon" href="./images/favicon.gif" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/color.css" />
	<link rel="stylesheet" href="css/prodDetl.css">
	<script src="./js/jquery-3.3.1.min.js"></script>
	<script>
		$(function(){
			var pdNum = <?php echo $pdNum ?>;
			$("#addCart").click(function(){
				var pSN = $(this).attr('data-psn');

				$.ajax({
					url:'cartAddQ.php',
					type:'post',
					data:{'addPSN':pSN},
					error:function(){
						alert('系統錯誤!! 請稍後再試');
					},
					success:function(info){
						var html = info.substr(4);
						var status = info.substring(0,3);
						if(status=="200"){
							console.log(html);
							pdNum++;
							$("#cartList").append(html);
							console.log(pdNum);
							$("#pNum").text(pdNum);
							alert("加入購物車成功");
						}else if(status=="404"){
							alert("商品不存在或已下架");
						}else if(status=="401"){
							alert("錯誤，請重整畫面");
						}else{
							console.log(info);
						}
					}
				});
				
				return false;
			});

			$("#cartIcon").click(function(){
				$("#cartList").stop().animate({"right":"0px"},500);
			});
			$("#closeList").click(function(){
				$("#cartList").stop().animate({"right":"-300px"},500);
			});
		});
	</script>
</head>
<body>
    <div class="container">
		<header><?php include_once('_header.php'); ?></header>
		<main>
			<h3>商品</h3>
			<div id="productDetl">
				<div class="pImg">
					<img src="./productImg/<?php echo $row['p_photo']; ?>" alt="<?php echo $row['p_cname']; ?>">
				</div>
				<div class="contain">
					<p class="pName"><?php echo $row['p_cname']; ?></p>
					<p class="pSpec"><?php echo $row['p_spec']; ?></p>
					<p class="pDesc"><?php echo $row['p_desc']; ?></p>
					<a id="addCart" href="#" data-pSN="<?php echo $row['p_sn'] ?>"><svg enable-background="new 0 0 64 64" height="64px" id="Layer_1" version="1.0" viewBox="0 0 64 64" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><circle cx="20" cy="57" fill="currentColor" r="6" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><circle cx="44" cy="57" fill="currentColor" r="6" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><line fill="currentColor" stroke="#000000" stroke-miterlimit="10" stroke-width="2" x1="26" x2="38" y1="57" y2="57"/><polyline fill="currentColor" points="14,57 10,2 0,2 " stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><polyline fill="currentColor" points="13,43 56,40 63,10 11,10 " stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><polyline fill="currentColor" points="44,27 36,35   28,27 " stroke="#000000" stroke-linejoin="bevel" stroke-miterlimit="10" stroke-width="2"/><g><line fill="currentColor" stroke="#000000" stroke-miterlimit="10" stroke-width="2" x1="36" x2="36" y1="35" y2="15"/></g></svg>加入購物車</a>
					<?php
					if(isset($row['p_discount'])){
						echo '<p class="pPrice">特價 &#36;'.$row['p_discount'].'</p>';
					}else{
						echo '<p class="pPrice">售價 &#36;'.$row['p_price'].'</p>';
					}
					?>
				</div>
			</div>
			<?php // print_r($_COOKIE); ?>
		</main>
		<footer><?php include_once('_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
	<a id="cartIcon" href="#"><span id="pNum"><?php echo $pdNum; ?></span><svg enable-background="new 0 0 64 64" height="64px" id="Layer_1" version="1.0" viewBox="0 0 64 64" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><circle cx="20" cy="57" fill="currentColor" r="6" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><circle cx="44" cy="57" fill="currentColor" r="6" stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><line fill="currentColor" stroke="#000000" stroke-miterlimit="10" stroke-width="2" x1="26" x2="38" y1="57" y2="57"/><polyline fill="currentColor" points="14,57 10,2 0,2 " stroke="#000000" stroke-miterlimit="10" stroke-width="2"/><polyline fill="currentColor" points="13,43 56,40 63,10 11,10 " stroke="#000000" stroke-miterlimit="10" stroke-width="2"/></svg></a>
	<div id="cartList">
		<a id="closeList" href="#">&#8677;</a>
		<?php
			$html ='';
			for($i=0;$i<$pdNum;$i++){
				$p_sn = $cartList[$i]['p_sn'];
				// print_r($cartList);
				$qry='select * from `product` where `p_sn`='.$p_sn.' limit 0,1';
				$p_sn = $dbo->real_escape_string($_GET['p_sn']);
				$row = $dbo->query($qry)->fetch_array();
				$html = '<div class="cartItem" data-psn="'.$p_sn.'">';
				$html .= '<span>'.$row['p_cname'].'</span>';
				if(isset($row['p_discount'])){
					$html .= '<span>$'.$row['p_discount'].'</span>';
				}else{
					$html .= '<span>$'.$row['p_price'].'</span>';
				}
				$html .= '<a href="#" data-del-cartsn="'.$i.'"></a>';
				$html .= '</div>';
				echo $html;
			}
		?>
		<div class="listBtn"><a id="checkout" href="cart.php">前往購物清單</a><a id="claerCart" href="clearCart.php?p_sn=<?php echo $p_sn; ?>">清空購物清單</a></div>
	</div>
</body>
</html>
