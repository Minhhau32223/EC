<?php
session_start(); // Khởi tạo session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Kết nối đến cơ sở dữ liệu (sử dụng connect.php hoặc tương tự)
    include('connect.php');
    $conn = connectDB();

    // Lấy mã người dùng từ session
    $maKH = $_SESSION['user_id'];

    // Lấy mã sản phẩm muốn xóa từ dữ liệu POST
    $masp = $_POST['product_id'];

    // Xóa sản phẩm khỏi giỏ hàng
    $delete_query = "DELETE FROM giohang WHERE Manguoidung = '$maKH' AND Masp = '$masp'";
    $conn->query($delete_query);

    // Đóng kết nối
    mysqli_close($conn);

    // Chuyển hướng trở lại trang giỏ hàng sau khi xóa sản phẩm
    header("Location: cart.php");
    exit();
}
?>
