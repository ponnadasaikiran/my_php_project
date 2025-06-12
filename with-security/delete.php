<?php
include 'db.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "Access Denied.";
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: posts.php");
exit();
