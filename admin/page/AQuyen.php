<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$conn = new Database();

$userAuth = new userAuth($conn);
$userAuth->checkReadPermission("CN006");

$isCreate = $userAuth->checkCreatePermission("CN006");
$isUpdate = $userAuth->checkUpdatePermission("CN006");
$isDelete = $userAuth->checkDeletePermission("CN006");

$role = $conn->query("SELECT * FROM quyen");

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách quyền</title>

    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/dsnv.css">
    <link rel="stylesheet" href="style.css?version=1.0">

    <style>

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php
?>
<?php
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "bolashop";

$conn = new mysqli($servername, $user, $password, $dbname);
$sql="SELECT * FROM quyen";
$query=mysqli_query($conn, $sql);
mysqli_close($conn);
?>

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
        <div class="title">Danh sách quyền</div>
        <div class="btn-ThemNV  <?= $isCreate ?"":"hidden"  ?> "><a href="AHome.php?chon=t&id=quyen&loai=them"> + Thêm quyền</a></div>
        <div style="clear: both;"></div>
        <div class="timkiembar" action="" method="post">
            <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
            <button type="submit" name="timkiem" >Tìm kiếm</button>
        </div>
        <div><br></div>
        <div style="display: flex; justify-content: center;">
            <div class="table">
                <div class="table-title">
                    <div style="width: 20%; font-weight: bold;">Mã quyền</div>
                    <div style="width: 20%; font-weight: bold;">Tên quyền</div>
                    <div style="width: 40%; font-weight: bold;">Mô tả</div>
                    <div style="width: 20%; font-weight: bold;">Thao tác</div>

                </div>
                <div><br></div>
                <div><br></div>
                <div style="overflow-y: scroll;">
                <?php foreach($query as $key => $value) { ?>
                    <div class="table-items">
                        <div style="width: 20%;">
                            <div><?php echo $value["Maquyen"]; ?></div>
                        </div>
                        <div style="width: 20%;"><?php echo $value["Tenquyen"]; ?></div>
                        <div style="width: 40%;">abc</div>
                        <div style="width: 20%;">
                            <a class="<?= $isUpdate?"":"hidden" ?>"
                                style="background-color: white; border: solid 0.5px #D61EAD; color: black; text-decoration: none;" href="AHome.php?chon=t&id=quyen&loai=sua&idquyen=<?php echo $value['Maquyen'] ;?>">Sửa</a>
                            <button id="<?php echo $value["Maquyen"]; ?>" class="<?= $isDelete?"":"hidden" ?>"type="button" onclick="xoaquyen(this)" >Xóa</button>
                        </div>
                    </div>
                    <?php }?>
                </div>

                <!-- <div class="horizontal-line"></div>
                <div class="page">
                    < 1 2 3 ...>
                </div> -->

            </div>
        </div>

    </div>
</body>

</html>
<script>
    function xoaquyen(button){
        var id=$(this).attr("id");
        $.ajax({

            url: "delete_quyen.php",
            type: "POST",
            data: {
                id: id
            },
            success: function(data) {
                if (data == 1) {
                    alert("Xóa thành công");
                    location.reload();
                } else {
                    alert("Xóa thất bại");
                }
            },
            error: function(data) {
                alert("Xóa thất bại");
            }
        });


    }
</script>