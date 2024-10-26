<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="../css/formthemKM.css?version=1.0" rel="stylesheet"/>
        <title>Form Nhà cung cấp</title>
    </head>
    <body>
        <?php
       $con = mysqli_connect('localhost', 'root', '', 'bolashop');
        if(isset($_GET['idncc'])){
            $mancc = $_GET['idncc'];
            $sql="SELECT * FROM nhacungcap WHERE Mancc ='$mancc'";
            $query = mysqli_query($con, $sql);
            if(isset($_POST['submitBtn'])){
                $ma_ncc = $_POST['Mancc'];
                $ten_ncc = $_POST['Ten'];
                $dc_ncc = $_POST['Diachi'];
                $sdt_ncc = $_POST['Sdt'];
            
                // Sử dụng prepared statements để bảo vệ dữ liệu và tránh lỗi SQL injection
                $sql = "UPDATE nhacungcap SET Ten=?, Diachi=?, Sdt=? WHERE Mancc=?";
                $stmt = mysqli_prepare($con, $sql);
            
                // Kiểm tra lỗi khi chuẩn bị truy vấn
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssss", $ten_ncc, $dc_ncc, $sdt_ncc, $ma_ncc);
                    mysqli_stmt_execute($stmt);
            
                    // Kiểm tra xem có hàng được cập nhật hay không
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        header('Location: AHome.php?chon=t&id=nhacungcap');
                        exit(); // Kết thúc kịch bản sau khi chuyển hướng
                    } else {
                        echo "Không thể cập nhật nhà cung cấp.";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Lỗi trong quá trình chuẩn bị truy vấn.";
                }
            }
        }
       mysqli_close($con);
        ?>
        <h2><a href="AHome.php">Trang chủ >> </a><a href="AHome.php?chon=t&id=nhacungcap">Nhà cung cấp >> </a>Sửa nhà cung cấp</h2>
        <div class="form-km">
            <form class="formkhuyenmai" id="formkhuyenmai" method="post" action="">
                <h2 style="margin-left: 200px;">Nhà cung cấp</h2>
                <?php foreach($query as $key => $value) { ?>
                    <input type="hidden" name="Mancc" value="<?php echo $value["Mancc"]; ?>" />

                    <label for="txtTenkh">Tên nhà cung cấp</label>
                    <input type="text" name="Ten" value="<?php echo $value["Ten"]; ?>" />

                    <label for="txtDiachi">Địa chỉ</label>
                    <input type="text" name="Diachi" value="<?php echo $value["Diachi"]; ?>" />

                    <label for="txtSdt">Số điện thoại</label>
                    <input type="text" name="Sdt" value="<?php echo $value["Sdt"]; ?>" />
                <?php } ?>
                <div class="group-btn">
                    <button type="button" id="delBtn" class="delBtn" onclick="history.back();">Hủy</button>
                    
                    <button type="Submit" name="submitBtn" id="submitBtn" class="submitBtn">Lưu</button>
                </div>
            </form>
        </div>
    </body>
</html>