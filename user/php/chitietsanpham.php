<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <meta charset="UTF-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>chitietsanpham</title>
    <style>
        .content-sp {
            margin: 7% 10% 5% 10%;
            background-color: white;
            border-radius: 2px;
            box-shadow: inset ;
            padding: 20px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.15);
        }
        .hienthisanpham {
            display: flex;
            width: 80%;
            margin: auto;
            justify-content: space-between;
            align-items: center;
            /* border: 1px solid #000000; */
            box-sizing: border-box;
            border-radius: 5px;
            border-width: 3px;  
           
        }
        .thongtinsanpham {
            width: 50%;
        }
        .line_sp {
            width: 80%;
            margin: 10px;
        }
    /* Hình hiển thị */
        .photo-sp {
            width: 100%;
            /* border: #000000 0.5px solid; */
            padding: 10px;
            margin: 10px;
          
        }
        .photo-sp img {
            background-size:cover ;
            box-shadow: 3px 4px 3px 3px rgba(0, 0, 0, 0.3);
            /* box-shadow: inset 3px 4px 3px 3px rgba(0, 0, 0, 0.3); */
        }      
    /* Hình hiển thị */
    /* Tên SP */
        #TenSanPham{
            margin-top: 50px;
            font-size: 35px;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    /* Tên SP */
    /* Giá bán */
        .Gia {
            margin-top: 15px;
            font-size: 30px;
            padding: 10px;
            height: 60px;
            background-color: #eef1f3;
        }
        .Gia p{
            float: inline-start;
            margin-left: 15px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        .Gia #giaban{
            color: rgb(245, 80, 3);
        }
    /* Giá bán */
    /* Mô tả sản phẩm */
        #ThongSoText{
            padding-left: 20px;
            margin-top: 30px;
            font-size: 25px;
        }
        .detail_infor{
            margin-top: 10px;
            background-color: #eef1f3;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            padding: 15px;
            /* height: 75px; */
        }
    /* Mô tả sản phẩm */
    /* Số lượng còn lại */
        /* Số lượng sp */   
        .soLuong {
            display: flex;
            margin-top: 30px;
            align-items: center;
            /* background-color: red; */
            height: 60px;
        }

        .soLuong p{
            margin-left: 10px;
            padding: 10px;
            color: grey;
            font-size: 20px;
            font-weight: bold;
        }

        .soLuong-container {
            margin-left: 25px;
            height: 35px;
            /* padding-top: 7.5px; */
            
        }
        #soLuongInput{
            margin-top: 5px;
            text-align: center;
            font-size: 15px;
            width: 60%;
            border-width: 0px;
            font-weight: bold;
            /* padding: auto; */
        }
        #congButton, #truButton{
            width: 18%;
            font-size: 15px;
            border-width: 0px;
            font-weight: bold;
        }
        #congButton:hover, #truButton:hover{
            background-color: #afc5d4;
        }
        #congButton, #soLuongInput, #truButton{
            background-color: #def0fd;
            margin: 0px 0px 0px 0px;
            height: 95%;
        }
            /* Số lượng sp */

            /* Còn lại */
        .conLai {
            margin-left: 25px;
            display: flex;
            align-items: center;
        }
        .conLai p {
            color: #1f010193;
            font-size: 17px;
        }

        .conLai-container {
            margin-left: 12px;     
        }

        .conLai-input {
            width: 80px;
            /* background-color: #88C273; */
            border: none;
            font-size: 17px;
            color: #1f010193;
            text-align: left;
        }

        .conLai-input:focus {
            outline: none;
        }
        /* Còn lại */
     /* Số lượng còn lại */
    /* Button mua hàng */
        .button_muahang {
            width: 100%;
            margin-left: 0px;
            margin-top: 30px;
            display: flex;
            padding: 10px;
        }
        .button_muahang .button_muahang_them {
            background-color: whitesmoke;
            border-width: 3px;
            border-color: #1598cc;
            color: #1598cc;
            border-radius: 10px;
            width: 195px;
            padding: 10px 0;
            margin-top: 10px;
            margin-right: 50px;
            font-size: 20px;
            align-self: center;
            box-shadow: none;
        }
        .button_muahang .button_muahang_them:hover {
            background-color: rgb(223, 223, 223);
            font-weight: bold;
            color: #1aade7;
        }

        .button_muahang .button_muahang_muangay {
            background-color: #1598cc;
            color: gold;
            cursor: pointer;
            border-radius: 10px;
            width: 200px;
            padding: 10px 0;
            margin-top: 10px;
            font-size: 25px;
            align-self: center;
            border: none;
        }
        .button_muahang .button_muahang_muangay:hover {
            background-color: #1179a3;
            color: rgb(255, 231, 96);
            font-weight: bold;
        }
    /* Button mua hàng */

    </style>
</head>
<!-- Đẩy dữ liệu vào bảng khi bấm thêm vào giỏ hàng -->

<?php

