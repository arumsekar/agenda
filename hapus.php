<?php
include 'koneksi.php';

if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];

    if (empty($tanggal)) {
        echo "Tanggal tidak boleh kosong!";
        exit;
    }

    $query = "DELETE FROM tamu WHERE tanggal = ?";
    $stmt = $config->prepare($query);

    if (!$stmt) {
        die("Error dalam query: " . $config->error);
    }

    $stmt->bind_param("s", $tanggal);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Tanggal tidak ditemukan!";
}

$config->close();
?>
