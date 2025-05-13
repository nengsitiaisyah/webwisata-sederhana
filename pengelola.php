<?php
include 'koneksi.php';

// Ambil data pengelola
$result = $conn->query("SELECT * FROM pengelola");

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM pengelola WHERE id=$id");
    header("Location: pengelola.php");
    exit();
}
// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM pengelola WHERE id=$id");
    if ($editResult->num_rows > 0) {
        $editData = $editResult->fetch_assoc();
    }
}
// Tambah atau update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    

    if ($id) {
        // Update data
        $sql = "UPDATE pengelola SET nama='$nama', kontak='$kontak' WHERE id=$id";
    } else {
        // Tambah data baru
        $sql = "INSERT INTO pengelola (nama, kontak) 
                VALUES ('$nama', '$kontak')";
    }

    $conn->query($sql);
    header("Location: pengelola.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengelola</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Data Pengelola</h2>
        <img src="uploads/prambanan.jpg" alt="Prambanan" width="100%" style="margin-bottom: 20px;">
        <form method="POST">
    <input type="hidden" name="id" value="<?= $editData ? $editData['id'] : '' ?>">
    <input type="text" name="nama" placeholder="Nama Pengelola" required value="<?= $editData ? $editData['nama'] : '' ?>">
    <input type="text" name="kontak" placeholder="Kontak" required value="<?= $editData ? $editData['kontak'] : '' ?>">
    <button type="submit"><?= $editData ? 'Update' : 'Tambah' ?></button>

    <?php if ($editData): ?>
        <a href="pengelola.php" class="btn-batal"><i class="fas fa-times-circle"></i> Batal Edit</a>
    <?php endif; ?>
</form>


        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th class="aksi">Aksi</th>

            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['kontak'] ?></td>
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
