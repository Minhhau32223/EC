<?php include("../page/connectDB.php") 
?>
<?php
if (isset($_POST["txtThemsanpham"])) {
    if (!empty($_POST["txtTensp"]) && !empty($_POST["txtMotasp"]) && !empty($_FILES["txtHinhanh"]["name"]) && !empty($_POST["txtGioitinh"]) && !empty($_POST["txtThuonghieu"])
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

        // Kiểm tra xem sản phẩm đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check_product = mysqli_query($conn, "SELECT * FROM sanpham WHERE Tensp = '$tensp'");
        $num_rows = mysqli_num_rows($sql_check_product);

        if ($num_rows > 0) {
            // Sản phẩm đã tồn tại, tăng số lượng sản phẩm
            $row = mysqli_fetch_assoc($sql_check_product);
            $soluongconlai = $row['Soluongconlai'] + $soluong;

            $sql_update_product = mysqli_query($conn, "UPDATE sanpham SET Soluongconlai = '$soluongconlai' WHERE Tensp = '$tensp'");
            echo '<script>window.location.href = "AHome.php?chon=t&id=sanpham"</script>';
        } else {
            // Sản phẩm chưa tồn tại, thêm sản phẩm mới
            $sqp_insert_product = mysqli_query($conn, "INSERT INTO sanpham(Tensp, Giaban, Soluongconlai, Mota, Madanhmuc, Mathuonghieu, Img, Gianhap, Gioitinh) 
                VALUES('$tensp', '$giaban', '$soluong', '$motasp', '$danhmuc', '$thuonghieu', '$hinhanh', '$gianhap', '$gioitinhsp')");

            move_uploaded_file($hinhanh_temp, $path . $hinhanh);
            echo '<script>window.location.href = "AHome.php?chon=t&id=sanpham"</script>';
            
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="../css/style.css?v= <?php echo time();?>">
  
</head>
<body>

    <form action="" method="POST" enctype="multipart/form-data" class="addsp">
    <h1>Thêm sản phẩm</h1>
        <div class="addleft">
            <label for="">Tên sản phẩm</label><br>
            <input type="text" class="form-addsp ip_nameSp" name="txtTensp" placeholder="Vui lòng nhập tên sản phẩm."> <br>
            <label for="">Mô tả</label><br>
            <input type="text" class="form-addsp ip_mota" name="txtMotasp" placeholder="Vui lòng mô tả cho sản phẩm."> <br>
            <label for="">Hình ảnh</label><br>
            <input type="file" class="form-addsp ip_hinhanh" id="ip_hinhanh" name="txtHinhanh" value="Thêm hình ảnh" placeholder="Chọn sản phẩm"> <br>
            <div id="image_sp">
                
                 </div>
        </div>
        <div class="addright1">
            <label for="">Giới tính</label><br>
            <input type="radio" value="nu" class="form-addsp ip_gioitinh" name="txtGioitinh">
            <label for="nu" class="lbnu">Nữ</label>
            <input type="radio" value="nam" class="form-addsp ip_gioitinh" name="txtGioitinh">
            <label for="nam" class="lbnam">Nam</label>
            <input type="radio" value="unisex" class="form-addsp ip_gioitinh" name="txtGioitinh">
            <label for="unisex" class="lbunisex">Unisex</label>
            <br>
            <label for="">Thương hiệu</label><br>
            <?php
            $sql_thuonghieu=mysqli_query($conn,"SELECT * FROM thuonghieu ORDER BY Mathuonghieu DESC");
            ?>
            <select name="txtThuonghieu" >
                <option value="0">--Chọn thương hiệu--</option>
                <?php 
                        while($row_thuonghieu=mysqli_fetch_array($sql_thuonghieu))
                        {

                        
                ?>
                <option value="<?php echo $row_thuonghieu["Mathuonghieu"]?>"> <?php echo $row_thuonghieu["tenThuonghieu"]?></option>

                <?php 
                        }
                ?>
            </select><br>
            <label for="">Danh mục</label><br>
            <?php
                $sql_danhmuc=mysqli_query($conn,"SELECT *FROM danhmuc ORDER BY Madanhmuc DESC");
            ?>
            <select name="txtDanhmuc" >
                <option value="0">--Chọn danh mục--</option>
                <?php
                while($row_danhmuc=mysqli_fetch_array($sql_danhmuc))
                { 
                ?>
                <option value="<?php echo $row_danhmuc["Madanhmuc"]?>"> <?php echo $row_danhmuc["Tendanhmuc"]?></option>
                <?php 
                }
            ?>
            </select><br>
            <label for="">Số lượng nhập </label><br>
            <input type="text" name="txtSoluongnhap" class="form-addsp" placeholder="Nhập số lượng.">

        </div>
        <div class="addright2">
                <label for="">Giá nhập</label><br>
                <input type="text" name="txtGianhap"><br>
                
                <label for="">Giá bán</label><br>
                <input type="text" name="txtGiaban"><br>
        </div>

        <input type="submit" value="Thêm sản phẩm" name="txtThemsanpham" class="addsp_submit">
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var form = document.querySelector('.addsp');

    form.addEventListener('submit', function(event) {
        var soluongnhap = document.querySelector('input[name="txtSoluongnhap"]').value;
        var gianhap = document.querySelector('input[name="txtGianhap"]').value;
        var giaban = document.querySelector('input[name="txtGiaban"]').value;

        if (!Number.isInteger(parseInt(soluongnhap))) {
            alert("Vui lòng nhập số nguyên cho số lượng nhập.");
            event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu nếu dữ liệu không hợp lệ
        }

        if (!Number.isInteger(parseInt(gianhap))) {
            alert("Vui lòng nhập số nguyên cho giá nhập.");
            event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu nếu dữ liệu không hợp lệ
        }

        if (!Number.isInteger(parseInt(giaban))) {
            alert("Vui lòng nhập số nguyên cho giá bán.");
            event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu nếu dữ liệu không hợp lệ
        }
    });
});
</script>

</body>
<script src="../scripts/main.js"></script>
</html>