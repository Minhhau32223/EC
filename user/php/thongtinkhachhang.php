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
        /* header_TTKH */
        a{
            color: white;
            text-decoration: none;
            font-size: 20px;
        }
        .section__container{
            margin-top: 80px;
        }
        .row{
            padding-top: 15px;
            display: flex;
        }
        
        .breadcrumb__links {
            margin-top: -5px;
            display: flex;
            /* padding: 10px; */
        }
        .breadcrumb__links #ttkh{
            margin-left: 2px;
            color: gray;
        } 
        .breadcrumb .title{
            margin-bottom: 0.5rem;
        }
        .breadcrumb .breadcrumb__link{
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .breadcrumb .breadcrumb__links > :last-child{
            color: var(--color-text-disabled);
        }
        .breadcrumb .breadcrumb__link::after{
            content: '';    
            width: 4px;
            height: 4px;
            margin: 0 1rem;
            background-color: var(--color-text-disabled);
            border-radius: 75%;
        }
        .breadcrumb .breadcrumb__links > :last-child::after{
            content: none;    
        }
        .breadcrumb .breadcrumb__link:hover{
            text-decoration: underline;
            color: var(--color-pri-main);
        }
        .breadcrumb .breadcrumb__links > :last-child:hover{
            text-decoration: none;
            color: var(--color-text-disabled);
        }
        .form_TTKhachHang {
            margin-top: 100px;
            margin-left: 55px;
        }
        /* header_TTKH */

        /* TTKhachHang */
        .ThongTinKhachHang {
            margin-top: 20px;
            margin-left: 4%;
            width: 90%;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
            display: flex;
            background-color: #FFFAFA;
            /* justify-content: space-between;   */
        }
        .ThongTinKhachHang div{
            padding: 5px;
            margin-left: 40px;
            /* background-color: blue; */
        }
        .ThongTinKhachHang div input[type="file"]{
            margin-left: 25px;
            margin-right: 15px;
        }

        .ThongTinKhachHang-data1,
        .ThongTinKhachHang-data2 {
            width: 30%;
        }
        .ThongTinKhachHang-data1,
        .ThongTinKhachHang-data2 p{
           font-size: 23px;
        }
        .photo {
            width: 150px;
            height: 150px;
            background-color: #ddd;
            border-radius: 80%;
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
            border-radius: 7px;
            font-size: 16px;
            background-color: #C0C0C0;
            font-size: 18px;
            color: white;
            box-shadow: 5px 5px 0px rgba(0, 0, 0, 0.5);
        }
        /* button đổi */
        .ThongTinKhachHang-data3{
            margin-top: 5%;
            margin-right: 2%;
            width: 15%;
            height: 50%;
            font-size: 30px;
            text-align: center;
            /* background-color: blue; */
        }
        .check-ThongTin {
            background-color: #027f79;
            width: 50%;
            height: 35px;
            border-radius: 8px;
            color: gold;
            padding: 5px 10px 5px 5px;
            font-weight: bold;
            font-size: 15px;
            box-shadow: 1px 3px black;
            /* transition: transform .2s; */
        }
        .check-ThongTin:hover{
            -ms-transform: scale(1.05); /* IE 9 */
            -webkit-transform: scale(1.05); /* Safari 3-8 */
            transform: scale(1.05); 
        }
        .check-ThongTin:active{
            -ms-transform: scale(1.05); /* IE 9 */
            -webkit-transform: scale(1.05); /* Safari 3-8 */
            transform: scale(1.05); 
        }
        /* TTKhachHang */
        
        /* Lịch sử mua hàng */
        #LichSu-Text{
            margin-left: 50px;
            margin-top: 50px;
            font-size: 35px;
        }
        #wrapper{
            margin-top: 20px;
            margin-left: 2.5%;
            margin-right: 5%;
        }
        .table{
            background-color: #FFFAFA;
            border-radius: 10px;
        }
        .table-title{
            background-color: aqua;
            font-size: 25px;
            text-align: center;
            box-shadow: 1px 2px 0px rgba(0, 0, 0, 0.3);
        }

        #LS-list .table-items{
            background-color: aliceblue;
            width: 100%;
        }
        #LS-list .table-items:hover{
            border-color: black;
        }
        #LS-list .table-items div{
            margin-left: 15px;
            padding: auto;
            font-size: 25px;
            border-radius: 10px;
            border-width: 2px;
            border-color: black;
            /* background-color: #027f79; */
            text-align: center;
            display: block;
        }
        #LS-list .table-items .trangThai{
            /* background-color: blue; */
            text-align: right;
            padding-right: 10%;
        }
        #LS-list .table-items .trangThai .status-orders{
            background-color: red;
            width: 50%;
            /* margin-left: 6%; */
        }
        .order-detail {
            background-color: #027f79;
            /* font-weight: bold; */
            border-radius: 5px;
            box-shadow: 1px 2px 0px rgba(0, 0, 0, 0.3);
            width: 50px;
            margin-left: -50px;
            margin-right: 20px;
            font-size: 20px;
            padding: 1.5px;
        }
        .order-detail a{
            color: whitesmoke;
        }
        .order-detail:hover a{
            color: gold;
            background-color: #027f79;
        }
        .order-detail:active{
            color: gold;
            background-color: #027f79;
        }
        /* Lịch sử mua hàng */
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <div class="form_TTKhachHang">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="section__container">
                <div class="row">
                    <div class="col-12">
                        <h4 style="font-size: 40px;">Thông tin khách hàng</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="breadcrumb col-12">
                        <div class="breadcrumb__links horizontal">
                            <div class="breadcrumb__link body2"><a href="home.php">Trang chủ</a></div>
                            <div id="ttkh" class="breadcrumb__link body2">Thông tin khách hàng</div>
                        </div>
                    </div>
                </div>
        </div>
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
                                <input type="file" value="img/defaultAVT.jpg" accept="image/png, image/jpeg" id="uploadInput" name="txtHinhAnh" onchange="hienThiAnh(event)" >
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
                        </div>
                        <div class="ThongTinKhachHang-data3">Bạn muốn thay đổi thông tin?<button class="check-ThongTin" id="check-ThongTin" name="thaydoi" onclick="validateForm(event)">Thay đổi</button></div>
                        ';}
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
                                // echo "bbbb";
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
            <h1 id="LichSu-Text">Lịch sử mua hàng</h1>
            <script>
            </script>
            <div id="wrapper">
                <div class="table">
                    <div class="table-title">
                        <!-- <div style="width: 20%; font-weight: bold;">Khách hàng</div> -->
                        <div style="width: 15%; font-weight: bold;">Số hóa đơn</div>
                        <div style="width: 15%; font-weight: bold;">Ngày mua</div>
                        <div style="width: 30%; font-weight: bold;">Tổng tiền</div>
                        <div style="width: 40%; font-weight: bold;">Trạng thái</div>
                    </div>
                    <div><br></div>
                    <div><br></div>
                    <div id="LS-list" style="overflow-y: scroll;">
                        <?php
                        $conn = connectDB();
                        if (isset($_SESSION['user_id'])) {
                            $maKH = $_SESSION['user_id']; //SELECT * FROM table_name ORDER BY ngay_column DESC
                            $sql = mysqli_query($conn, "SELECT * FROM donhang WHERE maKhachhang = '$maKH' ORDER BY Ngay DESC");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<div class="table-items">';
                                echo '<div style="width: 12.5%;">' . $row["Madonhang"] . '</div>';
                                echo '<div style="width: 20%;">' . $row["Ngay"] . '</div>';
                                echo '<div style="width: 27.5%;">' . $row["Tonggiatri"] . ' VND</div>';
                                echo '<div class="trangThai" style="width: 40%;>';
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
                                
                                echo '<button style="width: 5%" type="button" class="order-detail"><a href="home.php?chon=ctdh&maDH=' . $row['Madonhang'] . '">Chi tiết</a></button>';
                                echo '</div>';
                                // echo '</div>';
                            }
                        }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
    </div>

    </form>
    </div>
</body>

</html>