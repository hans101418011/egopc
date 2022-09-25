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
	<style>

	</style>
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
					<?php
					if(isset($row['p_discount'])){
						echo '<p class="pPrice">特價 &#36;'.$row['p_discount'].'</p>';
					}else{
						echo '<p class="pPrice">售價 &#36;'.$row['p_price'].'</p>';
					}
					?>
				</div>
			</div>
		</main>
		<footer><?php include_once('_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
