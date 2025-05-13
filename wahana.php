<?php
include 'koneksi.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM wahana WHERE id=$id");
    header("Location: wahana.php");
    exit();
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM wahana WHERE id=$id");
    if ($editResult->num_rows > 0) {
        $editData = $editResult->fetch_assoc();
    }
}

// Tambah atau update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    if ($id) {
        // Update
        $sql = "UPDATE wahana SET nama='$nama', deskripsi='$deskripsi', harga='$harga' WHERE id=$id";
    } else {
        // Tambah baru
        $sql = "INSERT INTO wahana (nama, deskripsi, harga) VALUES ('$nama', '$deskripsi', '$harga')";
    }

    $conn->query($sql);
    header("Location: wahana.php");
    exit();
}

// Ambil semua data
$result = $conn->query("SELECT * FROM wahana");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Wahana</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Data Wahana</h2>
    <img src="uploads/prambanan.jpg" alt="Prambanan" width="100%" style="margin-bottom: 20px;">

    <form method="POST">
        <input type="hidden" name="id" value="<?= $editData ? $editData['id'] : '' ?>">
        <input type="text" name="nama" placeholder="Nama Wahana" required value="<?= $editData ? $editData['nama'] : '' ?>">
        <textarea name="deskripsi" placeholder="Deskripsi Wahana" required><?= $editData ? $editData['deskripsi'] : '' ?></textarea>
        <input type="number" name="harga" placeholder="Harga Wahana" required value="<?= $editData ? $editData['harga'] : '' ?>">
        <button type="submit"><?= $editData ? 'Update' : 'Tambah' ?></button>
        <?php if ($editData): ?>
            <a href="wahana.php" class="btn-batal"><i class="fas fa-times-circle"></i> Batal Edit</a>
        <?php endif; ?>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Wahana</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['deskripsi'] ?></td>
            <td><?= number_format($row['harga'], 0, ',', '.') ?> IDR</td>
            <td class="aksi">
                <a href="?edit=<?= $row['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                <a href="?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
