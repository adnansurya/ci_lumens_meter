<?php
// Koneksi database
$host = "localhost";
$username = "cond7572_root";
$password = "UDTyT)],K*Cg";
$database = "cond7572_login";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}

// Menerima request AJAX untuk menghapus data
if (isset($_POST['tabel']) && $_POST['tabel'] === 'all') {
    $tabel = $_POST['tabel'];

    // Hapus semua data di tabel yang diterima dari request
    $query_hapus = "DELETE FROM table_data";
    if (mysqli_query($conn, $query_hapus)) {
        // Setelah menghapus semua data, reset auto-increment
        $query_reset = "ALTER TABLE table_data AUTO_INCREMENT = 1";
        if (mysqli_query($conn, $query_reset)) {
            echo 'success';  // Kirim respons sukses ke AJAX
        } else {
            echo 'error: ' . mysqli_error($conn);  // Kirim error jika gagal reset auto-increment
        }
    } else {
        echo 'error: ' . mysqli_error($conn);  // Kirim error jika gagal menghapus data
    }

} else {
    echo 'error: No table specified';  // Jika tidak ada tabel dikirim, kirim error
}

mysqli_close($conn);
?>
