<?php
require '../inc/config.php';
require '../class/Database.php';
require '../class/Book.php';
require '../class/Utility.php';

$db = new Database($conn);
$book = new Book($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cover = Utility::uploadFile($_FILES['cover']);

    $data = [
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'status' => $_POST['status'],
        'cover' => $cover
    ];

    $book->create($data);
    header("Location: 1_index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>

<h2>Create Book</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Year:</label><br>
    <input type="number" name="year" required><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="available">Available</option>
        <option value="unavailable">Unavailable</option>
    </select><br><br>

    <label>Cover:</label><br>
    <input type="file" name="cover"><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
