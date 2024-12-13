<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN008");

$isCreate = $userAuth->checkCreatePermission("CN008");
$isUpdate = $userAuth->checkUpdatePermission("CN008");
$isDelete = $userAuth->checkDeletePermission("CN008");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách nhà cung cấp</title>

    <link rel="stylesheet" href="../css/phieuxuat.css?version=1.0">
    <link rel="stylesheet" href="../css/chitiethoadon.css?version=1.0">
    <link rel="stylesheet" href="../css/dsnv.css?version=1.0">
    <link rel="stylesheet" href="../css/ncc.css?version=1.0">
    <!-- <link rel="stylesheet" href="style.css?version=1.0"> -->

    <style>
        *, a{
            text-decoration: none;
            list-style:none;
        }

        .table-items{
            text-align: center;
            /* background-color: red; */
        }
        .thaotac{
            width: 30%;
            /* background-color: aqua; */
        }

        .thaotac button{
            height: 20%;
            width: 20%;
            padding: 1%;
            font-size: 20px;
            justify-content: center;
            padding-bottom: 5%;
            
        }

        .thaotac button a{
            color: black;
            /* padding: 5%;
            margin-bottom: 50%; */
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
    <div id="wrapper-NCC">
        <!-- <h3>Nhà cung cấp</h3> -->
        <div id="themNCC">
            <div>
                <input type="button" id="x" value="X" onclick="closeThemNCC()">
                <div style="clear: both;"></div>

            </div>
            <div class="titleNCC">Mã nhà cung cấp: </div>
            <input type="text" id="maNCC">
            <div class="titleNCC">Tên nhà cung cấp: </div>
            <input type="text" id="tenNCC">
            <div class="btn">
                <div class="btn-huy">Hủy</div>
                <div> </div>
                <div class="btn-them">Thêm</div>
            </div>

        </div>
    </div>

    <div id="NCC">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <div class="title">Nhà cung cấp</div>
            <div class="btn-ThemNV <?= $isCreate?"":"hidden"?>" onclick="window.location.href='AHome.php?chon=t&id=nhacungcap&loai=them'"> + Thêm nhà cc</href=></div>
            <div style="clear: both;"></div>
            <form class="timkiembar" action="" method="post">
                <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
                <button type="submit" name="timkiem" >Tìm kiếm</button>
            </form>
            <div><br></div>
            <div style="display: flex; justify-content: center;">
                <div class="table">
                    <div class="table-title">
                        <div style="width: 20%; font-weight: bold;">Mã NCC</div>
                        <div style="width: 30%; font-weight: bold;">Tên NCC</div>
                        <div style="width: 20%; font-weight: bold;">Số điện thoại</div>
                        <div style="width: 30%; font-weight: bold;">Thao tác</div>
                    </div>
                    <div><br></div>
                    <div><br></div>
                    <div style="overflow-y: scroll;">
                    <?php foreach($rs_ncc as $key => $value) {?>
                        <div class="table-items">
                            <div style="width: 20%;"><?php echo $value["Mancc"]; ?></div>
                            <div style="width: 30%; margin-left: 1%"><?php echo $value["Ten"]; ?></div>
                            <div style="width: 20%; margin-left: 1.5%"><?php echo $value["Sdt"]; ?></div>
                           
                            <div class="thaotac">
                                <button style="margin-left: 10%;" class="<?=$isUpdate?"":"hidden"?>" type="button"><a href="AHome.php?chon=t&id=nhacungcap&loai=sua&idncc=<?php echo $value["Mancc"] ?>">Sửa</a></button>
                                <button style="margin-left: 5%;"class="<?=$isDelete?"":"hidden"?>" onclick="return delNcc('<?php echo $value['Ten']; ?>')" type="button"><a href="xoaNcc.php?idncc=<?php echo $value["Mancc"]; ?>">Xóa</a></button>
                            </div> 
                        </div>
                        <?php }?>
                    </div>


                </div>
            </div>

        </div>
    </div>
   
    <script>
        
        function delNcc(name){
            return confirm("Bạn chắc chắn muốn xóa "+name+" ?");
        }
    </script>
</body>

</html>