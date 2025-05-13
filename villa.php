<?php
include 'koneksi.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Hapus juga foto dari folder (opsional)
    $getFoto = $conn->query("SELECT foto FROM villa WHERE id=$id");
    if ($getFoto->num_rows > 0) {
        $foto = $getFoto->fetch_assoc()['foto'];
        unlink("uploads/$foto");
    }

    $conn->query("DELETE FROM villa WHERE id=$id");
    header("Location: villa.php");
    exit();
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM villa WHERE id=$id");
    if ($editResult->num_rows > 0) {
        $editData = $editResult->fetch_assoc();
    }
}

// Tambah atau update data villa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nama = $_POST['nama'];
    $fasilitas = implode(", ", $_POST['fasilitas']);
    $harga = $_POST['harga'];
    $target_dir = "uploads/";

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    } else {
        $foto = isset($editData['foto']) ? $editData['foto'] : '';
    }

    if ($id) {
        // Update data
        $sql = "UPDATE villa SET nama='$nama', fasilitas='$fasilitas', harga='$harga', foto='$foto' WHERE id=$id";
    } else {
        // Tambah data baru
        $sql = "INSERT INTO villa (nama, fasilitas, harga, foto) VALUES ('$nama', '$fasilitas', '$harga', '$foto')";
    }

    $conn->query($sql);
    header("Location: villa.php");
    exit();
}


// Ambil semua data villa untuk ditampilkan
$result = $conn->query("SELECT * FROM villa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Villa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Data Villa</h2>
    <img src="uploads/prambanan.jpg" alt="Prambanan" width="100%" style="margin-bottom: 20px;">
    
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $editData ? $editData['id'] : '' ?>">
        <input type="text" name="nama" placeholder="Nama Villa" required value="<?= $editData ? $editData['nama'] : '' ?>">

        <label><input type="checkbox" name="fasilitas[]" value="AC" <?= $editData && strpos($editData['fasilitas'], 'AC') !== false ? 'checked' : '' ?>> AC</label>
        <label><input type="checkbox" name="fasilitas[]" value="WiFi" <?= $editData && strpos($editData['fasilitas'], 'WiFi') !== false ? 'checked' : '' ?>> WiFi</label>
        <label><input type="checkbox" name="fasilitas[]" value="Kolam Renang" <?= $editData && strpos($editData['fasilitas'], 'Kolam Renang') !== false ? 'checked' : '' ?>> Kolam Renang</label>
        <label><input type="checkbox" name="fasilitas[]" value="Parkir" <?= $editData && strpos($editData['fasilitas'], 'Parkir') !== false ? 'checked' : '' ?>> Parkir</label>
        <label><input type="checkbox" name="fasilitas[]" value="Dapur" <?= $editData && strpos($editData['fasilitas'], 'Dapur') !== false ? 'checked' : '' ?>> Dapur</label>

        <input type="number" name="harga" placeholder="Harga per malam" required value="<?= $editData ? $editData['harga'] : '' ?>">
        <input type="file" name="foto" accept="image/*" <?= $editData ? '' : 'required' ?>>

        <button type="submit"><?= $editData ? 'Update' : 'Tambah' ?></button>
        <?php if ($editData): ?>
            <a href="villa.php" class="btn-batal"><i class="fas fa-times-circle"></i> Batal Edit</a>
        <?php endif; ?>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Villa</th>
            <th>Fasilitas</th>
            <th>Harga</th>
            <th>Foto</th>
            <th class="aksi">Aksi</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['fasilitas'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><img src="uploads/<?= $row['foto'] ?>" alt="<?= $row['nama'] ?>" width="100"></td>
            <td class="aksi">
                <a href="?edit=<?= $row['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i>Edit</a>
                <a href="?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i>Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
