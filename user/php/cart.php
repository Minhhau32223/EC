<?php
$server = "localhost";
$username = "root";
$pass = "";
$database = "bolashop";

$conn = new mysqli($server, $username, $pass, $database);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (!isset($_SESSION["user_id"])) {
    echo '<script>alert("Vui lòng đăng nhập để xem giỏ hàng.");
    window.location.href = "dangnhap.php";
    </script>';
}
// Thêm sản phẩm vào giỏ 
if (isset($_POST['them']) && ($_POST['them'])) {
    if (isset($_SESSION['user_id'])) {
        $manguoidung = $_SESSION['user_id']; // mã của người dùng
        $masp = $_POST['Masp'];
        $soluong = $_POST['soluong'];

        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
        $check_query = "SELECT * FROM giohang WHERE Manguoidung = '$manguoidung' AND Masp = '$masp'";
        $check_result = $conn->query($check_query);

        // Kiểm tra số lượng sản phẩm trong giỏ hàng của người dùng
        if ($check_result->num_rows > 0) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $existing_item = $check_result->fetch_assoc();
            $new_quantity = $existing_item['Soluong'] + $soluong; // Tính toán số lượng mới
            $update_query = "UPDATE giohang SET Soluong = '$new_quantity' WHERE Manguoidung = '$manguoidung' AND Masp = '$masp'";
            $conn->query($update_query);
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
            $insert_query = "INSERT INTO giohang (Manguoidung, Masp, Soluong) VALUES ('$manguoidung', '$masp', '$soluong')";
            $conn->query($insert_query);
        }
    } else {
        echo "Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.";
    }
}



function showgiohang()
{
    // Khởi tạo session và kết nối đến cơ sở dữ liệu
    include('connect.php');
    $conn = connectDB();

    // Lấy mã người dùng từ session
    $maKH = $_SESSION['user_id'];

    $sql = "SELECT giohang.*, sanpham.Tensp, sanpham.Giaban, sanpham.Img 
    FROM giohang 
    INNER JOIN sanpham ON giohang.Masp = sanpham.Masp 
    WHERE giohang.Manguoidung = '$maKH'";
    $result = mysqli_query($conn, $sql);

    // Hiển thị thông tin sản phẩm trong giao diện
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i += 1;
        echo '<label for="tongGia"><li class="table-items-Q">';
        echo '<div style=" width: 40%; display: flex; justify-content: space-evenly; align-items: center;">';
        echo '
                <input id="tongGia" type="checkbox" style="width: 5%;" value="20">
                <span class="checkmark"></span>
                ';
        echo '<img src="../../img/' . $row['Img'] . '" alt="' . $row['Tensp'] . '" style="width: 10%; float: left;display-inline: block;"> 
        <div style="width: 60%; font-size: 20px;">' . $row['Tensp'] . '</div>
        </div>';
        echo '<div style="width: 15%;font-size: 20px; margin: 40px 5px;">' . $row['Giaban'] . ' VND</div>';
        echo '<div class="btn_tang_giam_soluong" style="width: 20%; font-size: 25px;">';
        echo '<button class="quantity-btn decrease" style="width: 5%; margin-left:2px;" data-masp="' . $row['Masp'] . '" data-action="decrease">-</button>';
        echo '<div class="soluongsp" style="width: 10%; margin-left:2px;" data-masp="' . $row['Masp'] . '" contenteditable="true">' . $row['Soluong'] . '</div>';
        echo '<button class="quantity-btn increase" style="width: 5%; margin-left:2px;" data-masp="' . $row['Masp'] . '" data-action="increase">+</button>';
        echo '</div>';
        $tongtiensanpham = $row['Giaban'] * $row['Soluong'];
        echo '<div style="width: 15%;font-size: 20px; margin: 40px 5px;" value="' . $tongtiensanpham . '>' . $tongtiensanpham . ' VND</div>';
        echo '<form method="post" action="xulyxoaspgiohang.php">';
        echo '<input type="hidden" name="masp" value="' . $row['Masp'] . '">';
        echo '<button type="submit" name="delete_btn" class="delete-btn" data-id="' . $row['Masp'] . '">X</button>';
        echo '</form>';
        echo '</div></li></label>';
    }

    mysqli_close($conn);
}


