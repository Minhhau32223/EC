<?php session_start();
if(isset($_SESSION['user_id'])){
  $maTK = $_SESSION['user_id'];
}?>

<html>

<head>
  <meta charset="utf-8" />
  <title>Điện máy chợ nhỏ</title>
  <link href="../css/home.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="../../themify-icons/themify-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="../js/home.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div id="body-home">
    <div class="topmenu-wrap">
      <div id="topmenu">
        <?php require('header.php'); ?>
      </div>
    </div>

    <div id="middleContent">
      <?php if (isset($_GET['chon'])) {
        if ($_GET['chon'] == 'giohang') {
          include('./cart.php');
          // }else if(isset($_GET['chon'])=='ctsp')
        }
        if ($_GET['chon'] == 'ctsp') {
          include('./chitietsanpham.php');
        }
        if ($_GET['chon'] == 'tttk') {
          include('./thongtinkhachhang.php');
        }
        if ($_GET['chon'] == 'ctdh') {
          include('./chitietdonhang.php');
        }
        if ($_GET['chon'] == 'thanhtoan') {
          include('./thanhtoan.php');}
      } else {
        include('./middleContent.php');
      } ?></div>
    </div>
    <footer class="footer">
      <div class="footer__addr">
        <?php require('./footer.php'); ?>
      </div>
    </footer>
  </div>
  <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="EC"
  agent-id="d82aff69-b586-4ace-8184-851359e01a1d"
  language-code="vi"
></df-messenger>
</body>

</html>