<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
// Khởi đầu session
session_start();

// Hủy toàn bộ dữ liệu session
session_destroy();
echo "<script>window.location.href = 'home.php';</script>";
exit(); // Dừng kịch bản tiếp tục thực thi sau khi chuyển hướng
?>
