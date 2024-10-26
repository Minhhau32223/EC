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
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
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
                        // $sql_total = mysqli_query($con, "SELECT SUM(s.Giaban * c.Soluong) AS TongTien FROM chitietdonhang c JOIN sanpham s ON c.Masp = s.Masp WHERE c.Madonhang = " . $row["Madonhang"]);

                        // // Lấy tổng giá trị của đơn hàng từ kết quả của truy vấn
                        // $row_total = mysqli_fetch_assoc($sql_total);
                        // $total_price = $row_total["TongTien"];
                        // $ma = $row["Madonhang"];

                        // // Cập nhật giá trị tổng tiền vào cột Tonggiatri trong bảng donhang
                        // $update_query = "UPDATE donhang SET Tonggiatri = $total_price WHERE Madonhang = " . $row["Madonhang"];
                        // mysqli_query($con, $update_query);

                        // Hiển thị thông tin của đơn hàng
                        echo '<div class="table-items">';
                        echo '<div class="customer">';
                        echo '<div ><img src="../../img/' . $row['img'] . '"class="avt"></div>';
                        echo '<div>' . $row["Ten"] . '</div>';
                        echo '</div>';
                        echo '<div style="width: 20%;">' . $row["Ngay"] . '</div>';
                        echo '<div style="width: 20%;">' . $row["Madonhang"] . '</div>';
                        echo '<div style="width: 20%;">' . $row["Tonggiatri"] . '</div>';
                        echo '<div class="btn">';
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
                        echo '<button type="button" class="order-detail"><a href="chitiethoadon.php?iddh=' . $row["Madonhang"] . '">Chi tiết</a></button>';
                        echo '</div>';
                    }
                    // Đóng kết nối đến cơ sở dữ liệu
                    mysqli_close($con);
                    ?>


                    <!-- <div class="table-items">
                        <div class="customer">
                            <div class="avt"></div>
                            <div>KH001</div>
                        </div>
                        <div style="width: 20%;">29/03/2004</div>
                        <div style="width: 20%;">12011252_donhang</div>
                        <div style="width: 20%;">120210</div>
                        <div class="btn">
                            <select>
                                <option id="status" value="1">Hoàn thành</option>
                                <option id="status" value="1">Đang giao hàng</option>
                                <option id="status" value="1">Đã chuyển hàng</option>
                            </select>
                            <button type="button">Sửa</button>
                        </div>
                    </div>
                    <div class="table-items">
                        <div class="customer">
                            <div class="avt"></div>
                            <div>KH001</div>
                        </div>
                        <div style="width: 20%;">29/03/2004</div>
                        <div style="width: 20%;">12011252_donhang</div>
                        <div style="width: 20%;">120210</div>
                        <div class="btn">
                            <select>
                                <option id="status" value="1">Hoàn thành</option>
                                <option id="status" value="1">Đang giao hàng</option>
                                <option id="status" value="1">Đã chuyển hàng</option>
                            </select>
                            <button type="button">Sửa</button>
                        </div>
                    </div>
                    <div class="table-items">
                        <div class="customer">
                            <div class="avt"></div>
                            <div>KH001</div>
                        </div>
                        <div style="width: 20%;">29/03/2004</div>
                        <div style="width: 20%;">12011252_donhang</div>
                        <div style="width: 20%;">120210</div>
                        <div class="btn">
                            <select>
                                <option id="status" value="1">Hoàn thành</option>
                                <option id="status" value="1">Đang giao hàng</option>
                                <option id="status" value="1">Đã chuyển hàng</option>
                            </select>
                            <button type="button">Sửa</button>
                        </div>
                    </div>
                    <div class="table-items">
                        <div class="customer">
                            <div class="avt"></div>
                            <div>KH001</div>
                        </div>
                        <div style="width: 20%;">29/03/2004</div>
                        <div style="width: 20%;">12011252_donhang</div>
                        <div style="width: 20%;">120210</div>
                        <div class="btn">
                            <select>
                                <option id="status" value="1">Hoàn thành</option>
                                <option id="status" value="1">Đang giao hàng</option>
                                <option id="status" value="1">Đã chuyển hàng</option>
                            </select>
                            <button type="button">Sửa</button>
                        </div>
                    </div> -->

                </div>

            </div>
        </div>
        <!-- <div class="return"><a href="#">
                << Quay lại</a>
        </div> -->
    </div>


</body>

</html>