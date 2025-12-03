<?php
require '../inc/config.php';
require '../class/Database.php';
require '../class/Book.php';

$db = new Database($conn);
$book = new Book($db->getConnection());
$books = $book->getAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Book List</h2>
<a href="2_create.php">Add New Book</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Year</th>
        <th>Status</th>
        <th>Cover</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($books as $row): ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td><?= $row['title']; ?></td>
        <td><?= $row['year']; ?></td>
        <td><?= $row['status']; ?></td>
        <td>
            <?php if ($row['cover']): ?>
                <img src="../uploads/<?= $row['cover']; ?>" width="80">
            <?php endif; ?>
        </td>
        <td>
            <a href="3_edit.php?id=<?= $row['id']; ?>">Edit</a>
            <a href="4_delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
