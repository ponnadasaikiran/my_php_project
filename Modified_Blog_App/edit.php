<?php include 'auth.php'; include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM posts WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
    $stmt->bind_param("ssi", $_POST['title'], $_POST['content'], $id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<form method="post">
    Title: <input name="title" value="<?= $row['title'] ?>"><br>
    Content: <textarea name="content"><?= $row['content'] ?></textarea><br>
    <button type="submit">Update</button>
</form>
