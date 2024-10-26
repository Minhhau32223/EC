<?php include("../page/connectDB.php")
?>
<?php

if (isset($_POST['txtMakh']) && isset($_POST['txtTenkh']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['txtSale']) && isset($_POST['txtMota'])) {

    $maKhuyenMai = $_POST['txtMakh'];
    $tenKhuyenMai = $_POST['txtTenkh'];
    $ngayBatDau = $_POST['startDate'];
    $ngayKetThuc = $_POST['endDate'];
    $mucGiam = $_POST['txtSale'];
    $moTa = $_POST['txtMota'];

    $sql_check = "SELECT * FROM giamgia WHERE Magiamgia = '$maKhuyenMai'";
    $result_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>alert('Mã khuyến mãi đã tồn tại. Vui lòng nhập mã khác.');</script>";
    } else {
        $sql_insert = "INSERT INTO giamgia (Magiamgia, Ngaybatdau, Ngayketthuc, Mucgiam, tenGiamgia, moTa) VALUES ('$maKhuyenMai', '$ngayBatDau', '$ngayKetThuc', '$mucGiam', '$tenKhuyenMai', '$moTa')";

        if (mysqli_query($conn, $sql_insert)) {
            echo '<script>window.location.href = "AHome.php?chon=t&id=khuyenmai";</script>';
        } else {
            echo "Lỗi: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    // echo '';
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <link href="../css/formthemKM.css?version=1.0" rel="stylesheet" />
    <title>Form thêm khuyến mãi</title>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h2><a href="AHome.php">Trang chủ</a> >><a href="AHome.php?chon=t&id=khuyenmai"> Khuyến mãi</a> >> Thêm khuyến mãi</h2>
    <div class="form-km">
        <form class="formkhuyenmai" id="formkhuyenmai" method="post" action="">
            <h3>Khuyến mãi</h3>
            <label for="txtMakh">Mã khuyến mãi</label>
            <input type="text" name="txtMakh" value="" placeholder="Nhập vào mã khuyến mãi..." />

            <label for="txtTenkh">Tên khuyến mãi</label>
            <input type="text" name="txtTenkh" value="" placeholder="Nhập vào tên mã khuyến mãi..." />

            <label for="startDate">Ngày bắt đầu</label>
            <input type="date" name="startDate" id="startDate" value="" />

            <label for="endDate">Ngày kết thúc</label>
            <input type="date" name="endDate" id="endDate" value="" />

            <label for="txtSale">Mức giảm</label>
            <input type="text" name="txtSale" value="" />

            <label for="txtMota">Mô tả</label>
            <input type="text" name="txtMota" value="" placeholder="Nhập vào mô tả khuyến mãi..." />

            <div class="group-btn">
                <button type="button" id="delBtn" class="delBtn" onclick="redirectToAKhuyenmai()">Hủy</button>
                <button type="reset" id="resetBtn" class="resetBtn">Đặt lại</button>
                <button type="Submit" id="submitBtn" class="submitBtn">Lưu</button>
            </div>
        </form>
    </div>
    <script>
        function redirectToAKhuyenmai() {
            window.location.href = "AHome.php?chon=t&id=khuyenmai";
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('formkhuyenmai');

            form.addEventListener('submit', function(event) {
                var txtSale = document.querySelector('input[name="txtSale"]').value;
                var regex = /^[0-9]+$/;

                if (!regex.test(txtSale)) {
                    alert("Vui lòng nhập số nguyên cho mức giảm.");
                    event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu nếu dữ liệu không hợp lệ
                }
            });
        });
    </script>
</body>

</html>