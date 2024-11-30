<?php
// Koneksi ke database
$host = "localhost";
$username = "cond7572_root";
$password = "UDTyT)],K*Cg";
$database = "cond7572_login";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan nilai slider dari request
if (isset($_POST['slider_value'])) {
    $slider_value = intval($_POST['slider_value']);
    date_default_timezone_set('Asia/Makassar');
    $jam = date("h:i:s A");

    // Query untuk mengupdate nilai slider di tabel dataArduino
    $sqlUpdate = "UPDATE dataarduino SET slider_value = $slider_value WHERE id = 1";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Record updated successfully";

        // Cek jumlah data di tabel dataHistory kecuali data dengan nilai 0
        $sqlCount = "SELECT COUNT(*) AS total FROM dataHistory WHERE slider_value != 0";
        $countResult = $conn->query($sqlCount);
        $countRow = $countResult->fetch_assoc();
        $totalRecords = $countRow['total'];

        // Jika jumlah record (tanpa nilai 0) sudah 10, hapus data paling lama (tanpa menghapus nilai 0)
        if ($totalRecords >= 10) {
            $sqlDeleteOldest = "DELETE FROM dataHistory WHERE slider_value != 0 ORDER BY id ASC LIMIT 1";
            if ($conn->query($sqlDeleteOldest) === TRUE) {
                echo "Oldest non-zero record deleted successfully.<br>";
            } else {
                echo "Error deleting oldest record: " . $conn->error . "<br>";
            }
        }

        // Cek apakah sudah ada entri dengan nilai 0
        $sqlCheckZero = "SELECT COUNT(*) AS zeroCount FROM dataHistory WHERE slider_value = 0";
        $zeroCountResult = $conn->query($sqlCheckZero);
        $zeroCountRow = $zeroCountResult->fetch_assoc();

        // Hanya masukkan nilai 0 jika belum ada di tabel
        if ($zeroCountRow['zeroCount'] == 0) {
            // Jika tidak ada, masukkan nilai 0
            $sqlInsertZero = "INSERT INTO dataHistory (waktu, slider_value) VALUES ('$jam', 0)";
            if ($conn->query($sqlInsertZero) === TRUE) {
                echo "Zero value inserted into dataHistory.<br>";
            } else {
                echo "Error inserting zero value: " . $conn->error . "<br>";
            }
        }

        // Masukkan nilai slider terbaru ke dataHistory hanya jika tidak sama dengan 0
        if ($slider_value != 0) {
            $sqlInsert = "INSERT INTO dataHistory (waktu, slider_value) VALUES ('$jam', $slider_value)";
            if ($conn->query($sqlInsert) === TRUE) {
                echo "New record inserted into dataHistory successfully.<br>";
            } else {
                echo "Error inserting new record: " . $conn->error . "<br>";
            }
        }
    } else {
        echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
    }
}

$conn->close();
