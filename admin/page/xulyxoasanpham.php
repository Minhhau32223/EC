<?php
include("../page/connectDB.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Masp'])) {
    $maSanPham = $_POST['Masp'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete related rows in giohang
        $stmt1 = $conn->prepare("DELETE FROM giohang WHERE Masp = ?");
        $stmt1->bind_param("s", $maSanPham);
        $stmt1->execute();
        $stmt1->close();

        // Delete product in sanpham
        $stmt2 = $conn->prepare("DELETE FROM sanpham WHERE Masp = ?");
        $stmt2->bind_param("s", $maSanPham);
        $stmt2->execute();
        $stmt2->close();

        // Commit transaction
        $conn->commit();

        echo "Xóa sản phẩm thành công!";
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        throw $exception;
    }

    $conn->close();
} else {
    echo "Không nhận được mã sản phẩm!";
}
?>
