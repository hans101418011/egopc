<?php
include_once('../comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}

$p_status=array(0=>'正常銷售',1=>'無庫存',2=>'停售',3=>'客戶不可見',4=>'刪除');

$qry = 'select product.*, p_type.* from product join p_type on product.p_type=p_type.type_id';
$result = $dbo->query($qry);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>e-Go PC 易購電腦-後台管理</title>
	<?php
		include_once('./_head.html');
	?>
	<script>
		$(function(){
			
			$('.delBtn').click(function(){
				var pName = $(this).parent().parent().find(".pName").text();
				var pID = $(this).attr('data-pid');
				if(confirm('確認刪除產品: ('+pID+') '+pName+' ?')){
					var pSN = [];
					pSN.push(pID);
					$.ajax({
						url:'productDel.php',
						type:'post',
						data:{'pSN':pSN},
						error:function(){
							alert('Requery Error');
						},
						success:function(info){
							// console.log('Delete info: '+info);
							alert(info);
							location.reload();
						}
					});
				}
				return false;
			});
				
		});
	</script>
</head>
<body>
    <div class="container">
		<header><?php include_once('./_header.php'); ?></header>
		<main>
			<p class="prodControl"><a href="productAdd.php" class="addBtn">新增商品</a></p>
		<table id="productList">
			<thead>
				<th>序號</th>
				<th>類別</th>
				<th>圖片</th>
				<th>商品名</th>
				<th>價格</th>
				<th>優惠價</th>
				<th>規格</th>
				<th>狀態</th>
				<th>動作</th>
			</thead>
		<?php
			while($row=$result->fetch_array()){
				echo '<tr class="pItem">';
				echo '<td class="pNo"><input type="checkbox" class="selNo" value="'.$row['p_sn'].'">'.$row['p_sn'].'</td>';
				echo '<td class="pType">'.$row['type_cname'].'</td>';
				echo '<td><img src="../productImg/tiny/'.$row['p_photo'].'"></td>';
				echo '<td class="pName">'.$row['p_cname'].'</td>';
				echo '<td class="pPrice">'.$row['p_price'].'</td>';
				echo '<td class="pDisc">'.$row['p_discount'].'</td>';
				echo '<td class="p_spec">'.$row['p_spec'].'</td>';
				echo '<td class="pStatu">'.$p_status[$row['p_status']].'</td>';
				echo '<td><a class="editBtn" href="productEdit.php?p_sn='.$row['p_sn'].'">編輯</a> <a class="delBtn" href="#" data-pid="'.$row['p_sn'].'">刪除</a></td>';
				echo '</tr>';
			};
		?>
		</table>
		</main>
		<footer><?php include_once('./_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
