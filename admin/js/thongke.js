$(document).ready(function() {
    $('#filter-button').click(function(e) {
        e.preventDefault(); // Ngăn chặn hành động mặc định của nút

        var formData = $('#topsells-form').serialize(); // Thu thập dữ liệu từ form

        $.ajax({
            type: 'POST',
            url: 'xulyLocthongke.php', // Đường dẫn tới tập tin xử lý yêu cầu AJAX
            data: formData, // Dữ liệu gửi đi
            success: function(data) {
                $('.table-container').html(data); // Cập nhật nội dung của bảng
            }
        });
    });
});