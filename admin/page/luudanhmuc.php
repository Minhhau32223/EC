<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'bolashop';

$db = new mysqli($server, $user, $pass, $database);

if ($db->connect_error) {
    die("Kết nối thất bại: " . $db->connect_error);
}

mysqli_query($db, "SET NAMES 'utf8'");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $madanhmuc = $_POST['txtMakh'];
    $tendanhmuc = $_POST['txtTenkh'];

    // Kiểm tra mã danh mục bắt đầu bằng "TH"
    if (strpos($madanhmuc, 'DM') !== 0) {
        echo 'error: Mã danh mục phải bắt đầu bằng "TH"';
        $db->close();
        exit();
    }

    // Kiểm tra mã danh mục trùng lặp
    $sql_check = "SELECT * FROM danhmuc WHERE Madanhmuc = ?";
    $stmt_check = $db->prepare($sql_check);
    if ($stmt_check) {
        $stmt_check->bind_param('s', $madanhmuc);
        $stmt_check->execute();
        $stmt_check->store_result();
        if ($stmt_check->num_rows > 0) {
            echo 'error: Mã danh mục đã tồn tại';
            $stmt_check->close();
            $db->close();
            exit();
        }
        $stmt_check->close();
    } else {
        echo 'error: ' . $db->error;
        $db->close();
        exit();
    }

    // Thêm mới danh mục
    $sql = "INSERT INTO danhmuc (Madanhmuc, Tendanhmuc) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $madanhmuc, $tendanhmuc);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        echo 'error: ' . $db->error;
    }
}

$db->close();
?>