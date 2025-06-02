<?php include 'auth.php'; include 'db.php'; ?>
<form method="post">
    Title: <input name="title"><br>
    Content: <textarea name="content"></textarea><br>
    <button type="submit">Create</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['title'], $_POST['content']);
    $stmt->execute();
    header("Location: index.php");
}
?>
