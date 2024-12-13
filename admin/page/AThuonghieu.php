<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN012");

$isCreate = $userAuth->checkCreatePermission("CN012");
$isUpdate = $userAuth->checkUpdatePermission("CN012");
$isDelete = $userAuth->checkDeletePermission("CN012");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách thương hiệu</title>

    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/dsnv.css">
    <!-- <link rel="stylesheet" href="style.css?version=1.0"> -->

    <style>
        .staff{
            height: 100%;
            width: 100%;
            /* background-color: aqua; */
            padding-top: 0%;
            margin-top: -2.5%;
        }
        .staff button{
            height: 75%;
            font-size: 18px;
            margin-left: 4%;
            font-weight: bold;
            border-radius: 5px;
            border-width: 0.5px;
        }
        .staff button:hover{
            background-color: gray;
            color: whitesmoke;
        }
        .edit-btn{
            width: 20%;
        }
        .edit-btn:hover{
            background-color: gray;
            color: whitesmoke;
        }
        .delete-btn{
            background-color: red;
            color: whitesmoke;
            width: 10%;
        }
        .delete-btn:hover{
            background-color: brown;
            color: white;
        }
    </style>
</head>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'bolashop');
$sql = "SELECT * FROM nhacungcap";
$rs_ncc = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs_ncc);

if(isset($_POST["timkiem"])){
    $searchKey = trim($_POST["txtTimKiem"]);
    $sql_search = "SELECT * FROM nhacungcap WHERE Mancc LIKE '%$searchKey%' OR Ten LIKE '%$searchKey%'";
    $rs_ncc = mysqli_query($conn, $sql_search);
}
mysqli_close($conn);
?>
<body>
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="title">Danh sách thương hiệu</div>
        <div class="btn-ThemNV <?=$isCreate?"":"hidden"?>" onclick="window.location.href='AHome.php?chon=t&id=thuonghieu&loai=them'"> + Thêm thương hiệu</div>
        <div style="clear: both;"></div>
        <div class="timkiembar" action="" method="post">
            <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
            <button type="submit" name="timkiem" >Tìm kiếm</button>
        </div>
        <div><br></div>
        <div id="wrapper">
            <div class="table">
                <div class="table-title">
                    <div style="width: 35%; font-weight: bold;">Mã thương hiệu</div>
                    <div style="width: 35%; font-weight: bold;">Tên thương hiệu</div>
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

                    $sql = "SELECT * FROM thuonghieu";
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
                            echo '<div style="width: 35%;">' . $row['Mathuonghieu'] . '</div>';
                            echo '<div style="width: 35%;">' . $row['tenThuonghieu'] . '</div>';
                            echo '<div style="width: 30%;">';
                            echo '<div class="staff" data-id="' . $row['Mathuonghieu'] . '">';
                            echo '<button type="button" class="edit-btn  '.$textupd.'" >Sửa</button>';
                            echo '<button type="button" class="delete-btn'.$textdel.'" >X</button>';
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
//xóa thương hiệu
$(document).ready(function() {
    $('.DLT').click(function() {
        var id = $(this).parents('.staff').data('id');
        $.ajax({
            type: 'POST',
            url: 'xoathuonghieu.php', 
            data: { id: id },
            success: function(response) { 
                if(response === 'success') {
                    alert("Đã xóa thương hiệu có id là: " + id);
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
        // Lấy id của thương hiệu
        var idth = $(this).closest('.staff').data('id');
        
        // Chuyển hướng đến trang suathuonghieu.php với tham số id
        window.location.href = 'AHome.php?chon=t&id=thuonghieu&loai=sua&idth=' + idth;   
     });
});     


</script>