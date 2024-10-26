<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chi tiết hóa đơn</title>
    <link rel="stylesheet" href="../css/thongke.css">
    <!-- <link rel="stylesheet" href="../css/chitiethoadon.css">
    <link rel="stylesheet" href="../css/phieuxuat.css">
    <link rel="stylesheet" href="../css/dsnv.css"> -->
    <link rel="stylesheet" href="style.css?version=1.0">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/thongke.js"></script> -->
    <style>
        .container {
    width: 65%;
    margin-left: 30px;
    padding: 20px;
    border:solid 2px black;
    margin-top: 30px;
    height: 500px;
    float: left;
    
    
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow:scroll;
}
.table-container{
    width: 100%;
    overflow-y:auto;
    max-height: 350px;
}

th, td {
    padding: 10px;
    border: 1px solid #070707;
    text-align: left;
}

th {
    background-color: #fc74cf;
}
select {
    float: left;
    
    padding: 10px 12px;
    margin-top: 10px;
    margin-bottom: 10px;
    width: 100px;
    margin-right: 20px;
}
.filter-container{
    width: 20%;
    margin-left: 30px;
    padding: 20px;
    border:solid 2px black;
    margin-top: 30px;
    height:250px;
    float: left;

   
}
h2{
    color: #d61ead;
}
button{
    width: 50px;
    height: fit-content;
    padding: 10px 12px;
    color: #fff;
    background-color: #D61EAD;
    float: left;
    margin-top: 10px;
}
input[type="date"]{
    width: 90%;
}

    </style>
</head>
<body>
<?php
$con = mysqli_connect("localhost", "root", "", "bolashop");

$nhanvien = mysqli_query($con, "SELECT COUNT(Manguoidung) AS TotalNV FROM nguoidung WHERE Loainguoidung NOT IN ('Q0', 'Q2')");
$row = mysqli_fetch_assoc($nhanvien);
$totalNV = $row["TotalNV"];

$khachhang = mysqli_query($con, "SELECT COUNT(Manguoidung) AS TotalKH FROM nguoidung WHERE Loainguoidung = 'Q2'");
$row = mysqli_fetch_assoc($khachhang);
$totalKH = $row["TotalKH"];

$ncc = mysqli_query($con, "SELECT COUNT(Mancc) AS Totalncc FROM nhacungcap");
$row = mysqli_fetch_assoc($ncc);
$totalncc = $row["Totalncc"];

$sp = mysqli_query($con, "SELECT COUNT(Masp) AS Totalsp FROM sanpham");
$row = mysqli_fetch_assoc($sp);
$totalsp = $row["Totalsp"];

$pnh = mysqli_query($con, "SELECT COUNT(Mapn) AS Totalpn FROM phieunhap");
$row = mysqli_fetch_assoc($pnh);
$totalpn = $row["Totalpn"];

$dh = mysqli_query($con, "SELECT COUNT(Madonhang) AS Totaldh FROM donhang");
$row = mysqli_fetch_assoc($dh);
$totaldh = $row["Totaldh"];

