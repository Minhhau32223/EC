<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="user/css/thongke.css">
    <link rel="stylesheet" href="user/css/chitiethoadon.css">
    <link rel="stylesheet" href="user/css/phieuxuat.css">
    <link rel="stylesheet" href="user/css/dsnv.css">
    <style>
        #bodi {
            margin: 10%;
        }
        #khung {
            /* margin: 10%; */
            border: 1px;
        }
        .khung {
            margin-top: 5%;
            margin-left: 5%;
            margin-right: 5%;
        }
        .progress-container {
            top: 10px;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

    /* Thanh ở trên */
     .progress-bar {
            height: 10px;
            background-color: green;
            border: darkgreen solid 1px;
            transition: width 0.5s ease;
        }

        .step-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 10px;
            margin-top: 10px;
            /* margin-left: 10%; */
            /* margin-right: 5%; */
        }

        .step {
            /* background-color: #0052cd; */
            width: 25%;
            text-align: center;
            /* font-weight: bold; */
        }

        .step-text {
            font-size: 20px;
            color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .progress-wrapper {
            height: 50px;
            width: 100%;
            position: relative;
            border: cyan solid 2px;
        }

        .progress-markers {
            height: 100%;
            /* Cùng chiều cao với progress-bar */
            display: flex;
            justify-content: space-between;
            /* background-color: #0080ff; */
        }
        .marker {
            position: absolute;
            top: 0;
            height: 100%;
            width: 2px;
            /* Độ rộng của điểm đánh dấu */
            background-color: cyan;
            /* Màu sắc của điểm đánh dấu */
        }
    /* Thanh ở trên */
    /* Bảng sản phẩm */ 
        /* header */
            .section__container_2{
                margin-top: 60px;
                width: 95%;
                height: 250px;
                margin-left: 2.5%;
                /* height: fit-content; */
                background-color: white;
                border-radius: 5px;
                box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
            }
            .table-title {
                padding: 5px;
                background-color: aqua;
                border-radius: 5px;
                display: flex;
                text-align: center;
            }
            .table-title div{
                font-size: 30px;
                border-radius: 3px;
                border-width: 5px black;
            }
            
            .cart-table__cont{
                margin-left: 0px;
                height: 460px;
            }
            .scoll{
                float: right;
                margin-right: 0px;
                display: flex;
            }
            /* width */
            .scroll::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            .scroll::-webkit-scrollbar-track {
            box-shadow: inset 0 0 3px grey; 
            border-radius: 2px;
            }
            
            /* Handle */
            .scroll::-webkit-scrollbar-thumb {
            background: #778899; 
            border-radius: 3px;
            }

            /* Handle on hover */
            .scroll::-webkit-scrollbar-thumb:hover {
            background: #696969; 
            }
        /* header */
        .sp {
            /* background-color: red; */
            display: flex;
            text-align: left;
            margin-left: 10px;
        }
        .sp div{
            padding-top: 25px;
            text-align: left;
            font-size: 20px;
        }
        .sp img{
            padding: 10px ;
        }
        .table-items .tien{
            /* background-color: teal; */
            margin-left: 10px;
            text-align: center;
            font-size: 20px;
            padding-top: 25px;
        }
        .table-items{
            display: flex;
            text-align: center;
            border-radius: 3px;
            border-width: 5px;
            border-color: grey;
        }
       
    /* Bảng sản phẩm */
    /* FORM thông tin */
        .order-info-complete {
            width: 95%;
            display: block;
            /* background-color: black; */
            border: solid 2px #ccc;
            border-radius: 20px;
            padding: 25px;
            margin-left: 2.5%;
            /* margin-top: 20px; */
        }
        .order-details h2 {
            margin: 5px 0;
            font-weight: bold;
            font-size: 30px;
        }
        .order-details {
            position: relative;
        }

        .total-row {
            font-size: 20px;
        }

        .total-row::before {
            content: "";
            position: absolute;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #ccc;
        }

        .line-info-checkout {
            padding: 5px;
            margin: 15px 25px;
            font-size: 20px;
            /* background-color: aqua; */
        }
        .line-info-checkout span {
            padding: 5px;
            font-weight: bold;
            /* float: inline-end; */
        }
        .total-price{
            padding-top: 20px;
            font-size: 30px;
            margin-left: 70%;
        }
        .total-price span{
            color: red;
            font-weight: bold;
            font-style: italic;
        }
    /* FORM thông tin */
    /* Button Hủy    */
        #cancel-form{
            margin-top: 30px;
            /* background-color: red; */
            padding: 10px;
        }
        #cancel-form button{
            background-color: #0080ff;
            width: 10%;
            height: 60px;
            margin-left: 87.5%;
            border-radius: 3px;
            border-width: 0px;
            font-size: 20px;
            color: whitesmoke;
            font-weight: bold;
            box-shadow: 3px 4px 3px rgba(0, 0, 0, 0.25);
        }
        #cancel-form button:hover{
            background-color: #0052cd;
            color: gold;
            -ms-transform: scale(1.05); /* IE 9 */
            -webkit-transform: scale(1.05); /* Safari 3-8 */
            transform: scale(1.05); 
        }
    /* Button Hủy    */
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body style="background-color: white;">
    <div id="bodi">
        <div id="khung">
                <div class="progress-wrapper" id="progress-wrapper">
                    <div class="progress-markers">
                        <div class="marker" style="left: 25%;"></div>
                        <div class="marker" style="left: 50%;"></div>
                        <div class="marker" style="left: 75%;"></div>
                        <div class="marker" style="left: 100%;"></div>
                    </div>
                </div>
            <?php

            if (isset($_GET['maDH'])) {
                // echo 'abc';
                $maDH = $_GET['maDH'];
                include('./connect.php');
                $conn = connectDB();
                $sql = "SELECT Trangthai FROM donhang WHERE Madonhang=$maDH";
                $rs = mysqli_query($conn, $sql);
                if (mysqli_num_rows($rs) > 0) {
                    $row = mysqli_fetch_assoc($rs);
                    $trangthai = $row["Trangthai"];
                    // var_dump($trangthai);
                    switch ($trangthai) {
                        case 0:
                            $tt = 25;
                            break;
                        case 1:
                            $tt = 50;
                            break;
                        case 2:
                            $tt = 75;
                            break;
                        case 3:
                            $tt = 100;
                            break;
                        case 4:
                            $tt = 0;
                            break;
                        default:
                            // echo '0';
                    }
                } else {
                    echo "Lỗi ";
                }
                mysqli_close($conn);
            }?>

            <div class="progress-container" id="progress-container">
                <div class="step-container">
                    <div class="step">
                        <div class="step-text">Chờ xác nhận</div>
                    </div>
                    <div class="step">
                        <div class="step-text">Đã xử lý</div>
                    </div>
                    <div class="step">
                        <div class="step-text">Đang giao hàng</div>
                    </div>
                    <div class="step">
                        <div class="step-text">Đã giao hàng</div>
                    </div>
                </div>
            </div>

            <!-- <div id="huy"></div> -->

            <div class="section__container_2">
            <div class="cart-table col-8">
                <div class="cart-table__cont">
                    <div class="table-title">
                        <div style="width: 40%; font-weight: bold;">Sản phẩm</div>
                        <div style="width: 20%; font-weight: bold;">Đơn giá</div>
                        <div style="width: 15%; font-weight: bold;">Số lượng</div>
                        <div style="width: 25%; font-weight: bold;">Tổng tiền</div>
                    </div>
                    <div><br></div>
                    <div><br></div>
                    <!--DATA-->
                    <div class="scroll" style="overflow-y: scroll;"> 
                        <?php
                        if (isset($_GET['maDH'])) {
                            $maDH = $_GET['maDH'];
                            // include('./connect.php');
                            $conn = connectDB();
                            $sql = mysqli_query($conn, "SELECT * FROM chitietdonhang ctdh, sanpham sp WHERE Madonhang = $maDH AND ctdh.Masp = sp.Masp");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<div class="table-items">
                                <div class="sp" style="width: 40%">
                                    <img src="../../img/' . $row["Img"] . '" style="width: 15%">
                                    <div>' . $row["Tensp"] . '</div>
                                </div>
                                <div class="tien" style="width: 20%;">' . $row["Giaban"] . ' VND</div>
                                <div class="tien"style="width: 15%;">' . $row["Soluong"] . '</div>
                                <div class="tien"style="width: 25%;">' . $row["Giaban"] * $row["Soluong"] . ' VNĐ</div>
                                </div>';
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
            </div>
            <div><br></div>
            <?php
            if (isset($_GET['maDH'])) {
                $maDH = $_GET['maDH'];
                $maKH = $_SESSION['user_id'];
                $conn = connectDB();
                $sql = "SELECT Madonhang, vc.Gia, Ngay, nd.Diachi, Tonggiatri FROM donhang dh, vanchuyen vc, nguoidung nd WHERE dh.maKhachhang=nd.Manguoidung AND dh.Mavc = vc.Mavc and nd.Manguoidung='$maKH'AND Madonhang=$maDH";
                $rs = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($rs)) {
                    echo '<div class="order-info-complete">
                    <div class="order-details">
                        <h2>Thông tin đơn hàng</h2>
                        <p class="total-row"></p>
                        <p class="line-info-checkout">Mã đơn hàng: <span id="total-items" class="right-aligned">' . $row["Madonhang"] . '</span></p>
                        <p class="line-info-checkout">Phí vận chuyển: <span id="shipping-fee" class="right-aligned">' . $row["Gia"] . '</span></p>
                        <p class="line-info-checkout">Thời gian đặt hàng: <span id="subtotal" class="right-aligned">' . $row["Ngay"] . '</span></p>
                        <p class="line-info-checkout">Địa chỉ giao hàng: <span id="subtotal" class="right-aligned">' . $row["Diachi"] . '</span></p>
                        <p class="line-info-checkout">Phương thức thanh toán: <span id="subtotal" class="right-aligned">Thanh toán khi nhận hàng</span>
                        </p>
                        <p class="total-row"></p>
                        <p class="total-price">Tổng cộng: <span id="total" class="right-aligned">' . $row["Tonggiatri"] . ' VND</span></p>
                    </div>';
                }
            }?>

        </div>
        <script>
            function confirmCancel() {
                var confirmation = confirm("Bạn có chắc chắn muốn hủy đơn hàng không?");
                if (confirmation) {
                    document.getElementById("cancel-form").submit();
                }
            }
        </script>
        <?php
        // Kiểm tra xem đã nhấn vào nút hủy đơn chưa
        if (isset($_POST['cancel_order'])) {
            $conn = connectDB();
            // Lấy mã đơn hàng cần hủy từ form hoặc các nguồn dữ liệu khác
            $maDonHang = $_POST['maDonHang'];

            // Xác định trạng thái mới của đơn hàng sau khi hủy (ví dụ: gán trạng thái mới là 4 cho trạng thái "Đã hủy")
            $trangThaiMoi = 4;

            // Tạo truy vấn SQL để cập nhật trạng thái của đơn hàng
            $sql = "UPDATE donhang SET Trangthai = ? WHERE Madonhang = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ii', $trangThaiMoi, $maDonHang);
            mysqli_stmt_execute($stmt);

            $affectedRows = mysqli_stmt_affected_rows($stmt);
            if ($affectedRows > 0) {

                $sqlCTDH = "SELECT * FROM chitietdonhang WHERE Madonhang=?";
                $stmtCTDH = mysqli_prepare($conn, $sqlCTDH);
                mysqli_stmt_bind_param($stmtCTDH, 'i',  $maDonHang);
                mysqli_stmt_execute($stmtCTDH);
                $result = mysqli_stmt_get_result($stmtCTDH);

                while ($row = mysqli_fetch_assoc($result)) {
                    $soluong = $row["Soluong"];
                    $masp = $row["Masp"];

                    $sqlCapNhatSoLuong = "UPDATE sanpham SET Soluongconlai=Soluongconlai+? WHERE Masp=?";

                    $stmtCNSL = mysqli_prepare($conn, $sqlCapNhatSoLuong);

                    mysqli_stmt_bind_param($stmtCNSL, 'ii', $soluong, $masp);

                    mysqli_stmt_execute($stmtCNSL);
                    
                    echo "Cập nhật trạng thái đơn hàng thành công!";
                    echo "<script>window.location = 'home.php?chon=tttk';</script>";
                    exit();
                }
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
            mysqli_close($conn);
        }?>

    <!-- Form Cancel -->
        <form id="cancel-form" name="cancel-form" method="post" action="">
            <input type="hidden" name="maDonHang" value="<?php echo $maDH; ?>">
            <!-- <button type="button" name="cancel_order">Hủy đơn hàng</button> -->
            <button type="submit" name="cancel_order" onclick="confirmCancel()">Hủy đơn hàng</button>
        </form>
    <!-- Form Cancel -->

        <script>
            // Giả sử bạn có một biến PHP là $progress (đại diện cho phần trăm tiến trình)
            var progress = <?php echo $tt ?>; //mở thẻ php echo trạng thái ra
            if (progress == 25) {
                var progressBar = document.getElementById('progress-bar');
                progressBar.style.width = progress + '%';
                document.getElementById('cancel-form').style.display = "block";
                document.getElementById('progress-wrapper').style.display = "block";
                document.getElementById('progress-container').style.display = "flex";

            }
            if (progress > 25) {
                // Lấy phần tử thanh màu xanh theo id
                var progressBar = document.getElementById('progress-bar');
                document.getElementById('cancel-form').style.display = "none";
                document.getElementById('progress-wrapper').style.display = "block";
                document.getElementById('progress-container').style.display = "flex";
                // Thay đổi chiều dài của thanh màu xanh
                progressBar.style.width = progress + '%';
            }
            if (progress == 0) {
                document.getElementById('progress-wrapper').style.display = "none";
                document.getElementById('progress-container').style.display = "none";
                document.getElementById('cancel-form').style.display = "none";

            }
        </script>
    </div>
    </div>
</body>

</html>