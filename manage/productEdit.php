<?php
include_once('../comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
}

if(isset($_GET['p_sn'])){
	$p_sn = $dbo->real_escape_string($_GET['p_sn']);
	$qry='select * from `product` where `p_sn`='.$p_sn;
	$row = $dbo->query($qry)->fetch_array();
}
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
	$(function() {
		$('#productAdd').submit(function(){
			var pd = new FormData();
			pd.append('p_sn',$('#p_sn').val());
			pd.append('p_type',$('#p_type').val());
			pd.append('p_cname',$('#p_cname').val());
			// pd.append('p_ename',$('#p_ename').val());
			pd.append('p_price',$('#p_price').val());
			pd.append('p_discount',$('#p_discount').val());
			pd.append('p_photo',$('#p_photo').prop('files')[0]);
			pd.append('p_desc',$('#p_desc').val());
			pd.append('p_spec',$('#p_spec').val());
			pd.append('p_promotion',$('input[name=p_promotion]:checked').val());
			pd.append('p_status',$('#p_status').val());
			
			$.ajax({
				url:'productEditQ.php',
				type:'post',
				data:pd,
				contentType:false,
				processData:false,
				error:function(){
					alert('Upload Error');
				},
				success:function(info){
					console.log('Upload info : '+info);
					if(info=='Update'){
					// alert('已更新');
						$('#msg').html('已更新').addClass('msg info');
					}else{
					// alert('更新失敗');
						$('#msg').html('更新錯誤').addClass('msg err');
					}
				}
			});
			return false;
		});
		$('#p_photo').change(function(){
			var fileURL=URL.createObjectURL($(this).prop('files')[0]);
			$('#previewImg').attr('src',fileURL);
		});

	});
	</script>
</head>
<body>
    <div class="container">
		<header><?php include_once('./_header.php'); ?></header>
		<main>
			<h3>商品修改</h3>
			<p id="msg"></p>
			<form id="productAdd">
				<input type="hidden" id="p_sn" name="p_sn" value="<?php echo $row['p_sn']; ?>">
				<p><label for="p_type">類別：</label>
					<select name="p_type" id="p_type" required><?php
						$qType = "select * from `p_type` order by type_id ASC";
						$resType = $dbo->query($qType);
						while($rowType=$resType->fetch_array()){
							$sel=$row['p_type']==$rowType['type_id']?' selected ':'';
							echo '<option value="'.$rowType['type_id'].'" '.$sel.'>'.$rowType['type_name'].$rowType['type_cname'].'</option>';
						}
					?></select>
				</p>
				<p><label for="p_cname">名稱：</label><input type="text" id="p_cname" name="p_cname" maxlength="20" value="<?php echo $row['p_cname']; ?>" required></p>
				<p><label for="p_price">單價：</label><input type="number" id="p_price" name="p_price" value="<?php echo $row['p_price']; ?>" required></p>
				<p><label for="p_discount">優惠：</label><input type="number" id="p_discount" name="p_discount" value="<?php echo $row['p_discount']; ?>" ></p>
				<p><label for="p_photo">圖片：</label><input type="file" name="p_photo" id="p_photo" accept="image/jpeg"><img id="previewImg" alt="預覽圖" src="<?php echo '../productImg/tiny/'.$row['p_photo']; ?>"></p>
				<p><label for="">規格：</label><textarea name="p_spec" id="p_spec"><?php echo $row['p_spec']; ?></textarea required></p>
				<p><label for="">說明：</label><textarea name="p_desc" id="p_desc"><?php echo $row['p_desc']; ?></textarea></p>
				<p><label for="">促銷：</label>
					<input type="radio" name="p_promotion" id="non-promotion" value="0" <?php echo $row['p_promotion']?'':'checked'; ?>><label for="non-promotion">非促銷</label>
					<input type="radio" name="p_promotion" id="promotion" value="1"  <?php echo $row['p_promotion']?'checked':''; ?>><label for="promotion">首頁促銷</label>
				</p>
				<p><label for="">狀態：</label>
				<select name="p_status" id="p_status">
					<option value="0" <?php if($row['p_status']==0)echo ' selected ';?>>正常銷售</option>
					<option value="1" <?php if($row['p_status']==1)echo ' selected ';?>>無庫存</option>
					<option value="2" <?php if($row['p_status']==2)echo ' selected ';?>>停售</option>
					<option value="3" <?php if($row['p_status']==3)echo ' selected ';?>>使用者不可見</option>
				</select>
				</p>
				<p class='formBtn'><input type="submit" value="更新"></p>
			</form>
		</main>
		<footer><?php include_once('./_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
