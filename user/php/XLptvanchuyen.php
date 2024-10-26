<?php
// Kết nối đến cơ sở dữ liệu
include('./connect.php');
$conn = connectDB();

// Lấy tên nhà vận chuyển từ yêu cầu
$maVC = $_POST['data'];

// Truy vấn cơ sở dữ liệu để lấy phí vận chuyển
// if(!$maVC){
//     echo "<script>alert('Vui lòng chọn phương thức vận chuyển!')</script>";
// }
$stmt = mysqli_prepare($conn, "SELECT Gia FROM vanchuyen WHERE Mavc = ?");
mysqli_stmt_bind_param($stmt, 's', $maVC);
mysqli_stmt_execute($stmt);
// $affectedRows = mysqli_stmt_affected_rows($stmt);
mysqli_stmt_bind_result($stmt, $phiVC);
if (mysqli_stmt_fetch($stmt)) {
    echo trim($phiVC." VND");
}
mysqli_close($conn);
?>
