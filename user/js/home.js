function filterTool(){
    
   
    var filter = document.getElementById("filter-tool");
  
    if (filter.style.display === "none") {
      filter.style.display = "block";
      
    } else {
    filter.style.display = "none"; 
    } 
}
function bannerHide() {
  var banner = document.getElementById("banner");
  var h1Element = document.querySelector(".page-noti h1");
  
  if (banner.style.display === "none") {

    banner.style.display = "block";
    h1Element.textContent = "Trang chủ"; 
  } else {
  
    banner.style.display = "none"; 
    h1Element.textContent = "Tất cả sản phẩm";
  } 
}

function toggleMenu() {
  var menu = document.querySelector('.menu');
  menu.classList.toggle('open');
}

// $(document).ready(function () {
//   function loadProduct(page, category) {
//     $.ajax({
//       url: 'middleContent.php',
//       type: 'GET',
//       data: {trang:page, idlt:category},
//       success:function(data){
//         $('.content-container').append(data);
//       }
//     });
    
//   }
  

// $(document).on('click', '.page-segment a', function(e) {
//   e.preventDefault();
//   const page = $(this).data('trang');
//   const category = '<?php echo $danhMuc; ?>';
//   loadProducts(page, category);
// });


// loadProducts(1, '<?php echo $danhMuc; ?>');
// });