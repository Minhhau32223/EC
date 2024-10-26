<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN011");

$isCreate = $userAuth->checkCreatePermission("CN011");
$isUpdate = $userAuth->checkUpdatePermission("CN011");
$isDelete = $userAuth->checkDeletePermission("CN011");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Danh sách vận chuyển</title>

    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/dsnv.css">
    <link rel="stylesheet" href="style.css?version=1.0">

    <style>

    </style>
</head>

<body>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'bolashop');
$sql = "SELECT * FROM vanchuyen";
$rs_vc = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($rs_vc);


if(isset($_POST["timkiem"])){
    $searchKey = trim($_POST["txtTimKiem"]);
    $sql_search = "SELECT * FROM vanchuyen WHERE Mavc LIKE '%$searchKey%' OR Ten LIKE '%$searchKey%'";
    $rs_vc = mysqli_query($conn, $sql_search);
}


mysqli_close($conn);
?>
    <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div class="title">Đơn vị vận chuyển</div>
        <div class="btn-ThemNV <?=$isCreate?"":"hidden"?>"> <a href="AHome.php?chon=t&id=vanchuyen&loai=them">+ Thêm đơn vị vận chuyển </a></div>
        <div style="clear: both;"></div>
        <form action="" method="post">
                <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
                <button type="submit" name="timkiem" >Tìm kiếm</button>
            </form>
        <div><br></div>
        <div style="display: flex; justify-content: center;">
            <div class="table">
                <div class="table-title">
                    <div style="width: 30%; font-weight: bold;">Mã ĐVVC</div>
                    <div style="width: 30%; font-weight: bold;">Tên ĐVVC</div>
                    <div style="width: 20%; font-weight: bold;">Phí vận chuyển</div>
                    <div style="width: 20%; font-weight: bold;">Thao tác</div>

                </div>
                <div><br></div>
                <div><br></div>
                <div style="overflow-y: scroll;">
                <?php foreach($rs_vc as $key => $value) {?>
                        <div class="table-items">
                            
                            <div style="width: 20%;"><?php echo $value["Mavc"]; ?></div>
                            <div style="width: 30%;"><?php echo $value["Ten"]; ?></div>
                            <div style="width: 20%;"><?php echo $value["Gia"]; ?></div>
                           
                            <div class="thaotac">
                                <button class="<?=$isUpdate?"":"hidden"?>" type="button"><a href="AHome.php?chon=t&id=vanchuyen&loai=sua&idvc=<?php echo $value["Mavc"] ?>">Sửa</a></button>
                                <button class="<?=$isDelete?"":"hidden"?>" onclick="return delNcc('<?php echo $value['Ten']; ?>')" type="button"><a href="xoaVanchuyen.php?idvc=<?php echo $value["Mavc"]; ?>">Xóa</a></button>
                            </div> 
                        </div>
                        <?php }?>
                    </div>


                </div>

            </div>
        </div>

    </div>
</body>

</html>