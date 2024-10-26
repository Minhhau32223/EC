<?php
global $sum, $price, $conn, $tongGiaTri, $gia;
$sum = 0;
$price = 0;
$gia = 0;
function connect()
{
    $conn = mysqli_connect("localhost", "root", "", "bolashop");
    if (!$conn) {
        die("Lỗi" . mysqli_connect_error());
    }
}




?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/csscheckout.css?version=1.0">
    <link rel="stylesheet" href="../css/cssdoan.css?version=1.0">
    <!-- <link rel="stylesheet" href="./csscheckout.css?version=1.0 " > -->
    <title>Thanh toán</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <form action="" id="form_complete_payment">
        <?php require_once("./completepayment.php") ?>
    </form>
    <div class="container">
        <div class="left-section">
            <div class="section__container">
                <div class="row">
                    <div class="col-12">
                        <h4>Giỏ hàng</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="breadcrumb col-12">
                        <div class="breadcrumb__links horizontal">
                            <div class="breadcrumb__link body2"><a href="home.php">Trang chủ</a></div>
                            <div class="breadcrumb__link body2"><a href="home.php?chon=giohang">Giỏ hàng</a></div>
                            <div class="breadcrumb__link body2">Thanh toán</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="delivery-info">
                <h2>Thông tin giao hàng</h2>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "bolashop");
                if (!$conn) {
                    die("Lỗi" . mysqli_connect_error());
                }
                $maNguoiDung = $_SESSION['user_id'];
                $sql = "SELECT * FROM nguoidung WHERE Manguoidung='$maNguoiDung'";
                $rs = mysqli_query($conn, $sql);
                if (mysqli_num_rows($rs) > 0) {
                    while ($row = mysqli_fetch_array($rs)) {
                        $hoTen = $row["Ten"];
                        $sdt = $row["Sodienthoai"];
                        $diaChi = $row["Diachi"];
                    }
                } else {
                    echo 'Lỗi load dữ liệu';
                }
                // mysqli_close($conn);


                ?>
                <div class="input-group">
                    <label for="fullname">Họ và tên:</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo $hoTen ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $sdt ?>" readonly>
                </div>
                <div class="input-group">
                    <label for="address">Địa chỉ nhận hàng:</label>
                    <input type="text" id="address" name="address" value="<?php echo $diaChi ?>" readonly>
                </div>
            </div>
            <div class="payment-method">
                <h2>Phương thức thanh toán</h2>
                <div class="radio-cod">
                    <input checked type="radio" id="payment-cod" name="payment-method" value="cod">
                    <label for="payment-cod">Thanh toán khi nhận hàng</label>
                </div>
            </div>
            <div class="payment-method">
                <h2>Phương thức vận chuyển</h2>
                <div class="vanChuyen">
                    <select id="vanChuyen" style="width: 100%; border-radius: 15px; padding: 8px;">
                        <option selected>Chọn phương thức vận chuyển</option>

                        <?php
                        $sqlVanChuyen = "SELECT * FROM vanchuyen";
                        $rsVanChuyen = mysqli_query($conn, $sqlVanChuyen);
                        if (mysqli_num_rows($rsVanChuyen) > 0) {
                            while ($row = mysqli_fetch_array($rsVanChuyen)) {
                                echo '<option id="' . $row["Mavc"] . '" value="' . $row["Mavc"] . '">' . $row["Ten"] . '</option>';
                            }
                        }
                        ?><script>
                            $('#vanChuyen').change(function() {
                                var valueSelected = $(this).val();

                                $.ajax({
                                    url: 'XLptvanchuyen.php',
                                    type: 'POST',
                                    data: {
                                        data: valueSelected
                                    },
                                    dataType: 'html',
                                    success: function(data) {
                                        $('#phiVC').html(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.log(xhr.responseText);
                                    }
                                });
                            });
                        </script>
                    </select>




                </div>
            </div>
            <div class="payment-method">
                <h2>Mã giảm giá</h2>
                <div class="vanChuyen">
                    <select id="giamGia" style="width: 100%; border-radius: 15px; padding: 8px;">
                        <option selected>Chọn mã giảm giá</option>

                        <?php
                        $sqlGiamGia = "SELECT * FROM giamgia WHERE NOW() BETWEEN Ngaybatdau AND Ngayketthuc AND Magiamgia!='MG000';";
                        $rsGiamGia = mysqli_query($conn, $sqlGiamGia);
                        if (mysqli_num_rows($rsGiamGia) > 0) {
                            while ($row = mysqli_fetch_array($rsGiamGia)) {
                                echo '<option id="' . $row["Magiamgia"] . '" value="' . $row["Magiamgia"] . '">' . $row["tenGiamgia"] . ' - ' . $row["moTa"] . '</option>';
                            }
                        }
                        ?><script>
                            $('#giamGia').change(function() {
                                var valueSelected = $(this).val();
                                if (valueSelected == '') {
                                    valueSelected = 'MG000';
                                }
                                $.ajax({
                                    url: 'XLgiamgia.php',
                                    type: 'POST',
                                    data: {
                                        data: valueSelected
                                    },
                                    dataType: 'html',
                                    success: function(data) {
                                        $('#giamgia').html(data);
                                    },
                                    error: function(xhr, status, error) {
                                        console.log(xhr.responseText);
                                    }
                                });
                            });
                        </script>
                    </select>




                </div>
            </div>
            <button id="backButton" class="type-back"><a href="#"> &lt; Trở lại</a></button>
        </div>
        <div class="vertical-divider"></div>
        <div class="right-section">

            <div class="order-info">
                <div class="list-title" style="font-weight: bold;">
                    <div style="width: 50%;">Tên sản phẩm</div>
                    <div style="width: 25%; text-align: center">Số lượng</div>
                    <div style="width: 25%; text-align: center">Giá</div>
                </div>
                <div class="order-details">
                    <p class="total-row"></p>

                    <?php
                    if (isset($_GET["loai"])) {
                        if ($_GET["loai"] == 'muangay') {
                            $maNguoiDung = $_SESSION["user_id"];
                            $maSP = $_SESSION["Masp"];
                            $soLuong = $_SESSION["Soluong"];

                            $sql = "SELECT * FROM sanpham sp WHERE Masp = '$maSP'";
                            $rs = mysqli_query($conn, $sql);
                            if (!$rs) {
                                die("Lỗi truy vấn: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($rs) > 0) {
                                while ($row = mysqli_fetch_array($rs)) {
                                    echo '<br>
                                <div class="list-title">
                                        <div style="width: 50%;" id="' . $maSP . '">' . $row["Tensp"] . ' </div>
                                        <div style="width: 25%; text-align: center">' . $soLuong . '</div>
                                        <div style="width: 25%; text-align: center">' . $row["Giaban"] . ' VNĐ</div>
                                </div>';
                                }
                            }
                        } else {
                            // $_SESSION['Masp'] = "";
                            // $_SESSION['Soluong'] = '';
                            $maNguoiDung = $_SESSION["user_id"];

                            $sql = "SELECT * FROM sanpham sp, giohang gh WHERE sp.Masp=gh.Masp AND Manguoidung='$maNguoiDung'";
                            $rs = mysqli_query($conn, $sql);
                            if (!$rs) {
                                die("Lỗi truy vấn: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($rs) > 0) {
                                while ($row = mysqli_fetch_array($rs)) {
                                    echo '<br>
                                    <div class="list-title">
                                            <div style="width: 50%;" id="' . $row["Masp"] . '">' . $row["Tensp"] . ' </div>
                                            <div style="width: 25%; text-align: center">' . $row["Soluong"] . '</div>
                                            <div style="width: 25%; text-align: center">' . $row["Giaban"] . ' VNĐ</div>
                                    </div>';
                                }
                            }
                        }
                    }

                    // mysqli_close($conn);

                    ?>

                </div>
            </div>

            <div class="order-info">
                <h2>Thông tin đơn hàng</h2>
                <div class="order-details">
                    <p class="total-row"></p>

                    <?php
                    global $gia;
                    if (isset($_GET['loai'])) {
                        if ($_GET['loai'] == 'muangay') {
                            $maNguoiDung = $_SESSION["user_id"];
                            $maSP = $_SESSION["Masp"];
                            $soLuong = $_SESSION["Soluong"];

                            $sql = "SELECT * FROM sanpham sp WHERE Masp = '$maSP'";
                            $rs = mysqli_query($conn, $sql);
                            if (!$rs) {
                                die("Lỗi truy vấn: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($rs) > 0) {
                                while ($row = mysqli_fetch_array($rs)) {
                                    $sum += $soLuong;
                                    $price += $row["Giaban"] * $soLuong;
                                }
                                echo '<div class="line-info-checkout ">
                                <div>Tổng số lượng: </div>
                                <div id="num">' . $sum . '</div>
                            </div>
                            <div class="line-info-checkout ">
                                <div>Tạm tính: </div>
                                <div id="tamtinh">' . $price . ' VND</div>
                            </div>
                            <div class="line-info-checkout ">
                                <div>Phí vận chuyển: </div>
                                <div id="phiVC">0 VND</div>
                            </div>
                            <div class="line-info-checkout ">
                                <div>Mã giảm giá: </div>
                                <div id="giamgia">0 VND</div>
                            </div>
                            <p class="total-row"></p>
                            <div class="line-info-checkout ">
                                <div>Thành tiền: </div>
                                <div id="thanhtien"></div>
                            </div>';
                            }
                        } else {
                            $maNguoiDung = $_SESSION["user_id"];

                            $sql = "SELECT * FROM sanpham sp, giohang gh WHERE sp.Masp=gh.Masp AND Manguoidung='$maNguoiDung'";
                            $rs = mysqli_query($conn, $sql);
                            if (!$rs) {
                                die("Lỗi truy vấn: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($rs) > 0) {
                                while ($row = mysqli_fetch_array($rs)) {
                                    $sum += $row["Soluong"];
                                    $price += $row["Giaban"] * $row["Soluong"];
                                }

                                // $tongGiaTri = ($price - $mucGiam + $gia);
                                echo '<div class="line-info-checkout ">
                                    <div>Tổng số lượng: </div>
                                    <div id="num">' . $sum . '</div>
                                </div>
                                <div class="line-info-checkout ">
                                    <div>Tạm tính: </div>
                                    <div id="tamtinh">' . $price . ' VND</div>
                                </div>
                                <div class="line-info-checkout ">
                                    <div>Phí vận chuyển: </div>
                                    <div id="phiVC">0 VND</div>
                                </div>
                                <div class="line-info-checkout ">
                                    <div>Mã giảm giá: </div>
                                    <div id="giamgia">0 VND</div>
                                </div>
                                <p class="total-row"></p>
                                <div class="line-info-checkout ">
                                    <div>Thành tiền: </div>
                                    <div id="thanhtien"></div>
                                </div>';
                            }
                        }
                    }

                    mysqli_close($conn);
                    ?>
                    <script>
                        function updateThanhTien() {
                            var tamtinh = (document.getElementById('tamtinh').textContent).split(" ");
                            var phivanchuyen = (document.getElementById('phiVC').textContent).split(" ");
                            var magiamgia = (document.getElementById('giamgia').textContent).split(" ");
                            var thanhtien = parseInt(tamtinh[0]) + parseInt(phivanchuyen[0]) - parseInt(magiamgia[0]);
                            document.getElementById('thanhtien').innerHTML = thanhtien.toString() + " VND";
                        }
                        // Gọi hàm cập nhật khi có sự thay đổi giá trị
                        document.getElementById('tamtinh').addEventListener('DOMSubtreeModified', updateThanhTien);
                        document.getElementById('phiVC').addEventListener('DOMSubtreeModified', updateThanhTien);
                        document.getElementById('giamgia').addEventListener('DOMSubtreeModified', updateThanhTien);

                        // Gọi hàm cập nhật lần đầu tiên
                        updateThanhTien();
                    </script>
                </div>

            </div>


            <script>
                function getParameterByName(name) {
                    const urlParams = new URLSearchParams(window.location.search);
                    return urlParams.get(name);
                }

                function redirectToComplete() {
                    // Điều hướng đến trang complete.php
                    var tonggiatri = (document.getElementById('thanhtien').textContent).split(" ");
                    var maVC = document.getElementById('vanChuyen').value;
                    if (maVC == "Chọn phương thức vận chuyển") {
                        alert("Vui lòng chọn phương thức vận chuyển!");
                        return false;
                    }
                    var maGiamGia = document.getElementById('giamGia').value;
                    var maGG;
                    if (maGiamGia == 'Chọn mã giảm giá') {
                        maGG = 'MG000';
                    } else {
                        maGG = maGiamGia;
                    }
                    // alert('aaaa');
                    var loai = getParameterByName('loai');
                    console.log(loai);
                    if (loai == 'thanhtoan') {
                        var maKH = <?php echo json_encode($maNguoiDung); ?>;

                        var currentDate = new Date();
                        var year = currentDate.getFullYear();
                        var month = currentDate.getMonth() + 1; // Lưu ý: tháng bắt đầu từ 0, vì vậy cần cộng thêm 1
                        var day = currentDate.getDate();
                        var ngay = (year.toString() + "-" + month.toString() + "-" + day.toString());
                        $.ajax({
                            url: 'XLthanhtoan.php',
                            type: 'POST',
                            data: {
                                tonggiatri: tonggiatri[0],
                                maVC: maVC,
                                maGG: maGG,
                                maKH: maKH,
                                ngay: ngay

                            },
                            // dataType: 'html',
                            success: function(data) {
                                // console.log(data);
                                // $('#compltete-button').html(data);
                                $('#form_complete_payment').show();
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                    if (loai == 'muangay') {
                        var maKH = <?php echo json_encode($maNguoiDung); ?>;
                        
                        var maSP = <?php echo isset($_SESSION["Masp"]) ? json_encode($_SESSION["Masp"]) : 'null'; ?>;
                        var soLuong = <?php echo isset($_SESSION["Soluong"]) ? json_encode($_SESSION["Soluong"]) : 'null'; ?>;
                        
                        var currentDate = new Date();
                        var year = currentDate.getFullYear();
                        var month = currentDate.getMonth() + 1; // Lưu ý: tháng bắt đầu từ 0, vì vậy cần cộng thêm 1
                        var day = currentDate.getDate();
                        var ngay = (year.toString() + "-" + month.toString() + "-" + day.toString());
                        $.ajax({
                            url: 'XLthanhtoan.php',
                            type: 'POST',
                            data: {
                                tonggiatri: tonggiatri[0],
                                maVC: maVC,
                                maGG: maGG,
                                maKH: maKH,
                                ngay: ngay,
                                maSP: maSP,
                                soLuong: soLuong,
                            },
                            // dataType: 'html',
                            success: function(data) {
                                // console.log(data);
                                // $('#compltete-button').html(data);
                                $('#form_complete_payment').show();
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    } 

                    // document.getElementById("form_complete_payment").style.display = "block";
                }
            </script>
            <button id="complete-order" class="complete-button" onclick="redirectToComplete()">Hoàn tất đơn hàng</button>
            <!-- <button id="complete-order" class="complete-button">Hoàn tất đơn hàng</button> -->



        </div>
    </div>

</body>

</html>