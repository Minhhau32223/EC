<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN013");

$isCreate = $userAuth->checkCreatePermission("CN013");
$isUpdate = $userAuth->checkUpdatePermission("CN013");
$isDelete = $userAuth->checkDeletePermission("CN013");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách danh mục</title>

    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/dsnv.css">
    <!-- <link rel="stylesheet" href="style.css?version=1.0"> -->

    <style>

    </style>
</head>

<body>
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="title">Danh sách danh mục</div>
        <div class="btn-ThemNV <?=$isCreate?"":"hidden"?>" onclick="window.location.href='AHome.php?chon=t&id=danhmuc&loai=them'"> + Thêm danh mục</div>
        <div style="clear: both;"></div>
        <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
        <div><br></div>
        <div style="display: flex; justify-content: center;">
            <div class="table">
                <div class="table-title">
                    <div style="width: 35%; font-weight: bold;">Mã danh mục</div>
                    <div style="width: 35%; font-weight: bold;">Tên danh mục</div>
                    <div style="width: 30%; font-weight: bold;">Thao tác</div>
                    <div><br></div>
                    <div><br></div>
                    <div style="overflow-y: scroll;"></div>
                </div>
                <div><br></div>
                <div><br></div>
                <div style="overflow-y: scroll;">
                    <?php
                    $server = 'localhost';
                    $user = 'root';
                    $pass = '';
                    $database = 'bolashop';

                    $db = new mysqli($server, $user, $pass, $database);

                    if ($db) {
                        mysqli_query($db, "SET NAMES 'utf8'");
                    } else {
                        echo 'Kết nối thất bại';
                        exit();
                    }

                    $sql = "SELECT * FROM danhmuc";
                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $textupd="";
                            $textdel="";
                            if(!$isUpdate)
                            {
                                $textupd="hidden";
                            }
                            if(!$isDelete)
                            {
                                $textdel="hidden";
                            }
                            echo '<div class="table-items">';
                            echo '<div style="width: 35%;">' . $row['Madanhmuc'] . '</div>';
                            echo '<div style="width: 35%;">' . $row['Tendanhmuc'] . '</div>';
                            echo '<div style="width: 30%;">';
                            echo '<div class="staff" data-id="' . $row['Madanhmuc'] . '">';
                            echo '<button type="button" class="edit-btn  '.$textupd.'" style="background-color: ##D61EAD; border: solid 0.5px #D61EAD; color: black;">Sửa</button>';
                            echo '<button type="button" class="DLT  '.$textdel.'" style="background-color: white; border: solid 0.5px #D61EAD; color: black;">Xóa</button>';
                            echo '</div>'; // staff
                            echo '</div>'; // table-items
                            echo '</div>'; // container
                        }
                    } else {
                        echo '<div>Không có dữ liệu</div>';
                    }

                    $db->close();
                    ?>
                </div>

                <div class="horizontal-line"></div>
                <div class="page">
                </div>

            </div>
        </div>

    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
//xóa danh mục
$(document).ready(function() {
    $('.DLT').click(function() {
        var id = $(this).parents('.staff').data('id');
        $.ajax({
            type: 'POST',
            url: 'xoadanhmuc.php', 
            data: { id: id },
            success: function(response) { 
                if(response === 'success') {
                    alert("Đã xóa danh mục có id là: " + id);
                    location.reload();  
                } else {
                    alert("Có lỗi xảy ra: " + response);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

});
// sửa
$(document).ready(function() {
    $('.edit-btn').click(function() {
        // Lấy id của danh mục
        var idth = $(this).closest('.staff').data('id');
        
        // Chuyển hướng đến trang suadanhmuc.php với tham số id
        window.location.href = 'AHome.php?chon=t&id=danhmuc&loai=sua&idth=' + idth;   
     });
});     


</script>