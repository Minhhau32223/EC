
<?php session_start();
if(isset($_SESSION['user_id'])){
  $maTK = $_SESSION['user_id'];
}

?>


<html>

<head>
  <meta charset="utf-8" />
  <title>Trang chủ</title>
  <link href="../css/home.css?v=<?php echo time(); ?>" rel="stylesheet" />
  <script src="../js/home.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div id="body-home">
    <div class="topmenu-wrap">
      <div id="topmenu">
        <!-- <div class="logo-bola">
               <b> BOLA</b>
            </div>
            <form name="search" method="get">
            
              <input type="search" id="search-bar" placeholder="Search..." name="txtSearch"/>
              </form>
            <div class="menu">
                
                    <div class="option">Sản phẩm</div>
                    <div class="option">Túi xách</div>
                    <li class="cart">Giỏ hàng</li>
               
                <div class="user-icon">
                    
                </div>
            </div> -->
        <?php require('header.php'); ?>
      </div>
    </div>

    <div id="middleContent"><?php if (isset($_GET['chon'])) {
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

    <script>

    </script>
  </div>
  <footer class="footer">
    <div class="footer__addr">
      <?php require('./footer.php'); ?>
      
    </div>
  </footer>
  </div>
</body>

</html>