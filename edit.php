<?php
include 'koneksi.php';

if (isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal']; 

    
    $query = "SELECT * FROM tamu WHERE tanggal = ?";
    $stmt = $config->prepare($query);
    $stmt->bind_param("s", $tanggal);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }

    $stmt->close();
} else {
    echo "Tanggal tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hari = $_POST['hari'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $lokasi = $_POST['lokasi'];
    $agenda = $_POST['agenda'];

    
    if (empty($hari) || empty($tanggal) || empty($jam) || empty($lokasi) || empty($agenda)) {
        echo "Semua field harus diisi!";
        exit;
    }

   
    $updateQuery = "UPDATE tamu SET hari = ?, tanggal = ?, jam = ?, lokasi = ?, agenda = ? WHERE tanggal = ?";
    $stmt = $config->prepare($updateQuery);
    
    if (!$stmt) {
        die("Error dalam query: " . $config->error);
    }

    $stmt->bind_param("ssssss", $hari, $tanggal, $jam, $lokasi, $agenda, $row['tanggal']);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
}

$config->close();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-box">
            <h2>Edit Data</h2>
            <form action="edit.php?tanggal=<?php echo $row['tanggal']; ?>" method="POST">
                <div class="mb-3">
                    <label for="hari" class="form-label">Hari:</label>
                    <input type="text" id="hari" name="hari" class="form-control" value="<?php echo $row['hari']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo $row['tanggal']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="jam" class="form-label">Jam:</label>
                    <input type="time" id="jam" name="jam" class="form-control" value="<?php echo $row['jam']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi:</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control" value="<?php echo $row['lokasi']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="agenda" class="form-label">Agenda:</label>
                    <input type="text" id="agenda" name="agenda" class="form-control" value="<?php echo $row['agenda']; ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
