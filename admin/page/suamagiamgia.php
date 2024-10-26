<?php
include("../page/connectDB.php");

if (isset($_GET['Magiamgia'])) {
    $maKhuyenMai = $_GET['Magiamgia'];

    // Lấy thông tin mã giảm giá từ cơ sở dữ liệu
    $sql = "SELECT * FROM giamgia WHERE Magiamgia = '$maKhuyenMai'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Mã giảm giá không tồn tại.";
        exit;
    }
}

if (isset($_POST['txtMakm']) && isset($_POST['txtTenkm']) && isset($_POST['startDate']) && isset($_POST['endDate']) && isset($_POST['txtSale']) && isset($_POST['txtMota'])) {
    $oldMaKhuyenMai = $_POST['txtOldMakm'];
    $maKhuyenMai = $_POST['txtMakm'];
    $tenKhuyenMai = $_POST['txtTenkm'];
    $ngayBatDau = $_POST['startDate'];
    $ngayKetThuc = $_POST['endDate'];
    $mucGiam = $_POST['txtSale'];
    $moTa = $_POST['txtMota'];

    if ($oldMaKhuyenMai !== $maKhuyenMai) {
        $sql_check = "SELECT * FROM giamgia WHERE Magiamgia = '$maKhuyenMai'";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            echo "<script>alert('Mã khuyến mãi đã tồn tại. Vui lòng nhập mã khác.'); window.history.back();</script>";
            exit;
        }
    }

    $sql_update = "UPDATE giamgia SET Magiamgia='$maKhuyenMai', tenGiamgia='$tenKhuyenMai', Ngaybatdau='$ngayBatDau', Ngayketthuc='$ngayKetThuc', Mucgiam='$mucGiam', moTa='$moTa' WHERE Magiamgia='$oldMaKhuyenMai'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href = 'AKhuyenmai.php';</script>";
    } else {
        echo "Lỗi: " . $sql_update . "<br>" . mysqli_error($conn);
    }
} 

    mysqli_close($conn);
?>

<html>
<head>
    <meta charset="utf-8"/>
    <link href="../css/formthemKM.css?version=1.0" rel="stylesheet"/>
    <title>Sửa khuyến mãi</title>
</head>
<body>
    <h2><a href="AHome.php">Trang chủ</a> >> <a href="AHome.php?chon=t&id=khuyenmai">Khuyến mãi</a> > >Sửa khuyến mãi</h2>
    <div class="form-km">
        <form class="formkhuyenmai" id="formkhuyenmai" method="post" action="">
            <h3>Sửa khuyến mãi</h3>
            <input type="hidden" name="txtOldMakm" value="<?php echo htmlspecialchars($row['Magiamgia']); ?>"/>
            
            <label for="txtMakm">Mã khuyến mãi</label>
            <input type="text" name="txtMakm" value="<?php echo htmlspecialchars($row['Magiamgia']); ?>" placeholder="Nhập vào mã khuyến mãi..."/>

            <label for="txtTenkm">Tên khuyến mãi</label>
            <input type="text" name="txtTenkm" value="<?php echo htmlspecialchars($row['tenGiamgia']); ?>" placeholder="Nhập vào tên mã khuyến mãi..."/>

            <label for="startDate">Ngày bắt đầu</label>
            <input type="date" name="startDate" id="startDate" value="<?php echo htmlspecialchars($row['Ngaybatdau']); ?>"/>

            <label for="endDate">Ngày kết thúc</label>
            <input type="date" name="endDate" id="endDate" value="<?php echo htmlspecialchars($row['Ngayketthuc']); ?>"/>

            <label for="txtSale">Mức giảm</label>
            <input type="text" name="txtSale" value="<?php echo htmlspecialchars($row['Mucgiam']); ?>" />

            <label for="txtMota">Mô tả</label>
            <input type="text" name="txtMota" value="<?php echo htmlspecialchars($row['moTa']); ?>" placeholder="Nhập vào mô tả khuyến mãi..."/>

            <div class="group-btn">
                <button type="button" id="delBtn" class="delBtn" onclick="window.location.href='AKhuyenmai.php'">Hủy</button>
                <button type="reset" id="resetBtn" class="resetBtn">Đặt lại</button>
                <button type="submit" id="submitBtn" class="submitBtn">Lưu</button>
            </div>
        </form>
    </div>
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
