<html>
<head>
    <meta charset="utf-8"/>
    <link href="../css/formthemKM.css?version=1.0" rel="stylesheet"/>
    <title>Form vận chuyển</title>
</head>
<body>
<?php
$con = mysqli_connect('localhost', 'root', '', 'bolashop');
if (isset($_GET['idvc'])) {
    $mavc = $_GET['idvc'];
    $sql = "SELECT * FROM vanchuyen WHERE Mavc = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $mavc);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $query = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (isset($_POST['submitBtn'])) {
                $ma_vc = $_POST['Mavc'];
                $ten_vc = $_POST['Ten'];
                $phivc = $_POST['Gia'];

                $sql = "UPDATE vanchuyen SET Ten=?, Gia=? WHERE Mavc=?";
                $update_stmt = mysqli_prepare($con, $sql);

                if ($update_stmt) {
                    mysqli_stmt_bind_param($update_stmt, "sss", $ten_vc, $phivc, $ma_vc);
                    mysqli_stmt_execute($update_stmt);

                    if (mysqli_stmt_affected_rows($update_stmt) > 0) {
                        mysqli_stmt_close($update_stmt);
                        mysqli_close($con);
                        echo '<script>window.location.href = "AHome.php?chon=t&id=vanchuyen";</script>';
                        // header('Location: AHome.php?chon=t&id=vanchuyen');
                        // exit();
                    } else {
                        echo "Không thể cập nhật phương thức vận chuyển.";
                    }
                    mysqli_stmt_close($update_stmt);
                } else {
                    echo "Lỗi trong quá trình chuẩn bị truy vấn.";
                }
            }
        } else {
            echo "Không tìm thấy phương thức vận chuyển.";
            $query = [];
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi trong quá trình chuẩn bị truy vấn.";
    }
} 
mysqli_close($con);
?>
        <h2><a href="AHome.php">Trang chủ >> </a><a href="AHome.php?chon=t&id=vanchuyen">Vận chuyển >> </a>Sửa vận chuyển</h2>

<div class="form-km">
    <form class="formkhuyenmai" id="formvanchuyen" method="post" action="">
        <h3>Vận chuyển</h3>
        <?php if (!empty($query)) { ?>
            <?php foreach($query as $value) { ?>
                <input type="hidden" name="Mavc" value="<?php echo $value["Mavc"]; ?>" />

                <label for="txtTenkh">Tên vận chuyển</label>
                <input type="text" name="Ten" value="<?php echo $value["Ten"]; ?>" />

                <label for="txtDiachi">Phí vận chuyển</label>
                <input type="text" name="Gia" value="<?php echo $value["Gia"]; ?>" />
            <?php } ?>
        <?php } else { ?>
            <p>Không có thông tin về phương thức vận chuyển.</p>
        <?php } ?>

        <div class="group-btn">
            <button type="button" id="delBtn" class="delBtn" onclick="history.back();">Hủy</button>
            <button type="submit" id="submitBtn" name="submitBtn" class="submitBtn">Lưu</button>
        </div>
    </form>
</div>
</body>
</html>
