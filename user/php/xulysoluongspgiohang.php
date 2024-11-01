<?php
session_start();
$maKH = $_SESSION['user_id'];

// Kết nối đến cơ sở dữ liệu
$server ='localhost';
$user ='root';
$pass = '';
$database = 'bolashop';

$db = new mysqli($server, $user, $pass, $database);

if($db) {
    mysqli_query($db, "SET NAMES 'utf8'");
} else {
    echo 'Kết nối thất bại';
}

// Xử lý yêu cầu AJAX
if(isset($_POST['masp']) && isset($_POST['action'])) {
    $masp = $_POST['masp'];
    $action = $_POST['action'];

    // Lấy số lượng sản phẩm hiện tại trong giỏ hàng
    $sql_select_cart = "SELECT soluong FROM giohang WHERE Manguoidung = '$maKH' AND Masp = '$masp'";
    $result_cart = mysqli_query($db, $sql_select_cart);
    $row_cart = mysqli_fetch_assoc($result_cart);
    $soluong = $row_cart['soluong'];

    // Lấy số lượng sản phẩm còn lại trong kho
    $sql_select_stock = "SELECT Soluongconlai FROM sanpham WHERE Masp = '$masp'";
    $result_stock = mysqli_query($db, $sql_select_stock);
    $row_stock = mysqli_fetch_assoc($result_stock);
    $Soluongconlai = $row_stock['Soluongconlai'];

    // Kiểm tra và cập nhật số lượng sản phẩm dựa trên hành động
    if($action === 'decrease' && $soluong > 1) {
        $soluong--;
    } elseif($action === 'increase') {
        if($soluong + 1 > $Soluongconlai) {
            $message = -1;
            echo $message;
            exit;
        }
        $soluong++;
    }

    // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
    $sql_update = "UPDATE giohang SET soluong = '$soluong' WHERE Manguoidung = '$maKH' AND Masp = '$masp'";
    if ($db->query($sql_update) === TRUE) {
        echo $soluong;
    } else {
        echo "Lỗi: " . $db->error;
    }
}

// Đóng kết nối với cơ sở dữ liệu
$db->close();
?>
