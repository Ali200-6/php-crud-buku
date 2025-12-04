<?php
require "../inc/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $status = $_POST['status'];

    // Upload file
    $fileName = "";
    if (!empty($_FILES['cover']['name'])) {
        $fileName = time() . "_" . basename($_FILES["cover"]["name"]);
        move_uploaded_file($_FILES["cover"]["tmp_name"], "../uploads/" . $fileName);
    }

    $stmt = $pdo->prepare("INSERT INTO books (title, author, year, status, cover) 
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $year, $status, $fileName]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Buku</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Judul Buku" required>
        <input type="text" name="author" placeholder="Penulis" required>
        <input type="number" name="year" placeholder="Tahun Terbit" required>

        <select name="status" required>
            <option value="available">Tersedia</option>
            <option value="borrowed">Dipinjam</option>
        </select>

        <label>Upload Cover:</label>
        <input type="file" name="cover">

        <button type="submit" class="button">Simpan</button>
    </form>

    <a href="index.php" class="button">Kembali</a>
</div>
</body>
</html>
