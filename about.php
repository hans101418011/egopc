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
    <link rel="stylesheet" href="css/about.css">
    <script src="./js/jquery-3.3.1.min.js"></script>
    <script>

    </script>
  </head>
  <body>
    <div class="container">
      <header><?php include_once('_header.php'); ?></header>
      <main>
        <section id="about">
          <h2>關於我們</h2>
          <article>
            <p>此網站為職訓局在巨匠開班授課指導設計作品，網站由Hans Chen設計製作，並非真實存在。</p>
          </article>
          <h2>關於圖片素材</h2>
          <article>
            <p>icon來自<a href="https://www.iconfinder.com/icons/8608590/ecommerce_cart_content_icon" target="_blank">ICONFINDER</a>，採用 <a href="https://creativecommons.org/licenses/by/4.0/" target="_blank">Attribution 4.0 International (CC BY 4.0)</a>。</p>
            <p>Logo及其他圖像為網頁製作者自行繪製。</p>
          </article>
        </section>
      </main>
      <footer><?php include_once('_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
  </body>
</html>
