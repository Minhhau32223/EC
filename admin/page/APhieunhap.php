<?php
require_once("../../db_connect.php");
require_once("../../role_check.php");

$connn = new Database();

$userAuth = new userAuth($connn);
$userAuth->checkReadPermission("CN007");

$isCreate = $userAuth->checkCreatePermission("CN007");
$isUpdate = $userAuth->checkUpdatePermission("CN007");
$isDelete = $userAuth->checkDeletePermission("CN007");

$role = $connn->query("SELECT * FROM quyen");

$connn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách phiếu nhập</title>

    <link rel="stylesheet" href="../css/phieuxuat.css?version=1.0">
    <link rel="stylesheet" href="../css/chitiethoadon.css?version=1.0">
    <link rel="stylesheet" href="../css/dsnv.css?version=1.0">
    <link rel="stylesheet" href="../css/ncc.css?version=1.0">
    <!-- <link rel="stylesheet" href="style.css?version=1.0"> -->

    <style>
        a {
            color: white;
            direction: none;
        }

        .status-phieunhap {
            width: 19%;
            display: flex;
            /* flex-direction: row;
            justify-content: space-evenly;
            align-items: center; */
            /* background-color: red; */
            height: 100%;
        }

        .status-phieunhap button{
            margin-left: 25%;
        }
        .btn-X-PN{
            margin-top: 9%;
            padding: 1%;
            width: 12%;
            height: 40%;
            background-color: red;
            border-radius: 10%;
            color: white;
            font-weight: bold;
        }
        .btn-X-PN:hover{
            background-color: rgb(198, 37, 37);
        }
        .btn-xemct{
            width: 30%;
            height: 40%;
            padding: 1%;
            margin-top: 9%;
            font-size: 18px;
        }

        #phieunhap {
            display: block;
        }

        .title-ctpn {
            display: flex;
            flex-direction: row;
            font-weight: bold;
        }

        /*sửa viền*/
        .wrapper-ctpn {
            /*border: solid 0.5px rgb(152, 152, 152);*/
            width: 90%;
            margin-top: 10px;
            margin-left: 5%;
            /* box-shadow: 0 7px 7px 0 rgb(87, 87, 87); */
            border-radius: 20px;
            padding-bottom: 40px;
        }
        .wrapper-pn {
            /*border: solid 0.5px rgb(152, 152, 152);*/
            width: 90%;
            margin-top: 10px;
            margin-left: 5%;
            /* box-shadow: 0 7px 7px 0 rgb(87, 87, 87); */
            border-radius: 20px;
            padding-bottom: 40px;
        }

        .top {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        /*sửa*/
        .top-left {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-left: 30px;
        }

        /**/
        .top-items {
            margin: 5px;
            width: 80%;
        }

        /* .btn-Xem {
            margin: 5px;
            width: 80%;
            padding: 5px;
            background-color: #D61EAD;
            color: white;
            border-radius: 20px;
            text-align: center;
        } */

        .btn-ThemPN {
            padding: 10%;
            font-size: 30px;
            margin: 5px;
            width: 20%;
            height: 2.5%;
            padding: 5px;
            background-color: #D61EAD;
            color: white;
            border-radius: 20px;
            text-align: center;
            float: right;
        }

        /*sửa btn */
        .btn-HoanTat {
            float: right;
            margin-right: 40px;
            width: 20%;
            padding: 5px;
            background-color: #D61EAD;
            color: white;
            border-radius: 20px;
            text-align: center;
            margin-top: 20px;
        }
        .btn-Huy {
            float: right;
            margin-right: 40px;
            width: 20%;
            padding: 5px;
            background-color: #D61EAD;
            color: white;
            border-radius: 20px;
            text-align: center;
            margin-top: 20px;
        }

        #chiTietPhieuNhap {
            margin: 10%;
            display: none;
        }

        #themPN {
            display: none;
            width: 100%;
            height: 100%;
        }

        #addPN {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            width: 80%;
            border: solid 0.5px black;
            margin: 10%;
            z-index: 1000;
            background-color: white;


        }

        .soluong {
            width: 20%;
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;
        }

        /*thêm mới*/
        select {
            width: 125px;
            padding: 10px 12px;

            color: #000000;
            border-radius: 15px;
        }

        select:focus {
            border: #D61EAD 2px solid;
        }

        .total-price {
            font-size: 20px;
            margin-top: 15px;
            margin-left: 100px;

        }
        .table-items-details {
        margin: 10px 0 10px 0;
        width: 100%;
        height: 100px;
        border: rgb(162, 161, 161) solid 0.5px;
        align-items: center;
        display: flex;
        flex-direction: row;
        justify-content: center;
        text-align: center;
        word-break: break-all;
        border-radius: 10px;

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

    <form id="addPN">
        <div id="themPN">
            <div class="wrapper-pn">
                <div class="top">
                    <div class="top-left">
                        <!--sửa-->
                        <div class="top-items">Mã sản phẩm</div>
                        <select id="sel1">
                        <option value="0"  selected>Mã</option>
                            <?php 
                            include 'connectDB.php';

                            // Truy vấn cơ sở dữ liệu để lấy dữ liệu danh sách
                            $sql = "SELECT * FROM sanpham";
                            $result_sanpham = mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_array($result_sanpham)){
                                

                            ?>
                             <option value="<?php echo $row['Masp']?>" id="<?php echo $row['Masp']?>" ><?php echo $row['Masp']?></option>
                            <?php }?>
                        </select>
                        <button class="btn-ThemPN"  type="button" onclick="addSP_toPN()">+ Thêm</button>


                    </div>
                    <!--sửa-->
                    
                    <div class="top-left">
                        <div class="top-items">Mã nhà cung cấp</div>
                        <select id="sel2">
                        <option value="0"  selected>Mã</option>
                            <?php 
                            include 'connectDB.php';

                            // Truy vấn cơ sở dữ liệu để lấy dữ liệu danh sách
                            $sql = "SELECT * FROM nhacungcap";
                            $result_nhacungcap = mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_array($result_nhacungcap)){
                                

                            ?>
                             <option value="<?php echo $row['Mancc']?>" id="<?php echo $row['Mancc']?>" ><?php echo $row['Mancc']?></option>
                            <?php }?>
                        </select>
                        <button class="btn-ThemPN">+ Thêm sản phẩm</button>     
                    </div>
                    <div class="top-left">
                        <div class="top-items">Phiếu nhập</div>
                        <input type="text" class="top-items"  id="mapn" name="txtmapn" readonly>
                       

                    </div>
                    <!--sửa-->
                    <div class="top-left">
                        <div class="top-items">Đơn giá</div>
                        <input type="text" class="top-items"  id="dongia" name="txtdongia" readonly>
                        
                    </div>
                    <div class="top-left">
                        <div class="top-items">Số lượng</div>
                        <input type="text" class="top-items" name="txtsoluong">
                    </div>
                </div>
                <div style="display: flex; justify-content: center;">
                    <div class="table">
                        <div class="table-title">
                            <div style="width: 20%; font-weight: bold;">Mã sản phẩm</div>
                            <div style="width: 30%; font-weight: bold;">Sản phẩm</div>
                            <div style="width: 30%; font-weight: bold;">Đơn giá</div>
                            <div style="width: 20%; font-weight: bold;">Số lượng</div>

                        </div>
                        <div><br></div>
                        <div><br></div>
                        <div style="overflow-y: scroll;" id="new-item">
                            <!-- <div class="table-items">
                                <div style="width: 20%;">SP001</div>
                                <div class="staff">
                                    <div class="avt-sp"></div>
                                    <div>Len milk cotton</div>
                                </div>
                                <div style="width: 30%;">15000 VNĐ
                                </div>
                                <div class="soluong">
                                    <input type="text" value="1" style="text-align: center;width: 60%;">
                                    <button type="button">X</button>

                                </div>
                            </div> -->
                            
                        </div>
                    </div>


                </div>

                <!--sửa: đem ra ngoài div-->
                <div id="end-themPN">
                    <div class="total-price"><b>Ngày nhập:</b>
                    <?php 
                    $ngayhientai=date('Y-m-d');
                    ?>
                        <input type="data" name="txtngaynhap" id="txtngaynhap" value="<?php echo $ngayhientai?>" readonly>
                        
                    </div>
                    <div class="total-price"><b>Tổng Tiền:</b>
                        <input type="number" name="txtTongtien" id="txtTongtien" value="0" readonly>
                        VND
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content:right;">
                        <!--  onclick="closeThemPhieuNhap()"><a href="AHome.php?chon=t&id=phieunhap"
                 onclick="closeThemPhieuNhap()"><a href="AHome.php?chon=t&id=phieunhap"-->
                        <button class="btn-Huy"><a href="AHome.php?chon=t&id=phieunhap">Hủy</a></button>
                        <button class="btn-HoanTat" >Hoàn tất</button>

                    </div>
                </div>
                <!-- <div class="return"><a href="#"><<  Quay lại</a></div> -->
            </div>
    </form>

    </div>
    <div id="chiTietPhieuNhap">
        <div class="title-ctpn">
            <div><a href="AHome.php?chon=t&id=phieunhap">Phiếu nhập >> </a></div>
            <div> Chi tiết phiếu nhập</div>
        </div>
        <div class="btn-ThemPN <?=$isUpdate?"":"hidden"?>" onclick="">Sửa</div>
        <div style="clear: both;"></div>

        <!-- </div> -->
        <div class="wrapper-ctpn">
            <div class="top">
           
            </div>

            <div style="display: flex; justify-content: center;">
                <div class="table">
                    <div class="table-title">
                        <div style="width: 30%; font-weight: bold;">Sản phẩm</div>
                        <div style="width: 20%; font-weight: bold;">Mã sản phẩm</div>
                        <div style="width: 30%; font-weight: bold;">Đơn giá</div>
                        <div style="width: 20%; font-weight: bold;">Số lượng</div>

                    </div>
                    <div><br></div>
                    <div><br></div>
                    <div style="overflow-y: scroll;" class="table_item_details">
                        <div class="table-items-details">
                            <div class="staff">
                                <div class="avt-sp"></div>
                                <div>Len milk cotton</div>
                            </div>
                            <div style="width: 20%;">SP001</div>
                            <div style="width: 30%;">15000 VNĐ
                            </div>
                            <div style="width: 20%;">
                                <input type="text" value="1" readonly style="text-align: center;width: 90%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 


    <div id="phieunhap">
        <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <div class="title">Phiếu nhập</div>
            <div class="btn-ThemNV <?=$isCreate?"":"hidden"?>" type="button" onclick="showThemPhieuNhap()"> + Thêm phiếu nhập</div>
            <div style="clear: both;"></div>
            <div class="timkiembar" action="" method="post">
                <input class="search" type="text" name="txtTimKiem" placeholder="Tìm kiếm...">
                <button type="submit" name="timkiem" >Tìm kiếm</button>
            </div>
            <div><br></div>
            <div style="display: flex; justify-content: center;">
                <div class="table">
                    <div class="table-title">
                        <div style="width: 20%; font-weight: bold;">Mã phiếu nhập</div>
                        <div style="width: 20%; font-weight: bold;">Mã nhân viên</div>
                        <div style="width: 20%; font-weight: bold;">Mã NCC</div>
                        <div style="width: 20%; font-weight: bold;">Ngày tạo</div>
                        <div style="width: 20%; font-weight: bold;">Thao tác</div>
                    </div>
                    <div><br></div>
                    <div><br></div>
                    <div style="overflow-y: scroll;" class="table_item"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showThemPhieuNhap() {
            var a = document.getElementById('themPN');
            var b = document.getElementById('addPN');
            a.style.display = "block";
            b.style.display = "block";
        }

        function closeThemPhieuNhap() {
            var a = document.getElementById('themPN');
            var b = document.getElementById('addPN');
            a.style.display = "none";
            b.style.display = "none";
        }
       
            
        function addSP_toPN(){
            var masp=document.getElementById('sel1').value;
            var soluong=document.getElementsByName('txtsoluong')[0].value;
           
            $.ajax({
                url: 'new_item_add.php',
                type: 'POST',
                data: { data : masp , sl:soluong},
                dataType: 'html',
                success: function(data) {
                    var currentData = $('#new-item').html(); // Lấy dữ liệu hiện tại
                    var newData = currentData + data; // Gộp dữ liệu mới vào dữ liệu hiện tại
                    $('#new-item').html(newData); // Đặt lại nội dung phần tử HTML
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            $.ajax({
                url: 'xl_thanhtien_add.php',
                type: 'POST',
                data: { data : masp , sl:soluong},
                dataType: 'html',
                success: function(data) {
                    var currentData =$('#txtTongtien').val(); // Lấy dữ liệu hiện tại
                    var newData = parseInt(currentData) + parseInt(data); // Gộp dữ liệu mới vào dữ liệu hiện tại
                    $('#txtTongtien').val(newData); // Đặt lại nội dung phần tử HTML
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            
            
        }
        function showChiTiet(button) {
            var mapn= button.id;
            
            console.log(mapn);
            $.ajax({
                url: 'load_ctpn.php',
                type: 'POST',
                data: { data : mapn },
                dataType: 'html',
                success: function(data) {
                    $('.top').html(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            $.ajax({
                url: 'load_table_ct.php',
                type: 'POST',
                data: { data : mapn },
                dataType: 'html',
                success: function(data) {
                    $('.table_item_details').html(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            document.getElementById('chiTietPhieuNhap').style.display = "block";
            document.getElementById('phieunhap').style.display = "none";
        }
        
      $(document).ready(function(){
        $.ajax({
                url: 'load_phieunhap.php',
                type: 'POST',
             
                dataType: 'html',
                success: function(data) {
                    $('.table_item').html(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            }); 
       });
       $('.btn-HoanTat').click(function(){
        var mapn= $('#mapn').val();
        var ngaynhap= $('#txtngaynhap').val();
        var mancc=$('#sel2').val();
        $.ajax({
                url: 'insert_new_pn.php',
                type: 'POST',
                data: { data:mapn, ngaynhap:ngaynhap, mancc:mancc},
                dataType:'html',
               success:function(data){
                alert(data);
                window.location.href="AHome.php?chon=t&id=phieunhap";
               },
                
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });


       });
       $('#sel1').change(function() {
            var dongia = $(this).val();
            
            $.ajax({
                url: 'hiendongia.php',
                type: 'POST',
                data: { data: dongia },
                dataType: 'html',
                success: function(data) {
                    $('#dongia').val(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
        });
        $('.btn-ThemNV').click(function() {
           
            $.ajax({
                url: 'maphieunhap.php',
                type: 'POST',
             
                dataType: 'html',
                success: function(data) {
                    $('#mapn').val(data);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
        });
        
        $(document).on('click',".btn-X",function(){
            var confirmation = confirm("Bạn có chắc chắn muốn xóa?"); // Hiển thị hộp thoại xác nhận
            var id=$(this).closest('.table-items').attr('id');
            var soluong=$(this).closest('.table-items').find('.soluong_in').val();
            if (confirmation) {

            $(this).closest('.table-items').remove();
            $.ajax({
                url: 'delete_item_pnnew.php',
                type: 'POST',
                data: { data: id },
                dataType: 'html',
                success: function(data) {
                   
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            $.ajax({
                url: 'xl_thanhtien_add.php',
                type: 'POST',
                data: { data : id , sl:soluong},
                dataType: 'html',
                success: function(data) {
                    var currentData =$('#txtTongtien').val(); // Lấy dữ liệu hiện tại
                    var newData = parseInt(currentData) - parseInt(data); // Gộp dữ liệu mới vào dữ liệu hiện tại
                    $('#txtTongtien').val(newData); // Đặt lại nội dung phần tử HTML
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            
            }

        })
        $(document).on('click',".btn-X-PN",function(){
            var confirmation = confirm("Bạn có chắc chắn muốn xóa?"); // Hiển thị hộp thoại xác nhận
            var id=$(this).closest('.table-items').attr('id');
         
            if (confirmation) {

            $(this).closest('.table-items').remove();
            $.ajax({
                url: 'delete_pn.php',
                type: 'POST',
                data: { data: id },
                dataType: 'html',
                success: function(data) {
                   
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
                    
                    // Nếu cần, bạn có thể thực hiện xử lý lỗi khác ở đây
                }
            });
            
            }

        })
    </script>
 
</body>

</html>