<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <link rel="stylesheet" href="../css/thongke.css">
    <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/dsnv.css">
    <style>
        a {
            text-decoration: none;
            color: black;
        }

        .form_TTKhachHang {
            border: 2px solid black;
            padding: 20px;
            margin-top:50px;
        }

        .chuXam {
            color: #1f010193;
        }

        .ThongTinKhachHang {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
        }

        .ThongTinKhachHang-data1,
        .ThongTinKhachHang-data2 {
            width: 30%;
        }

        .photo {
            width: 250px;
            height: 250px;
            background-color: #ddd;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            margin: auto;

        }

        .ThongTinKhachHang input[type="text"],
        .ThongTinKhachHang input[type="password"] {
            width: 80%;
            /* Đặt chiều rộng của các trường nhập */
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .check-ThongTin {
            color: #88C273;
            text-decoration: none;
            color: white;
        }

        /* table {
            width: 100%;
            /* border-collapse: collapse; 
            border-collapse: separate;
            border-spacing: 0 40px;
        }

        tbody td {
            width: 50%;
            padding: 10px;
            border: 1px solid black;
        }

        tbody tr {
            /* border: 1px solid black; */
        /* margin-bottom: 20px; 
        }

        .LichSuMuaHang {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .LichSuMuaHang .left-align {
            text-align: left;
            border-right: none;
        }

        .LichSuMuaHang .right-align {
            text-align: right;
            border-left: none;
        } */
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="form_TTKhachHang">
        <form action="" method="post" enctype="multipart/form-data">
            <h1>Thông tin của tôi</h1>
            <p><a href="./home.php">Trang chủ >> </a><span class="chuXam">Thông tin của tôi</span></p>
            <div class="ThongTinKhachHang">
                <?php
                function loadData()
                {
                    include('./connect.php');
                    $conn = connectDB();
                    if (isset($_SESSION['user_id'])) {
                        $maKH = $_SESSION['user_id'];
                        $sql = "SELECT * FROM nguoidung WHERE Manguoidung='$maKH'";
                        $rs = mysqli_query($conn, $sql);
                        if ($row = mysqli_fetch_array($rs)) {
                            echo '<div style="display:flex; flex-direction: column;">
                                <div class="photo">
                                    <img id="hinhAnh" src="../../img/' . $row["img"] . '" alt="ảnh" style="width: 100%; height:100%;">
                                </div>
                                <input type="file" id="uploadInput" name="txtHinhAnh" onchange="hienThiAnh(event)">
                                </div>
                        <script>
                        function hienThiAnh(event) {
                            var input = event.target;
                            var reader = new FileReader();
                            reader.onload = function(){
                                var dataURL = reader.result;
                                var img = document.getElementById("hinhAnh");
                                img.src = dataURL;
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                        </script>
                        <div class="ThongTinKhachHang-data1">
                            <p>Họ tên:</p>
                            <input type="text" id="name" name="name" value="' . $row["Ten"] . '">
                            <div id="tbTen"></div>
                            <p>Địa chỉ:</p>
                            <input type="text" id="address" name="address" value="' . $row["Diachi"] . '">
                            <div id="tbDiaChi"></div>
                            <p>Mật khẩu:</p>
                            <input type="password" id="password" name="password" value="' . $row["Matkhau"] . '">
                            <div id="tbMatKhau"></div>
                        </div>
                        <div class="ThongTinKhachHang-data2">
                            <p>Số điện thoại:</p>
                            <input type="text" id="phone" name="phone" value="' . $row["Sodienthoai"] . '">
                            <div id="tbSDT"></div>
                            <p>Email:</p>
                            <input type="text" id="email" name="email" value="' . $row["Email"] . '">
                            <div id="tbEmail"></div>
                            <p>Xác nhận mật khẩu:</p>
                            <input type="password" id="check-password" name="check-password" value="' . $row['Matkhau'] . '">
                            <div id="tbLaiMatKhau"></div>
                            <p class="">Bạn muốn thay đổi thông tin, <button class="check-ThongTin" id="check-ThongTin" name="thaydoi" onclick="validateForm(event)">Thay đổi</button></p>
                        </div>';
                        }
                        mysqli_close($conn);
                    } else {
                        echo "<script>alert('Lỗi');</script>";
                    }
                }
                loadData();

                ?>

                <script>
                    // Regex pattern



                    function validateForm(event) {
                        var pattern_ten = /^[a-zA-ZàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆđĐìÌỉỈĩĨíÍịỊòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢùÙủỦũŨúÚụỤưỪừỬữỮứỨựỰỳỲỷỶỹỸýÝỵỴ\s]+$/;
                        var pattern_mk_rmk = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/;
                        var pattern_email = /^[\w\.-]+@[\w\.-]+\.\w+$/;
                        var pattern_sdt = /^0\d{9}$/;
                        var ten = document.getElementById('name').value;
                        var diaChi = document.getElementById('address').value;
                        var mk = document.getElementById('password').value;
                        var sdt = document.getElementById('phone').value;
                        var email = document.getElementById('email').value;
                        var rmk = document.getElementById('check-password').value;
                        if (!ten) {
                            document.getElementById('tbTen').innerHTML = 'Tên không được phép bỏ trống!';
                            document.getElementById('name').focus();event.preventDefault();
                            return false;
                        }
                        if (!diaChi) {
                            document.getElementById('tbDiaChi').innerHTML = 'Địa chỉ không được phép bỏ trống!';
                            document.getElementById('address').focus();event.preventDefault();
                            return false;
                        }
                        if (!mk) {
                            document.getElementById('tbMatKhau').innerHTML = 'Mật khẩu không được phép bỏ trống!';
                            document.getElementById('password').focus();event.preventDefault();
                            return false;
                        }
                        if (!sdt) {
                            document.getElementById('tbSDT').innerHTML = 'Số điện thoại không được phép bỏ trống!';
                            document.getElementById('phone').focus();event.preventDefault();
                            return false;
                        }
                        if (!email) {
                            document.getElementById('tbEmail').innerHTML = 'Email không được phép bỏ trống!';
                            document.getElementById('email').focus();event.preventDefault();
                            return false;
                        }
                        if (!rmk) {
                            document.getElementById('tbLaiMatKhau').innerHTML = 'Nhập lại mật khẩu không được phép bỏ trống!';
                            document.getElementById('check-password').focus();event.preventDefault();
                            return false;
                        }
                        if (!pattern_ten.test(ten)) {
                            // Xử lý khi dữ liệu không hợp lệ
                            document.getElementById('tbTen').innerHTML = 'Tên không được phép có ký tự đặc biệt!';
                            document.getElementById('name').focus();event.preventDefault();
                            return false;
                        }

                        if (!pattern_mk_rmk.test(mk)) {
                            // Xử lý khi dữ liệu không hợp lệ
                            document.getElementById('tbMatKhau').innerHTML = 'Mật khẩu phải đủ 8 ký tự, có kí tự in hoa,in thường,ký tự đặc biệt và số!';
                            document.getElementById('password').focus();event.preventDefault();
                            return false;
                        }

                        if (!pattern_sdt.test(sdt)) {
                            // Xử lý khi dữ liệu không hợp lệ
                            document.getElementById('tbSDT').innerHTML = 'Số điện thoại gồm 10 số, bắt đầu bằng 0';
                            document.getElementById('phone').focus();event.preventDefault();
                            return false;
                        }

                        if (!pattern_email.test(email)) {
                            // Xử lý khi dữ liệu không hợp lệ
                            document.getElementById('tbEmail').innerHTML = 'Email phải có @ và .';
                            document.getElementById('email').focus();event.preventDefault();
                            return false;
                        }

                        if (rmk != mk) {
                            // Xử lý khi dữ liệu không hợp lệ
                            document.getElementById('tbLaiMatKhau').innerHTML = 'Mật khẩu không trùng!';
                            document.getElementById('check-password').focus();event.preventDefault();
                            return false;
                        }
                        
                    }
                    // Kiểm tra dữ liệu
                </script>

                <?php
                $pattern_ten = "/^[a-zA-ZàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆđĐìÌỉỈĩĨíÍịỊòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢùÙủỦũŨúÚụỤưỪừỬữỮứỨựỰỳỲỷỶỹỸýÝỵỴ\\s]+$/"; // chỉ chấp nhận các ký tự chữ và khoảng trắng
                $pattern_mk_rmk = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/"; // Mật khẩu phải đủ 8 ký tự, có kí tự in hoa,in thường,ký tự đặc biệt và số 
                $pattern_email = "/^[\w\.-]+@[\w\.-]+\.\w+$/";
                $pattern_sdt = "/^0\d{9}$/";
                // $
                // include('./connect.php');
                $conn = connectDB();
                // if (isset($_POST["thaydoi"])) {
                if (isset($_SESSION['user_id'])) {
                    $maKH = $_SESSION['user_id'];
                    if (isset($_POST['thaydoi'])) {

                        if (!empty($_POST["name"]) && !empty($_POST['address']) && !empty($_POST['password']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['check-password'])) {
                            if (!empty($_FILES["txtHinhAnh"]["name"])) {
                                echo "abc";
                                $ten = $_POST["name"];
                                $diaChi = $_POST['address'];
                                $mk = $_POST['password'];
                                $sdt = $_POST['phone'];
                                $email = $_POST['email'];
                                $rmk = $_POST['check-password'];

                                $tenTep = $_FILES['txtHinhAnh']['name'];
                                $duongDanTam = $_FILES['txtHinhAnh']['tmp_name'];
                                $duongDanLuu = "../../img/" . $tenTep;
                                if (move_uploaded_file($duongDanTam, $duongDanLuu)) {
                                    $hinhanh = $tenTep;
                                    $sql = "UPDATE nguoidung SET Ten=?, Diachi=?, Matkhau=?, Sodienthoai=?, Email=?, img=? WHERE Manguoidung=?";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, "sssssss", $ten, $diaChi, $mk, $sdt, $email, $hinhanh, $maKH);
                                    mysqli_stmt_execute($stmt);
                                    echo "aaaa";
                                    // Kiểm tra kết quả
                                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                                        echo "<script>alert('Cập nhật thông tin thành công');</script>";
                                        echo "<script>window.location = 'home.php?chon=tttk';</script>";
                                        exit();
                                    } else {

                                        // echo "<script>alert('Cập nhật thông tin thất bại');</script>";
                                        echo "" . mysqli_error($conn);
                                    }

                                    mysqli_stmt_close($stmt);
                                }
                            } else {
                                // var_dump($_POST);
                                $ten = $_POST["name"];
                                $diaChi = $_POST['address'];
                                $mk = $_POST['password'];
                                $sdt = $_POST['phone'];
                                $email = $_POST['email'];
                                $rmk = $_POST['check-password'];

                                $sql = "UPDATE nguoidung SET Ten=?, Diachi=?, Matkhau=?, Sodienthoai=?, Email=? WHERE Manguoidung=?";
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_bind_param($stmt, "ssssss", $ten, $diaChi, $mk, $sdt, $email,  $maKH);
                                mysqli_stmt_execute($stmt);
                                echo "bbbb";
                                // Kiểm tra kết quả
                                if (mysqli_stmt_affected_rows($stmt) > 0) {
                                    echo "<script>alert('Cập nhật thông tin thành công');</script>";
                                    echo "<script>window.location = 'home.php?chon=tttk';</script>";
                                    exit();
                                } else {
                                    echo mysqli_error($conn);
                                    echo "<script>alert('Cập nhật thông tin thất bại');</script>";
                                }

                                mysqli_stmt_close($stmt);
                            }
                        }
                    }
                }
                // }

                mysqli_close($conn);
                ?>
            </div>
            <h1>Lịch sử mua hàng</h1>
            <script>

            </script>
            <div id="wrapper">
                <div class="table">
                    <div class="table-title">
                        <!-- <div style="width: 20%; font-weight: bold;">Khách hàng</div> -->
                        <div style="width: 25%; font-weight: bold;">Số hóa đơn</div>
                        <div style="width: 25%; font-weight: bold;">Ngày mua</div>
                        <div style="width: 25%; font-weight: bold;">Tổng tiền</div>
                        <div style="width: 25%; font-weight: bold;">Trạng thái</div>
                    </div>
                    <div><br></div>
                    <div><br></div>
                    <div style="overflow-y: scroll;">
                        <?php
                        $conn = connectDB();
                        if (isset($_SESSION['user_id'])) {
                            $maKH = $_SESSION['user_id']; //SELECT * FROM table_name ORDER BY ngay_column DESC
                            $sql = mysqli_query($conn, "SELECT * FROM donhang WHERE maKhachhang = '$maKH' ORDER BY Ngay DESC");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<div class="table-items">';

                                echo '<div style="width: 25%;">' . $row["Madonhang"] . '</div>';
                                echo '<div style="width: 25%;">' . $row["Ngay"] . '</div>';
                                echo '<div style="width: 25%;">' . $row["Tonggiatri"] . '</div>';
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
                                echo '<button type="button" class="order-detail"><a href="home.php?chon=ctdh&maDH=' . $row['Madonhang'] . '">Chi tiết</a></button>';
                                echo '</div>';
                            }
                        }


                        mysqli_close($conn);


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

    </form>
    </div>
</body>

</html>