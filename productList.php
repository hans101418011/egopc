<?php
include_once('comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}
$qry = 'select product.* from product order by p_sn DESC';
$result = $dbo->query($qry);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-Go PC 易購電腦-商品列表</title>
    <link rel="shortcut icon" href="./images/favicon.gif" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/color.css" />
</head>
<body>
    <div class="container">
		<header><?php include_once('_header.php'); ?></header>
		<main>
		<section class="prod">
			<h3>商品列表</h3>
			<?php
				while($row=$result->fetch_array()){
					echo '<div class="pItem"><a href="productDetl.php?p_sn='.$row['p_sn'].'">';
					echo '<img src="productImg/tiny/'.$row['p_photo'].'">';
					echo '<p class="prod_name">'.$row['p_cname'].'</p>';
					if(isset($row['p_discount'])){
						echo '<p class="prod_price">'.$row['p_discount'].'</p>';
					}else{
						echo '<p class="prod_price">'.$row['p_price'].'</p>';
					}
					echo '</a></div>';
				};
			?>
		</main>
		<footer><?php include_once('_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
