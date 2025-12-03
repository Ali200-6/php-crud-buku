<?php
require '../inc/config.php';
require '../class/Database.php';
require '../class/Book.php';
require '../class/Utility.php';

$db = new Database($conn);
$book = new Book($db->getConnection());

$id = $_GET['id'];
$data = $book->getById($id);

if (!$data) {
    die("Data tidak ditemukan");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cover = $data['cover'];

    if (!empty($_FILES['cover']['name'])) {
        $cover = Utility::uploadFile($_FILES['cover']);
    }

    $update = [
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'status' => $_POST['status'],
        'cover' => $cover
    ];

    $book->update($id, $update);

    header("Location: 1_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Edit Book</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Title:</label><br>
    <input type="text" name="title" value="<?= $data['title'] ?>" required><br><br>

    <label>Year:</label><br>
    <input type="number" name="year" value="<?= $data['year'] ?>" required><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="available" <?= $data['status']=="available"?"selected":"" ?>>Available</option>
        <option value="unavailable" <?= $data['status']=="unavailable"?"selected":"" ?>>Unavailable</option>
    </select><br><br>

    <label>Old Cover:</label><br>
    <img src="../uploads/<?= $data['cover'] ?>" width="80"><br><br>

    <label>New Cover (optional):</label><br>
    <input type="file" name="cover"><br><br>

    <button type="submit">Update</button>

</form>

</body>
</html>
