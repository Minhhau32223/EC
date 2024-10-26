
<html>

<head>
  <meta charset="utf-8" />
  <title>Trang chủ</title>
  <link href="../css/home.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="../css/thongke.css?version=1.0">
  <link rel="stylesheet" href="../css/chitiethoadon.css?version=1.0">
  <link rel="stylesheet" href="../css/phieuxuat.css?version=1.0">
  <link rel="stylesheet" href="../css/dsnv.css?version=1.0">
  <link rel="stylesheet" href="../css/ncc.css?version=1.0">
  <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/middle.css?version=1.0">
  <script src="../js/home.js"></script>
  <!-- <script src="../js/chuyentab.js"></script> -->


</head>

<body style="background-color: white;">
  <div id="body-home">
    <div class="topmenu-wrap">
      <div id="topmenu">

        <?php require('./AHeader.php'); ?>
      </div>
    </div>
    <div id="middleContent"><?php include_once('./AContent.php'); ?></div>



  </div>
  <footer class="footer">
    <div class="footer__addr">
      <?php require('footer.php'); ?>

  </footer>
  </div>
</body>