$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cssdoan.css"?v=<?php echo time(); ?>>
    <title>Giỏ hàng</title>
    <style>
        a{
            color: white;
            text-decoration: none;
            font-size: 20px;
        }
        .table-items-Q:hover{
            background-color: #778899;
        }
        .table-items-Q {
            width: 100%;
            height: 100px;
            border: rgb(162, 161, 161) solid 0.5px;
            align-items: left;
            display: flex;
            flex-direction: row;
            /* justify-content: center; */
            text-align: center;
            word-break: break-all;
            border-radius: 15px;
        }

        .edit-btn,
        .delete-btn {
            padding: 10px;
            background-color: #7de3ff ;
            color: black;
            border: none;
            align-items: center;
            margin-left: 70px;
            margin-top: 30%;
            border-radius: 4px 4px;
        }

        .btn_tang_giam_soluong {
            align-items: center;
            justify-content: center;
            width: 20%;
            display: flex;
        }
        .section__container{
            margin-top: 80px;
        }
        .section__container_2{
            /* margin-top: 60px; */
            width: 80%;
            height: 530px;
            margin-left: 10%;
            /* height: fit-content; */
            background-color: white;
            border-radius: 5px;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
        }
        .table-title {
            background-color: whitesmoke;
            border-radius: 5px;
        }
        .table-title div{
            font-size: 30px;
            border-radius: 3px;
            border-width: 5px black;
        }
        .row{
            padding-top: 15px;
        }
        .cart-table__cont{
            margin-left: 0px;
            height: 460px;
        }
        .scoll{
            float: right;
            margin-right: 0px;
        }
        /* width */
        .scroll::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        .scroll::-webkit-scrollbar-track {
        box-shadow: inset 0 0 3px grey; 
        border-radius: 2px;
        }
        
        /* Handle */
        .scroll::-webkit-scrollbar-thumb {
        background: #778899; 
        border-radius: 3px;
        }

        /* Handle on hover */
        .scroll::-webkit-scrollbar-thumb:hover {
        background: #696969; 
        }
        /* Nút thanh toán */
        .custom-button{
            background-color: navy;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
            margin-left: 1000px;
        }
        /* Nút thanh toán */
        .ThanhTien{
            /* background-color: red; */
            height: 60px;
            width: 20%;
            font-size: 25px;   
            display: flex;
            float: right; 
            /* margin-bottom: 0px; */
        }
        .ThanhTien div{
            width: 45%;
            height: 80%;
            /* background-color: yellow; */
            /* border-radius: 10px;
            box-shadow: inset; */
            margin-left: 2px;
            padding: 15px 5px;
        }

        #backButton{
            margin-top: 100px;
            border-radius: 10px;
        }
        #backButton a{
            color: #696969;
            font-weight: bold;
        }
        #backButton:hover {
            margin-top: 100px;
            background-color: #696969;
        }
        #backButton:hover a{
            color: white;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <div class="section__container">
                <div class="row">
                    <div class="col-12">
                        <h4 style="font-size: 40px;">Giỏ hàng</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="breadcrumb col-12">
                        <div class="breadcrumb__links horizontal">
                            <div class="breadcrumb__link body2"><a href="home.php">Trang chủ</a></div>
                            <div class="breadcrumb__link body2">Giỏ hàng</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__container_2">
            <div class="cart-table col-8">
                <div class="cart-table__cont">
                    <div class="table-title">
                        <div style="width: 40%; font-weight: bold;">Sản phẩm</div>
                        <div style="width: 15%; font-weight: bold;">Đơn giá</div>
                        <div style="width: 20%; font-weight: bold;">Số lượng</div>
                        <div style="width: 15%; font-weight: bold;">Tổng tiền</div>
                        <div style="width: 10%; font-weight: bold;"></div>
                    </div>
                    <div><br></div>
                    <div><br></div>
                    <!--DATA-->
                    <div class="scroll" style="overflow-y: scroll;"> 
                        <?php showgiohang(); ?>
                    </div>
                    
                </div>
                <div class="ThanhTien"><div>Thành tiền:</div><div id="tongTien" style="font-weight: bold; color: red;"></div></div>
                <div>
                    <button id="backButton" class="type-back">&lt;<a href="home.php">Trở lại mua sắm</a></button>
                    <button id="cart-checkout-btn" class="custom-button" ><a href="home.php?chon=thanhtoan&loai=thanhtoan">Thanh toán</a></button>                  
                </div>
            </div>
            <button onclick="TinhTongTien()">Bấm đi</button>

            <!-- <script src="javascript.js"></script> -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.quantity-btn').click(function() {
                        var masp = $(this).data('masp');
                        var action = $(this).data('action');
                        var soluongElement = $(this).siblings('.soluongsp');

                        $.ajax({
                            type: 'POST',
                            url: 'xulysoluongspgiohang.php',
                            data: {
                                masp: masp,
                                action: action
                            },
                            success: function(response) {
                                // Cập nhật số lượng sản phẩm trên giao diện
                                if(response==-1)
                                {
                                    alert("Vượt quá số lượng sản phẩm còn lại!!");
                                    return
                             }      
                                soluongElement.text(response);
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('.delete-btn').click(function() {
                        var id = $(this).data('id');

                        $.ajax({
                            type: 'POST',
                            url: 'xulyxoaspgiohang.php',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                if (response === 'success') {
                                    alert("Đã xóa sản phẩm khỏi giỏ hàng");
                                    location.reload();
                                } else {
                                    alert("Xóa không thành công!");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });

                    });
                });
            </script>
            <script>
                function TinhTongTien(){
                    // var tongthanhtien = 0;    
                    // var check_price = []               
                    
                    // for(var i=0; i<4; i++){
                    //     var tong = ("tongGia" + i).toString();
                    //     check_price[i] = document.getElementById(tong);  
                    //     console.log("okok");
                    //     if(check_price[i].checked == true){
                    //         console.log("i= " + i);
                    //         tongthanhtien += parseInt(check_price[i].value);
                    //         console.log("Thành tiền: " + tongthanhtien);                      
                    //     }
                    // }
                    // alert("length= " + check_price.length);
                    
                    // document.getElementById("tongTien").innerHTML = tongthanhtien;

                    if(document.getElementById('tongGia').checked == true){
                        alert("checked");
                    }else{
                        alert("no check");
                    }
                }
            </script>
</body>
</html>