<?php
session_start();
$maKH = $_SESSION['user_id'];

// Kết nối đến cơ sở dữ liệu
$server ='localhost';
$user ='root';
$pass = '';
$database = 'bolashop';

$db = new mysqli($server, $user, $pass,$database);

if($db) {
    mysqli_query($db,"SET NAMES 'utf8' ");
} else {
    echo 'ket noi that bai';
}

// Xử lý yêu cầu AJAX
if(isset($_POST['masp']) && isset($_POST['action'])) {
    $masp = $_POST['masp'];
    $action = $_POST['action'];

    // Lấy số lượng sản phẩm hiện tại
    $sql_select = "SELECT soluong FROM giohang WHERE Manguoidung = '$maKH' AND Masp = '$masp'";
    $result = mysqli_query($db, $sql_select);
    $row = mysqli_fetch_assoc($result);
    $soluong = $row['soluong'];

    // Cập nhật số lượng sản phẩm dựa trên hành động
    if($action === 'decrease' && $soluong > 1) {
        $soluong--;
    } elseif($action === 'increase') {
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