$tksp = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['startdate']) && isset($_POST['enddate'])){
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $tksp = mysqli_query($con, "SELECT sp.Masp, sp.Tensp, SUM(ctdh.Soluong) AS TongSoLuong 
                        FROM sanpham sp
                        LEFT JOIN chitietdonhang ctdh ON sp.Masp = ctdh.Masp
                        LEFT JOIN donhang dh ON ctdh.Madonhang = dh.Madonhang
                        WHERE dh.Ngay BETWEEN '$startdate' AND '$enddate' AND dh.Trangthai='3'
                        GROUP BY sp.Masp, sp.Tensp
                        ORDER BY TongSoLuong DESC");
    }
    if (isset($_POST['soluong']) && isset($_POST['danhmuc'])) {
        $soluong = $_POST['soluong'];
        $category = $_POST['danhmuc'];

        if ($category == '0' && $soluong == '0') {
            
            $tksp = mysqli_query($con, "SELECT sp.Masp, sp.Tensp, SUM(ctdh.Soluong) AS TongSoLuong, sp.Madanhmuc 
                FROM sanpham sp 
                LEFT JOIN chitietdonhang ctdh ON sp.Masp = ctdh.Masp
                LEFT JOIN donhang dh ON ctdh.Madonhang = dh.Madonhang
                WHERE dh.Trangthai='3'
                GROUP BY sp.Masp, sp.Tensp
                ORDER BY TongSoLuong DESC");
        } elseif ($category == '0') {
            
            $tksp = mysqli_query($con, "SELECT sp.Masp, sp.Tensp, SUM(ctdh.Soluong) AS TongSoLuong, sp.Madanhmuc 
                FROM sanpham sp 
                LEFT JOIN chitietdonhang ctdh ON sp.Masp = ctdh.Masp
                LEFT JOIN donhang dh ON ctdh.Madonhang = dh.Madonhang
                WHERE dh.Trangthai='3'
                GROUP BY sp.Masp, sp.Tensp
                ORDER BY TongSoLuong DESC
                LIMIT $soluong");
        } elseif ($soluong == '0') {
            
            $tksp = mysqli_query($con, "SELECT sp.Masp, sp.Tensp, SUM(ctdh.Soluong) AS TongSoLuong, sp.Madanhmuc 
                FROM sanpham sp 
                LEFT JOIN chitietdonhang ctdh ON sp.Masp = ctdh.Masp
                LEFT JOIN donhang dh ON ctdh.Madonhang = dh.Madonhang
                WHERE sp.Madanhmuc = '$category' AND dh.Trangthai='3'
                GROUP BY sp.Masp, sp.Tensp
                ORDER BY TongSoLuong DESC");
        } else {
            
            $tksp = mysqli_query($con, "SELECT sp.Masp, sp.Tensp, SUM(ctdh.Soluong) AS TongSoLuong, sp.Madanhmuc 
                FROM sanpham sp 
                LEFT JOIN chitietdonhang ctdh ON sp.Masp = ctdh.Masp
                WHERE sp.Madanhmuc = '$category' AND dh.Trangthai='3'
                GROUP BY sp.Masp, sp.Tensp
                ORDER BY TongSoLuong DESC
                LIMIT $soluong");
        }
    }
}

$danhmuc = mysqli_query($con,"SELECT * FROM danhmuc");



mysqli_close($con);
?>
<div id="thongke">
    <h3>Thống kê</h3>
    <!-- <div id="title">Thống kê</div> -->
    <div id="grid-container">
        <div class="grid-items">
            <div class="text-top-left">Nhân viên</div>
            <div class="number-center"><?php echo $totalNV; ?></div>
        </div>
        <div class="grid-items">
            <div class="text-top-left">Khách hàng</div>
            <div class="number-center"><?php echo $totalKH; ?></div>
        </div>
        <div class="grid-items">
            <div class="text-top-left">Nhà cung cấp</div>
            <div class="number-center"><?php echo $totalncc; ?></div>
        </div>
        <div class="grid-items">
            <div class="text-top-left">Sản phẩm</div>
            <div class="number-center"><?php echo $totalsp; ?></div>
        </div>
        <div class="grid-items">
            <div class="text-top-left">Phiếu nhập</div>
            <div class="number-center"><?php echo $totalpn; ?></div>
        </div>
        <div class="grid-items">
            <div class="text-top-left">Đơn hàng</div>
            <div class="number-center"><?php echo $totaldh; ?></div>
        </div>
    </div>
    <div class="filter-container">
        <form method="post" action="" name="form-filter">
            <h2>Chọn ngày</h2>
            <p>Từ:</p>
            <input type="date" id="startdate" name="startdate"/>
            <p>Đến:</p>
            <input type="date" id="enddate" name="enddate"/>
            <br>
            <button type="submit">Lọc</button>
        </form>
    </div>
    <div class="container">
        <h2>Thống kê sản phẩm</h2>
        <form method="post" action="" name="topsells-form">
        <select name="soluong" class="top-sells">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="0" selected>Tất cả</option>
        </select>
        
        <select name="danhmuc" class="top-sells"> 
            <?php foreach($danhmuc as $key => $value) { ?>
            <option value="<?php echo $value["Madanhmuc"] ?>"><?php echo $value["Tendanhmuc"]; } ?></option>
            
            <option value="0" selected>Tất cả</option>
        </select>
        <button id="filter-button" type="submit">Lọc</button>
        </form>
        <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng bán ra</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tksp as $key => $value){?>
                <tr>
                    <td><?php echo $value["Masp"];?></td>
                    <td><?php echo $value["Tensp"];?></td>
                    <td><?php echo $value["TongSoLuong"];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</body>