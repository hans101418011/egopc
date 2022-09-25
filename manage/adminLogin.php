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
</head>
<body>
    <div class="container">
		<header><?php include_once('./_header.php'); ?></header>
		<main>
		
		</main>
		<footer><?php include_once('./_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
</body>
</html>
