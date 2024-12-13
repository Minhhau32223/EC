<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN003");

$isCreate = $userAuth->checkCreatePermission("CN003");
$isUpdate = $userAuth->checkUpdatePermission("CN003");
$isDelete = $userAuth->checkDeletePermission("CN003");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/thongke.css?version=1.0">
    <link rel="stylesheet" href="../css/chitiethoadon.css?version=1.0">
    <link rel="stylesheet" href="../css/phieuxuat.css?version=1.0">
    <link rel="stylesheet" href="../css/dsnv.css?version=1.0">
    <link rel="stylesheet" href="../css/ncc.css?version=1.0">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/middle.css?version=1.0">
    <style>
        .table{
            height: 600px;
            width: 90%;
            /* background-color: red; */
        }
        .table-title div{
            text-decoration: none;
        }
        .hidden {
            display: none !important;
        }
        #listSP{
            height: 100%;
        }
        #SpContainer{
            margin-top: -16%;
            /* background-color: red; */
            height: 25%;
        }
        .item{
            height: 20%;
            /* background-color: red; */
            margin-top: 1%;
            display: flex;
            border: 0.2px solid rgba(0, 0, 0, 0.6);
            border-radius: 4px;
        }   
        .item img {
            height: 90%;
            width: 4%;
            margin-left: 2.5%;
            padding-left: 0.5%;
            margin-top: 0.25%;
        }
        .item-tensp{
            width: 28%;
            padding: 1%;
            font-size: 18px;
            margin-left: 1%;
        }
        .item-dongia{
            /* background-color: #0056b3; */
            width: 20%;
            padding: 1%;
            font-size: 18px;
            margin-left: 1%;
        }
        .item-soluong{
            /* background-color: #0056b3; */
            width: 20%;
            padding: 1%;
            font-size: 18px;
            margin-left: 2%;
        }
        .item-actions {
            width: 20%;
            /* background-color: #0056b3; */
            /* padding: 5%; */
        }
        .btn_sua_sp {
            background: #D61EAD;
            color: #ffffff;
            border: 0.2px solid rgba(0, 0, 0, 0.6);
            border-radius: 4px;
            position: relative;
            text-align: center;
            width: 30%;
            height: 30%;
            padding: 5%;
            font-size: 16px;
            padding-bottom: 10%;
        }

        .btn_sua_sp:hover {
            background-color: #942a7d;
            /* Màu nền khi hover */
        }

        .delete-btn-sp {
            border: 0.2px solid rgba(0, 0, 0, 0.6);
            border-radius: 4px;
            text-align: center;
            position: relative;
            width: 30%;
            height: 30%;
            padding: 5%;
            font-size: 16px;
            padding-bottom: 10%;
        }
        .delete-btn-sp:hover{
            background-color: gray;
            color: white;
        }
        .timkiembar{
            height: 20%;
        }
        .btn-ThemNV {
            height: 20%;
        }
    </style>
</head>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'bolashop');
$sql = "SELECT * FROM sanpham";
$rs_sp = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs_sp);

if(isset($_POST["timkiemsp"])){
    $searchKey = trim($_POST["txtTimKiemsp"]);
    $sql_search = "SELECT * FROM sanpham WHERE Tensp LIKE '%$searchKey%' OR Giaban LIKE '%$searchKey%'";
    $rs_sp = mysqli_query($conn, $sql_search);
}
mysqli_close($conn);
?>

<body>
    <div id="SpContainer" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="title">Sản phẩm</div>
    <div class="btn-ThemNV <?=$isCreate?"":"hidden"?>" onclick="redirectToForm()"> + Thêm sản phẩm</div>
    <div style="clear: both;"></div>
    <form class="timkiembar" action="" method="post">
        <input class="search" type="text" name="txtTimKiemsp" placeholder="Tìm kiếm...">
        <button type="submit" name="timkiemsp" >Tìm kiếm</button>
    </form>
    <div><br></div>
    <div id="wrapper">
            <div class="table">
                <div class="table-title">
                    <div style="width: 30%; font-weight: bold;">Sản phẩm</div>
                    <div style="width: 20%; font-weight: bold;">Đơn giá</div>
                    <div style="width: 20%; font-weight: bold;">Số lượng</div>
                    <div style="width: 30%; font-weight: bold;"></div>
                </div>
                <div><br></div>
                <div><br></div>
                <div id="listSP" style="overflow-y: scroll;">
                <?php
                include("../page/connectDB.php");
                $sql_sanpham = mysqli_query($conn, "SELECT * FROM sanpham ORDER BY Masp ASC");
                while ($row_sanpham = mysqli_fetch_array($sql_sanpham)) {
                    $textupd = "";
                    $textdel = "";
                    if (!$isUpdate) {
                        $textupd = "hidden";
                    }
                    if (!$isDelete) {
                        $textdel = "hidden";
                    }

                    echo '<div class="item" id="item-' . $row_sanpham["Masp"] . '">';
                    echo '<img src="../../img/' . $row_sanpham["Img"] . '" alt="">';
                    echo '<div class="item-tensp">' . $row_sanpham["Tensp"] . '</div>';
                    echo '<div class="item-dongia">' . $row_sanpham["Giaban"] . ' VND</div>';
                    echo '<div class="item-soluong">' . $row_sanpham["Soluongconlai"] . '</div>';
                    echo '<div class="item-actions">';
                    echo '<button class="btn_sua_sp  ' . $textupd . '" onclick="AHome.php?chon=t&id=sanpham&loai=sua&Masp=' . $row_sanpham["Masp"] . '" >Sửa</button>';
                    echo '<button class="delete-btn-sp  ' . $textdel . '" onclick="deleteItem(\'' . $row_sanpham["Masp"] . '\')">Xóa</button>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</body>
    <script>
        function deleteItem(masp) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'xulyxoasanpham.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200 && xhr.responseText.trim() === 'Xóa sản phẩm thành công!') {
                        alert('Xóa sản phẩm thành công!');
                        var element = document.getElementById('item-' + masp);
                        if (element) {
                            element.parentNode.removeChild(element);
                        }
                    } else {
                        alert('Đã xảy ra lỗi khi xóa sản phẩm: ' + xhr.responseText);
                    }
                };
                xhr.onerror = function() {
                    console.error('Đã xảy ra lỗi khi gửi yêu cầu AJAX');
                };
                xhr.send('Masp=' + encodeURIComponent(masp));
            }
        }

        function redirectToForm() {
            window.location.href = 'AHome.php?chon=t&id=sanpham&loai=them   ';
        }
    </script>

</html>