<?php
require "../inc/config.php";

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    die("Data tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $status = $_POST['status'];

    $fileName = $data['cover'];

    if (!empty($_FILES['cover']['name'])) {
        $fileName = time() . "_" . basename($_FILES["cover"]["name"]);
        move_uploaded_file($_FILES["cover"]["tmp_name"], "../uploads/" . $fileName);
    }

    $update = $pdo->prepare("UPDATE books 
                             SET title=?, author=?, year=?, status=?, cover=? 
                             WHERE id=?");
    $update->execute([$title, $author, $year, $status, $fileName, $id]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h2>Edit Buku</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" value="<?= $data['title'] ?>" required>
        <input type="text" name="author" value="<?= $data['author'] ?>" required>
        <input type="number" name="year" value="<?= $data['year'] ?>" required>

        <select name="status" required>
            <option value="available" <?= $data['status'] === 'available' ? 'selected' : '' ?>>Tersedia</option>
            <option value="borrowed" <?= $data['status'] === 'borrowed' ? 'selected' : '' ?>>Dipinjam</option>
        </select>

        <label>Cover Lama:</label><br>
        <img src="../uploads/<?= $data['cover'] ?>" width="100"><br><br>

        <label>Ganti Cover:</label>
        <input type="file" name="cover">

        <button type="submit" class="button">Update</button>
    </form>

    <a href="index.php" class="button">Kembali</a>
</div>
</body>
</html>
