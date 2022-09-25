<?php
include_once('../comm/dbo.php');
if(!isset($_SESSION)){
	session_start();
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
				url:'productAddQ.php',
				type:'post',
				data:pd,
				contentType:false,
				processData:false,
				error:function(){
					alert('Upload Error');
				},
				success:function(info){
					console.log('Upload info : '+info);
					if(info=='Added'){
					// alert('已新增');
						$('#msg').html('已新增').addClass('msg info');
						$('[type="text"], [type="file"], [type="number"], textarea, #p_type, #p_status').val('');
						$('#previewImg').attr('src','');
					}else{
					// alert('新增失敗');
						$('#msg').html('新增錯誤').addClass('msg err');
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
			<h3>商品新增</h3>
			<p id="msg"></p>
			<form id="productAdd">
				<p><label for="p_type">類別：</label>
					<select name="p_type" id="p_type" required><?php
						$qType = "select * from `p_type` order by type_id ASC";
						$resType = $dbo->query($qType);
						while($rowType=$resType->fetch_array()){
							echo '<option value="'.$rowType['type_id'].'">'.$rowType['type_name'].$rowType['type_cname'].'</option>';
						}
					?></select>
				</p>
				<p><label for="p_cname">名稱：</label><input type="text" id="p_cname" name="p_cname" maxlength="20" required></p>
				<p><label for="p_price">單價：</label><input type="number" id="p_price" name="p_price" required></p>
				<p><label for="p_photo">圖片：</label><input type="file" name="p_photo" id="p_photo" accept="image/jpeg"><img id="previewImg" alt="預覽圖"></p>
				<p><label for="">規格：</label><textarea name="p_spec" id="p_spec"></textarea required></p>
				<p><label for="">說明：</label><textarea name="p_desc" id="p_desc"></textarea></p>
				<p><label for="">促銷：</label>
					<input type="radio" name="p_promotion" id="non-promotion" value="0" checked><label for="non-promotion">非促銷</label>
					<input type="radio" name="p_promotion" id="promotion" value="1"><label for="promotion">首頁促銷</label>
				</p>
				<p><label for="">狀態：</label>
				<select name="p_status" id="p_status">
					<option value="0">正常銷售</option>
					<option value="1">無庫存</option>
					<option value="2">停售</option>
					<option value="3">使用者不可見</option>
				</select>
				</p>
				<p class='formBtn'><input type="submit" value="新增"></p>
			</form>
		</main>
		<footer><?php include_once('./_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
