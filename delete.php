<?php
    include "koneksi.php";
    // Mengambil ID data yang akan dihapus
    $kode = $_GET['kode_pelanggan'];
    
    // Menghapus data dari database
    $query = "DELETE FROM data_training WHERE kode_pelanggan='$kode'";
    mysqli_query($koneksi, $query);
    
    // Mengarahkan kembali ke halaman utama
    header("Location: inputAdmin.php");
?>