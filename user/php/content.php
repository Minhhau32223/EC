<?php
$conn = mysqli_connect('localhost', 'root', '', 'bolashop');

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}

$soSanPhamTrenTrang = 12;
$trangHienTai = isset($_GET['trang']) ? $_GET['trang'] : 1;
$batDau = ($trangHienTai - 1) * $soSanPhamTrenTrang;
$danhMuc = isset($_GET['idtl']) ? $_GET['idtl'] : '';

$sql = "SELECT * FROM sanpham";
if (!empty($danhMuc)) {
    $sql .= " WHERE Madanhmuc = '$danhMuc'";
}
$sql .= " LIMIT $batDau, $soSanPhamTrenTrang";
$result = mysqli_query($conn, $sql);

// Truy vấn để đếm tổng số sản phẩm
$sqlCount = "SELECT COUNT(*) AS total FROM sanpham";
if (!empty($danhMuc)) {
    $sqlCount .= " WHERE Madanhmuc = '$danhMuc'";
}
$resultCount = mysqli_query($conn, $sqlCount);
$rowCount = mysqli_fetch_assoc($resultCount);
$totalRecords = $rowCount['total'];
$totalPages = ceil($totalRecords / $soSanPhamTrenTrang);

if (isset($_GET['ajax'])) {
    $products = [];
    while ($row = mysqli_fetch_array($result)) {
        $products[] = $row;
    }
    echo json_encode([
        'products' => $products,
        'totalPages' => $totalPages
    ]);
    exit;
}

// Đóng kết nối
mysqli_close($conn);
?>


