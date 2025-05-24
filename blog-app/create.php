<?php include 'auth.php'; include 'db.php'; ?>

<h2>Create New Post</h2>
<form method="post">
    Title: <input name="title" required><br>
    Content: <textarea name="content" required></textarea><br>
    <button type="submit">Publish</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST["title"], $_POST["content"]);
    $stmt->execute();
    header("Location: index.php");
}
?>