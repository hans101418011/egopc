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
    <link rel="stylesheet" href="css/slider.css">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script src="./js/slider.js"></script>

  </head>
  <body>
    <div class="container">
      <header><?php include_once('_header.php'); ?></header>
      <main>
        <div id="banner">
          <div id="slider">
            <ul>
              <li>
                <a href="#"><img src="./images/banner-01.png" alt="" /></a>
              </li>
              <li>
                <a href="#"><img src="./images/banner-02.png" alt="" /></a>
              </li>
              <li>
                <a href="#"><img src="./images/banner-03.png" alt="" /></a>
              </li>
            </ul>
          </div>
          <div id="chosePoint"></div>
          <a id="prevBtn" href="#">&#8678;</a>
          <a id="nextBtn" href="#">&#8680;</a>
        </div>
        <!-- <section id="slider">
          <div class="album">
            <a href="#"><img src="./images/banner-01.png" /></a>
            <a href="#"><img src="./images/banner-02.png" /></a>
            <a href="#"><img src="./images/banner-03.png" /></a>
            <a href="#"><img src="./images/banner-01.png" /></a>
          </div>
        </section> -->
        <section class="prod">
          <h3>精選商品</h3>
          <?php
            $qry = 'select * from `product` where `p_promotion`=1 order by `p_sn` DESC limit 0,8';
            $result = $dbo->query($qry);
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
        </section>
        <!-- <section class="news">
          <h3>最新資訊</h3>
          <div>
            <img src="https://fakeimg.pl/160x160/999" />
            <div class="right">
              <a href="#01">
                <p class="news_titl">日報市政府登陸深入為您簡直，生物配件關。</p>
                <p class="news_date">2099/09/09</p>
                <p class="news_cont">元素第三因而看到以上，原理法院相關文章財產唯一代表英語那是讓你對不起，師傅處罰要求到達，提問凱文每。</p>
              </a>
            </div>
          </div>
          <div>
            <img src="https://fakeimg.pl/160x160/999" />
            <div class="right">
              <a href="#02">
                <p class="news_titl">轉變高興外貿最高轉帖，版主人員，舉辦動。</p>
                <p class="news_date">2099/09/09</p>
                <p class="news_cont">水果健康厲害共享版通常提醒足夠導致希望地方，注意線路她們但我一大多年認證審核，是以動物實力優勢，願。</p>
              </a>
            </div>
          </div>
          <div>
            <img src="https://fakeimg.pl/160x160/999" />
            <div class="right">
              <a href="#03">
                <p class="news_titl">走到呼吸也就是變得尋找你怎不來處理器安。</p>
                <p class="news_date">2099/09/09</p>
                <p class="news_cont">報名一方面只能，門派女兒，桌面外國一步要求腦袋，線上回去一方面，擴大組織加速身份廣告聽到理論討論特。</p>
              </a>
            </div>
          </div>
        </section> -->
      </main>
      <footer><?php include_once('_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
    <script>
    $(function () {
			// hi
			$("#slider img:last").on("load", function () {
				var imgNum = $("#banner img").length;
				// console.log($("#banner img").length);
				$(window).resize();
				for (var i = 0; i < imgNum; i++) {
					$('#chosePoint').append('<a href="#" class="point" data-imgP="' + i + '"></a>');
				}
				graphPoint(nowIndex);
				$('.point').click(function () {
					clearInterval(sliderAction);
					var goIndex = $(this).attr('data-imgp');
					// console.log('go: ' + goIndex + ' , now: ' + nowIndex);
					if (nowIndex > goIndex) {
						do {
							prSlide();
							// console.log('go: ' + goIndex + ' , now: ' + nowIndex);
						} while (nowIndex != goIndex);
					} else if (nowIndex < goIndex) {
						do {
							nxSlide();
							// console.log('go: ' + goIndex + ' , now: ' + nowIndex);
						} while (nowIndex != goIndex);
					}
					sliderAction = setInterval(nxSlide, 4000);
					return false;
				});
			});

			$("#nextBtn").click(function () {
				nxSlide();
				clearInterval(sliderAction);
				sliderAction = setInterval(nxSlide, 4000);
				return false;
			});
			$("#prevBtn").click(function () {
				prSlide();
				clearInterval(sliderAction);
				sliderAction = setInterval(nxSlide, 4000);
				return false;
			});
			sliderAction = setInterval(nxSlide, 4000);
		});
    </script>
  </body>
</html>
