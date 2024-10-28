<?php 
$con = mysqli_connect("localhost", "root", "", "bolashop");
mysqli_query($con, "set names 'utf8'");

// Function to execute search query
function executeSearchQuery($con, $text_search) {
    // Chỉ tìm kiếm theo tên sản phẩm
    $sql = "SELECT * FROM sanpham WHERE Tensp LIKE '%$text_search%'";
    return mysqli_query($con, $sql);
}

// Handle AJAX request
if (isset($_POST['data'])) {
    $text_search = $_POST['data'];

    // Execute search query
    $query = executeSearchQuery($con, $text_search);

    // Display search results
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        while ($row = mysqli_fetch_array($query)) {
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
