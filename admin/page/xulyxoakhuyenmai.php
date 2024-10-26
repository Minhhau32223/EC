<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Magiamgia'])) {
    $magiamgia = $_POST['Magiamgia'];

    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bolashop"; // Thay bằng tên cơ sở dữ liệu của bạn

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $magiamgia = $_POST['Magiamgia'];

    // Xóa mã khuyến mãi từ cơ sở dữ liệu
    $sql = "DELETE FROM giamgia WHERE Magiamgia = '$magiamgia'";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>
