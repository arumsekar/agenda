<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">My Agenda</h1>
        <hr>
        <div class="d-flex justify-content-between mb-3">
            <a href="tambah.php" class="btn btn-success">Tambah Data</a>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-danger text-center">
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Lokasi</th>
                    <th>Agenda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php'; 
                $query = "SELECT * FROM tamu ORDER BY tanggal ASC"; 
                $result = $config->query($query);
                $no = 1;
                while ($row = $result->fetch_assoc()) { 
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['hari']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><?php echo $row['jam']; ?></td>
                        <td><?php echo $row['lokasi']; ?></td>
                        <td><?php echo $row['agenda']; ?></td>
                        <td>
                           <a href="edit.php?tanggal=<?php echo $row['tanggal']; ?>" class="btn btn-info mr-2">Edit</a>
                           <a href="hapus.php?tanggal=<?php echo $row['tanggal']; ?>"
                           onclick="return confirm('Apakah data dihapus?')" class="btn btn-danger">Delete</a>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php
        if (isset($_GET['halaman'])) {
            if ($_GET['halaman'] == "edit") {
                include 'edit.php';
            } elseif ($_GET['halaman'] == "hapus") {
                include 'hapus.php';
            }
        }
        ?>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
