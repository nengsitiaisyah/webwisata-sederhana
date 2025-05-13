<?php
include 'koneksi.php';



// Ambil data pengunjung
$result = $conn->query("SELECT * FROM pengunjung");

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM pengunjung WHERE id=$id");
    header("Location: pengunjung.php");
    exit();
}
// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM pengunjung WHERE id=$id");
    if ($editResult->num_rows > 0) {
        $editData = $editResult->fetch_assoc();
    }
}
// Tambah atau update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];

    if ($id) {
        // Update data
        $sql = "UPDATE pengunjung SET nama='$nama', email='$email', tanggal_kunjungan='$tanggal_kunjungan' WHERE id=$id";
    } else {
        // Tambah data baru
        $sql = "INSERT INTO pengunjung (nama, email, tanggal_kunjungan) 
                VALUES ('$nama', '$email', '$tanggal_kunjungan')";
    }

    $conn->query($sql);
    header("Location: pengunjung.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Pengunjung</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Data Pengunjung</h2>
        <img src="uploads/prambanan.jpg" alt="Prambanan" width="100%" style="margin-bottom: 20px;">
        <form method="POST">
    <input type="hidden" name="id" value="<?= $editData ? $editData['id'] : '' ?>">
    <input type="text" name="nama" placeholder="Nama Pengunjung" required value="<?= $editData ? $editData['nama'] : '' ?>">
    <input type="email" name="email" placeholder="Email" required value="<?= $editData ? $editData['email'] : '' ?>">
    <input type="date" name="tanggal_kunjungan" required value="<?= $editData ? $editData['tanggal_kunjungan'] : '' ?>">
    <button type="submit"><?= $editData ? 'Update' : 'Tambah' ?></button>
    <?php if ($editData): ?>
    <a href="pengunjung.php" class="btn-batal"><i class="fas fa-times-circle"></i> Batal Edit</a>
<?php endif; ?>

    
</form>

        <table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Tanggal Kunjungan</th>
        <th class="aksi">Aksi</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['tanggal_kunjungan'] ?></td>
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
