<?php
include("../page/connectDB.php");

if (isset($_GET['Masp'])) {
    $maSanPham = $_GET['Masp'];

    $sql_sanpham = mysqli_query($conn, "SELECT * FROM sanpham WHERE Masp = '$maSanPham'");
    $row_sanpham = mysqli_fetch_assoc($sql_sanpham);

    if (!$row_sanpham) {
        echo "Không tìm thấy sản phẩm.";
        exit;
    }
}

if (isset($_POST["txtSuaSanpham"])) {
    if (
        !empty($_POST["txtTensp"]) && !empty($_POST["txtMotasp"]) && !empty($_POST["txtGioitinh"]) && !empty($_POST["txtThuonghieu"])
        && !empty($_POST["txtDanhmuc"]) && !empty($_POST["txtSoluongnhap"]) && !empty($_POST["txtGianhap"]) && !empty($_POST["txtGiaban"])
    ) {
        $tensp = $_POST["txtTensp"];
        $motasp = $_POST["txtMotasp"];
        $hinhanh = $_FILES["txtHinhanh"]["name"];
        $hinhanh_temp = $_FILES["txtHinhanh"]["tmp_name"];
        $gioitinhsp = $_POST["txtGioitinh"];
        $thuonghieu = $_POST["txtThuonghieu"];
        $danhmuc = $_POST["txtDanhmuc"];
        $soluong = $_POST["txtSoluongnhap"];
        $gianhap = $_POST["txtGianhap"];
        $giaban = $_POST["txtGiaban"];
        $path = "../../img/";

        if (!empty($hinhanh)) {
            // If a new image is uploaded, update the image as well
            $sql_update_product = "UPDATE sanpham SET Tensp = '$tensp', Mota = '$motasp', Img = '$hinhanh', Gioitinh = '$gioitinhsp', Mathuonghieu = '$thuonghieu', Madanhmuc = '$danhmuc', Soluongconlai = '$soluong', Gianhap = '$gianhap', Giaban = '$giaban' WHERE Masp = '$maSanPham'";
            move_uploaded_file($hinhanh_temp, $path . $hinhanh);
        } else {
            // If no new image is uploaded, don't update the image
            $sql_update_product = "UPDATE sanpham SET Tensp = '$tensp', Mota = '$motasp', Gioitinh = '$gioitinhsp', Mathuonghieu = '$thuonghieu', Madanhmuc = '$danhmuc', Soluongconlai = '$soluong', Gianhap = '$gianhap', Giaban = '$giaban' WHERE Masp = '$maSanPham'";
        }

        if (mysqli_query($conn, $sql_update_product)) {
            echo "<script>
            alert('Cập nhật sản phẩm thành công!');
            window.location.href = 'AHome.php?chon=t&id=sanpham';
          </script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="../css/style.css?v= <?php echo time(); ?>">
</head>

<body>
    <form id="updateForm" action="" method="POST" enctype="multipart/form-data" class="addsp">
        <h1>Sửa sản phẩm</h1>
        <div class="addleft">
            <label for="">Tên sản phẩm</label><br>
            <input type="text" class="form-addsp ip_nameSp" name="txtTensp" value="<?php echo $row_sanpham['Tensp']; ?>" placeholder="Vui lòng nhập tên sản phẩm."> <br>
            <label for="">Mô tả</label><br>
            <input type="text" class="form-addsp ip_mota" name="txtMotasp" value="<?php echo $row_sanpham['Mota']; ?>" placeholder="Vui lòng mô tả cho sản phẩm."> <br>
            <label for="">Hình ảnh</label><br>
            <input type="file" class="form-addsp ip_hinhanh" id="ip_hinhanh" name="txtHinhanh" value="Thêm hình ảnh" placeholder="Chọn sản phẩm"> <br>
            <div id="image_sp">
                <img src="../../img/<?php echo $row_sanpham['Img']; ?>" alt="<?php echo $row_sanpham['Tensp']; ?>">
            </div>
        </div>
        <div class="addright1">
            <label for="">Giới tính</label><br>
            <input type="radio" value="nu" class="form-addsp ip_gioitinh" name="txtGioitinh" <?php if ($row_sanpham['Gioitinh'] == 'nu') echo 'checked'; ?>>
            <label for="nu" class="lbnu">Nữ</label>
            <input type="radio" value="nam" class="form-addsp ip_gioitinh" name="txtGioitinh" <?php if ($row_sanpham['Gioitinh'] == 'nam') echo 'checked'; ?>>
            <label for="nam" class="lbnam">Nam</label>
            <input type="radio" value="unisex" class="form-addsp ip_gioitinh" name="txtGioitinh" <?php if ($row_sanpham['Gioitinh'] == 'unisex') echo 'checked'; ?>>
            <label for="unisex" class="lbunisex">Unisex</label>
            <br>
            <label for="">Thương hiệu</label><br>
            <?php
            $sql_thuonghieu = mysqli_query($conn, "SELECT * FROM thuonghieu ORDER BY Mathuonghieu DESC");
            ?>
            <select name="txtThuonghieu">
                <option value="0">--Chọn thương hiệu--</option>
                <?php
                while ($row_thuonghieu = mysqli_fetch_array($sql_thuonghieu)) {
                ?>
                    <option value="<?php echo $row_thuonghieu["Mathuonghieu"] ?>" <?php if ($row_sanpham['Mathuonghieu'] == $row_thuonghieu['Mathuonghieu']) echo 'selected'; ?>><?php echo $row_thuonghieu["tenThuonghieu"] ?></option>
                <?php
                }
                ?>
            </select><br>
            <label for="">Danh mục</label><br>
            <?php
            $sql_danhmuc = mysqli_query($conn, "SELECT * FROM danhmuc ORDER BY Madanhmuc DESC");
            ?>
            <select name="txtDanhmuc">
                <option value="0">--Chọn danh mục--</option>
                <?php
                while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                ?>
                    <option value="<?php echo $row_danhmuc["Madanhmuc"] ?>" <?php if ($row_sanpham['Madanhmuc'] == $row_danhmuc['Madanhmuc']) echo 'selected'; ?>><?php echo $row_danhmuc["Tendanhmuc"] ?></option>
                <?php
                }
                ?>
            </select><br>
            <label for="">Số lượng nhập </label><br>
            <input type="text" name="txtSoluongnhap" class="form-addsp" value="<?php echo $row_sanpham['Soluongconlai']; ?>" placeholder="Nhập số lượng.">
        </div>
        <div class="addright2">
            <label for="">Giá nhập</label><br>
            <input type="text" name="txtGianhap" value="<?php echo $row_sanpham['Gianhap']; ?>"><br>
            <label for="">Giá bán</label><br>
            <input type="text" name="txtGiaban" value="<?php echo $row_sanpham['Giaban']; ?>"><br>
        </div>

        <input type="submit" value="Cập nhật sản phẩm" name="txtSuaSanpham" class="addsp_submit">
    </form>
    <footer class="footer">
        <?php require('footer.php'); ?>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('updateForm').addEventListener('submit', function (e) {
                // Lấy giá trị của các trường số lượng, giá nhập và giá bán
                var soluong = document.forms['updateForm']['txtSoluongnhap'].value;
                var gianhap = document.forms['updateForm']['txtGianhap'].value;
                var giaban = document.forms['updateForm']['txtGiaban'].value;

                // Biểu thức chính quy để kiểm tra số nguyên dương
                var integerRegex = /^[0-9]+$/;

                // Kiểm tra số lượng
                if (!integerRegex.test(soluong)) {
                    alert('Vui lòng nhập số lượng là số nguyên.');
                    e.preventDefault();
                    return;
                }

                // Kiểm tra giá nhập
                if (!integerRegex.test(gianhap)) {
                    alert('Vui lòng nhập giá nhập là số nguyên.');
                    e.preventDefault();
                    return;
                }

                // Kiểm tra giá bán
                if (!integerRegex.test(giaban)) {
                    alert('Vui lòng nhập giá bán là số nguyên.');
                    e.preventDefault();
                    return;
                }
            });
        });
    </script>
</body>

</html>
