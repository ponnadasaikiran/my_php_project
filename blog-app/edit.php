<?php include 'auth.php'; include 'db.php'; ?>

<?php
$id = $_GET["id"];
$post = $conn->query("SELECT * FROM posts WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST["title"], $_POST["content"], $id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<h2>Edit Post</h2>
<form method="post">
    Title: <input name="title" value="<?= $post['title'] ?>" required><br>
    Content: <textarea name="content" required><?= $post['content'] ?></textarea><br>
    <button type="submit">Update</button>
</form>