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
    $mathuonghieu = $_POST['txtMakh'];
    $tenthuonghieu = $_POST['txtTenkh'];

    // Kiểm tra mã thương hiệu bắt đầu bằng "TH"
    if (strpos($mathuonghieu, 'TH') !== 0) {
        echo 'error: Mã thương hiệu phải bắt đầu bằng "TH"';
        $db->close();
        exit();
    }

    // Kiểm tra mã thương hiệu trùng lặp
    $sql_check = "SELECT * FROM thuonghieu WHERE Mathuonghieu = ?";
    $stmt_check = $db->prepare($sql_check);
    if ($stmt_check) {
        $stmt_check->bind_param('s', $mathuonghieu);
        $stmt_check->execute();
        $stmt_check->store_result();
        if ($stmt_check->num_rows > 0) {
            echo 'error: Mã thương hiệu đã tồn tại';
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

    // Thêm mới thương hiệu
    $sql = "INSERT INTO thuonghieu (Mathuonghieu, tenThuonghieu) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ss', $mathuonghieu, $tenthuonghieu);
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