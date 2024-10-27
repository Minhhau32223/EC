
<?php

require_once('../../role_check.php');
require_once('../../db_connect.php');

?>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../js/home.js"></script>
<div class="logo-bola">
    <b><a href="home.php"> <img src="../..///img//logo.png" alt="">   Điện Máy CHỢ NHỎ </a></b>
</div>

<div class="menu-toggle">
    <button onclick="toggleMenu()">Menu</button>
</div>

<div class="menu">

    <div class="option" id="product" onclick="bannerHide()" >
            <li><a href='#' class='category-link' data-idtl=""></a></a>Sản phẩm <i class="ti-angle-down"></i>
            <div class="submenu">
                <ul>
                <?php
    $con = mysqli_connect("localhost", "root", "", "bolashop");
    mysqli_query($con, "set names 'utf8'");


    $result = mysqli_query($con, "SELECT * FROM danhmuc");
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['Madanhmuc'];
        $name = $row['Tendanhmuc'];
        echo "<li class='option' id='$id' onclick='bannerHide()'><a data-idtl='$id' class='category-link' href='home.php?idtl=$id'>$name</a></li>";
    }



    mysqli_close($con)
    //  
    ?>
                </ul>
            </div>
        
        
        </li>
        </div>
   

    <li class="option" id="cart"><a href="home.php?chon=giohang" style="text-decoration: none; font-size: 16px; color: rgba(0, 0, 0,0.7);">Giỏ hàng <i class="ti-shopping-cart"></i></a></li>
    <?php if (isset($_SESSION['user_id'])) {
        $maND = $_SESSION['user_id'];

        $conn = mysqli_connect("localhost", "root", "", "bolashop");

        if (!$conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

        $sql = "SELECT img FROM nguoidung WHERE Manguoidung='$maND'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $imgSrc = $row["img"];
        } else {
            // Nếu không có dữ liệu ảnh, bạn có thể sử dụng ảnh mặc định hoặc hiển thị một tin nhắn cho người dùng
            $imgSrc = "path_to_default_image.jpg";
        }

        // Đóng kết nối CSDL
        mysqli_close($conn);
    }
    ?>

    <!-- Hiển thị hình ảnh trong thẻ <img> -->
    <div class="user-icon">
        <img src="../../img/<?php echo $imgSrc; ?>" alt="Avatar" class="avt">

        <div class="sub-menu">
            <ul>
                <?php
                // session_start();
                if (isset($_SESSION['user_id'])) {

                    $userData = $_SESSION['userdata'];
                    // Xuất thông tin người dùng trong một thẻ HTML
                    $conn = new Database();
                    $userAuth = new userAuth($conn);
                    $isAdmin = $userAuth->isAdmin();
                    $textadm="";
                    if(!$isAdmin) {
                        $textadm="hidden";
                    }  
                    echo '<li><a href="../../admin/page/AHome.php"   class="'.$textadm.'" >Trang quản trị</a></li>';
                    echo '<li><a href="home.php?chon=tttk">Thông tin tài khoản</a></li>';
                    echo '<li><a href="./logout.php">Đăng xuất</a></li>';
                } else {
                    // Nếu chưa đăng nhập
                    echo '<li><a href="./dangnhap.php">Đăng nhập</a></li>';
                    echo '<li><a href="./dangky.php">Đăng ký</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    // Kiểm tra trạng thái của session và tải lại trang nếu session không tồn tại
    if (!<?php echo json_encode(session_id()); ?>) {
        window.location.reload(true); // Tải lại trang một cách đầy đủ
    }

          $(document).ready(function() {
    function loadProducts(trang, danhmuc) {
        $.ajax({
            url: 'content.php',
            type: 'GET',
            data: {
                trang: trang,
                idtl: danhmuc,
                ajax: 1
            },
            success: function(response) {
                const data = JSON.parse(response);
                let productsHtml = '';
                data.products.forEach(product => {
                    productsHtml += `<div class='content-item' ><a href='home.php?chon=ctsp&id=${product.Masp}'>`;
                    productsHtml += `<div class='product-image'><img src='../../img/${product.Img}' alt=''></div>`;
                    productsHtml += `<h3>${product.Tensp}</h3>`;
                    productsHtml += `<p>Giá: ${product.Giaban} VND</p>`;
                    productsHtml += `</a></div>`;
                });
                productsHtml +=` <div class='page-segment'>
                
                </div>`;

                $('.content-container').html(productsHtml);
                let sotrang=parseInt(data.totalPages);
                let paginationHtml = '';
                for (let i = 1; i <= sotrang ; i++) {
                    paginationHtml += `<li><a href='#' class='page-link' data-trang='${i}' data-idtl='${danhmuc}'>${i}</a></li>`;
                }
                $('.page-segment').html(paginationHtml);
            }
        });
    }

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        const trang = $(this).data('trang');
        const danhmuc = $(this).data('idtl');
        loadProducts(trang, danhmuc);
    });

    $(document).on('click', '.category-link', function(e) {
   
        e.preventDefault();
        const danhmuc = $(this).data('idtl');
      
        loadProducts(1, danhmuc); // Load first page of the selected category
    });

    // Initial load
    loadProducts(1, '');
});


   
   


</script>


