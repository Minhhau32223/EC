<?php
session_start(); 

include('connect.php');
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["them"])) {
        // Lấy ID của sản phẩm từ dữ liệu POST
        if (isset($_POST['id']) && isset($_POST['soLuong'])) {
            $id = $_POST['id'];
            $soLuong = $_POST['soLuong'];

            // Lấy mã người dùng từ session
            $maKH = $_SESSION['user_id'];

            // Thực hiện thêm sản phẩm vào giỏ hàng
            $sql = "INSERT INTO giohang(Manguoidung, Masp, Soluong) VALUES($maKH, $id, $soLuong)";
            if (mysqli_query($conn, $sql)) {
                echo "alert('Thêm vào giỏ hàng thành công!')";
            } else {
                echo "alert('Thêm vào giỏ hàng thất bại!')";
                echo "Lỗi: " . mysqli_error($conn);
            }
        } else {
            echo "alert('Dữ liệu không hợp lệ!')";
        }
    } else {
        echo "alert('Lỗi!')";
    }
}
?>