include('./connect.php');
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["them"])) {
    // Lấy thông tin từ form
    $maSP = $_POST['masp'];
    $soLuong = $_POST['soLuong'];
    if (isset($_SESSION['user_id'])) {
        $maKH = $_SESSION['user_id'];
        // Kiểm tra xem thông tin có hợp lệ không
        if (!empty($maSP) && !empty($soLuong) && !empty($maKH)) {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
            $check_query = "SELECT * FROM giohang WHERE Manguoidung = '$maKH' AND Masp = '$maSP'";
            $check_result = $conn->query($check_query);
            // Kiểm tra số lượng sản phẩm trong giỏ hàng của người dùng
            if ($check_result->num_rows > 0) {
                // Nếu sản phẩm đã tồn tại, cập nhật số lượng
                $existing_item = $check_result->fetch_assoc();
                $new_quantity = $existing_item['Soluong'] + $soLuong; // Tính toán số lượng mới
                $update_query = "UPDATE giohang SET Soluong = '$new_quantity' WHERE Manguoidung = '$maKH' AND Masp = '$maSP'";
                if ($conn->query($update_query)) {
                    echo "";
                } else {
                    echo "";
                    echo "Lỗi: " . mysqli_error($conn);
                }
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
                $insert_query = "INSERT INTO giohang (Manguoidung, Masp, Soluong) VALUES ('$maKH', '$maSP', '$soLuong')";
                if ($conn->query($insert_query)) {
                    echo "";
                } else {
                    echo "";
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }
        } else {
            echo '<script>alert("Dữ liệu không hợp lệ!");</script>';
        }
    } else {
        // Xử lý khi 'user_id' không tồn tại trong phiên
        echo '<script>alert("Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.");
        window.location.href = "dangnhap.php";
        </script>';
    }
}
//Mua ngay
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mua"])) {
    // Lấy thông tin từ form
    $_SESSION['Masp'] = $_POST['masp'];
    $_SESSION['Soluong'] = $_POST['soLuong'];

    if (isset($_SESSION['user_id'])) {
        echo '<script>window.location.href = "home.php?chon=thanhtoan&loai=muangay";</script>';
    } else {
        // Xử lý khi 'user_id' không tồn tại trong phiên
        echo '<script>alert("Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.");
        window.location.href = "dangnhap.php";
        </script>';
    }
}
?>




<body style="background-color: #D3D3D3;">
    <form id="formThemVaoGioHang" method="POST" action="">
        <div class="content-sp">
            <div class="hienthisanpham">
                <?php
                if (isset($_GET['id'])) {
                    $maSP = $_GET['id'];
                    $sql = "SELECT * FROM sanpham WHERE Masp=$maSP " ;
                    $rs = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_array($rs)) {
                        echo '<div class="photo-sp">
                            <img src="../../img/' . $row["Img"] . '" style="width: 80%; height: fit-content;">
                        </div>
                        <div class="thongtinsanpham">
<<<<<<< HEAD
                            <h1>' . $row["Tensp"] . '</h1>
                            <p> Giá bán: ' .  number_format($row["Giaban"],0,"",",") .' VND</p>
=======
                            <h1 id="tenSanPham">' . $row["Tensp"] . '</h1>
                            <div class="Gia"><p id="giaban">' . $row["Giaban"] . ' VND</p></div>
                            <hr class="line_sp">   
                            '.' <div class="infor_product">
                    <strong id="ThongSoText">Mô tả sản phẩm:</strong>
                    <div class="detail_infor">
                    ' .nl2br($row["Mota"]).'</div>
                            </div>   
>>>>>>> 487b7ad8cca016551434c04310a56e2c03c4919f
                            <div class="soLuong">
                                <P>Số lượng:</P>
                                <input type="hidden" name="masp" value="' . $maSP . '"> <!-- Trường ẩn chứa mã sản phẩm -->
                                <div class="soLuong-container">
                                    <button id="truButton" class="soLuong-button">-</button>
                                    <input id="soLuongInput" class="soLuong-input" type="number" min="1" value="1" name="soLuong" readonly>
                                    <button id="congButton" class="soLuong-button">+</button>
                                </div>
                            </div>
                            <div class="conLai">
                                <p>Còn lại:</p>
                                <div class="conLai-container">
                                    <input id="conLaiInput" class="conLai-input" type="number" value="' . $row["Soluongconlai"] . '" readonly>
                                </div>
                            </div>
                            
                            <div class="button_muahang">
                                <div class="themGioHang">
                                    <input type="submit" class="button_muahang_them" name="them" value="Thêm vào giỏ hàng">
                                </div>
                                <div class="muaNgay">
                                    <input type="submit" class="button_muahang_muangay" name="mua" value="Mua ngay">
                                </div>
                            </div>
                        </div>';
                    }
                }
                ?>
               
            </div>
        </div>
    </form>

    <script>
        const truButton = document.getElementById('truButton');
        const congButton = document.getElementById('congButton');
        soLuongInput = document.getElementById('soLuongInput');
        const conLaiInput = document.getElementById('conLaiInput');

        truButton.addEventListener('click', (event) => {
            event.preventDefault();
            let quantity = parseInt(soLuongInput.value);
            if (quantity > 1) {
                quantity--;
                soLuongInput.value = quantity;
            }
        });

        congButton.addEventListener('click', (event) => {
            event.preventDefault();
            let quantity = parseInt(soLuongInput.value);
            if (quantity < conLaiInput.value) {
                quantity++;
                soLuongInput.value = quantity;
            }


        });

        soLuongInput.addEventListener('change', (event) => {
            event.preventDefault();
            let quantity = parseInt(soLuongInput.value);
            if (quantity < 1) {
                quantity = 1;
            }
            soLuongInput.value = quantity;
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>