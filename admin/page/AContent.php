<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_GET['chon']) && isset($_GET['id'])) {
    if ($_GET['id'] == 'thongke') {
        include_once('./AThongke.php');
    } else if ($_GET['id'] == 'sanpham') {
        if (isset($_GET['loai'])) {
            if ($_GET['loai'] == 'them') {
                include_once('./themsp.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./suasanpham.php');
            }
        } else {
            include_once('./ASanpham.php');
        }
    } else if ($_GET['id'] == 'phieunhap') {
        include_once('./APhieunhap.php');
    } else if ($_GET['id'] == 'donhang') {
        include_once('./APhieuxuat.php');
    } else if ($_GET['id'] == 'nhacungcap') {
        if (isset($_GET['loai'])) {

            if ($_GET['loai'] == 'them') {
                include_once('./formNcc.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./formSuaNcc.php');
            }
        } else {
            include_once('./ANCC.php');
        }
    } else if ($_GET['id'] == 'nguoidung') {
        if (isset($_GET['loai'])) {
            if ($_GET['loai'] == 'them') {
                include_once('./themnguoidungmoi.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./suanguoidung.php');
            }
        } else {
            include_once('./ANguoidung.php');
        }
    } else if ($_GET['id'] == 'quyen') {
        if (isset($_GET['loai'])) {
            if ($_GET['loai'] == 'them') {
                include_once('./phanquyen.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./updatequyen.php');
            }
        } else {
            include_once('./AQuyen.php');
        }
    } else if ($_GET['id'] == 'khuyenmai') {
        if (isset($_GET['loai'])) {
            if ($_GET['loai'] == 'them') {
                include_once('./formThemKm.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./suamagiamgia.php');
            }
        } else {
            include_once('./AKhuyenmai.php');
        }
    } else if ($_GET['id'] == 'vanchuyen') {
        if (isset($_GET['loai'])) {
            if ($_GET['loai'] == 'them') {
                include_once('./formVanchuyen.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./formSuaVc.php');
            }
        } else {
            include_once('./AVanchuyen.php');
        }
    } else if ($_GET['id'] == 'thuonghieu') {
        if (isset($_GET['loai'])) {
            if ($_GET['loai'] == 'them') {
                include_once('./formThuonghieu.php');
            } else if ($_GET['loai'] == 'sua') {
                include_once('./suathuonghieu.php');
            }
        } else {
            include_once('./AThuonghieu.php');
        }
    }
} else {
    include_once('./AThongke.php');
}
