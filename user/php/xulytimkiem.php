<?php 
$con = mysqli_connect("localhost", "root", "", "bolashop");
mysqli_query($con, "set names 'utf8'");

// Function to execute search query
function executeSearchQuery($con, $text_search, $min_price, $max_price, $categories, $gender) {
    $sql = "SELECT * FROM sanpham WHERE Tensp LIKE '%$text_search%' AND ( Giaban BETWEEN $min_price AND $max_price )  ";
    if (!empty($categories)) {
        $lenghtcate=count($categories);
        $sql.="AND (";
        for ($i=0; $i<$lenghtcate; $i++) {
            $sql.= " Mathuonghieu='".$categories[$i]."' OR";
            if($i==$lenghtcate-1){
                $sql=substr($sql,0,-2);
            }
        }
        $sql.=")";
        
    }
  // Xây dựng điều kiện cho nhiều giới tính
    if (!empty($gender)) {
        $lenghtcate=count($gender);
        $sql.="AND (";
        for ($i=0; $i<$lenghtcate; $i++) {
            $sql.= " Madanhmuc='".$gender[$i]."' OR";
            if($i==$lenghtcate-1){
                $sql=substr($sql,0,-2);
            }
        }
        $sql.=")";
    }

    return mysqli_query($con, $sql);
}

// Handle AJAX request
if(isset($_POST['data'])) {
    $text_search = $_POST['data'];
    $min_price = isset($_POST['min_price']) ? (int)$_POST['min_price'] : 0;
    $max_price = isset($_POST['max_price']) ? (int)$_POST['max_price'] : 999999999;
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
    $gender = isset($_POST['genders']) ? $_POST['genders'] : [];
    // var_dump($categories);
    // var_dump($gender);
    // Execute search query
    $query = executeSearchQuery($con, $text_search, $min_price, $max_price, $categories, $gender);

    // Display search results
    $num = mysqli_num_rows($query);
    if($num > 0) {
        while($row = mysqli_fetch_array($query)) {
            echo "<div class='content-item'><a href='home.php?chon=ctsp&id=" . $row['Masp'] . "'>";
            echo "<div class='product-image'><img src='../../img/" . $row['Img'] . "' alt=''></div>";
            echo "<h3>" . $row["Tensp"] . "</h3>";
            echo "<p>Giá: " . $row['Giaban'] . " VND</p>";
            echo "</a></div>";
        }
    } else {
        echo "Không tìm thấy sản phẩm phù hợp.";
        
    }
}

// Close connection
mysqli_close($con);
?>
