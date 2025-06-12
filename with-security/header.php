<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="posts.php">MyBlog</a>
    <div>
      <?php if (isset($_SESSION['username'])): ?>
        <span class="text-light me-3">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-outline-light">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container mt-4">