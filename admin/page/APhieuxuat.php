<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Phiếu xuất</title>
    <link rel="stylesheet" href="../css/thongke.css">
    <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/dsnv.css">
    <link rel="stylesheet" href="style.css?version=1.0">


</head>

<body>
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; height: 100%;">
        <div id="title">Thống kê</div>
        <div id="grid-container">
            <div class="grid-items">
                <div class="text-top-left">Số sản phẩm đã bán</div>
                <div class="number-center-left">
                    <?php
                    $con = mysqli_connect('localhost', 'root', '', 'bolashop');
                    $sql = "SELECT SUM(Soluong) AS tongsoluong FROM chitietdonhang ctdh, donhang dh WHERE ctdh.Madonhang=dh.Madonhang AND Trangthai='3'";
                    $result_sql = mysqli_query($con, $sql);
                    $row_soluong = mysqli_fetch_assoc($result_sql);
                    echo $row_soluong["tongsoluong"];
                    mysqli_close($con);


                    ?>
                </div>
                <div class="text-center-right">Sản phẩm</div>
            </div>
            <div class="grid-items">
                <div class="text-top-left">Tổng doanh thu</div>
                <div class="number-center-left"><?php
                    $con = mysqli_connect('localhost', 'root', '', 'bolashop');
                    $sql = "SELECT SUM(Tonggiatri) AS tonggiatri FROM donhang WHERE Trangthai='3'";
                    $result_sql = mysqli_query($con, $sql);
                    $row_doanhthu = mysqli_fetch_assoc($result_sql);
                    if ($row_doanhthu == "") {
                        echo "0";
                    } else {
                        echo $row_doanhthu["tonggiatri"];
                    }
                    mysqli_close($con);

                    ?></div>
                <div class="text-center-right">VNĐ</div>
            </div>
            <div class="grid-items">
                <form method="post" name="date-filter">
                    Ngày bắt đầu:
                    <input type="date" id="start-date" name="start-date" />
                    Ngày kết thúc:
                    <input type="date" id="end-date" name="end-date" />
                    <button type="submit" class="filter-btn">Lọc</button>
                </form>
            </div>

        </div>
        <div id="title">Danh sách hóa đơn</div>

        <div id="wrapper">
            <div class="table">
                <div class="table-title">
                    <div style="width: 20%; font-weight: bold;">Khách hàng</div>
                    <div style="width: 20%; font-weight: bold;">Ngày mua</div>
                    <div style="width: 20%; font-weight: bold;">Số hóa đơn</div>
                    <div style="width: 20%; font-weight: bold;">Tổng tiền</div>
                    <div style="width: 20%; font-weight: bold;">Trạng thái</div>
                </div>
                <div><br></div>
                <div><br></div>
                <div style="overflow-y: scroll;">
                    <?php
                    // Kết nối đến cơ sở dữ liệu
                    $con = mysqli_connect('localhost', 'root', '', 'bolashop');
                    if (!$con) {
                        die("Kết nối không thành công: " . mysqli_connect_error());
                    }

                    // Kiểm tra xem có lọc theo ngày hay không
                    if (isset($_POST['start-date']) && isset($_POST['end-date'])) {
                        $start_date = $_POST['start-date'];
                        $end_date = $_POST['end-date'];
                        // Truy vấn SQL để lấy các đơn hàng trong khoảng thời gian được chỉ định
                        $sql = "SELECT *, nguoidung.Ten, nguoidung.img FROM donhang JOIN nguoidung WHERE donhang.maKhachhang = nguoidung.Manguoidung AND Ngay BETWEEN '$start_date' AND '$end_date' ORDER BY Ngay DESC";
                    } else {
                        // Truy vấn SQL để lấy tất cả các đơn hàng
                        $sql = "SELECT *, nguoidung.Ten FROM donhang JOIN nguoidung WHERE donhang.maKhachhang = nguoidung.Manguoidung ORDER BY Ngay DESC";
                    }

                    // Thực thi truy vấn SQL
                    $result = mysqli_query($con, $sql);

                    // Hiển thị kết quả
                    while ($row = mysqli_fetch_array($result)) {
                        // Hiển thị thông tin của đơn hàng
                        echo '<div class="table-items">';
                        echo '<div class="customer">';
                        echo '<div class="imgHolder"><img src="../../img/' . $row['img'] . '" class="avt"></div>';
                        echo '<div class="tenuser">' . $row["Ten"] . '</div>';
                        echo '</div>';
                        echo '<div style="width: 21%;">' . $row["Ngay"] . '</div>';
                        echo '<div style="width: 10%;">' . $row["Madonhang"] . '</div>';
                        echo '<div id="tongGia"style="width: 15%;">' . $row["Tonggiatri"] . '</div>';
                        echo '<div class="DonHangbtn">';
                        echo '<button type="button" class="order-detail"><a href="chitiethoadon.php?iddh=' . $row["Madonhang"] . '">Chi tiết</a></button>';
                        if ($row["Trangthai"] == 0) {
                            echo '<div class="status-orders">Chưa xác nhận</div>';
                        }
                        if ($row["Trangthai"] == 1) {
                            echo '<div class="status-orders">Đã xử lý</div>';
                        }
                        if ($row["Trangthai"] == 2) {
                            echo '<div class="status-orders">Đang giao hàng</div>';
                        }
                        if ($row["Trangthai"] == 3) {
                            echo '<div class="status-orders">Đã giao hàng</div>';
                        }
                        if ($row["Trangthai"] == 4) {
                            echo '<div class="status-orders">Đã hủy hàng</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    // Đóng kết nối đến cơ sở dữ liệu
                    mysqli_close($con);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>