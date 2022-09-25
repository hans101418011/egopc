<?php

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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/slider.js"></script>
    <script>
      $(function () {
        $(window).resize();
      });
    </script>
  </head>
  <body>
    <div class="container">
      <header><?php include_once('_header.php'); ?></header>
      <main>
        <div id="banner">
          <ul class="sViewer">
            <li><a href="#"><img src="https://fakeimg.pl/1600x600/333" /></a></li>
            <li><a href="#"><img src="https://fakeimg.pl/1600x600/666" alt="" /></a></li>
            <li><a href="#"><img src="https://fakeimg.pl/1600x600/999" alt="" /></a></li>
            <li><a href="#"><img src="https://fakeimg.pl/1600x600/ccc" alt="" /></a></li>
            <li><a href="#"><img src="https://fakeimg.pl/1600x600/fff" alt="" /></a></li>
          </ul>
          <div id="sliderPoint">
              <a href="#" id="sp1"></a>
              <a href="#" id="sp2"></a>
              <a href="#" id="sp3"></a>
              <a href="#" id="sp4"></a>
              <a href="#" id="sp5"></a>
            </div>
        </div>
        <section>
          <h1>Hellow</h1>
        </section>
      </main>
      <footer><?php include_once('_footer.php'); ?></footer>
    </div>
    <a id="gotop" href="#">&#x21e7;</a>
  </body>
</html>
