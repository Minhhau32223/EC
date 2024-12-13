<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN004");

$isCreate = $userAuth->checkCreatePermission("CN004");
$isUpdate = $userAuth->checkUpdatePermission("CN004");
$isDelete = $userAuth->checkDeletePermission("CN004");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>



<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'bolashop';

$db = new mysqli($server, $user, $pass, $database);

if ($db) {
    mysqli_query($db, "SET NAMES 'utf8'");
} else {
    echo 'ket noi that bai';
}

$sql = "SELECT * FROM nguoidung WHERE Loainguoidung != 'Q1'";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="../css/phieuxuat.css?version=1.0">
    <link rel="stylesheet" href="../css/chitiethoadon.css?version=1.0">
    <link rel="stylesheet" href="../css/dsnv.css?version=1.0">
    <style>
        #avt-name{
            display: flex;
            margin-top: -1.5%;           
            padding: 2%;
            /* background-color: blanchedalmond; */
        }
        #name{
            padding-top: 5%;
            /* background-color: aqua; */
            width: 75%;
            text-align: left;
            margin-left: 5%;
        }
        .avt {
            /* background-color: bisque; */
            width: 20%;
            height: 80px;
            border-radius: 50%;
            /* overflow: hidden;
            background-size: cover; */
            /* background-repeat: no-repeat; */
            background-position: center;
            float: left;
        }
        .table-items div{
            /* background-color: aqua; */
            margin-left: 0.5%;
            text-align: center;
        }
        #userButtons{
            /* background-color: aquamarine; */      
        }
        #userButtons select{
            font-size: 18px;
            width: 30%;
            height: 75%;
            float: left;
            margin-left: 17.5%;
            /* padding: 2.5%; */
        }
        #userButtons button{
            height: 75%;
            font-size: 18px;
            margin-left: 5%;
        }
        .delete-btn{
            background-color: red;
            color: white;
            width: 10%;
            border-radius: 10px;
            border-width: 0.5px;
        }
        .delete-btn:hover{
            background-color: rgb(193, 35, 35);
        }
        .edit-btn {
            width: 20%;
            border-radius: 10px;
            border-width: 0.5px;
        }
        .edit-btn:hover{
            background-color: grey;
            color: whitesmoke;
        }
    </style>
</head>


<?php
$conn = mysqli_connect('localhost', 'root', '', 'bolashop');
$sql = "SELECT * FROM nguoidung";
$rs_ncc = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs_ncc);

if(isset($_POST["timkiem"])){
    $searchKey = trim($_POST["txtTimKiem"]);
    $sql_search = "SELECT * FROM nguoidung WHERE Manguoidung LIKE '%$searchKey%' OR Ten LIKE '%$searchKey%'";
    $rs_ncc = mysqli_query($conn, $sql_search);
}
mysqli_close($conn);
?>
<body>
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="title">Người dùng</div>
        <div class="btn-ThemNV <?=$isCreate?"":"hidden"?>" onclick="window.location.href='AHome.php?chon=t&id=nguoidung&loai=them'"> + Thêm người dùng</div>
        <div style="clear: both;"></div>
        <div class="timkiembar" action="" method="post">
            <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
            <button type="submit" name="timkiem" >Tìm kiếm</button>
        </div>
        <div><br></div>
        <div style="display: flex; justify-content: center;">
            <div class="table">
                <div class="table-title">
                    <div style="width: 30%; font-weight: bold;">Họ tên</div>
                    <div style="width: 20%; font-weight: bold;">Mã người dùng</div>
                    <div style="width: 20%; font-weight: bold;">Nhóm quyền</div>
                    <div style="width: 25%; font-weight: bold; text-align: left; margin-left: 5%">Trạng thái</div>
                </div>
                <div><br></div>
                <div><br></div>
                <div style="overflow-y: scroll;">
                    <?php
                    if ($result->num_rows > 0) {
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
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="table-items">';
                            echo '<div class="staff" id="avt-name">';
                            echo '<div class="avt" style="background-image: url(\'../../img/' . $row['img'] . '\');"></div>';
                            echo '<div id="name">' . $row['Ten'] . '</div>';
                            echo '</div>';
                            echo '<div style="width: 20%;">' . $row['Manguoidung'] . '</div>';
                            echo '<div style="width: 20%;">';
                            echo '<div class="button">' . $row['Loainguoidung'] . '</div>';
                            echo '</div>';
                            echo '<div id="userButtons" class="staff" data-id="' . $row['Manguoidung'] . '">';
                            echo '<select>';
                            if ($row['Loainguoidung'] != 'Q0') {
                                echo '<option value="1">Đã duyệt</option>';
                            } else {
                                echo '<option value="0">Chưa duyệt</option>';
                            }
                            echo '</select>';
                            echo '<button type="button" class="edit-btn'.$textupd.'">Sửa</button>';
                            echo '<button type="button" class="delete-btn'.$textdel.'">X</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "Không có dữ liệu";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        var id = $(this).closest('.staff').data('id');
        $.ajax({
            type: 'POST',
            url: 'xoanguoidung.php',
            data: { id: id },
            success: function(response) {
                if(response == 'success') {
                    alert("Đã xóa người dùng có id là: " + id);
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('.edit-btn').click(function() {
        var id = $(this).closest('.staff').data('id');
        window.location.href = 'AHome.php?chon=t&id=nguoidung&loai=sua&maND=' + id;
    });
});
</script>