<?php
$con = mysqli_connect("localhost", "root", "", "bolashop");
mysqli_query($con, "set names 'utf8'");

$sql= "SELECT thuonghieu.* FROM sanpham, thuonghieu WHERE sanpham.Mathuonghieu = thuonghieu.Mathuonghieu GROUP BY thuonghieu.Mathuonghieu";
$result_query = mysqli_query($con, $sql);

$sqll = "SELECT Gioitinh FROM sanpham GROUP BY Gioitinh";
$rs_gt = mysqli_query($con,$sqll);
mysqli_close($con);
?>
<div class="banner" id="banner">   
</div>
<div class="content-title">
    <div class="page-noti">
        <h1>Trang chủ</h1>
    </div>
</div>
<div class="container">
    <form class="filter-tool" id="filter-tool" name="formFilter" method="POST">
        <h1>Bộ lọc</h1>
        <hr />
        
        <input type="text" class="search-bar" placeholder="Search..." name="txtSearch" />
        <h4>Thương hiệu</h4>
        <?php foreach($result_query as $key => $value) { ?>
        <input type="checkbox" class="category-checkbox"  id="brand" name="brand[]"  value="<?php echo $value["Mathuonghieu"]; ?>" />
        <label for="<?php echo $value["Mathuonghieu"]; ?>"><?php echo $value["tenThuonghieu"]; ?></label>
        <br />
        <?php } ?>
        <h4>Giới tính</h4>
        <?php foreach($rs_gt as $key => $value) { ?>
        <input type="checkbox"  class="gender-checkbox"id="gender" name="gender[]" value="<?php echo $value["Gioitinh"]; ?>" />
        <label for="<?php echo $value["Gioitinh"]; ?>"><?php echo $value["Gioitinh"]; ?></label><br />
        <?php } ?>
        <label for="">Mức giá Từ</label>
        <input type="number" class="min-price" name="txtTu" />
        <br>
        <label for="">Đến</label>
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