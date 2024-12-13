<?php
$con = mysqli_connect("localhost", "root", "", "bolashop");
mysqli_query($con, "set names 'utf8'");

$sql= "SELECT thuonghieu.* FROM sanpham, thuonghieu WHERE sanpham.Mathuonghieu = thuonghieu.Mathuonghieu GROUP BY thuonghieu.Mathuonghieu";
$result_query = mysqli_query($con, $sql);

$sqll = "SELECT danhmuc.* FROM sanpham,danhmuc WHERE sanpham.Madanhmuc=danhmuc.Madanhmuc GROUP BY danhmuc.Madanhmuc";
$rs_dm = mysqli_query($con,$sqll);
mysqli_close($con);
?>
<div class="background_transfer_container" id="banner">   
<div class="background_transfer">
              <div class="background_transfer_img"><img src="../../img/banner/tuyet-chieu-tiet-kiem-dien-cho-thiet-bi-gia-dung-1.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="../../img/banner/do-gia-dung-2.png" alt=""></div>
              <div class="background_transfer_img"><img src="../../img/banner/pngtree-assortment-of-home-appliances-on-a-white-background-rendered-in-3d-picture-image_5826208.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="../../img/banner/bìa.jpg" alt=""></div>
              <div class="background_transfer_img"><img src="../../img/banner/31.jpg" alt=""></div>
            </div>
            <div class="background_transfer_button">
              <button id="slide_prev"><</button>
              <button id="slide_next">></button>
            </div>
            <ul class="dots">
              <li class="active"></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
</div>
<div class="anhhai" style="margin-top: 50px;">
            <div class="baophuallcai">
                <div class="home-item">
                    <div class="home-item-icon">
                        <i class="ti-truck"></i>
                    </div>
                    <div class="home-item-content">
                        <h4>UY TÍN, ĐẢM BẢO</h4>
                        <p>- Nhập hàng chính hãng</p>
                        <p>- Giao hàng nhanh chóng</p>
                        <!-- <p>Uy tín và đảm bảo</p> -->
                    </div>
                </div>
    
                <div class="home-item">
                    <div class="home-item-icon">
                        <i class="ti-heart"></i>
                    </div>
                    <div class="home-item-content">
                        <h4>SẢN PHẨM CHẤT LƯỢNG</h4>
                        <p>- Công nghệ hiện đại</p>  
                        <p>- Đạt chuẩn quốc tế</p>  
                    </div>
                </div>
    
                <div class="home-item">
                    <div class="home-item-icon">
                        <i class="ti-headphone"></i>
                    </div>
                    <div class="home-item-content">
                        <h4>HỖ TRỢ 24/24</h4>
                        <p>- Phản hồi nhanh chóng</p>
                        <p>- Tận tâm, nhiệt tình</p>                  
                    </div>
                </div>
    
                <div class="home-item">
                    <div class="home-item-icon">
                        <i class="ti-money"></i>        
                    </div>
                    <div class="home-item-content">
                        <h4>CAM KẾT HOÀN TIỀN</h4>
                        <p>- Chính sách minh bạch</p>
                        <p>- Hoàn toàn miễn phí</p>
                    </div>
                </div>
            </div>
        </div>
<div class="content-title">
    <div class="page-noti">
        <h1>Trang chủ</h1>
    </div>
</div>
<div class="container">
    <form class="filter-tool" id="filter-tool" name="formFilter" method="POST">
        <h1>Tìm kiếm theo</h1>
        <hr />
        <input type="text" class="search-bar" placeholder="Search..." name="txtSearch" />
        <h4>Thương hiệu</h4>
        <?php foreach($result_query as $key => $value) { ?>
        <input type="checkbox" class="category-checkbox"  id="brand" name="brand[]"  value="<?php echo $value["Mathuonghieu"]; ?>" />
        <label for="<?php echo $value["Mathuonghieu"]; ?>"><?php echo $value["tenThuonghieu"]; ?></label>
        <br />
        <?php } ?>
        <h4>Danh mục</h4>
        <?php foreach($rs_dm as $key => $value) { ?>
        <input type="checkbox"  class="gender-checkbox"id="gender" name="gender[]" value="<?php echo $value["Madanhmuc"]; ?>" />
        <label for="<?php echo $value["Madanhmuc"]; ?>"><?php echo $value["Tendanhmuc"]; ?></label><br />
        <?php } ?>
        <label class="mucgia" for="">Mức giá từ</label>
        <input type="number" class="min-price" name="txtTu" />
        <br>
        <label class="mucgia" for="">Đến </label>
        <input type="number" class="max-price" name="txtDen" />
            <button class="btn-timkiem-nangcao" type="button">Tìm kiếm</button>
        <br />
        <br />
        <br />

    </form>
    <div class="content-container">
        <div class='page-segment'>
        </div>
    </div>

    <script type="text/javascript">
        let slide_list = document.querySelector(
  ".background_transfer_container .background_transfer"
);
let slide_list_img = document.querySelectorAll(
  ".background_transfer_container .background_transfer .background_transfer_img"
);
let slide_prev = document.getElementById("slide_prev");
let slide_next = document.getElementById("slide_next");
let dots = document.querySelectorAll(".background_transfer_container .dots li");
let isactive = 0;
slide_next.onclick = function () {
  isactive++;
  if (isactive > slide_list_img.length - 1) {
    isactive = 0;
  }
  transfer();
};
slide_prev.onclick = function () {
  isactive--;
  if (isactive < 0) {
    isactive = slide_list_img.length - 1;
  }
  transfer();
};
function transfer() {
  let checkindex = slide_list_img[isactive].offsetLeft;
  slide_list.style.left = -checkindex + "px";
  let isactivedots = document.querySelector(
    ".background_transfer_container .dots li.active"
  );
  isactivedots.classList.remove("active");
  dots[isactive].classList.add("active");
}
dots.forEach((li, key) => {
  li.addEventListener("click", function () {
    isactive = key;
    transfer();
  });
});
let refresh = setInterval(() => slide_next.click(), 5000);
$(document).ready(function() {
    $('.btn-timkiem-nangcao').on('click', function() {
        var textsearch = $('.search-bar').val();
        var minPrice = $('.min-price').val();
        var maxPrice = $('.max-price').val();
        var categories = [];
        var genders = [];
        
        if(minPrice=="")
        {
            minPrice=0;
        }
        if(maxPrice=="")
        {
            maxPrice=9999999999;
        }
        console.log(textsearch);
        console.log(minPrice);
        console.log(maxPrice);
        console.log(categories);
        console.log(genders);
        $('.category-checkbox:checked').each(function() {
            categories.push($(this).val());
        });
        $('.gender-checkbox:checked').each(function() {
            genders.push($(this).val());
        });

        $.ajax({
            url: 'xulytimkiem.php',
            type: 'POST',
            data: {
                data: textsearch,
                min_price: minPrice,
                max_price: maxPrice,
                categories: categories,
                genders: genders
            },
            dataType: 'html',
            success: function(data) {
                $('.content-container').html(data);
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText); // Hiển thị thông báo lỗi trong console
            }
        });
    });
});

    
</script>
    <!-- <div id="product-details-container"></div> -->