<?php
require '../inc/config.php';
require '../class/Database.php';
require '../class/Book.php';

$db = new Database($conn);
$book = new Book($db->getConnection());

$id = $_GET['id'];

$book->delete($id);

header("Location: 1_index.php");
exit;
