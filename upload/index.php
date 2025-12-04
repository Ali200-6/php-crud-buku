<?php
require "../inc/config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h2>Daftar Buku</h2>
    <a href="create.php" class="button">Tambah Buku</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Status</th>
            <th>Cover</th>
            <th>Aksi</th>
        </tr>

        <?php
        $stmt = $pdo->query("SELECT * FROM books");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if ($row['cover']): ?>
                    <img src="../uploads/<?= $row['cover'] ?>" alt="cover">
                <?php endif; ?>
            </td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="button">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="button-danger"
                   onclick="return confirm('Hapus data?');">
                   Delete
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
