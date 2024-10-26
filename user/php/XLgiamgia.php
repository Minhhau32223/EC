<?php
// Kết nối đến cơ sở dữ liệu
include('./connect.php');
$conn = connectDB();

// Lấy tên nhà vận chuyển từ yêu cầu
$maGG = $_POST['data'];

// Truy vấn cơ sở dữ liệu để lấy phí vận chuyển

$stmt = mysqli_prepare($conn, "SELECT Mucgiam FROM giamgia WHERE Magiamgia = ?");
mysqli_stmt_bind_param($stmt, 's', $maGG);
mysqli_stmt_execute($stmt);
// $affectedRows = mysqli_stmt_affected_rows($stmt);
mysqli_stmt_bind_result($stmt, $giamgia);
if (mysqli_stmt_fetch($stmt)) {
    echo trim($giamgia." VND");
}else{
    echo "0 VND";
}
?>