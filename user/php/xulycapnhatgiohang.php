<?php
// Khởi tạo session và kết nối đến cơ sở dữ liệu
include('connect.php');
$conn = connectDB();

if(isset($_POST['masp']) && isset($_POST['soluong'])) {
    // Lấy mã sản phẩm và số lượng từ yêu cầu
    $masp = $_POST['masp'];
    $soluong = $_POST['soluong'];

    // Lấy mã người dùng từ session
    $maKH = $_SESSION['user_id'];

    // Thực hiện truy vấn cập nhật số lượng sản phẩm trong giỏ hàng
    $sql = "UPDATE giohang SET soluong = '$soluong' WHERE Masp = '$masp' AND Manguoidung = '$maKH'";
    $result = mysqli_query($conn, $sql);

    if($result) {
        // Trả về phản hồi nếu cần
        echo "Cập nhật số lượng sản phẩm thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
