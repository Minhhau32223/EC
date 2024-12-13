<?php
require_once('../../db_connect.php');
require_once('../../role_check.php');
$conn = new Database();
$features_list = $conn->query("SELECT * FROM chucnang");

$userAuth = new userAuth($conn);
$view_permission_list = $userAuth->view_permission_list;

$conn->close();

function checkReadPermission($view_permission_list, $feature_id)
{
  if (in_array($feature_id, $view_permission_list)) {
    return ' ';
  } else {
    return 'hidden'; 
  }
}


?>

<html>

<head>
    <meta charset="utf-8" />
    <!-- <link rel="stylesheet" href="../css/home.css?version=1.0" /> -->
    <link rel="stylesheet" href="../css/menuadmin.css?version=1.0" />

</head>

<body>
  
        <div class="topmenu-wrap">
            <div id="topmenu-admin">
                <div class="logo-bola">
                    <b><a href="AHome.php"> </a></b>
                </div>

             

                <div class="menu">
                    <div class="option <?=checkReadPermission($view_permission_list, "CN009")?>" id="thongke"><a href="AHome.php?chon=t&id=thongke" onclick="selectOption(this)">Thống kê</a></div>
                    <div class="option <?=checkReadPermission($view_permission_list, "CN003")?>" id="sanpham"><a href="AHome.php?chon=t&id=sanpham" onclick="selectOption(this)">Sản phẩm</a></div>
                    <div class="option <?=checkReadPermission($view_permission_list, "CN007")?>" id="phieunhap"><a href="AHome.php?chon=t&id=phieunhap">Phiếu nhập</a></div>
                    <div class="option <?=checkReadPermission($view_permission_list, "CN005")?>"  id="donhang"><a href="AHome.php?chon=t&id=donhang">Đơn hàng</a></div>
                    <div class="option <?=checkReadPermission($view_permission_list, "CN008")?>" id="nhacungcap"><a href="AHome.php?chon=t&id=nhacungcap">Nhà cung cấp</a></div>
                    <div class="option <?=checkReadPermission($view_permission_list, "CN004")?>" id="nguoidung"><a href="AHome.php?chon=t&id=nguoidung">Người dùng</a></div>
                    <div class="option" id="cart">Khác
                        <div class="sub-menu">
                            <ul>
                                <li class="<?=checkReadPermission($view_permission_list, "CN006")?>"><a href="AHome.php?chon=t&id=quyen">Quyền</a></li>
                                <li class="<?=checkReadPermission($view_permission_list, "CN010")?>"><a href="AHome.php?chon=t&id=khuyenmai">Khuyến mãi</a></li>
                                <li class="<?=checkReadPermission($view_permission_list, "CN011")?>"><a href="AHome.php?chon=t&id=vanchuyen">Vận chuyển</a></li>
                                <li class="<?=checkReadPermission($view_permission_list, "CN012")?>"><a href="AHome.php?chon=t&id=thuonghieu">Thương hiệu</a></li>
                                <li class="<?=checkReadPermission($view_permission_list, "CN013")?>"><a href="AHome.php?chon=t&id=danhmuc">Danh mục</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['user_id'])) {
                        $maND = $_SESSION['user_id'];

                        $conn = mysqli_connect("localhost", "root", "", "bolashop");

                        if (!$conn) {
                            die("Kết nối thất bại: " . mysqli_connect_error());
                        }

                        $sql = "SELECT img FROM nguoidung WHERE Manguoidung='$maND'";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $imgSrc = $row["img"];
                        } else {
                            // Nếu không có dữ liệu ảnh, bạn có thể sử dụng ảnh mặc định hoặc hiển thị một tin nhắn cho người dùng
                            $imgSrc = "path_to_default_image.jpg";
                        }

                        // Đóng kết nối CSDL
                        mysqli_close($conn);
                    }
                    ?>
                    <div class="user-icon">
                        <img src="../../img/<?php echo $imgSrc; ?>" alt="Avatar" class="avt">

                        <div class="sub-menu">
                            <ul>
                                <?php
                                // session_start();
                                if (isset($_SESSION['user_id'])) {
                                    // Nếu đã đăng nhập
                                    echo '<li><a href="../../user/php/home.php?chon=tttk">Thông tin tài khoản</a></li>';
                                    echo '<li><a href="../../user/php/home.php">Về trang mua hàng</a></li>';
                                    echo '<li><a href="../../user/php/logout.php">Đăng xuất</a></li>';
                                } else {
                                    // Nếu chưa đăng nhập
                                    echo '<li><a href="../../user/php/dangnhap.php">Đăng nhập</a></li>';
                                    // echo '<li><a href="./dangky.php">Đăng ký</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- <div class="sub-menu">
                            <ul>
                                <li><a href="../../user/php/dangnhap.php">Đăng nhập</a></li>
                                <li><a href="../../user/php/logout.php">Đăng xuất</a></li>

                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    
    <script>


    </script>
</body>

</html>