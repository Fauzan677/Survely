<?php
require 'function.php';

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Panggil fungsi hapusPostingan
    if (hapusPostingan($post_id)) {
        // Redirect ke halaman yang sesuai setelah penghapusan berhasil
        $_SESSION['flash_message_beli'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Postingan berhasil dihapus';
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: Tidak dapat menghapus postingan.";
    }
} else {
    echo "Error: post_id tidak ditemukan.";
}
